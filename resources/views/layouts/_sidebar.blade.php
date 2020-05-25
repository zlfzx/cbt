<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('home') }}" class="brand-link pl-4">
    <span class="brand-text font-weight-light">Ujian Online</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/avatar04.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @role_menu('admin')
        <li class="nav-item">
          <a href="{{ route('kelas.index') }}" class="nav-link {{ Route::is('kelas.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-columns"></i>
            <p>Kelas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('mapel.index') }}" class="nav-link {{ Route::is('mapel.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tags"></i>
            <p>Mata Pelajaran</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('siswa.index') }}" class="nav-link {{ Route::is('siswa.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Siswa</p>
          </a>
        </li>
        @endrole_menu
        @role_menu('admin,petugas_soal')
        <li class="nav-item">
          <a href="{{ route('paket-soal.index') }}" class="nav-link {{ Route::is('paket-soal.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-folder"></i>
            <p>Paket Soal</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('soal.index') }}" class="nav-link {{ Route::is('soal.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Soal</p>
          </a>
        </li>
        @endrole_menu
        @role_menu('admin,petugas_ujian')
        <li class="nav-item">
          <a href="{{ route('ujian.index') }}" class="nav-link {{ Route::is('ujian.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-puzzle-piece"></i>
            <p>Ujian</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('ujian.aktif') }}" class="nav-link {{ Route::is('ujian.aktif') ? 'active' : '' }}">
            <i class="nav-icon fas fa-diagnoses"></i>
            <p>Ujian Aktif</p>
          </a>
        </li>
        @endrole_menu
        @role_menu('admin')
        <li class="nav-item">
          <a href="{{ route('pengaturan.index') }}" class="nav-link {{ Route::is('pengaturan.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cog"></i>
            <p>Pengaturan</p>
          </a>
        </li>
        @endrole_menu
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>