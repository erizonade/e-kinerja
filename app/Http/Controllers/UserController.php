<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
            $columns = ['id_user', 'nama', 'username', 'status',  'id_user'];

            $search    = $this->request['search']['value'];
            $start     = $this->request['start'];
            $length    = $this->request['length'];
            $order_col = $columns[$this->request['order'][0]['column']];
            $order_dir = $this->request['order'][0]['dir'];

            $totalData = User::count();
            $totalFiltered = $totalData;

            $ky = User::select('*');
            if (!empty($search)) {
                $ky->whereRaw('(nama LIKE "%' . $search . '%")');
            }
            $totalFiltered = $ky->count();
            $ur = $ky->offset($start)
                           ->limit($length)
                           ->orderBy($order_col,$order_dir)
                           ->get();
            $data = [];
            $no = $start + 1;
            foreach ($ur as $key => $res) {
                $data[] = [
                    $no++,
                    $res->nama,
                    $res->username,
                    ($res->status == 1 ? '<div class="btn btn-sm btn-success">Aktif</div>' : '<span class="btn btn-sm btn-danger">Tidak Aktif</span>'),
                    '<button class="btn btn-sm btn-info edit" data-id="' . $res->id_user . '"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-sm btn-danger hapus" data-id="' . $res->id_user . '"><i class="fas fa-trash"></i></button>'
                ];
            }

            $dt = [];
            $dt['draw']            = $this->request['draw'];
            $dt['recordsTotal']    = $totalData;
            $dt['recordsFiltered'] = $totalFiltered;
            $dt['data']            = $data;

            return response()->json(['response' => ['success' => 1, 'data' => $dt]]);

        }
        return view('/admin/user',['nama' => 'User'])->with('activeTab', 'data-user');
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
                'nama' => 'required',
                'username' => 'required',
                'password' => 'required',
                'status' => 'required',
            ],
            [
                'required' => 'kolom wajib di isi'
            ]
        );

        $param = [
            'nama' => $this->request->nama,
            'username' => $this->request->username,
            'password' => bcrypt($this->request->password),
            'role' => 1,
            'status' => $this->request->status,
        ];

        User::insert($param);

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
        $data = User::find($id);
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
                'nama' => 'required',
                'username' => 'required',
                'status' => 'required',
            ],
            [
                'required' => 'kolom wajib di isi'
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
            'nama' => $this->request->nama,
            'username' => $this->request->username,
            'role' => 1,
            'status' => $this->request->status,
        ];

        if(!empty($this->request->password)){
           $param = ['password' => bcrypt($this->request->password)];
        }

        User::where('id_user',$id)->update($param);

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
        User::find($id)->delete();
        return response()->json(['response' => ['success' => 1, 'message' => 'Berhasil Menghapus Data', 'data' => []]]);
    }
}
