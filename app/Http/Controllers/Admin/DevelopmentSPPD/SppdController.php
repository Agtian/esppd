<?php

namespace App\Http\Controllers\Admin\DevelopmentSPPD;

use App\Http\Controllers\Controller;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;
use App\Helpers\BantuAku;
use App\Models\DaftarOPD;
use App\Models\Kementerian;
use App\Models\PelaksanaPerjalananDinas;
use App\Models\PGSQL\GolonganPegawai_m;
use App\Models\PGSQL\Pangkat_m;
use App\Models\PGSQL\Pegawai_v;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SppdController extends Controller
{
    public function index()
    {
        return view('layouts.admin.sppd.index');
    }

    public function create()
    {
        return view('layouts.admin.sppd.create', with([
            'resultOPD'         => DaftarOPD::all(),
            'resultKementerian' => Kementerian::all(),
            'resultProvinsi'    => Provinsi::all(),
        ]));
    }

    public function dataSPPD()
    {
        $resultDataSPPD = PerjalananDinas::where('status_sppd', 1)->paginate(10);
        return view('layouts.admin.sppd.data-sppd', compact('resultDataSPPD'));
    }

    public function dataSPPDUnvalidated(int $sppd)
    {
        PerjalananDinas::findOrFail($sppd)->update([
            'status_sppd'   => 0,
        ]);

        return redirect('dashboard/admin/data-sppd')->with('message', 'SPPD berhasil batal validasi.');
    }

    public function getPegawai(Request $request)
    {
        $pegawais = [];
        if ($request->has('q')) {
            $search = $request->q;
            $pegawais = Pegawai_v::select('pegawai_id', 'nama_pegawai')
                            ->where('nama_pegawai', 'LIKE', "%$search%")
                            ->get();
        }
        return response()->json($pegawais);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dasar'                     => 'required',
            'daftar_opd_id'             => 'required',
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

        $getDetOPD   = DaftarOPD::findOrFail($validatedData['daftar_opd_id']);

        $perjalananDinas = PerjalananDinas::create([
            'no_perjal'                 => $valNoPerjal,
            'no_sppd'                   => $no_sppd,
            'dasar'                     => $validatedData['dasar'],
            'daftar_opd_id'             => $validatedData['daftar_opd_id'],
            'undangan_dari'             => $getDetOPD->nama_opd,
            'tgl_ditetapkan'            => $validatedData['tgl_sppd'],
            'jumlah_hari'               => $validatedData['jumlah_hari'],
            'hari'                      => $validatedData['hari'],
            'tgl_mulai'                 => $validatedData['tgl_mulai'],
            'tgl_selesai'               => $validatedData['tgl_selesai'],
            'tgl_sppd'                  => $validatedData['tgl_sppd'],
            'maksud_perjalanan'         => $validatedData['maksud_perjalanan'],
            'tempat_tujuan'             => $validatedData['tempat_tujuan'],
            'jam_acara'                 => $validatedData['jam_acara'],
            'user_id'                   => Auth::user()->id
        ]);

        // foreach ($request->pegawai_id as $idPegawaisArr) {
        //     $detPegawai = Pegawai_v::where('pegawai_id', $idPegawaisArr)->first();
        //     $detPangkat = Pangkat_m::where('pangkat_id', $detPegawai->pangkat_id)->get();
        //     $detGol     = GolonganPegawai_m::where('golonganpegawai_id', $$detPangkat->golonganpegawai_id)->get();
        //     PelaksanaPerjalananDinas::create([
        //         'perjalanandinas_id'    => 1,
        //         'pegawai_id'            => $idPegawaisArr,
        //         'gelardepan'            => $detPegawai->gelardepan,
        //         'nama_pegawai'          => $detPegawai->nama_pegawai,
        //         'gelarbelakang_nama'    => $detPegawai->gelarbelakang_nama,
        //         'nomorindukpegawai'     => $detPegawai->nomorindukpegawai,
        //         'pangkat'               => $detPangkat->pangkat_nama,
        //         'jabatan'               => $detPegawai->nama_jabatan,
        //         'golongan'              => $detGol->golonganpegawai_nama,
        //         'unit_kerja'            => $detPegawai->namaunitkerja,
        //         'tgl_sppd'              => date('Y-m-d'),
        //     ]);
        // }

        return redirect('dashboard/admin/sppd/create')->with('message', 'SPPD added successfully.');
    }

    public function storeOPD(Request $request)
    {
        $validatedData = $request->validate([
            'provinsi_id'       => 'integer|required',
            'kabupaten_id'      => 'integer|required',
            'nama_opd'          => 'required',
            'status_opd'        => 'required',
        ]);

        DaftarOPD::create([
            'kementerian_id'    => $request->kementerian_id,
            'provinsi_id'       => $validatedData['provinsi_id'],
            'kabupaten_id'      => $validatedData['kabupaten_id'],
            'nama_opd'          => $validatedData['nama_opd'],
            'status_opd'        => $validatedData['status_opd'],
            'alamat'            => $request->alamat_opd,
        ]);

        return redirect('dashboard/admin/sppd/create')->with('message', 'OPD berhasil disimpan !');
    }
}
