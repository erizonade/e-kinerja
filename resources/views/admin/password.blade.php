@extends('layouts.app')
@section('content')

<div class="alert-box psuccess"></div>

<section class="section-body">
    <h2 class="section-title">Password</h2>
</section>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="resetPassword">
                <input type="hidden" name="id" id="id" value="{{ Session::get('user')->id_user }}">
                <input type="hidden" name="type" id="type" value="user">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password_old"> Password Sekarang </label>
                        <input type="password" id="password_old" name="password_old" class="form-control" placeholder="Masukkan password sekarang">
                        <div class="invalid-feedback error-password_old"></div>
                    </div>
                    <div class="form-group">
                        <label for="password"> Password Baru </label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password baru">
                        <div class="invalid-feedback error-password"></div>
                    </div>
                    <div class="form-group">
                        <label for="password2"> Ulangi Password </label>
                        <input type="password" id="password2" name="password2" class="form-control" placeholder="Ulangi password baru">
                        <div class="invalid-feedback error-password2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submitPassword" class="btn btn-primary text-white"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Update </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/profil.js') }}"></script>
@endsection