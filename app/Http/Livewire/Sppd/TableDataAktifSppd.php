<?php

namespace App\Http\Livewire\Sppd;

use App\Models\Pegawais;
use App\Models\PelaksanaPerjalananDinas;
use App\Models\PerjalananDinas;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TableDataAktifSppd extends Component
{
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $showDetail = false;

    public $pegawaiPelaksana = [];
    
    public $perjalanandinas_id, $pegawai_id, $user_id, $no_perjal, $no_sppd, $dasar, $lokasi_ditetapkan, $tgl_ditetapkan, $jumlah_hari, $hari, $tgl_mulai, $tgl_selesai, $tgl_sppd, $maksud_perjalanan, $tempat_tujuan, $jam_acara, $uang_harian = 0, $biaya_transport = 0, $biaya_penginapan = 0, $uang_representasi = 0, $biaya_pesawat = 0, $biaya_lainnya = 0, $status_sppd, $gelardepan, $nama_pegawai, $gelarbelakang_nama, $nomorindukpegawai, $pelaksanaPerjalananDinas_id, $resultTotalBiaya, $jumlahPelaksanaPerjal, $addpegawai_id;

    public $detailResultAktifSPPD;

    public function rules()
    {
        return [
            'dasar'             => 'required|string',
            'lokasi_ditetapkan' => 'required|string',
            'jumlah_hari'       => 'required|integer',
            'hari'              => 'required',
            'tgl_mulai'         => 'required',
            'tgl_selesai'       => 'required',
            'tgl_sppd'          => 'required',
            'maksud_perjalanan' => 'required',
            'tempat_tujuan'     => 'required',
            'jam_acara'         => 'required',
        ];
    }

    public function resetInput()
    {
        $this->addpegawai_id = NULL;
        $this->gelardepan = NULL;
        $this->nama_pegawai = NULL;
        $this->gelarbelakang_nama = NULL;
        $this->nomorindukpegawai = NULL;
    }

    public function render()
    {
        $this->resultTotalBiaya = (($this->uang_harian == '') ? 0 : $this->uang_harian) + (($this->biaya_transport == '') ? 0 : $this->biaya_transport) + (($this->biaya_penginapan == '') ? 0 : $this->biaya_penginapan) + (($this->uang_representasi == '') ? 0 : $this->uang_representasi) + (($this->biaya_pesawat == '') ? 0 : $this->biaya_pesawat) + (($this->biaya_lainnya == '') ? 0 : $this->biaya_lainnya);

        
        $this->jumlahPelaksanaPerjal = PelaksanaPerjalananDinas::where('perjalanandinas_id', $this->perjalanandinas_id)->count();

        $resultAktifSPPD = PerjalananDinas::paginate(10);
        return view('livewire.sppd.table-data-aktif-sppd', compact('resultAktifSPPD'));
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

    public function closeModal()
    {
        $this->resetInput();
    }

    public function editPelaksanaPerjal(int $pelaksanaPerjal_id)
    {
        $pelaksanaPerjal = PelaksanaPerjalananDinas::findOrFail($pelaksanaPerjal_id);
        $this->pegawaiPelaksana = Pegawais::all();
        $this->pelaksanaPerjalananDinas_id = $pelaksanaPerjal->id;
        $this->perjalanandinas_id = $pelaksanaPerjal->perjalanandinas_id;
        $this->pegawai_id = $pelaksanaPerjal->pegawai_id;
        $this->gelardepan = $pelaksanaPerjal->gelardepan;
        $this->nama_pegawai = $pelaksanaPerjal->nama_pegawai;
        $this->gelarbelakang_nama = $pelaksanaPerjal->gelarbelakang_nama;
        $this->nomorindukpegawai = $pelaksanaPerjal->nomorindukpegawai;

        $this->emit(event:'refreshComponent');
    }

    public function updatePelaksanaPerjal()
    {
        $detPegawai = Pegawais::findOrFail($this->pegawai_id);
        PelaksanaPerjalananDinas::findOrFail($this->pelaksanaPerjalananDinas_id)->update([
            'pegawai_id'            => $detPegawai->id,
            'gelardepan'            => $detPegawai->gelardepan,
            'nama_pegawai'          => $detPegawai->nama_pegawai,
            'gelarbelakang_nama'    => $detPegawai->gelarbelakang_nama,
            'nomorindukpegawai'     => $detPegawai->nomorindukpegawai,
        ]);

        session()->flash('message', 'Pelaksana perjalanan dinas berhasil diperbarui');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function openAddPelaksanaModal()
    {
        $this->resetInput();
        $this->pegawaiPelaksana = Pegawais::all();
    }

    public function storePelaksanaPerjal()
    {
        $validatedAdd = $this->validate([
            'addpegawai_id'            => 'required',
        ]);

        $detPegawais = Pegawais::findOrFail($validatedAdd['addpegawai_id']);
        PelaksanaPerjalananDinas::create([
            'perjalanandinas_id'    => $this->perjalanandinas_id,
            'pegawai_id'            => $validatedAdd['addpegawai_id'],
            'gelardepan'            => $detPegawais->gelardepan,
            'nama_pegawai'          => $detPegawais->nama_pegawai,
            'gelarbelakang_nama'    => $detPegawais->gelarbelakang_nama,
            'nomorindukpegawai'     => $detPegawais->nomorindukpegawai,
            'tgl_sppd'              => $this->tgl_sppd,
        ]);

        session()->flash('message', 'Pelaksana perjalanan dinas berhasil disimpan');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function updateSPPD()
    {
        $validatedData = $this->validate();
        
        $this->validate([
            'uang_harian' => 'required|integer',
            'biaya_transport' => 'required|integer',
            'biaya_penginapan' => 'required|integer',
            'uang_representasi' => 'required|integer',
            'biaya_pesawat' => 'required|integer',
            'biaya_lainnya' => 'required|integer',
        ]);

        PerjalananDinas::findOrFail($this->perjalanandinas_id)->update([
            'dasar'                 => $this->dasar,
            'lokasi_ditetapkan'     => $this->lokasi_ditetapkan,
            'jumlah_hari'           => $this->jumlah_hari,
            'hari'                  => $this->hari,
            'tgl_mulai'             => $this->tgl_mulai,
            'tgl_selesai'           => $this->tgl_selesai,
            'tgl_sppd'              => $this->tgl_sppd,
            'maksud_perjalanan'     => $this->maksud_perjalanan,
            'tempat_tujuan'         => $this->tempat_tujuan,
            'jam_acara'             => $this->jam_acara,
            'uang_harian'           => $this->uang_harian,
            'biaya_transport'       => $this->biaya_transport,
            'biaya_penginapan'      => $this->biaya_penginapan,
            'uang_representasi'     => $this->uang_representasi,
            'biaya_pesawat'         => $this->biaya_pesawat,
            'biaya_lainnya'         => $this->biaya_lainnya,
        ]);

        session()->flash('message', "Rincian SPPD : $this->no_sppd berhasil diperbarui");
        $this->resetInput();
    }

    public function deletePelaksanaPerjal($perjalanandinas_id)
    {
        $this->perjalanandinas_id = $perjalanandinas_id;
    }

    public function destroyPelaksanaPerjal()
    {
        PelaksanaPerjalananDinas::findOrFail($this->perjalanandinas_id)->delete();
        session()->flash('message', 'Pelaksana perjalanan dinas berhasil dihapus');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
}
