<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Pertanyaan::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Hapus</button>';
                        return $button;
                        
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pertanyaan');
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
         $rules = [
           'judul' =>'required',
           'isi' =>'required',
        ];
        $msg = [
            'judul.required' => 'Judul tidak boleh kosong',
            'isi.required' => 'isi tidak boleh kosong',

        ];
        $this->validate($request,$rules,$msg);
         $data = Pertanyaan::create([
            'judul' => $request->judul,
            'isi'   =>$request->isi
        ]);
        return response()->json(['success' => 'Departement berhasil ditambahkan']);
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
        if(request()->ajax())
        {
            $data = Pertanyaan::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $rules = [
           'judul' =>'required',
           'isi' =>'required',
        ];
        $msg = [
            'judul.required' => 'Judul tidak boleh kosong',
            'isi.required' => 'isi tidak boleh kosong',

        ];
        $this->validate($request,$rules,$msg);
        
        $data = Pertanyaan::findOrFail($request->hidden_id);
        $data->update([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);
        return response()->json(['success' => 'pertanyaan berhasil di update']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $data = Pertanyaan::findOrFail($id);
        $data->delete();
         return response()->json(['success' => 'Pertanyaan berhasil di hapus']);
    }
}
