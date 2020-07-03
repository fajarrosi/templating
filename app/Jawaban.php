<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Jawaban extends Model
{
     protected $fillable = [
		'judul','isi','prt_id'
	];
	public static function getPertanyaan()
	{
		$data = DB::table('pertanyaans')
				->select('id','isi')
				->get();
		return $data;
	}

	public static function getJawaban(){
		 $data = DB::table('jawabans as jw')
		 		->join('pertanyaans as p','p.id','=','jw.prt_id')
		 		->select('jw.id',DB::raw('p.judul as judul'),DB::raw('jw.isi as jawaban'))
		 		->get();
		 return $data;
	}
}
