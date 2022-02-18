<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Laporan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        if($this->request->ajax()){
            $columns = ['id_laporan', 'tanggal', 'rincian_kegiatan', 'hasil', 'status_laporan', 'status_laporan','id_atasan_verif', 'id_laporan'];

            $search = $this->request['search']['value'];
            $start  = $this->request['start'];
            $length = $this->request['length'];
            $order_col = $columns[$this->request['order'][0]['column']];
            $order_dir = $this->request['order'][0]['dir'];

            $totalData = Laporan::where('id_karyawan',Session::get('karyawan')->id_karyawan)
                                ->where('tanggal', Carbon::now()->format('Y-m-d'))
                                ->count();

            $totalFiltered = $totalData;
            $lh = Laporan::selectRaw('a.nama as namak, tanggal, hari, rincian_kegiatan, status_laporan, hasil, id_laporan, b.nama as namal, id_atasan_verif, file_laporan')
            ->leftjoin('karyawan as a', 'a.id_karyawan', 'laporan_kinerja.id_karyawan')
            ->leftjoin('karyawan as b', 'b.id_karyawan', 'laporan_kinerja.id_atasan_verif');
            
            if(!empty($search)){
                $lh->whereRaw('(rincian_kegiatan LIKE "%' . $search . '%" OR hasil LIKE "%' . $search . '%")');
            }

            $totalFiltered = $lh->where('laporan_kinerja.id_karyawan',Session::get('karyawan')->id_karyawan)
                                ->where('tanggal', Carbon::now()->format('Y-m-d'))
                                ->count();

            $lp = $lh->offset($start)
                     ->limit($length)
                     ->where('laporan_kinerja.tanggal', Carbon::now()->format('Y-m-d'))
                     ->where('laporan_kinerja.id_karyawan',Session::get('karyawan')->id_karyawan)
                     ->orderBy($order_col, $order_dir)
                     ->get();
            $data = [];
            $no = $start + 1;
            foreach ($lp as $key => $res) {
                $data[] = [
                    $no++,
                    Carbon::parse($res->tanggal)->format('d/m/Y') ." - ". $res->hari,
                    $res->rincian_kegiatan,
                    $res->hasil,
                    '<a href="/Laporan/'.$res->file_laporan.'"><i class="fas fa-file"></i> File</a>',
                    '<div class="btn btn-sm btn-'.($res->status_laporan == 'Proses' ? 'warning' : ($res->status_laporan == 'Ditolak' ? 'danger' : 'success') ).'">'.$res->status_laporan.'</div>',
                    $res->namal,
                    (empty($res->id_atasan_verif) ? '<button class="btn btn-sm btn-info edit" data-id="' . $res->id_laporan . '"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-sm btn-danger hapus" data-id="' . $res->id_laporan . '"><i class="fas fa-trash"></i></button>' : '')
                ];
            }

            $dt = [];
            $dt['draw']            = $this->request['draw'];
            $dt['recordsTotal']    = $totalData;
            $dt['recordsFiltered'] = $totalFiltered;
            $dt['data']            = $data;

            return response()->json(['response' => ['success' => 1, 'data' => $dt]]);
         

        }

        return view('/karyawan/laporan_harian',['nama' => 'Laporan Harian'])->with('activeTab','data-laporan-harian');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        /* set location language indonesia */
        setlocale(LC_ALL, 'IND');
        $day =  strftime("%A", strtotime($this->request->tanggal));

        $this->request->validate(
            [
                'tanggal'          => 'required',
                'rincian_kegiatan' => 'required',
                'hasil'            => 'required',
                'file_laporan'     => 'required|mimes:pdf,doc,docx,xlsx|max:2048',
            ],
            [
                'required'  => 'kolom wajib di isi'
            ]
        );

        //file upload file_laporan
        $fileFolder = 'Laporan';
        $file     = $request->file('file_laporan');
        $fileName = time().$file->getClientOriginalName();
        $file->move($fileFolder, $fileName);

        $params = [
            'id_karyawan'      => Session::get('karyawan')->id_karyawan,
            'tanggal'          => $this->request->tanggal,
            'rincian_kegiatan' => $this->request->rincian_kegiatan,
            'hasil'            => $this->request->hasil,
            'hari'             => $day,
            'file_laporan'     => $fileName,
            'status_laporan'   => 'Proses',
            'created_at'       => Carbon::now(),
        ];

        Laporan::insert($params);

        return response()->json(['response' => ['success' => 1, 'message' => 'Berhasil Menambah Laporan', 'data' => []]]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Laporan::find($id);
        return response()->json(['response' => ['success' => 1, 'message' => 'Ada', 'data' => $data]]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        /* set location language indonesia */
        setlocale(LC_ALL, 'IND');
        $day =  strftime("%A", strtotime($this->request->tanggal));

        $this->request->validate(
            [
                'tanggal'          => 'required',
                'rincian_kegiatan' => 'required',
                'hasil'            => 'required',
            ],
            [
                'required'  => 'kolom wajib di isi'
            ]
        );

        //file upload update_file
        $fileLaporan = Laporan::find($id);
        if ($request->hasFile('file_laporan')) {
            $fileFolder = 'Laporan';
            $file     = $request->file('file_laporan');
            $fileName = time().$file->getClientOriginalName();
            $file->move($fileFolder, $fileName);
        }

        $params = [
            'id_karyawan'      => Session::get('karyawan')->id_karyawan,
            'tanggal'          => $this->request->tanggal,
            'rincian_kegiatan' => $this->request->rincian_kegiatan,
            'hasil'            => $this->request->hasil,
            'hari'             => $day,
            'file_laporan'     => (!empty($fileName) ? $fileName : $fileLaporan->file_laporan),
            'status_laporan'   => 'Proses',
            'created_at'       => Carbon::now(),
        ];

        Laporan::where('id_laporan',$id)->update($params);

        return response()->json(['response' => ['success' => 1, 'message' => 'Berhasil Menambah Laporan', 'data' => []]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Laporan::find($id)->delete(); 
        return response()->json(['response' => ['success' => 1, 'message' => 'Berhasil Menghapus Laporan', 'data' => []]]);
    }

    public function riwayatLaporanAdmin() 
    {
        return view('/admin/riwayat_laporan',['nama' => 'Riwayat Laporan'])->with('activeTab','data-laporan');
    }
    public function riwayatLaporan() 
    {
    return view('/karyawan/riwayat_laporan',['nama' => 'Riwayat Laporan'])->with('activeTab','data-riwayat-laporan');
    }

    public function listRiwayatLaporanAdmin()
    {
        $data = Laporan::selectRaw('a.nama as namak, tanggal, hari, rincian_kegiatan, status_laporan, hasil, id_laporan, b.nama as namal, a.id_karyawan as idkaryawan')
                        ->leftjoin('karyawan as a', 'a.id_karyawan', 'laporan_kinerja.id_karyawan')
                        ->leftjoin('karyawan as b', 'b.id_karyawan', 'laporan_kinerja.id_atasan_verif')
                        ->where('laporan_kinerja.tanggal','>=', $this->request->tgl_awal)
                        ->where('laporan_kinerja.tanggal','<=', $this->request->tgl_akhir)
                        ->groupBy('laporan_kinerja.id_karyawan')
                        // ->orderBy($order_col, $order_dir)
                        ->get();
        return response()->json(['response' => ['success' => 1, 'message' => 'ADA Laporan', 'data' => $data]]);
    }

    public function printRiwayatLaporanAdmin() 
    {
        $data = Laporan::selectRaw('a.nama as namak, a.nip as nipk, b.nip as nipl, tanggal, hari, rincian_kegiatan, status_laporan, hasil, id_laporan, b.nama as namal, c.nama_jabatan, d.nama_unit')
                        ->leftjoin('karyawan as a', 'a.id_karyawan', 'laporan_kinerja.id_karyawan')
                        ->leftjoin('karyawan as b', 'b.id_karyawan', 'laporan_kinerja.id_atasan_verif')
                        ->join('jabatan as c', 'c.id_jabatan', 'a.id_jabatan')
                        ->join('unit_kerja as d', 'd.id_unitkerja', 'a.id_unitkerja')
                        ->where('laporan_kinerja.id_karyawan',$this->request->id)
                        ->where('laporan_kinerja.tanggal','>=', $this->request->awal)
                        ->where('laporan_kinerja.tanggal','<=', $this->request->akhir)
                        ->orderBy('laporan_kinerja.tanggal','ASC')
                        ->get();
        setlocale(LC_ALL, 'IND');
        $bln = Carbon::parse($this->request->awal)->formatLocalized("%B");
        $tgl = Carbon::now()->formatLocalized("%d %B %Y");
        $thn = Carbon::parse($this->request->awal)->format('Y');

        return view('/karyawan/cetak-riwayat-laporan',compact('data', 'bln', 'thn', 'tgl'));
        
    }
    
    public function listRiwayatLaporan()
    {
        $data = Laporan::selectRaw('a.nama as namak, tanggal, hari, rincian_kegiatan, status_laporan, hasil, id_laporan, b.nama as namal, file_laporan')
                        ->leftjoin('karyawan as a', 'a.id_karyawan', 'laporan_kinerja.id_karyawan')
                        ->leftjoin('karyawan as b', 'b.id_karyawan', 'laporan_kinerja.id_atasan_verif')
                        ->where('laporan_kinerja.id_karyawan',Session::get('karyawan')->id_karyawan)
                        ->where('laporan_kinerja.tanggal','>=', $this->request->tgl_awal)
                        ->where('laporan_kinerja.tanggal','<=', $this->request->tgl_akhir)
                        // ->orderBy($order_col, $order_dir)
                        ->get();
        return response()->json(['response' => ['success' => 1, 'message' => 'ADA Laporan', 'data' => $data]]);
    }

    public function printRiwayatLaporan() 
    {
        $data = Laporan::selectRaw('a.nama as namak, a.nip as nipk, b.nip as nipl, tanggal, hari, rincian_kegiatan, status_laporan, hasil, id_laporan, b.nama as namal, c.nama_jabatan, d.nama_unit')
                        ->leftjoin('karyawan as a', 'a.id_karyawan', 'laporan_kinerja.id_karyawan')
                        ->leftjoin('karyawan as b', 'b.id_karyawan', 'laporan_kinerja.id_atasan_verif')
                        ->join('jabatan as c', 'c.id_jabatan', 'a.id_jabatan')
                        ->join('unit_kerja as d', 'd.id_unitkerja', 'a.id_unitkerja')
                        ->where('laporan_kinerja.id_karyawan',Session::get('karyawan')->id_karyawan)
                        ->where('laporan_kinerja.tanggal','>=', $this->request->awal)
                        ->where('laporan_kinerja.tanggal','<=', $this->request->akhir)
                        ->orderBy('laporan_kinerja.tanggal','ASC')
                        ->get();
        setlocale(LC_ALL, 'IND');
        $bln = Carbon::parse($this->request->awal)->formatLocalized("%B");
        $tgl = Carbon::now()->formatLocalized("%d %B %Y");
        $thn = Carbon::parse($this->request->awal)->format('Y');

        return view('/karyawan/cetak-riwayat-laporan',compact('data', 'bln', 'thn', 'tgl'));
        
    }

    public function laporanBawahan(){
        if($this->request->ajax()){
            $columns = ['id_laporan', 'tanggal', 'rincian_kegiatan', 'hasil', 'status_laporan', 'id_atasan_verif', 'id_laporan'];

            $awal        = $this->request->awal ?? Carbon::now();
            $akhir       = $this->request->akhir ?? Carbon::now();
            $id_karyawan = $this->request->id_karyawan ?? '';

            $search = $this->request['search']['value'];
            $start  = $this->request['start'];
            $length = $this->request['length'];
            $order_col = $columns[$this->request['order'][0]['column']];
            $order_dir = $this->request['order'][0]['dir'];

            $totalData = Laporan::where('laporan_kinerja.id_karyawan',$id_karyawan)
                                ->where('laporan_kinerja.tanggal','>=', $awal)
                                ->where('laporan_kinerja.tanggal','<=', $akhir)->count();
            $totalFiltered = $totalData;
            $lh = Laporan::selectRaw('a.nama as namak, tanggal, hari, rincian_kegiatan, status_laporan, hasil, id_laporan, b.nama as namal, file_laporan')
            ->leftjoin('karyawan as a', 'a.id_karyawan', 'laporan_kinerja.id_karyawan')
            ->leftjoin('karyawan as b', 'b.id_karyawan', 'laporan_kinerja.id_atasan_verif');
            
            if(!empty($search)){
                $lh->whereRaw('(namak LIKE "%' . $search . '%")');
            }

            $totalFiltered = $lh->where('laporan_kinerja.id_karyawan',$id_karyawan)
                                ->where('laporan_kinerja.tanggal','>=', $awal)
                                ->where('laporan_kinerja.tanggal','<=', $akhir)
                                ->count();
            $lp = $lh->offset($start)
                     ->limit($length)
                     ->where('laporan_kinerja.tanggal','>=', $awal)
                     ->where('laporan_kinerja.tanggal','<=', $akhir)
                     ->where('laporan_kinerja.id_karyawan',$id_karyawan)
                     ->orderBy($order_col, $order_dir)
                     ->get();
            $data = [];
            $no = $start + 1;
            foreach ($lp as $key => $res) {
                $data[] = [
                    $no++,
                    Carbon::parse($res->tanggal)->format('d/m/Y') ." - ". $res->hari,
                    $res->rincian_kegiatan,
                    $res->hasil,                    
                    '<a href="/Laporan/'.$res->file_laporan.'"><i class="fas fa-file"></i> File</a>',
                    '<div class="btn btn-sm btn-'.($res->status_laporan == 'Proses' ? 'warning' : ($res->status_laporan == 'Ditolak' ? 'danger' : 'success') ).'">'.$res->status_laporan.'</div>',
                    $res->namal,
                    '<div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        Verifikasi
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item diterima" type="button" data-id="'.$res->id_laporan.'">Diterima</a>
                            <a class="dropdown-item ditolak" type="button" data-id="'.$res->id_laporan.'">Ditolak</a>
                        </div>
                    </div>'
                ];
            }

            $dt = [];
            $dt['draw']            = $this->request['draw'];
            $dt['recordsTotal']    = $totalData;
            $dt['recordsFiltered'] = $totalFiltered;
            $dt['data']            = $data;

            return response()->json(['response' => ['success' => 1, 'data' => $dt]]);
         

        }
        $karyawan = Karyawan::where('karyawan.id_atasan2', Session::get('karyawan')->id_karyawan)
                            ->where('karyawan.id_atasan1', Session::get('karyawan')->id_karyawan)
                            ->get();
        return view('/karyawan/laporan-harian-bawahan',['nama' => 'Laporan Bawahan', 'karyawan' => $karyawan])->with('activeTab','data-laporan-harian-bawahan');
    }
    
    public function verifLaporan()
    {
        $params = [
                    'id_atasan_verif' => Session::get('karyawan')->id_karyawan,
                    'status_laporan'  => $this->request->status_laporan,
                  ];
        Laporan::where('id_laporan', $this->request->id)->update($params);
        
        return response()->json(['response' => ['success' => 1, 'message' => 'Verifikasi "'.$this->request->status_laporan.'" ', 'data' => []]]);
    }

}
