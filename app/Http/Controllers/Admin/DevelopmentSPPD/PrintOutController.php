<?php

namespace App\Http\Controllers\Admin\DevelopmentSPPD;

use App\Http\Controllers\Controller;
use App\Models\KonfigurasiSppd;
use App\Models\PelaksanaPerjalananDinas;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;
use PDF;

class PrintOutController extends Controller
{
    public function suratTugasKurangDari4Orang($perjalanandinas_id)
    {
        $detail            = PerjalananDinas::find($perjalanandinas_id);
        $resultPelaksana   = PelaksanaPerjalananDinas::where('perjalanandinas_id', $perjalanandinas_id)->get();
        $konf_sppd         = KonfigurasiSppd::findOrFail(1);

        // use TCPDF
        $html = view('layouts.admin.sppd.printout.surat-tugas-i', compact('detail', 'resultPelaksana', 'konf_sppd'));
        
        PDF::SetTitle('e SPPD | Surat Tugas');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output('Surat Tugas.pdf');
    }

    public function suratSPPD($perjalanandinas_id)
    {
        $detail            = PerjalananDinas::find($perjalanandinas_id);
        $resultPelaksana   = PelaksanaPerjalananDinas::where('perjalanandinas_id', $perjalanandinas_id)->get();
        
        // use TCPDF
        $htmlA = view('layouts.admin.sppd.printout.surat-perintah-perjalanan-dinas-i', compact('detail', 'resultPelaksana'));
        
        PDF::SetTitle('e SPPD | Surat Perintah Perjalanan Dinas');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($htmlA, true, false, true, false, '');

        
        $htmlB = view('layouts.admin.sppd.printout.surat-perintah-perjalanan-dinas-ii', compact('detail', 'resultPelaksana'));

        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($htmlB, true, false, true, false, '');

        PDF::Output('SPPD.pdf');
    }

    public function rincianBiayaI($perjalanandinas_id)
    {
        $detail            = PerjalananDinas::find($perjalanandinas_id);
        $resultPelaksana   = PelaksanaPerjalananDinas::where('perjalanandinas_id', $perjalanandinas_id)->get();

        // use TCPDF
        $html = view('layouts.admin.sppd.printout.rincian-biaya-i', compact('detail', 'resultPelaksana'));
        
        PDF::SetTitle('e SPPD | Rincian Biaya');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output('Rincian Biaya.pdf');
    }

    public function suratTugasLebihDari4Orang($perjalanandinas_id)
    {
        $detail            = PerjalananDinas::find($perjalanandinas_id);
        $resultPelaksana   = PelaksanaPerjalananDinas::where('perjalanandinas_id', $perjalanandinas_id)->get();

        // use TCPDF
        $htmlA = view('layouts.admin.sppd.printout.surat-tugas-ii', compact('detail', 'resultPelaksana'));

        $htmlB = view('layouts.admin.sppd.printout.lampiran-surat-perintah-tugas-ii', compact('detail', 'resultPelaksana'));
        
        PDF::SetTitle('e SPPD | Surat Tugas');
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($htmlA, true, false, true, false, '');
        
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($htmlB, true, false, true, false, '');

        PDF::Output('Surat Tugas.pdf');
    }

    public function suratSPPDLebihDari4Orang($perjalanandinas_id)
    {
        $detail            = PerjalananDinas::find($perjalanandinas_id);
        $resultPelaksana   = PelaksanaPerjalananDinas::where('perjalanandinas_id', $perjalanandinas_id)->get();

        // use TCPDF
        $htmlA = view('layouts.admin.sppd.printout.surat-perintah-perjalan-dinas-lebih-dari-4-orang', compact('detail', 'resultPelaksana'));

        $htmlB = view('layouts.admin.sppd.printout.surat-perintah-perjalanan-dinas-ii', compact('detail', 'resultPelaksana'));
        
        $htmlC = view('layouts.admin.sppd.printout.rekapitulasi-pelaksana-yang-melakasanakan-perjalanan-dinas', compact('detail', 'resultPelaksana'));
        
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
