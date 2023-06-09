<?php

namespace App\Http\Livewire\Sppd;

use App\Models\PerjalananDinas;
use Livewire\Component;
use Livewire\WithPagination;

class TableDataAktifSppd extends Component
{
    use WithPagination;

    public $showDetail = false;
    
    public $perjalanandinas_id, $pegawai_id, $user_id, $no_perjal, $no_sppd, $dasar, $lokasi_ditetapkan, $tgl_ditetapkan, $jumlah_hari, $hari, $tgl_mulai, $tgl_selesai, $tgl_sppd, $maksud_perjalanan, $tempat_tujuan, $jam_acara, $uang_harian, $biaya_transport, $biaya_penginapan, $uang_representasi, $biaya_pesawat, $biaya_lainnya, $status_sppd;

    public $detailResultAktifSPPD;

    public function render()
    {
        $resultAktifSPPD = PerjalananDinas::paginate(10);
        return view('livewire.sppd.table-data-aktif-sppd', compact('resultAktifSPPD'));
    }

    public function openDetail(int $perjalanandinas_id)
    {
        $this->showDetail =! $this->showDetail;

        $perjalananDinas = PerjalananDinas::findOrFail($perjalanandinas_id);
        $this->detailResultAktifSPPD = PerjalananDinas::findOrFail($perjalanandinas_id);

        $this->perjalanandinas_id = $perjalananDinas->id;
        $this->user_id = $perjalananDinas->user_id;
        $this->no_perjal = $perjalananDinas->no_perjal;
        $this->no_sppd = $perjalananDinas->no_sppd;
        $this->dasar = $perjalananDinas->no_perjal;
        $this->lokasi_ditetapkan = $perjalananDinas->lokasi_ditetapkan;
        $this->tgl_ditetapkan = $perjalananDinas->tgl_ditetapkan;
        $this->jumlah_hari = $perjalananDinas->jumlah_hari;
        $this->hari = $perjalananDinas->hari;
        $this->tgl_mulai = $perjalananDinas->tgl_mulai;
        $this->tgl_selesai = $perjalananDinas->tgl_selesai;
        $this->tgl_sppd = $perjalananDinas->tgl_sppd;
        $this->maksud_perjalanan = $perjalananDinas->maksud_perjalanan;
        $this->tempat_tujuan = $perjalananDinas->tempat_tujuan;
        $this->jam_acara = $perjalananDinas->jam_acara;
        $this->uang_harian = $perjalananDinas->uang_harian;
        $this->biaya_transport = $perjalananDinas->biaya_transport;
        $this->biaya_penginapan = $perjalananDinas->biaya_penginapan;
        $this->uang_representasi = $perjalananDinas->uang_representasi;
        $this->biaya_pesawat = $perjalananDinas->biaya_pesawat;
        $this->biaya_lainnya = $perjalananDinas->biaya_lainnya;
        $this->status_sppd = $perjalananDinas->status_sppd;
    }
}
