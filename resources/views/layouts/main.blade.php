<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | routind </title>
  <link rel="shortcut icon" href="{{ url('disc/assets/media/logos/favicon.ico') }}" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('adminlte/dist/css/adminlte.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="{{ route('logout') }}"
            class="nav-link"
            onclick="event.preventDefault();var check = confirm('Apakah Anda yakin akan keluar?');if(check){document.getElementById('logout-form').submit();}">
            <i class="fas fa-sign-out-alt"></i>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST"
            class="d-none">
            @csrf
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">&nbsp;&nbsp;&nbsp;routind</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('adminlte/dist/img/default-150x150.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(auth()->user()->hasRole('pengajar') || auth()->user()->hasRole('co-pengajar'))
          <li class="nav-item">
            <a href="{{ route('pengajar.index') }}" class="nav-link {!! (Request::segment(1) == 'pengajar' && Request::segment(2) == '') ? 'active' : '' !!}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pengajar.kelas') }}" class="nav-link {!! (Request::segment(1) == 'pengajar' && Request::segment(2) == 'kelas' ) ? 'active' : '' !!}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Kelas
              </p>
            </a>
          </li>
          @endif
          @if(auth()->user()->hasRole('prodi'))
            <li class="nav-item">
              <a href="{{ route('prodi.index') }}" class="nav-link {!! (Request::segment(1) == 'prodi' && Request::segment(2) == '') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item {!! (Request::segment(2) == 'pengguna') ? 'menu-open' : '' !!}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Pengguna
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('prodi.pengguna', ['type'=>'pengajar']) }}" class="nav-link  {!! (Request::segment(2) == 'pengguna' && Request::segment(3) == 'pengajar') ? 'active' : '' !!}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dosen</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('prodi.pengguna', ['type'=>'co-pengajar']) }}" class="nav-link  {!! (Request::segment(2) == 'pengguna' && Request::segment(3) == 'co-pengajar') ? 'active' : '' !!}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Co-Dosen</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('prodi.pengguna', ['type'=>'pelajar']) }}" class="nav-link {!! (Request::segment(2) == 'pengguna' && Request::segment(3) == 'pelajar') ? 'active' : '' !!}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mahasiswa</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('prodi.kelas') }}" class="nav-link {!! (Request::segment(2) == 'kelas' ) ? 'active' : '' !!}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Kelas
                </p>
              </a>
            </li>
          @endif
          @if(auth()->user()->hasRole('affiliate'))
          <li class="nav-item">
            <a href="{{ route('affiliate.index') }}" class="nav-link {!! (Request::segment(1) == 'affiliate' && Request::segment(2) == '') ? 'active' : '' !!}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @endif
          @if(auth()->user()->hasRole('admin'))
          <li class="nav-item">
            <a href="{{ route('admin.index') }}" class="nav-link {!! (Request::segment(1) == 'admin' && Request::segment(2) == '') ? 'active' : '' !!}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.transaction') }}" class="nav-link {!! (Request::segment(2) == 'transaksi') ? 'active' : '' !!}">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.discount.index') }}" class="nav-link {!! (Request::segment(2) == 'discount') ? 'active' : '' !!}">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Diskon
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.referral.index') }}" class="nav-link {!! (Request::segment(2) == 'referral') ? 'active' : '' !!}">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Referral
              </p>
            </a>
          </li>
          <li class="nav-item {!! (Request::segment(2) == 'pengguna') ? 'menu-open' : '' !!}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.pengguna', ['type'=>'pelajar']) }}" class="nav-link {!! (Request::segment(2) == 'pengguna' && Request::segment(3) == 'pelajar') ? 'active' : '' !!}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelajar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pengguna', ['type'=>'pengajar']) }}" class="nav-link  {!! (Request::segment(2) == 'pengguna' && Request::segment(3) == 'pengajar') ? 'active' : '' !!}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pengguna', ['type'=>'co-pengajar']) }}" class="nav-link  {!! (Request::segment(2) == 'pengguna' && Request::segment(3) == 'co-pengajar') ? 'active' : '' !!}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Co-Pengajar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pengguna', ['type'=>'prodi']) }}" class="nav-link  {!! (Request::segment(2) == 'pengguna' && Request::segment(3) == 'prodi') ? 'active' : '' !!}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin Prodi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pengguna', ['type'=>'affiliate']) }}" class="nav-link  {!! (Request::segment(2) == 'pengguna' && Request::segment(3) == 'affiliate') ? 'active' : '' !!}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Affiliate</p>
                </a>
              </li>
            </ul>
          </li>
            <li class="nav-item">
              <a href="{{ route('admin.log') }}" class="nav-link {!! (Request::segment(2) == 'log') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  Log Aktivitas
                </p>
              </a>
            </li>
            <li class="nav-item {!! (Request::segment(2) == 'sertifikat') ? 'menu-open' : '' !!}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-certificate"></i>
                <p>
                  Sertifikat
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.certificate.sign') }}" class="nav-link {!! (Request::segment(2) == 'sertifikat' && Request::segment(3) == 'ttd') ? 'active' : '' !!}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tanda Tangan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.certificate.design') }}" class="nav-link  {!! (Request::segment(2) == 'sertifikat' && Request::segment(3) == 'desain') ? 'active' : '' !!}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Desain</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.certificate.brevet') }}" class="nav-link  {!! (Request::segment(2) == 'sertifikat' && Request::segment(3) == 'brevet') ? 'active' : '' !!}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Brevet</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.certificate.lain') }}" class="nav-link  {!! (Request::segment(2) == 'sertifikat' && Request::segment(3) == 'lain') ? 'active' : '' !!}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pelatihan Lain</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.invoice.index') }}" class="nav-link {!! (Request::segment(2) == 'invoice') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Invoice
                </p>
              </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.performance.index') }}" class="nav-link {!! (Request::segment(2) == 'performance') ? 'active' : '' !!}">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                        Performance
                    </p>
                </a>
            </li>
                <li class="nav-item">
                    <a href="{{ route('admin.advertisement.index') }}" class="nav-link {!! (Request::segment(2) == 'advertisement') ? 'active' : '' !!}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Advertisement
                        </p>
                    </a>
                </li>
            <li class="nav-header">ACADEMY</li>
            <li class="nav-item">
              <a href="{{ route('admin.category.index') }}" class="nav-link {!! (Request::segment(2) == 'category') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Academy Category
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.event.index') }}" class="nav-link {!! (Request::segment(2) == 'event') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Academy Events
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.batch.index') }}" class="nav-link {!! (Request::segment(2) == 'batch') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                  Academy Batches
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.registration') }}" class="nav-link {!! (Request::segment(2) == 'registrasi') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Events Registration
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.header.index') }}" class="nav-link {!! (Request::segment(2) == 'header') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Academy Header
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.faq.index') }}" class="nav-link {!! (Request::segment(2) == 'faq') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-question-circle"></i>
                <p>
                  Academy Faq
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.gallery.index') }}" class="nav-link {!! (Request::segment(2) == 'gallery') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-image"></i>
                <p>
                  Academy Gallery
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.partnership.index') }}" class="nav-link {!! (Request::segment(2) == 'partnership') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                  Academy Partnership
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.message') }}" class="nav-link {!! (Request::segment(2) == 'pesan') ? 'active' : '' !!}">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                  Messages
                </p>
              </a>
            </li>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('title')</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2023 - <?=date('Y')?> </strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('adminlte/dist/js/adminlte.min.js') }}"></script>
@yield('js')
</body>
</html>
