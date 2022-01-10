@extends('layouts_login.app')

@section('content')
<div class="login-box bg-dark shadow rounded">
 <div class="card card-dark">
    <div class="card-header text-center shadow rounded">
      <h3 class="text-black">E-KINERJA</h3>
    </div>
   <div class="card-body login-card-body shadow rounded">

      @if(session('messages'))
      <div class="form-group">
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            &times;
          </button>
          <span>
                 {{session('messages')}} 
          </span>
        </div>
      </div>
      @endif
      <h6 class="text-black text-center mb-3">Silakan Login</h6>

        <form method="POST" action="/login">
            @csrf
            <div class="input-group mb-3 ">
              <input id="userName" type="text" class="form-control @error('userName') is-invalid @enderror " name="userName"
                value="{{ old('userName') }}" autocomplete="off" placeholder="Masukan UserName / NIP" autocomplete="off" autofocus>

              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              @error('userName')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="input-group mb-3 ">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" placeholder="Masukan Password" autocomplete="current-password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span toggle="#password" class="fas fa-low-vision  buka-mata"></span>
                </div>
              </div>
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-info btn-block shadow rounded"><i class="fas fa-sign-in-alt"></i> Login</button>
              </div>
              <!-- /.col -->
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
    <!-- /.login-card-body -->
@endsection

@section('script')
    <script>
      $(".buka-mata").click(function(){
        $(this).toggleClass('fa-low-vision fa-eye');
        var input = $($(this).attr('toggle'));
        if(input.attr('type') == "password"){
          input.attr("type","text");
        }else{
          input.attr("type","password");
        }
      });
    </script>
@endsection
 
