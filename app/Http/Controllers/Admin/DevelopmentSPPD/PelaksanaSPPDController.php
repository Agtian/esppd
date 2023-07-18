<?php

namespace App\Http\Controllers\Admin\DevelopmentSPPD;

use App\Http\Controllers\Controller;
use App\Models\DaftarOPD;
use App\Models\PelaksanaPerjalananDinas;
use App\Models\PerjalananDinas;
use App\Models\PGSQL\Pegawai_m;
use Illuminate\Http\Request;

class PelaksanaSPPDController extends Controller
{
    public function index()
    {
        return view('layouts.admin.sppd.pelaksana-sppd', with([
            'resultAktifSPPD' => PerjalananDinas::paginate(10),
        ]));
    }

    public function getPegawais(Request $request)
    {
        $search = $request->searchpegawai;

        if($search == ''){
            $pegawais = PelaksanaPerjalananDinas::orderby('nama_pegawai','asc')->select('pegawai_id', 'gelardepan', 'nama_pegawai', 'gelarbelakang_nama')->limit(5)->distinct()->get();
        }else{
            $pegawais = PelaksanaPerjalananDinas::orderby('nama_pegawai','asc')->select('pegawai_id', 'gelardepan', 'nama_pegawai', 'gelarbelakang_nama')->where('nama_pegawai', 'like', '%' .$search . '%')->limit(5)->distinct()->get();
        }

        $response = array();
        foreach($pegawais as $pegawai){
            $response[] = array(
                "id"    => $pegawai->pegawai_id,
                "text"  => $pegawai->gelardepan.' '.$pegawai->nama_pegawai.' '.$pegawai->gelarbelakang_nama
            );
        }
        return response()->json($response); 
    } 

    public function getDaftarOPD(Request $request)
    {
        $search = $request->searchsuratdari;

        if($search == ''){
            $query = PerjalananDinas::join('daftaropd', 'daftaropd.id', '=', 'perjalanandinas.daftar_opd_id')
                                ->leftJoin('kementerian', 'kementerian.id', '=', 'daftaropd.kementerian_id')
                                ->join('provinsi', 'provinsi.id', '=', 'daftaropd.provinsi_id')
                                ->join('kabupaten', 'kabupaten.id', '=', 'daftaropd.kabupaten_id')
                                ->orderby('nama_opd','asc')->select('daftaropd.id', 'daftaropd.nama_opd', 'kementerian.nama_kementerian', 'provinsi.nama_provinsi', 'kabupaten.nama_kabupaten')
                                ->limit(5)
                                ->distinct()
                                ->get();
        }else{
            $query = PerjalananDinas::join('daftaropd', 'daftaropd.id', '=', 'perjalanandinas.daftar_opd_id')
                                ->leftJoin('kementerian', 'kementerian.id', '=', 'daftaropd.kementerian_id')
                                ->join('provinsi', 'provinsi.id', '=', 'daftaropd.provinsi_id')
                                ->join('kabupaten', 'kabupaten.id', '=', 'daftaropd.kabupaten_id')
                                ->orderby('nama_opd','asc')->select('daftaropd.id', 'daftaropd.nama_opd', 'kementerian.nama_kementerian', 'provinsi.nama_provinsi', 'kabupaten.nama_kabupaten')
                                ->where('nama_opd', 'like', '%' .$search . '%')
                                ->limit(5)
                                ->distinct()
                                ->get();
        }

        $response = array();
        foreach($query as $item){
            $response[] = array(
                "id"    => $item->id,
                "text"  => strtoupper($item->nama_kementerian.' - '.$item->nama_provinsi.' - '.$item->nama_kabupaten).' - '.$item->nama_opd
            );
        }
        return response()->json($response); 
    }

    public function filterData(Request $request)
    {
        dd($request);
    }
}