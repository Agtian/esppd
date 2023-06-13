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
        
        PDF::SetTitle('e SPPD | Surat Tugas');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output('Surat Tugas.pdf');
    }

    public function suratSPPDLembarPertama($perjalanandinas_id)
    {
        // use TCPDF
        $html = view('layouts.admin.sppd.printout.surat-perintah-perjalanan-dinas-i')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);
        
        PDF::SetTitle('e SPPD | Surat Perintah Perjalanan Dinas');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output('SPPD.pdf');
    }

    public function suratSPPDLembarKedua()
    {
        // use TCPDF
        $html = view('layouts.admin.sppd.printout.surat-perintah-perjalanan-dinas-ii')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);
        
        PDF::SetTitle('e SPPD | Surat Perintah Perjalanan Dinas');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output('SPPD.pdf');
    }

    public function rincianBiaya()
    {
        
    }
}
