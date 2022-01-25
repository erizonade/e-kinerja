@extends('layouts.app')
@section('content')
<div class="alert-box psuccess"></div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Karyawan</h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-primary float-right mr-2 tambah-karyawan"  ><i class="fas fa-plus"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table id="karyawantable" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th width='5%'>No</th>
                        <th>NIP</th>
                        <th>Nama Karyawan</th>
                        <th>Jabatan</th>
                        <th>Unit Kerja</th>
                        <th>Atasan</th>
                        <th>Atasan dari Atasan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table> 
        </div>
    </div>
</div>


<div class="modal fade" id="modal-form-karyawan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"  id="form-input-karyawan" enctype="multipart/form-data" > 
              
                    <input type="hidden" id="id_karyawan" name="id_karyawan">

                    <div class="form-group row">
                        <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP karyawan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama karyawan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama karyawan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select name="id_jabatan" class="form-control"  id="id_jabatan">
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatan as $res)
                                    <option value="{{ $res->id_jabatan }}">{{ $res->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_unitkerja" class="col-sm-2 col-form-label">Unit Kerja</label>
                        <div class="col-sm-10">
                            <select name="id_unitkerja" class="form-control"  id="id_unitkerja">
                                <option value="">Pilih Unit Kerja</option>
                                @foreach ($unit as $res)
                                    <option value="{{ $res->id_unitkerja }}">{{ $res->nama_unit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_atasan2" class="col-sm-2 col-form-label">Atasan</label>
                        <div class="col-sm-10">
                            <select name="id_atasan2" class="form-control"  id="id_atasan2">
                                <option value="">Pilih Atasan</option>
                                @foreach ($atasan2 as $res)
                                    <option value="{{ $res->id_karyawan }}">{{ $res->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_atasan1" class="col-sm-2 col-form-label">Atasan Di Atas Atasan</label>
                        <div class="col-sm-10">
                            <select name="id_atasan1" class="form-control"  id="id_atasan1">
                                <option value="">Pilih Atasan Di Atas Atasan</option>
                                @foreach ($atasan1 as $res)
                                    <option value="{{ $res->id_karyawan }}">{{ $res->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" placeholder="password" class="form-control"  name="password" id="password">
                            <span class="text-danger">**jika untuk data baru dan password kosong maka password default 1-8</span>
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
<script src="{{ asset('assets/admin/karyawan.js') }}"></script>
@endsection