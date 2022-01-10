@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center">
    <form  id="search-laporan">
        <div class="row">
            <div class="form-group mb-2">
                <label for="tgl_awal" class="mr-2">Tanggal : </label>
                <input type="date" required class="form-control" id="tgl_awal" name="tgl_awal">
            </div>
            
            <div class="form-group mx-sm-3 mb-2">
                <label for="tgl_akhir" class="mr-2">Tanggal : </label>
                <input type="date" required class="form-control" id="tgl_akhir" name="tgl_akhir">
            </div>
        </div>
        
        <div class="form-group">
            <label for="" >Pilih Karyawan : </label>
            <select name="id_karyawan" id="id_karyawan" class="form-control">
                @if(count($karyawan) > 1)
                    <option value="">Pilih Karyawan</option>
                    @foreach ($karyawan as $res)
                        <option value="{{ $res->id_karyawan }}">{{ $res->nama }}</option>
                    @endforeach
                @else
                    <option value="">Anda Tidak Punya Bawahan</option>
                @endif
                
            </select>
        </div>
    </form>
</div>


<div class="alert-box psuccess"></div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Laporan Bawahan</h3>
        <div class="card-tools">
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
                        <th>Status</th>
                        <th>Verifikator</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table> 
        </div>
    </div>
</div>


@endsection
@section('script')
    <script src="{{ asset('assets/karyawan/laporan-bawahan.js') }}"></script>
@endsection