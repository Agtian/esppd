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

    public function getDaftarOPDDetails($daftar_opd_id)
    {
        $querydaftarOPD = DaftarOPD::find($daftar_opd_id);
        if ($querydaftarOPD->kementerians == null) {
            $nama_opd   = $querydaftarOPD->provinsis->nama_provinsi.' - '.$querydaftarOPD->kabupatens->nama_kabupaten.' - '.$querydaftarOPD->nama_opd;
        } else {
            $nama_opd   = $querydaftarOPD->kementerians->nama_kementerian.' - '.$querydaftarOPD->provinsis->nama_provinsi.' - '.$querydaftarOPD->kabupatens->nama_kabupaten.' - '.$querydaftarOPD->nama_opd;
        }

        return $nama_opd;
    }

    public function filterData(Request $request)
    {
        if ($request->pegawai_id == null && $request->daftar_opd_id == null && $request->tgl_awal == null && $request->tgl_akhir == null) {
            $resultAktifSPPD    = PerjalananDinas::paginate(10);
            return view('layouts.admin.sppd.pelaksana-sppd-filter-result', compact('resultAktifSPPD'));

        } elseif ($request->pegawai_id != null && $request->daftar_opd_id == null && $request->tgl_awal == null && $request->tgl_akhir == null) {
            $resultAktifSPPD    = PelaksanaPerjalananDinas::leftJoin('perjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->where('pelaksanaperjalanandinas.pegawai_id', $request->pegawai_id)
                                    ->paginate(10);
            $pegawais           = PelaksanaPerjalananDinas::where('pegawai_id', $request->pegawai_id)->first();
            $daftarOPD          = 'Semua OPD.';
            $tanggalFilter      = 'Semua tanggal yang tersedia.';
            $totalSPPD          = PelaksanaPerjalananDinas::where('pegawai_id', $request->pegawai_id)->count();
            return view('layouts.admin.sppd.pelaksana-sppd-filter-result-with-pegawais', compact('resultAktifSPPD', 'pegawais', 'daftarOPD', 'tanggalFilter', 'totalSPPD'));

        } elseif ($request->pegawai_id != null && $request->daftar_opd_id != null && $request->tgl_awal == null && $request->tgl_akhir == null) {
            $resultAktifSPPD    = PelaksanaPerjalananDinas::leftJoin('perjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->where('pegawai_id', $request->pegawai_id)
                                    ->where('perjalanandinas.daftar_opd_id', $request->daftar_opd_id)
                                    ->paginate(10);
            $pegawais           = PelaksanaPerjalananDinas::where('pegawai_id', $request->pegawai_id)->first();
            $daftarOPD          = $this->getDaftarOPDDetails($request->daftar_opd_id);
            $tanggalFilter      = 'Semua tanggal yang tersedia.';
            $totalSPPD          = PelaksanaPerjalananDinas::leftJoin('perjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->where('pegawai_id', $request->pegawai_id)
                                    ->where('daftar_opd_id', $request->daftar_opd_id)
                                    ->count();
            return view('layouts.admin.sppd.pelaksana-sppd-filter-result-with-pegawais', compact('resultAktifSPPD', 'pegawais', 'daftarOPD', 'tanggalFilter', 'totalSPPD'));

        } elseif ($request->pegawai_id != null && $request->daftar_opd_id != null && $request->tgl_awal != null && $request->tgl_akhir != null) {
            $resultAktifSPPD    = PelaksanaPerjalananDinas::leftJoin('perjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->where('pelaksanaperjalanandinas.pegawai_id', $request->pegawai_id)
                                    ->where('perjalanandinas.daftar_opd_id', $request->daftar_opd_id)
                                    ->whereBetween('perjalanandinas.tgl_sppd', [$request->tgl_awal, $request->tgl_akhir])
                                    ->paginate(10);
            $pegawais           = PelaksanaPerjalananDinas::where('pegawai_id', $request->pegawai_id)->first();
            $daftarOPD          = $this->getDaftarOPDDetails($request->daftar_opd_id);
            $tanggalFilter      = date('d-m-Y', strtotime($request->tgl_awal)).' s.d '.date('d-m-Y', strtotime($request->tgl_akhir));
            $totalSPPD          = PelaksanaPerjalananDinas::leftJoin('perjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->where('pelaksanaperjalanandinas.pegawai_id', $request->pegawai_id)
                                    ->where('perjalanandinas.daftar_opd_id', $request->daftar_opd_id)
                                    ->whereBetween('perjalanandinas.tgl_sppd', [$request->tgl_awal, $request->tgl_akhir])
                                    ->count();
            return view('layouts.admin.sppd.pelaksana-sppd-filter-result-with-pegawais', compact('resultAktifSPPD', 'pegawais', 'daftarOPD', 'tanggalFilter', 'totalSPPD'));

        } elseif ($request->pegawai_id != null && $request->daftar_opd_id == null && $request->tgl_awal != null && $request->tgl_akhir != null) {
            $resultAktifSPPD    = PelaksanaPerjalananDinas::leftJoin('perjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->where('pelaksanaperjalanandinas.pegawai_id', $request->pegawai_id)
                                    ->whereBetween('perjalanandinas.tgl_sppd', [$request->tgl_awal, $request->tgl_akhir])
                                    ->paginate(10);
            $pegawais           = PelaksanaPerjalananDinas::where('pegawai_id', $request->pegawai_id)->first();
            $daftarOPD          = 'Semua OPD.';
            $tanggalFilter      = date('d-m-Y', strtotime($request->tgl_awal)).' s.d '.date('d-m-Y', strtotime($request->tgl_akhir));
            $totalSPPD          = PelaksanaPerjalananDinas::leftJoin('perjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->where('pelaksanaperjalanandinas.pegawai_id', $request->pegawai_id)
                                    ->whereBetween('perjalanandinas.tgl_sppd', [$request->tgl_awal, $request->tgl_akhir])
                                    ->count();
            return view('layouts.admin.sppd.pelaksana-sppd-filter-result-with-pegawais', compact('resultAktifSPPD', 'pegawais', 'daftarOPD', 'tanggalFilter', 'totalSPPD'));

        } elseif ($request->pegawai_id == null && $request->daftar_opd_id != null && $request->tgl_awal != null && $request->tgl_akhir != null) {
            $resultAktifSPPD    = PerjalananDinas::where('daftar_opd_id', $request->daftar_opd_id)
                                    ->whereBetween('perjalanandinas.tgl_sppd', [$request->tgl_awal, $request->tgl_akhir])
                                    ->paginate(10);
            $pegawais           = 'Semua pagawai';
            $daftarOPD          =  $this->getDaftarOPDDetails($request->daftar_opd_id);
            $tanggalFilter      = date('d-m-Y', strtotime($request->tgl_awal)).' s.d '.date('d-m-Y', strtotime($request->tgl_akhir));
            $totalSPPD          = PelaksanaPerjalananDinas::leftJoin('perjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->whereBetween('perjalanandinas.tgl_sppd', [$request->tgl_awal, $request->tgl_akhir])
                                    ->where('perjalanandinas.daftar_opd_id', $request->daftar_opd_id)
                                    ->count();
            return view('layouts.admin.sppd.pelaksana-sppd-filter-result', compact('resultAktifSPPD', 'pegawais', 'daftarOPD', 'tanggalFilter', 'totalSPPD'));

        } elseif ($request->pegawai_id == null && $request->daftar_opd_id != null && $request->tgl_awal == null && $request->tgl_akhir == null) {
            $resultAktifSPPD    = PerjalananDinas::where('daftar_opd_id', $request->daftar_opd_id)
                                    ->paginate(10);
            $pegawais           = 'Semua pagawai';
            $daftarOPD          =  $this->getDaftarOPDDetails($request->daftar_opd_id);
            $tanggalFilter      = 'Semua tanggal yang tersedia.';
            $totalSPPD          = PelaksanaPerjalananDinas::leftJoin('perjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->where('perjalanandinas.daftar_opd_id', $request->daftar_opd_id)
                                    ->count();
            return view('layouts.admin.sppd.pelaksana-sppd-filter-result', compact('resultAktifSPPD', 'pegawais', 'daftarOPD', 'tanggalFilter', 'totalSPPD'));

        } elseif ($request->pegawai_id == null && $request->daftar_opd_id == null && $request->tgl_awal != null && $request->tgl_akhir != null) {
            $resultAktifSPPD    = PerjalananDinas::whereBetween('perjalanandinas.tgl_sppd', [$request->tgl_awal, $request->tgl_akhir])
                                    ->paginate(10);
            $pegawais           = 'Semua pagawai';
            $daftarOPD          = 'Semua OPD.';
            $tanggalFilter      = date('d-m-Y', strtotime($request->tgl_awal)).' s.d '.date('d-m-Y', strtotime($request->tgl_akhir));
            $totalSPPD          = PelaksanaPerjalananDinas::leftJoin('perjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->whereBetween('perjalanandinas.tgl_sppd', [$request->tgl_awal, $request->tgl_akhir])
                                    ->count();
            return view('layouts.admin.sppd.pelaksana-sppd-filter-result', compact('resultAktifSPPD', 'pegawais', 'daftarOPD', 'tanggalFilter', 'totalSPPD'));
        }
    }
}