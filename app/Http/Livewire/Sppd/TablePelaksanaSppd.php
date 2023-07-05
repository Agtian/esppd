<?php

namespace App\Http\Livewire\Sppd;

use App\Models\Pegawais;
use App\Models\PelaksanaPerjalananDinas;
use App\Models\PerjalananDinas;
use Livewire\Component;
use Livewire\WithPagination;

class TablePelaksanaSppd extends Component
{
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $showDetail = false;

    public $pegawaiPelaksana = [];
    
    public $perjalanandinas_id, $pegawai_id, $user_id, $no_perjal, $no_sppd, $dasar, $undangan_dari, $tgl_ditetapkan, $jumlah_hari, $hari, $tgl_mulai, $tgl_selesai, $tgl_sppd, $maksud_perjalanan, $tempat_tujuan, $jam_acara, $uang_harian = 0, $biaya_transport = 0, $biaya_penginapan = 0, $uang_representasi = 0, $biaya_pesawat = 0, $biaya_lainnya = 0, $status_sppd, $gelardepan, $nama_pegawai, $gelarbelakang_nama, $nomorindukpegawai, $pelaksanaPerjalananDinas_id, $resultTotalBiaya, $jumlahPelaksanaPerjal, $addpegawai_id;

    public $detailResultAktifSPPD;

    public function render()
    {
        $this->resultTotalBiaya = (($this->uang_harian == '') ? 0 : $this->uang_harian) + (($this->biaya_transport == '') ? 0 : $this->biaya_transport) + (($this->biaya_penginapan == '') ? 0 : $this->biaya_penginapan) + (($this->uang_representasi == '') ? 0 : $this->uang_representasi) + (($this->biaya_pesawat == '') ? 0 : $this->biaya_pesawat) + (($this->biaya_lainnya == '') ? 0 : $this->biaya_lainnya);
        $this->jumlahPelaksanaPerjal = PelaksanaPerjalananDinas::where('perjalanandinas_id', $this->perjalanandinas_id)->count();

        $resultAktifSPPD = PerjalananDinas::paginate(10);
        return view('livewire.sppd.table-pelaksana-sppd', compact('resultAktifSPPD'));
    }

    public function openDetail(int $perjalanandinas_id)
    {
        $this->showDetail =! $this->showDetail;
        
        $perjalananDinas = PerjalananDinas::findOrFail($perjalanandinas_id);
        $this->detailResultAktifSPPD = PerjalananDinas::find($perjalanandinas_id);

        $this->perjalanandinas_id = $perjalananDinas->id;
        $this->user_id = $perjalananDinas->user_id;
        $this->no_perjal = $perjalananDinas->no_perjal;
        $this->no_sppd = $perjalananDinas->no_sppd;
        $this->dasar = $perjalananDinas->dasar;
        $this->undangan_dari = $perjalananDinas->undangan_dari;
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

    public function closeModal()
    {
        $this->resetInput();
    }
}
