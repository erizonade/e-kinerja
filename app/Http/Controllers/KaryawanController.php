<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class KaryawanController extends Controller
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
        //
        if ($this->request->ajax()) {
            $columns = ['karyawan.id_karyawan', 'nip','karyawan.nama', 'id_jabatan', 'id_unitkerja', 'id_atasan2', 'id_atasan1', 'status',  'karyawan.id_karyawan'];

            $search    = $this->request['search']['value'];
            $start     = $this->request['start'];
            $length    = $this->request['length'];
            $order_col = $columns[$this->request['order'][0]['column']];
            $order_dir = $this->request['order'][0]['dir'];

            $totalData = Karyawan::count();
            $totalFiltered = $totalData;

            $ky = Karyawan::selectRaw('karyawan.nip as nipk, karyawan.nama as nama_karyawan, b.nama_jabatan, a.nama_unit, c.nama as atasan1, d.nama as atasan2, karyawan.status as status_karyawan, karyawan.id_karyawan as id_karyawank')
                            ->leftjoin('unit_kerja as a','a.id_unitkerja','karyawan.id_unitkerja')
                            ->leftjoin('jabatan as b','b.id_jabatan','karyawan.id_jabatan')
                            ->leftjoin('karyawan as c','c.id_karyawan','karyawan.id_atasan1')
                            ->leftjoin('karyawan as d','d.id_karyawan','karyawan.id_atasan2');
            if (!empty($search)) {
                $ky->whereRaw('(karyawan.nama LIKE "%' . $search . '%")');
            }
            $totalFiltered = $ky->count();
            $karyawan = $ky->offset($start)
                           ->limit($length)
                           ->orderBy($order_col,$order_dir)
                           ->get();
            $data = [];
            $no = $start + 1;
            foreach ($karyawan as $key => $res) {
                $data[] = [
                    $no++,
                    $res->nipk,
                    $res->nama_karyawan,
                    $res->nama_jabatan,
                    $res->nama_unit,
                    $res->atasan2,
                    $res->atasan1,
                    ($res->status_karyawan == 1 ? '<div class="btn btn-sm btn-success">Aktif</div>' : '<span class="btn btn-sm btn-danger">Tidak Aktif</span>'),
                    '<button class="btn btn-sm btn-info edit" data-id="' . $res->id_karyawank . '"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-sm btn-danger hapus" data-id="' . $res->id_karyawank . '"><i class="fas fa-trash"></i></button>'
                ];
            }

            $dt = [];
            $dt['draw']            = $this->request['draw'];
            $dt['recordsTotal']    = $totalData;
            $dt['recordsFiltered'] = $totalFiltered;
            $dt['data']            = $data;

            return response()->json(['response' => ['success' => 1, 'data' => $dt]]);

        }

        $jabatan = Jabatan::get();
        $unit    = UnitKerja::get();
        $atasan1 = Karyawan::get();
        $atasan2 = Karyawan::get();

        return view('/admin/karyawan',['nama' => 'Karyawan', 'jabatan' => $jabatan, 'unit' => $unit, 'atasan1' => $atasan1, 'atasan2' => $atasan2])->with('activeTab', 'data-karyawan');
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
        $this->request->validate(
            [
                'nip' => 'required|unique:karyawan,nip',
                'nama' => 'required',
                'id_jabatan' => 'required',
                'id_unitkerja' => 'required',
                // 'password' => 'required',
                'status' => 'required',
            ],
            [
                'required' => 'kolom wajib di isi',
                'unique'   => 'Sudah digunakan'
            ]
        );

        $param = [
            'nip' => $this->request->nip,
            'nama' => $this->request->nama,
            'id_jabatan' => $this->request->id_jabatan,
            'id_unitkerja' => $this->request->id_unitkerja,
            'id_atasan2' => $this->request->id_atasan2,
            'id_atasan1' => $this->request->id_atasan1,
            'password' => ($this->request->password == '' ? bcrypt(12345678) : bcrypt($this->request->password)),
            'role' => 2,
            'status' => $this->request->status,
        ];

        Karyawan::insert($param);

        return response()->json(['response' => ['success' => 1, 'message' => 'Berhasil Menambah Data', 'data' => []]]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Karyawan::find($id);
        return response()->json(['response' => ['success' => 1, 'message' => 'Berhasil Menambah Data', 'data' => $data]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->request->validate(
            [
                'nip' => 'required|unique:karyawan,nip,'.$id.',id_karyawan',
                'nama' => 'required',
                'id_jabatan' => 'required',
                'id_unitkerja' => 'required',
                'status' => 'required',
            ],
            [
                'required' => 'kolom wajib di isi',
                'unique'   => 'Sudah digunakan'
            ]
        );
        if (!empty($this->request->password)) {
            $this->request->validate(
                [
                    'password' => 'required',
                ],
                [
                    'required' => 'kolom wajib di isi'
                ]
            );
        }

        $param = [
            'nip' => $this->request->nip,
            'nama' => $this->request->nama,
            'id_jabatan' => $this->request->id_jabatan,
            'id_unitkerja' => $this->request->id_unitkerja,
            'id_atasan2' => $this->request->id_atasan2,
            'id_atasan1' => $this->request->id_atasan1,
            'role' => 2,
            'status' => $this->request->status,
        ];

        if(!empty($this->request->password)){
           $param = ['password' => bcrypt($this->request->password)];
        }

        Karyawan::where('id_karyawan',$id)->update($param);

        return response()->json(['response' => ['success' => 1, 'message' => 'Berhasil Merubah Data', 'data' => []]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Karyawan::find($id)->delete();
        return response()->json(['response' => ['success' => 1, 'message' => 'Berhasil Menghapus Data', 'data' => []]]);
    }
}
