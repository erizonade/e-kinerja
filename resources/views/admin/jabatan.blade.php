@extends('layouts.app')
@section('content')
<div class="alert-box psuccess"></div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Jabatan</h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-primary float-right mr-2 tambah-jabatan"  ><i class="fas fa-plus"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table id="jabatantable" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th width='5%'>No</th>
                        <th>Nama Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table> 
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form-jabatan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Jabatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"  id="form-input-jabatan" enctype="multipart/form-data" > 
              
                    <input type="hidden" id="id_jabatan" name="id_jabatan">

                    <div class="form-group row">
                        <label for="nama_jabatan" class="col-sm-2 col-form-label">Nama Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan">
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
    <script src="{{ asset('assets/admin/jabatan.js') }}"></script>
@endsection