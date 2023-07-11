<?php

namespace App\Http\Livewire\Sppd;

use App\Models\PelaksanaPerjalananDinas;
use App\Models\PerjalananDinas;
use Livewire\Component;

class TableRincianBiayaPerjal extends Component
{
    public $resultTotalBiaya, $perjalanandinas_id, $pelaksanaperjalanandinas_id, $uang_harian, $biaya_transport, $biaya_penginapan, $uang_representasi, $biaya_pesawat, $biaya_lainnya, $biaya_tol, $total_biaya, $nama_pegawai, $status_update, $status_sppd;

    public $pegawai_id, $gelardepan, $gelarbelakang_nama, $nomorindukpegawai, $pangkat_id, $jabatan_id, $golonganpegawai_id, $unitkerja_id, $searchPegawaiPelaksana;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function resetModalUpdateRincianBiaya()
    {
        $this->uang_harian = 0;
        $this->biaya_transport = 0;
        $this->biaya_penginapan = 0;
        $this->uang_representasi = 0;
        $this->biaya_pesawat = 0;
        $this->biaya_lainnya = 0;
        $this->biaya_tol = 0;
        $this->total_biaya = 0;
    }

    public function resetInput()
    {
        $this->pegawai_id = NULL;
        $this->gelardepan = NULL;
        $this->nama_pegawai = NULL;
        $this->gelarbelakang_nama = NULL;
        $this->nomorindukpegawai = NULL;
        $this->pangkat_id = NULL;
        $this->jabatan_id = NULL;
        $this->golonganpegawai_id = NULL;
        $this->unitkerja_id = NULL;
        $this->searchPegawaiPelaksana = NULL;
    }

    public function closeModalRincianBiaya()
    {
        $this->resetModalUpdateRincianBiaya();
    }

    public function closeModal()
    {
        $this->resetInput();
    }
    

    public function render()
    {
        $this->resultTotalBiaya = (($this->uang_harian == '') ? 0 : $this->uang_harian) + (($this->biaya_transport == '') ? 0 : $this->biaya_transport) + (($this->biaya_penginapan == '') ? 0 : $this->biaya_penginapan) + (($this->uang_representasi == '') ? 0 : $this->uang_representasi) + (($this->biaya_pesawat == '') ? 0 : $this->biaya_pesawat) + (($this->biaya_tol == '') ? 0 : $this->biaya_tol) + (($this->biaya_lainnya == '') ? 0 : $this->biaya_lainnya);

        $resultPelaksanaPerjal = PelaksanaPerjalananDinas::where('perjalanandinas_id', $this->perjalanandinas_id)->get();

        return view('livewire.sppd.table-rincian-biaya-perjal', compact('resultPelaksanaPerjal'));
    }

    public function modalUpdateRincianBiaya(int $pelaksanaperjalanandinas_id)
    {
        $rincianBiaya = PelaksanaPerjalananDinas::findOrFail($pelaksanaperjalanandinas_id);
        
        $this->pelaksanaperjalanandinas_id  = $rincianBiaya->id;
        $this->perjalanandinas_id           = $rincianBiaya->perjalanandinas_id;
        $this->nama_pegawai                 = $rincianBiaya->gelardepan.' '.$rincianBiaya->nama_pegawai.', '.$rincianBiaya->gelarbelakang_nama;
        $this->uang_harian                  = $rincianBiaya->uang_harian;
        $this->biaya_transport              = $rincianBiaya->biaya_transport;
        $this->biaya_penginapan             = $rincianBiaya->biaya_penginapan;
        $this->uang_representasi            = $rincianBiaya->uang_representasi;
        $this->biaya_pesawat                = $rincianBiaya->biaya_pesawat;
        $this->biaya_lainnya                = $rincianBiaya->biaya_lainnya;
        $this->status_update                = $rincianBiaya->status_update;
        $this->biaya_tol                    = $rincianBiaya->biaya_tol;
        $this->status_sppd                  = $rincianBiaya->status_sppd;
    }

    public function updateRincianBiaya()
    {   
        $validatedUpdate = $this->validate([
            'uang_harian'            => 'required|integer',
            'biaya_transport'        => 'integer',
            'biaya_penginapan'       => 'integer',
            'uang_representasi'      => 'integer',
            'biaya_pesawat'          => 'integer',
            'total_biaya'            => 'integer',
            'biaya_tol'              => 'integer',
            'biaya_lainnya'          => 'integer',
            'resultTotalBiaya'       => 'integer',
        ]);

        PelaksanaPerjalananDinas::findOrFail($this->pelaksanaperjalanandinas_id)->update([
            'uang_harian'            => $validatedUpdate['uang_harian'],
            'biaya_transport'        => $validatedUpdate['biaya_transport'],
            'biaya_penginapan'       => $validatedUpdate['biaya_penginapan'],
            'uang_representasi'      => $validatedUpdate['uang_representasi'],
            'biaya_pesawat'          => $validatedUpdate['biaya_pesawat'],
            'biaya_lainnya'          => $validatedUpdate['biaya_lainnya'],
            'biaya_tol'              => $validatedUpdate['biaya_tol'],
            'total_biaya'            => $validatedUpdate['resultTotalBiaya'],
            'status_update'          => 1,
        ]);

        $getDataPerjal = PerjalananDinas::findOrFail($this->perjalanandinas_id);
        PerjalananDinas::findOrFail($this->perjalanandinas_id)->update([
            'uang_harian'            => $getDataPerjal->uang_harian + $validatedUpdate['uang_harian'],
            'biaya_transport'        => $getDataPerjal->biaya_transport + $validatedUpdate['biaya_transport'],
            'biaya_penginapan'       => $getDataPerjal->biaya_penginapan + $validatedUpdate['biaya_penginapan'],
            'uang_representasi'      => $getDataPerjal->uang_representasi + $validatedUpdate['uang_representasi'],
            'biaya_pesawat'          => $getDataPerjal->biaya_pesawat + $validatedUpdate['biaya_pesawat'],
            'biaya_lainnya'          => $getDataPerjal->biaya_lainnya + $validatedUpdate['biaya_lainnya'],
            'biaya_tol'              => $getDataPerjal->biaya_tol + $validatedUpdate['biaya_tol'],
            'total_biaya'            => $getDataPerjal->total_biaya + $validatedUpdate['resultTotalBiaya'],
        ]);

        session()->flash('message', "Rincian biaya $this->nama_pegawai berhasil diperbarui");
        $this->dispatchBrowserEvent('close-modal');
        $this->resetModalUpdateRincianBiaya();
    }
}
