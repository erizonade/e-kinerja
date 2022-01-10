<nav class="main-header navbar navbar-expand navbar-dark navbar-cyan">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  
  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      

      {{--  logout  --}}
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" v-pre>
          {{ ( Session::get('user') == true ? Session::get('user')->nama : Session::get('karyawan')->nama ) }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{url('/logout')}}">
           <i class="fas fa-power-off"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>