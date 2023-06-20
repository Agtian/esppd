<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\KonfigurasiSppd;
use App\Models\PelaksanaPerjalananDinas;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    public function index()
    {
        $perjalananDinas = PerjalananDinas::paginate(15);
        return view('layouts.admin.report.biaya-sppd.index', compact('perjalananDinas'));
    }

    public function edit(int $id)
    {
        $detail         = PerjalananDinas::findOrFail($id);
        $pelaksanaArr   = PelaksanaPerjalananDinas::where('perjalanandinas_id', $id)->get();
        $confSppd       = KonfigurasiSppd::find(1);
        return view('layouts.admin.report.biaya-sppd.edit', compact('detail', 'confSppd', 'pelaksanaArr'));
    }

    public function filterData(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal_mulai'     => 'required',
            'tanggal_selesai'   => 'required'
        ]);

        $resultDataBiayaSPPD  = PerjalananDinas::whereBetween('tgl_sppd', [$validatedData['tanggal_mulai'], $validatedData['tanggal_selesai']])->paginate(15);
        $tgl_awal             = $validatedData['tanggal_mulai'];
        $tgl_selesai          = $validatedData['tanggal_selesai'];

        return view('layouts.admin.report.biaya-sppd.filter-data', compact('resultDataBiayaSPPD', 'tgl_awal', 'tgl_selesai'));
    }
}
