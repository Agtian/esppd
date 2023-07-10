<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\KonfigurasiSppd;
use App\Models\PelaksanaPerjalananDinas;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;
use PDF;

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

    public function laporanPengeluaranSPPD(Request $request)
    {
        $resultPengeluaranSPPD  = PerjalananDinas::whereBetween('tgl_sppd', [$request->tgl_awal, $request->tgl_selesai])->get();
        $tgl_awal               = $request->tgl_awal;
        $tgl_selesai            = $request->tgl_selesai;
        $html = view('layouts.admin.sppd.printout.laporan-pengeluaran-sppd', compact('resultPengeluaranSPPD', 'tgl_awal', 'tgl_selesai'));

        PDF::SetTitle('e SPPD | Laporan Pengeluaran SPPD');
        PDF::AddPage('L', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output('SPPD - Laporan Pengeluaran SPPD.pdf');
    }
}
