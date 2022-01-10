<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
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
            $columns = ['id_jabatan', 'nama_jabatan', 'id_jabatan'];

            $search    = $this->request['search']['value'];
            $start     = $this->request['start'];
            $length    = $this->request['length'];
            $order_col = $columns[$this->request['order'][0]['column']];
            $order_dir = $this->request['order'][0]['dir'];

            $totalData = Jabatan::count();
            $totalFiltered = $totalData;

            $jb = Jabatan::select('*');
            if (!empty($search)) {
                $jb->whereRaw('(nama_jabatan LIKE "%' .$search. '%)');
            }
            $totalFiltered = $jb->count();
            $jabatan = $jb->offset($start)
                          ->limit($length)
                          ->orderBy($order_col,$order_dir)
                          ->get();

            $data = [];
            $no = $start + 1;
            foreach ($jabatan as $key => $res) {
                $data[] = [
                    $no++,
                    $res->nama_jabatan,
                    '<button class="btn btn-sm btn-info edit" data-id="' . $res->id_jabatan . '"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-sm btn-danger hapus" data-id="' . $res->id_jabatan . '"><i class="fas fa-trash"></i></button>'
                ];
            }

            $dt = [];
            $dt['draw']            = $this->request->draw;
            $dt['recordsTotal']    = $totalData;
            $dt['recordsFiltered'] = $totalFiltered;
            $dt['data']            = $data;

            return response()->json(['response' => ['success' => 1, 'data' => $dt, 'message' => 'Ada']]);

        }
        return view('/admin/jabatan',['nama' => 'Jabatan'])->with('activeTab','data-jabatan');
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
        $jabatan = $this->request->validate([
            'nama_jabatan' => 'required|min:3',
        ],[
            'required' => ':attribute harus di isi'
        ]);

        Jabatan::insert($jabatan);
        return response()->json(['response' => ['success' => 1, 'data' => [], 'message' => 'Berhasil Menambah Jabatan']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Jabatan::select('id_jabatan','nama_jabatan')->find($id);
        return response()->json(['response' => ['success' => 1, 'data' => $data]]);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $jabatan = $this->request->validate([
            'nama_jabatan' => 'required|min:3',
        ],[
            'required' => ':attribute harus di isi'
        ]);

        Jabatan::where('id_jabatan',$id)->update($jabatan);
        return response()->json(['response' => ['success' => 1, 'data' => [], 'message' => 'Berhasil Merubah Jabatan']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Jabatan::where('id_jabatan',$id)->delete();
        return response()->json(['response' => ['success' => 1, 'data' => [], 'message' => 'Berhasil Menghapus Jabatan']]);
    }
}
