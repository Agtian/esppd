<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;

class RincianBiayaBPKController extends Controller
{
    public function index()
    {
        $resultRincianBiayaBPK = PerjalananDinas::where('status_sppd', 1)->paginate(10);
        return view('layouts.admin.report.rincian-biaya-bpk.index', compact('resultRincianBiayaBPK'));
    }

    public function filterData(Request $request)
    {
        $resultRincianBiayaBPK = PerjalananDinas::where('status_sppd', 1)->whereBetween('perjalanandinas.tgl_sppd', [$request->tanggal_mulai, $request->tanggal_selesai])
                                    ->paginate(10);
        return view('layouts.admin.report.rincian-biaya-bpk.index', compact('resultRincianBiayaBPK'));
    }
}
