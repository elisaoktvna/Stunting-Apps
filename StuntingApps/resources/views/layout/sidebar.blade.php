<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">



      @auth('web')

      <li class="nav-item">
        <a class="nav-link collapsed" href="/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/kecamatan">
          <i class="bi bi-pin-map-fill"></i>
          <span>Kecamatan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin">
          <i class="bi bi-person-circle"></i>
          <span>Pengguna</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/ortu">
          <i class="bi bi-people"></i>
          <span>Orang Tua</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/anak">
          <i class="bi bi-menu-button-wide"></i>
          <span>Data Anak</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/pengukuran">
          <i class="bi bi-graph-up"></i>
          <span>Pengukuran</span>
        </a>
      </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="/templateedukasi">
          <i class="bi bi-file-play-fill"></i>
          <span>Template Edukasi</span>
        </a>
      </li>

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="/edukasi">
          <i class="bi bi-menu-up"></i>
          <span>Edukasi</span>
        </a>
      </li> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" href="/faskes">
          <i class="bi bi-bag-plus"></i>
          <span>Faskes</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/paketgizi">
          <i class="bi bi-inboxes"></i>
          <span>Tempat Paket Gizi</span>
        </a>
      </li>
      @endauth

      @auth('ortu')
       <li class="nav-item">
        <a class="nav-link collapsed" href="/dashboard-ortu">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="/anak">
            <i class="bi bi-menu-button-wide"></i>
            <span>Data Anak</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/pengukuran">
            <i class="bi bi-graph-up"></i>
            <span>Pengukuran</span>
            </a>
        </li>
      @endauth


    </ul>

</aside>
