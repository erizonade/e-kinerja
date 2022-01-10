<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">


<title>E-KINERJA</title>
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script>
    window.print();
</script>
<center>
    <table width="100%">
        <tr>
            <td>
                <b>
                    <h4 style="text-align: center;">LAPORAN KINERJA KARYAWAN</h4>
                    <h4 style="text-align: center;">BULAN {{ Str::upper($bln) }} TAHUN {{ $thn }}</h4>
                </b>
            </td>
        </tr>
    </table>
    <hr>
    <br>
</center>
<div class="col-12">
    
    <div class="">
        <div class="form-group row d-flex justify-content-sm-between">
            <h5>NAMA</h5>
            <h5>{{ $data[0]->namal }}</h5>
        
            <h5>JABATAN</h5>
            <h5>{{ $data[0]->nama_jabatan }}</h5>
        </div>
        <div class="form-group row d-flex justify-content-sm-between">
            <h5>NIP</h5>
            <h5>{{ $data[0]->nipl }}</h5>
        
            <h5>UNIT KERJA</h5>
            <h5 class="d-flex justify-content-start ">{{ $data[0]->nama_unit }}</h5>
        </div>
    </div>

</div>

<table width="100%" class="table table-bordered table-sm">
    <thead>
        <tr align="center">
            <th width='5%'>No</th>
            <th >Hari / Tanggal </th>
            <th>Rincian Kegiatan</th>
            <th>Hasil Kegiatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $res)
            <tr>
                <td  align="center" widtd='5%'>{{ $loop->iteration  }}</td>
                <td align="center">{{ $res->hari }} / {{ $res->tanggal }} </td>
                <td>{{ $res->rincian_kegiatan }}</td>
                <td>{{ $res->hasil }}</td>
            </tr>
        @endforeach
    </tbody>

</table>
<h6 class="float-left">
    <br>
    Atasan Langsung
    <br>
    <br>
    <br>
    <br>
    <p class="text-center">{{ $data[0]->namal }}
    <br>
    NIP. {{ $data[0]->nipl }}</p>
</h6>
<h6 class="float-right">Palembang , {{ $tgl }}
    <br>
    Yang Membuat Perayataan
    <br>
    <br>
    <br>
    <br>
    {{ $data[0]->namak }}
    <br>
    <p>NIP. {{ $data[0]->nipk }}</p>
</h6>
<!-- AdminLTE -->
<script src="{{ asset('assets/dist/js/adminlte.js')}}"></script>



