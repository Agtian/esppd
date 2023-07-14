<?php

namespace App\Http\Controllers\Admin\DevelopmentSPPD;

use App\Http\Controllers\Controller;
use App\Models\PerjalananDinas;
use App\Models\PGSQL\Pegawai_m;
use Illuminate\Http\Request;

class PelaksanaSPPDController extends Controller
{
    public function index()
    {
        return view('layouts.admin.sppd.pelaksana-sppd');
    }

    public function getPegawais(Request $request){
        $search = $request->search;
  
        if($search == ''){
           $pegawais = Pegawai_m::orderby('nama_pegawai','asc')->select('pegawai_id','nama_pegawai')->limit(5)->get();
        }else{
           $pegawais = Pegawai_m::orderby('nama_pegawai','asc')->select('pegawai_id','nama_pegawai')->where('nama_pegawai', 'like', '%' .$search . '%')->limit(5)->get();
        }
  
        $response = array();
        foreach($pegawais as $pegawai){
           $response[] = array(
                "id"=>$pegawai->pegawai_id,
                "text"=>$pegawai->nama_pegawai
           );
        }
        return response()->json($response); 
     } 
}