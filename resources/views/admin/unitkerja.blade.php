@extends('layouts.app')
@section('content')
<div class="alert-box psuccess"></div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Unit Kerja</h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-primary float-right mr-2 tambah-unitkerja"  ><i class="fas fa-plus"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table id="unitkerjatable" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th width='5%'>No</th>
                        <th>Nama Unit Kerja</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table> 
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form-unitkerja">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Unit Kerja</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"  id="form-input-unitkerja" enctype="multipart/form-data" > 
              
                    <input type="hidden" id="id_unitkerja" name="id_unitkerja">

                    <div class="form-group row">
                        <label for="nama_unit" class="col-sm-2 col-form-label">Nama Unit Kerja</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_unit" name="nama_unit" placeholder="Nama Unit Kerja">
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
    <script src="{{ asset('assets/admin/unitkerja.js') }}"></script>
@endsection