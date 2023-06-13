<?php

namespace App\Http\Controllers\Admin\DevelopmentSPPD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class PrintOutController extends Controller
{
    public function suratTugas($perjalanandinas_id)
    {
        // use TCPDF
        $html = view('layouts.admin.sppd.printout.surat-tugas')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);
        
        PDF::SetTitle('e Diklat | Surat Balasan');
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output('Surat Tugas.pdf');
    }

    public function suratSPPD()
    {
        
    }

    public function rincianBiaya()
    {
        
    }
}
