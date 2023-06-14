<?php

namespace App\Http\Controllers\Admin\DevelopmentSPPD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class PrintOutController extends Controller
{
    public function suratTugasKurangDari4Orang($perjalanandinas_id)
    {
        // use TCPDF
        $html = view('layouts.admin.sppd.printout.surat-tugas-i')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);
        
        PDF::SetTitle('e SPPD | Surat Tugas');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output('Surat Tugas.pdf');
    }

    public function suratSPPD($perjalanandinas_id)
    {
        // use TCPDF
        $html = view('layouts.admin.sppd.printout.surat-perintah-perjalanan-dinas-i')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);
        
        PDF::SetTitle('e SPPD | Surat Perintah Perjalanan Dinas');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');

        
        $html = view('layouts.admin.sppd.printout.surat-perintah-perjalanan-dinas-ii')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output('SPPD.pdf');
    }

    public function suratTugasLebihDari4Orang()
    {
        // use TCPDF
        $htmlA = view('layouts.admin.sppd.printout.surat-tugas-ii')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);

        $htmlB = view('layouts.admin.sppd.printout.lampiran-surat-perintah-tugas-ii')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);
        
        PDF::SetTitle('e SPPD | Surat Tugas');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($htmlA, true, false, true, false, '');
        
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($htmlB, true, false, true, false, '');

        PDF::Output('Surat Tugas.pdf');
    }

    public function suratSPPDLebihDari4Orang()
    {
        // use TCPDF
        $htmlA = view('layouts.admin.sppd.printout.surat-perintah-perjalan-dinas-lebih-dari-4-orang')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);

        $htmlB = view('layouts.admin.sppd.printout.surat-perintah-perjalanan-dinas-ii')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);

        $htmlC = view('layouts.admin.sppd.printout.rekapitulasi-pelaksana-yang-melakasanakan-perjalanan-dinas')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);
        
        PDF::SetTitle('e SPPD | SPPD lebih dari 4 orang');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($htmlA, true, false, true, false, '');

        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($htmlB, true, false, true, false, '');
        
        PDF::AddPage('L', [215,330]);
        PDF::writeHTML($htmlC, true, false, true, false, '');

        PDF::Output('SPPD.pdf');
    }

    public function rincianBiayaLebihDari4Orang()
    {
        // use TCPDF
        $htmlA = view('layouts.admin.sppd.printout.rincian-biaya-lebih-dari-4-orang')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);
        
        PDF::SetTitle('e SPPD | Rincian Biaya lebih dari 4 orang');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($htmlA, true, false, true, false, '');

        $htmlB = view('layouts.admin.sppd.printout.rekapitulasi-rincian-biaya-perjalanan-dinas')->with([
            // 'detail'    => (new tDiklat())->getDetailSuratBalasan($no_pendaftaran)
        ]);
        
        PDF::AddPage('L', [215,330]);
        PDF::writeHTML($htmlB, true, false, true, false, '');

        PDF::Output('SPPD.pdf');
    }
}
