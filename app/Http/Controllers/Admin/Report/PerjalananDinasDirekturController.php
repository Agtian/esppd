<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;

class PerjalananDinasDirekturController extends Controller
{
    public function index()
    {
        $resultPerjalDirektur = PerjalananDinas::leftJoin('pelaksanaperjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->where('pelaksanaperjalanandinas.nomorindukpegawai', '197011112005011003')
                                    ->paginate(10);
        return view('layouts.admin.report.perjalanan-dinas-direktur.index', compact('resultPerjalDirektur'));
    }

    public function filterData(Request $request)
    {
        $resultPerjalDirektur = PerjalananDinas::leftJoin('pelaksanaperjalanandinas', 'perjalanandinas.id', '=', 'pelaksanaperjalanandinas.perjalanandinas_id')
                                    ->where('pelaksanaperjalanandinas.nomorindukpegawai', '197011112005011003')
                                    ->whereBetween('perjalanandinas.tgl_sppd', [$request->tanggal_mulai, $request->tanggal_selesai])
                                    ->paginate(10);
        return view('layouts.admin.report.perjalanan-dinas-direktur.index', compact('resultPerjalDirektur'));
    }
}
