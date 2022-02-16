@extends('layouts.app')
@section('content')
<div class="alert-box psuccess"></div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Laporan Harian</h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-primary float-right mr-2 tambah-laporan"  ><i class="fas fa-plus"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table id="laporantable" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th width='5%'>No</th>
                        <th>Tanggal - Hari </th>
                        <th>Rincian Kegiatan</th>
                        <th>Hasil Kegiatan</th>
                        <th>File Laporan</th>
                        <th>Status</th>
                        <th>Verifikator</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table> 
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form-laporan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Laporan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"  id="form-input-laporan" enctype="multipart/form-data" > 
              
                    <input type="hidden" id="id_laporan" name="id_laporan">

                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" min="{{ date('Y-m-d') }}" id="tanggal" name="tanggal" placeholder="Tanggal">
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="rincian_kegiatan" class="col-sm-2 col-form-label">Rincian Kegiatan</label>
                        <div class="col-sm-10">
                            <textarea name="rincian_kegiatan" class="form-control" id="rincian_kegiatan" cols="30" rows="10"></textarea>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="hasil" class="col-sm-2 col-form-label">Hasil Kegiatan</label>
                        <div class="col-sm-10">
                            <textarea name="hasil" class="form-control" id="hasil" cols="30" rows="10"></textarea>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="hasil" class="col-sm-2 col-form-label">File Upload</label>
                        <div class="col-sm-10">
                           <input type="file" name="file_laporan" id="file_laporan" class="form-control">
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
    <script src="{{ asset('assets/karyawan/laporan.js') }}"></script>
@endsection