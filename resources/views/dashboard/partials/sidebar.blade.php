<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
  <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
    <i class="fe fe-x"><span class="sr-only"></span></i>
  </a>
  <nav class="vertnav navbar navbar-light">
    <!-- nav bar -->
    <div class="w-100 mb-4 d-flex">
      <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/dashboard">
        <img src="{{ asset('dashboard-assets/assets/images/logo-pav.png') }}" width="40px" alt="">
      </a>
    </div>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="/dashboard" class="nav-link">
          <i class="fe fe-home fe-16"></i>
          <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
        </a>
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="#komoditas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-gift fe-16"></i>
          <span class="ml-3 item-text">Komoditas</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="komoditas">
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/data-rekomendasi"><span class="ml-1 item-text">Rekomendasi Tanaman</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/data-komoditas"><span class="ml-1 item-text">Data Tabel Komoditas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/tambah-data-komoditas"><span class="ml-1 item-text">Tambah Data</span></a>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#artikel" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-layout fe-16"></i>
          <span class="ml-3 item-text">Artikel</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="artikel">
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/data-artikel"><span class="ml-1 item-text">Data Tabel Artikel</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/tambah-data-artikel"><span class="ml-1 item-text">Tambah Data</span></a>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#video" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-youtube fe-16"></i>
          <span class="ml-3 item-text">Video</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="video">
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/data-video"><span class="ml-1 item-text">Data Tabel Video</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/tambah-data-video"><span class="ml-1 item-text">Tambah Data</span></a>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#produk" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-shopping-bag fe-16"></i>
          <span class="ml-3 item-text">Produk</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="produk">
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/data-produk"><span class="ml-1 item-text">Data Tabel Produk</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/tambah-data-produk"><span class="ml-1 item-text">Tambah Data</span></a>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#kategori" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-box fe-16"></i>
          <span class="ml-3 item-text">kategori</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="kategori">
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/data-kategori"><span class="ml-1 item-text">Data Tabel kategori</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="/dashboard/tambah-data-kategori"><span class="ml-1 item-text">Tambah Data</span></a>
          </li>
        </ul>
      </li>

      
      
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="/" aria-expanded="false" class=" nav-link">
          <i class="fe fe-corner-down-left fe-16"></i>
          <span class="ml-3 item-text">Kembali ke Web</span>
        </a>
      </li>
    </ul>
    
  </nav>
</aside>