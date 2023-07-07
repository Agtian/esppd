<?php

namespace App\Http\Livewire\Sppd;

use App\Models\Golonganpegawais;
use App\Models\Pangkats;
use App\Models\Pegawais;
use App\Models\PelaksanaPerjalananDinas;
use App\Models\PerjalananDinas;
use App\Models\PGSQL\GelarBelakang_m;
use App\Models\PGSQL\GolonganPegawai_m;
use App\Models\PGSQL\Jabatan_m;
use App\Models\PGSQL\Pangkat_m;
use App\Models\PGSQL\Pegawai_m;
use App\Models\PGSQL\Pegawai_v;
use App\Models\PGSQL\UnitKerja_m;
use App\Models\RincianBiaya;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TableDataAktifSppd extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $showDetail = false, $showSelectEditPangkat = false, $showDetailEditPelaksanaPerjal = false;

    public $pegawaiPelaksana = [], $resultPangkats = [], $resultGelarBelakangs = [], $resultJabatans = [], $resultGolonganPegawais = [], $resultUnitKerjas = [];
    
    public $searchPegawaiPelaksana, $searchPegawaiArr;
    
    public $pelaksanaperjalanandinas_id, $perjalanandinas_id, $pegawai_id, $user_id, $no_perjal, $no_sppd, $dasar, $undangan_dari, $tgl_ditetapkan, $jumlah_hari, $hari, $tgl_mulai, $tgl_selesai, $tgl_sppd, $maksud_perjalanan, $tempat_tujuan, $jam_acara, $uang_harian = 0, $biaya_transport = 0, $biaya_penginapan = 0, $uang_representasi = 0, $biaya_pesawat = 0, $biaya_lainnya = 0, $biaya_tol = 0, $total_biaya, $status_update, $status_sppd, $gelardepan, $nama_pegawai, $gelarbelakang_nama, $nomorindukpegawai, $pelaksanaPerjalananDinas_id, $resultTotalBiaya, $jumlahPelaksanaPerjal, $addpegawai_id;

    public $detNamaPegawai, $detGelarBelakangPegawai, $detJabatan, $detPangkat, $detGolongan, $detNIP;

    public $pangkat_id, $golonganpegawai_id, $unitkerja_id, $jabatan_id, $gelarbelakang_id;

    public $detailResultAktifSPPD, $resultPelaksanaPerjal;

    public function rules()
    {
        return [
            'dasar'             => 'required|string',
            'undangan_dari'     => 'required|string',
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

    public function resetShow()
    {
        $this->showDetailEditPelaksanaPerjal == false;
        $this->showSelectEditPangkat == false;
    }

    public function render()
    {
        $this->resultTotalBiaya = (($this->uang_harian == '') ? 0 : $this->uang_harian) + (($this->biaya_transport == '') ? 0 : $this->biaya_transport) + (($this->biaya_penginapan == '') ? 0 : $this->biaya_penginapan) + (($this->uang_representasi == '') ? 0 : $this->uang_representasi) + (($this->biaya_pesawat == '') ? 0 : $this->biaya_pesawat) + (($this->biaya_tol == '') ? 0 : $this->biaya_tol) + (($this->biaya_lainnya == '') ? 0 : $this->biaya_lainnya);

        $this->jumlahPelaksanaPerjal = PelaksanaPerjalananDinas::where('perjalanandinas_id', $this->perjalanandinas_id)->count();

        $resultAktifSPPD    = PerjalananDinas::paginate(10);
        $search             = '%'.$this->searchPegawaiPelaksana.'%';
        $resultPegawais     = (new Pegawai_v())->getDataPegawais($search);
        
        return view('livewire.sppd.table-data-aktif-sppd', compact('resultAktifSPPD', 'resultPegawais'));
    }

    public function openEditPangkat(int $pegawai_id)
    {
        $this->showSelectEditPangkat =! $this->showSelectEditPangkat;
        $this->resultPangkats = Pangkat_m::all();
    }

    public function openDetailEditPelaksanaPerjal(int $pegawai_id)
    {
        $this->showDetailEditPelaksanaPerjal =! $this->showDetailEditPelaksanaPerjal;
        $this->resultJabatans = Jabatan_m::all();
        $this->resultPangkats = Pangkat_m::all();
        $this->resultGolonganPegawais = GolonganPegawai_m::all();
        $this->resultGelarBelakangs = GelarBelakang_m::all();
        $this->resultUnitKerjas = UnitKerja_m::all();
        
        $detPegawai = Pegawai_m::findOrFail($pegawai_id);
        $this->pegawai_id = $detPegawai->pegawai_id;
        $this->gelardepan = $detPegawai->gelardepan;
        $this->nama_pegawai = $detPegawai->nama_pegawai;
        $this->gelarbelakang_id = $detPegawai->gelarbelakang_id;
        $this->nomorindukpegawai = $detPegawai->nomorindukpegawai;
        $this->jabatan_id = $detPegawai->jabatan_id;
        $this->pangkat_id = $detPegawai->pangkat_id;
        $this->golonganpegawai_id = $detPegawai->golonganpegawai_id;
        $this->unitkerja_id = $detPegawai->unitkerja_id;
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

    public function openDetail(int $perjalanandinas_id)
    {
        $this->showDetail =! $this->showDetail;
        
        $perjalananDinas = PerjalananDinas::findOrFail($perjalanandinas_id);
        $this->detailResultAktifSPPD = PerjalananDinas::find($perjalanandinas_id);
        $this->resultPelaksanaPerjal = PelaksanaPerjalananDinas::where('perjalanandinas_id', $perjalanandinas_id)->get();

        $this->perjalanandinas_id = $perjalanandinas_id;
        // $this->user_id = $perjalananDinas->user_id;
        // $this->no_perjal = $perjalananDinas->no_perjal;
        // $this->no_sppd = $perjalananDinas->no_sppd;
        // $this->dasar = $perjalananDinas->dasar;
        // $this->undangan_dari = $perjalananDinas->undangan_dari;
        // $this->tgl_ditetapkan = $perjalananDinas->tgl_ditetapkan;
        // $this->jumlah_hari = $perjalananDinas->jumlah_hari;
        // $this->hari = $perjalananDinas->hari;
        // $this->tgl_mulai = $perjalananDinas->tgl_mulai;
        // $this->tgl_selesai = $perjalananDinas->tgl_selesai;
        $this->tgl_sppd = $perjalananDinas->tgl_sppd;
        // $this->maksud_perjalanan = $perjalananDinas->maksud_perjalanan;
        // $this->tempat_tujuan = $perjalananDinas->tempat_tujuan;
        // $this->jam_acara = $perjalananDinas->jam_acara;
        // $this->uang_harian = $perjalananDinas->uang_harian;
        // $this->biaya_transport = $perjalananDinas->biaya_transport;
        // $this->biaya_penginapan = $perjalananDinas->biaya_penginapan;
        // $this->uang_representasi = $perjalananDinas->uang_representasi;
        // $this->biaya_pesawat = $perjalananDinas->biaya_pesawat;
        // $this->biaya_lainnya = $perjalananDinas->biaya_lainnya;
        // $this->status_sppd = $perjalananDinas->status_sppd;
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function closeModalRincianBiaya()
    {
        $this->resetModalUpdateRincianBiaya();
    }

    public function updateRincianBiaya()
    {   
        $validatedUpdate = $this->validate([
            'uang_harian'            => 'required|integer',
            'biaya_transport'        => 'integer',
            'biaya_penginapan'       => 'integer',
            'uang_representasi'      => 'integer',
            'biaya_pesawat'          => 'integer',
            'biaya_lainnya'          => 'integer',
            'total_biaya'            => 'integer',
            'biaya_tol'              => 'integer',
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

    public function updateBiodataPegawai()
    {
        $validatedAdd = $this->validate([
            'gelardepan'            => '',
            'nama_pegawai'          => 'required',
            'gelarbelakang_id'      => '',
            'nomorindukpegawai'     => 'required',
            'jabatan_id'            => 'required',
            'pangkat_id'            => 'required',
            'golonganpegawai_id'    => 'required',
            'unitkerja_id'          => 'required',
        ]);

        Pegawai_m::findOrFail($this->pegawai_id)->update([
            'gelardepan'            => $validatedAdd['gelardepan'],
            'nama_pegawai'          => $validatedAdd['nama_pegawai'],
            'gelarbelakang_id'      => $validatedAdd['gelarbelakang_id'],
            'nomorindukpegawai'     => $validatedAdd['nomorindukpegawai'],
            'jabatan_id'            => $validatedAdd['jabatan_id'],
            'pangkat_id'            => $validatedAdd['pangkat_id'],
            'golonganpegawai_id'    => $validatedAdd['golonganpegawai_id'],
            'unitkerja_id'          => $validatedAdd['unitkerja_id'],
        ]);
        
        session()->flash('message-sub', 'Biodata pegawai berhasil diperbarui');
    }

    public function updatePangkatPegawai(int $pegawai_id)
    {
        Pegawai_m::findOrFail($pegawai_id)->update([
            'pangkat_id'    => $this->pangkat_id,
        ]);

        session()->flash('message', 'Pangkat pegawai berhasil diperbarui');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function updatePelaksanaPerjal()
    {
        $detPegawai = Pegawais::findOrFail($this->pegawai_id);
        $detPangkat = Pangkats::findOrFail($this->pegawai_id);
        $detGol     = Golonganpegawais::findOrFail($detPangkat->golonganpegawai_id);
        PelaksanaPerjalananDinas::findOrFail($this->pelaksanaPerjalananDinas_id)->update([
            'pegawai_id'            => $detPegawai->id,
            'gelardepan'            => $detPegawai->gelardepan,
            'nama_pegawai'          => $detPegawai->nama_pegawai,
            'gelarbelakang_nama'    => $detPegawai->gelarbelakang_nama,
            'nomorindukpegawai'     => $detPegawai->nomorindukpegawai,
            'pangkat'               => $detPangkat->pangkat_nama,
            'jabatan'               => $detPegawai->nama_jabatan,
            'golongan'              => $detGol->golonganpegawai_nama,
            'unit_kerja'            => $detPegawai->namaunitkerja,
        ]);

        session()->flash('message', 'Pelaksana perjalanan dinas berhasil diperbarui');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function openAddPelaksanaModal()
    {
        $this->resetInput();
        $this->resetShow();
        $this->pegawaiPelaksana = Pegawais::all();
    }

    public function storePelaksanaPerjal(int $pegawai_id)
    {
        $detPegawais    = Pegawai_m::findOrFail($pegawai_id);

        if ($detPegawais->pangkat_id == null || $detPegawais->golonganpegawai_id == null || $detPegawais->jabatan_id == null || $detPegawais->unitkerja_id == null) {
            return session()->flash('message-sub-warning', 'Gagal, biodata pegawai belum lengkap!');
        } else {
            $detPangkat     = Pangkat_m::findOrFail($detPegawais->pangkat_id);
            $detGol         = GolonganPegawai_m::findOrFail($detPegawais->golonganpegawai_id);
            PelaksanaPerjalananDinas::create([
                'perjalanandinas_id'    => $this->perjalanandinas_id,
                'pegawai_id'            => $pegawai_id,
                'gelardepan'            => $detPegawais->gelardepan,
                'nama_pegawai'          => $detPegawais->nama_pegawai,
                'gelarbelakang_nama'    => $detPegawais->gelarbelakangs->gelarbelakang_nama,
                'nomorindukpegawai'     => $detPegawais->nomorindukpegawai,
                'pangkat'               => $detPangkat->pangkat_nama,
                'jabatan'               => $detPegawais->jabatans->jabatan_nama,
                'golongan'              => $detGol->golonganpegawai_nama,
                'unit_kerja'            => $detPegawais->unitkerjas->namaunitkerja,
                'tgl_sppd'              => $this->tgl_sppd,
            ]);

            session()->flash('message', 'Pelaksana perjalanan dinas berhasil disimpan');
            $this->dispatchBrowserEvent('close-modal');
            $this->resetInput();
        }
    }

    public function updateSPPD()
    {
        $validatedData = $this->validate();
        
        $this->validate([
            'uang_harian'       => 'required|integer',
            'biaya_transport'   => 'required|integer',
            'biaya_penginapan'  => 'required|integer',
            'uang_representasi' => 'required|integer',
            'biaya_pesawat'     => 'required|integer',
            'biaya_lainnya'     => 'required|integer',
        ]);

        PerjalananDinas::findOrFail($this->perjalanandinas_id)->update([
            'dasar'                 => $this->dasar,
            'undangan_dari'         => $this->undangan_dari,
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

    public function deletePelaksanaPerjal($pelaksanaperjalanandinas_id)
    {
        $this->pelaksanaperjalanandinas_id = $pelaksanaperjalanandinas_id;
    }

    public function hapusBiayaDanPelaksanaPerjal()
    {   
        $getDataPelaksanaPerjal = PelaksanaPerjalananDinas::findOrFail($this->pelaksanaperjalanandinas_id);
        $getDataPerjal          = PerjalananDinas::findOrFail($getDataPelaksanaPerjal->perjalanandinas_id);

        PerjalananDinas::findOrFail($this->perjalanandinas_id)->update([
            'uang_harian'            => $getDataPerjal->uang_harian - $getDataPelaksanaPerjal->uang_harian,
            'biaya_transport'        => $getDataPerjal->biaya_transport - $getDataPelaksanaPerjal->biaya_transport,
            'biaya_penginapan'       => $getDataPerjal->biaya_penginapan - $getDataPelaksanaPerjal->biaya_penginapan,
            'uang_representasi'      => $getDataPerjal->uang_representasi - $getDataPelaksanaPerjal->uang_representasi,
            'biaya_pesawat'          => $getDataPerjal->biaya_pesawat - $getDataPelaksanaPerjal->biaya_pesawat,
            'biaya_lainnya'          => $getDataPerjal->biaya_lainnya - $getDataPelaksanaPerjal->biaya_lainnya,
            'total_biaya'            => $getDataPerjal->total_biaya - $getDataPelaksanaPerjal->total_biaya,
        ]);

        PelaksanaPerjalananDinas::findOrFail($this->pelaksanaperjalanandinas_id)->delete();
        session()->flash('message', 'Pelaksana perjalanan dinas berhasil dihapus');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetModalUpdateRincianBiaya();
        $this->emit(event:'refreshComponent');
    }
}
