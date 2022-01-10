<!DOCTYPE html>
<html lang="id">

<head>

  @include('layouts.header') 
  @yield('header')
</head>

{{-- <body class="hold-transition sidebar-mini"> --}}
  <body class="sidebar-mini text-sm" style="height:auto">
  <div id="loadingProduk" >
      <div class="cv-spinner">
         <span class="spinner"></span>
      </div>
  </div>   
  <div class="wrapper">
      
    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    
    @include('layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1 class="m-0 text-dark">{{ ucwords(str_replace('-', ' ', $activeTab)) }}</h1> --}}
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          @yield('content')
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('layouts.footer')
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  @include('layouts.script')
  @yield('script')
</body>

</html>