<?php

namespace App\Http\Controllers\Admin\DevelopmentSPPD;

use App\Http\Controllers\Controller;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;
use App\Helpers\BantuAku;
use App\Models\Pegawais;

class SppdController extends Controller
{
    public function index()
    {
        return view('layouts.admin.sppd.index');
    }

    public function create()
    {
        return view('layouts.admin.sppd.create');
    }

    public function getPegawai(Request $request)
    {
        $pegawais = [];
        if ($request->has('q')) {
            $search = $request->q;
            $pegawais = Pegawais::select('id', 'nama_pegawai')
                            ->where('nama_pegawai', 'LIKE', "%$search%")
                            ->get();
        }
        return response()->json($pegawais);
    }

    public function store(Request $request)
    {
        dd($request->livesearch_pegawai);
        $validatedData = $request->validate([
            'nama_pegawai'              => 'required',
            'dasar'                     => 'required',
            'lokasi_ditetapkan'         => 'required',
            'jumlah_hari'               => 'required',
            'hari'                      => 'required',
            'tgl_mulai'                 => 'required',
            'tgl_selesai'               => 'required',
            'tgl_sppd'                  => 'required',
            'maksud_perjalanan'         => 'required',
            'tempat_tujuan'             => 'required',
            'jam_acara'                 => 'required'
        ]);

        $cekNoPerjal = PerjalananDinas::orderBy('no_perjal', 'DESC')->first();
        if ($cekNoPerjal == null) {
            $valNoPerjal = 1;
        } else {
            $valNoPerjal = intval($cekNoPerjal->no_perjal) + 1;
        }
        $noUrutPerjal = str_pad($valNoPerjal, 2, "0", STR_PAD_LEFT);

        $bulan      = date('m', strtotime($validatedData['tgl_sppd']));
        $tahun      = date('Y', strtotime($validatedData['tgl_sppd']));
        $addRomawi  = BantuAku::getRomawi($bulan);
        $romawi     = $addRomawi.'/'.$tahun;
        $no_sppd    = '094/'.$noUrutPerjal.'/'.$romawi;

        PerjalananDinas::create([
            'pegawai_id'                => $validatedData['nama_pegawai'],
            'no_sppd'                   => $no_sppd,
            'dasar'                     => $validatedData['dasar'],
            'lokasi_ditetapkan'         => $validatedData['lokasi_ditetapkan'],
            'jumlah_hari'               => $validatedData['jumlah_hari'],
            'hari'                      => $validatedData['hari'],
            'tgl_mulai'                 => $validatedData['tgl_mulai'],
            'tgl_selesai'               => $validatedData['tgl_selesai'],
            'tgl_sppd'                  => $validatedData['tgl_sppd'],
            'maksud_perjalanan'         => $validatedData['maksud_perjalanan'],
            'tempat_tujuan'             => $validatedData['tempat_tujuan'],
            'jam_acara'                 => $validatedData['jam_acara']
        ]);

        return redirect('dashboard/admin/sppd/create')->with('message', 'SPPD added successfully.');
    }
}
