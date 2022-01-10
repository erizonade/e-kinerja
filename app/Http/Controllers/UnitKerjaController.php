<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
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
            $columns = ['id_unitkerja', 'nama_unit', 'id_unitkerja'];

            $search    = $this->request['search']['value'];
            $start     = $this->request['start'];
            $length    = $this->request['length'];
            $order_col = $columns[$this->request['order'][0]['column']];
            $order_dir = $this->request['order'][0]['dir'];

            $totalData = UnitKerja::count();
            $totalFiltered = $totalData;

            $jb = UnitKerja::select('*');
            if (!empty($search)) {
                $jb->whereRaw('(nama_unit LIKE "%' .$search. '%)');
            }
            $totalFiltered = $jb->count();
            $unitkerja = $jb->offset($start)
                          ->limit($length)
                          ->orderBy($order_col,$order_dir)
                          ->get();

            $data = [];
            $no = $start + 1;
            foreach ($unitkerja as $key => $res) {
                $data[] = [
                    $no++,
                    $res->nama_unit,
                    '<button class="btn btn-sm btn-info edit" data-id="' . $res->id_unitkerja . '"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-sm btn-danger hapus" data-id="' . $res->id_unitkerja . '"><i class="fas fa-trash"></i></button>'
                ];
            }

            $dt = [];
            $dt['draw']            = $this->request->draw;
            $dt['recordsTotal']    = $totalData;
            $dt['recordsFiltered'] = $totalFiltered;
            $dt['data']            = $data;

            return response()->json(['response' => ['success' => 1, 'data' => $dt, 'message' => 'Ada']]);

        }
        return view('/admin/unitkerja',['nama' => 'Unit Kerja'])->with('activeTab','data-unitkerja');
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
        $unitkerja = $this->request->validate([
            'nama_unit' => 'required|min:3',
        ],[
            'required' => ':attribute harus di isi'
        ]);

        UnitKerja::insert($unitkerja);
        return response()->json(['response' => ['success' => 1, 'data' => [], 'message' => 'Berhasil Menambah Unit Kerja']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit Kerja  $unitkerja
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit Kerja  $unitkerja
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = UnitKerja::select('id_unitkerja','nama_unit')->find($id);
        return response()->json(['response' => ['success' => 1, 'data' => $data]]);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit Kerja  $unitkerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $unitkerja = $this->request->validate([
            'nama_unit' => 'required|min:3',
        ],[
            'required' => ':attribute harus di isi'
        ]);

        UnitKerja::where('id_unitkerja',$id)->update($unitkerja);
        return response()->json(['response' => ['success' => 1, 'data' => [], 'message' => 'Berhasil Merubah Unit Kerja']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit Kerja  $unitkerja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        UnitKerja::where('id_unitkerja',$id)->delete();
        return response()->json(['response' => ['success' => 1, 'data' => [], 'message' => 'Berhasil Menghapus Unit Kerja']]);
    }
}
