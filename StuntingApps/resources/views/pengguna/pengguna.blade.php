@extends('layout.app');
@section('content')
<div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Admin</h5>
            <p>Berikut merupakan detail dari data admin </p>
            @if(session('success'))
            <div class="alert alert-info">
                {{ session('success') }}
            </div>
            @endif
            <!-- Table with stripped rows -->
            <a href="/addadmin" class="btn btn-success mb-3">Tambah Data Admin</a>
            <table class="table datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admin as $p )
                <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $p->name}}</td>
                    <td>{{ $p->email}}</td>
                    <td>{{ $p->role}}</td>
                    <td>
                        <form action="/deleteadmin/{{ $p->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bx bxs-trash"></i></button>
                        </form>

                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
