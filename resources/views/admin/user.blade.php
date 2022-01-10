@extends('layouts.app')
@section('content')
<div class="alert-box psuccess"></div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">User</h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-primary float-right mr-2 tambah-user"  ><i class="fas fa-plus"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table id="usertable" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th width='5%'>No</th>
                        <th>Nama </th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table> 
        </div>
    </div>
</div>


<div class="modal fade" id="modal-form-user">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"  id="form-input-user" enctype="multipart/form-data" > 
              
                    <input type="hidden" id="id_user" name="id_user">

                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama user</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama user">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status"  class="form-control"  id="status">
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>      

                    <div class="modal-footer justify-content-between">						
                        <button type="button" class="btn btn-danger " data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info " >Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script src="{{ asset('assets/admin/user.js') }}"></script>
@endsection