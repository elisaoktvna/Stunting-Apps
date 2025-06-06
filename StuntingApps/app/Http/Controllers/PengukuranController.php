<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Edukasi;
use App\Models\Pengukuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PengukuranController extends Controller
{
    // public function index() {
    //     $pengukuran = Pengukuran::with('anak')->latest()->get();
    //     return view ('pengukuran.pengukuran', compact('pengukuran'));
    // }

    public function index()
    {
        if (auth()->guard('web')->check()) {
            $pengukuran = Pengukuran::with('anak')->latest()->get();
            return view('pengukuran.pengukuran', compact('pengukuran'));
        } elseif (auth()->guard('ortu')->check()) {
            $idOrtu = auth()->guard('ortu')->id();
            $anakList = Anak::with(['pengukuran' => function ($q) {
                $q->orderBy('created_at', 'desc');
            }])->where('id_orangtua', $idOrtu)->get();

            return view('pengukuran.pengukuranortu', compact('anakList'));
        }
    }


    public function create(){
        $anak = Anak::where('status', 'diterima')->get();
        return view('pengukuran.addpengukuran', compact('anak'));
    }

   public function createByOrtu($id)
    {
        $anak = Anak::where('id', $id)
                    ->where('status', 'diterima')
                    ->where('id_orangtua', auth()->guard('ortu')->id())
                    ->firstOrFail();

        return view('pengukuran.pengukuranbyortu', compact('anak'));
    }



    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'id_anak' => 'required|exists:anak,id',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'usia_bulan' => 'required|integer',
        ]);

        // Mengambil data anak dan jenis kelamin
        $anak = Anak::find($validatedData['id_anak']);
        $jenis_kelamin = $anak->jenis_kelamin;

        // Kirim data ke Flask API
        $response = Http::post('http://localhost:5000/predict_gizi', [
            'jenis_kelamin' => $jenis_kelamin,
            'tinggi_badan_cm' => $request->tinggi,
            'berat_badan_kg' => $request->berat,
            'umur_bulan' => $request->usia_bulan,

        ]);

        // Periksa apakah response berhasil
        if (!$response->successful()) {
            return back()->with('error', 'Gagal prediksi cek koneksi model flask');
        }

        $result = $response->json();

            // Simpan pengukuran
        $pengukuran = Pengukuran::create([
            'id_anak' => $request->id_anak,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'usia_bulan' => $request->usia_bulan,
            'zs_tbu' => $result['zscore_tb_u'] ?? null,
            'hasil' => $result['hasil_model'] ?? null,
            'bmi' => $result['bmi'] ?? null,
            'zs_bmi_u' => $result['zscore_bmi_u'] ?? null,
            'status_gizi_bmi' => $result['status_gizi_bmi'] ?? null,
        ]);

        $kategori = $result['hasil_model'] ?? null;

        if($kategori) {
            $template = DB::table('template_edukasi')->where('kategori', $kategori)->first();

            if ($template) {
                Edukasi::create([
                    'id_anak' => $validatedData['id_anak'],
                    'id_pengukuran' => $pengukuran->id,
                    'judul' => $template->judul,
                    'content' => $template->content,
                    'kategori' => $template->kategori,
                    'image' => $template->image,
                ]);
            }
        }

        return redirect('/pengukuran')->with('success', 'Data pengukuran berhasil disimpan!');


    }
}
