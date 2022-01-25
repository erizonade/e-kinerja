@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center">
    <form  class="form-inline" id="search-laporan">
        <div class="row">
            <div class="form-group mb-2">
                <label for="tgl_awal" class="mr-2">Tanggal : </label>
                <input type="date" required class="form-control" id="tgl_awal" name="tgl_awal">
            </div>
            
            <div class="form-group mx-sm-3 mb-2">
                <input type="date" required class="form-control" id="tgl_akhir" name="tgl_akhir">
            </div>

            <button class="btn btn-info mb-2 search-laporan" type="submit" form="search-laporan"><i class="fa fa-search"></i></button>
         
        </div>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Laporan</h3>
        <div class="card-tools">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="riwayatable" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th width='5%'>No</th>
                        <th>Nama Karyawan</th>
                        <th>Print</th>
                    </tr>
                </thead>
                <tbody class="laporan-body">

                </tbody>
            </table> 
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset("assets/admin/riwayat_laporan.js") }}"></script>
@endsection