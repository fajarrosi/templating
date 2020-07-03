<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jawaban;

class JawabanController extends Controller
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

            return datatables()->of(Jawaban::getJawaban())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Hapus</button>';
                        return $button;
                        
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $data = Jawaban::getPertanyaan();
        return view('jawaban',compact('data'));
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
           'isi' =>'required',
        ];
        $msg = [
            'isi.required' => 'isi tidak boleh kosong',

        ];
        $this->validate($request,$rules,$msg);
         $data = Jawaban::create([
            'judul' => $request->isi,
            'isi'   =>$request->isi,
            'prt_id' =>$request->pertanyaan
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
            $data = Jawaban::findOrFail($id);
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
           'isi' =>'required',
        ];
        $msg = [
            'isi.required' => 'isi tidak boleh kosong',
        ];
        $this->validate($request,$rules,$msg);
        
        $data = Jawaban::findOrFail($request->hidden_id);
        $data->update([
            'judul' => $request->isi,
            'isi' => $request->isi,
            'prt_id' =>$request->pertanyaan
        ]);
        return response()->json(['success' => 'jawaban berhasil di update']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = Jawaban::findOrFail($id);
        $data->delete();
         return response()->json(['success' => 'Jawaban berhasil di hapus']);
    }
}
