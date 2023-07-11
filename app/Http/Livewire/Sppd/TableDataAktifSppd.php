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
        $this->resultJabatans = Jabatan_m::orderBy('jabatan_nama', 'ASC')->get();
        $this->resultPangkats = Pangkat_m::orderBy('pangkat_nama', 'ASC')->get();
        $this->resultGolonganPegawais = GolonganPegawai_m::orderBy('golonganpegawai_nama', 'ASC')->get();
        $this->resultGelarBelakangs = GelarBelakang_m::orderBy('gelarbelakang_nama', 'ASC')->get();
        $this->resultUnitKerjas = UnitKerja_m::orderBy('namaunitkerja', 'ASC')->get();
        
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

    public function openDetail(int $perjalanandinas_id)
    {
        $this->showDetail =! $this->showDetail;
        
        $perjalananDinas = PerjalananDinas::findOrFail($perjalanandinas_id);
        $this->detailResultAktifSPPD = PerjalananDinas::find($perjalanandinas_id);
        $this->resultPelaksanaPerjal = PelaksanaPerjalananDinas::where('perjalanandinas_id', $perjalanandinas_id)->get();

        $this->perjalanandinas_id = $perjalanandinas_id;
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
    }

    public function closeModal()
    {
        $this->resetInput();
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

        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        session()->flash('message', 'Pelaksana perjalanan dinas berhasil diperbarui');
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
                'gelarbelakang_nama'    => ($detPegawais->gelarbelakangs == NULL) ? '' : $detPegawais->gelarbelakangs->gelarbelakang_nama,
                'nomorindukpegawai'     => $detPegawais->nomorindukpegawai,
                'pangkat'               => $detPangkat->pangkat_nama,
                'jabatan'               => $detPegawais->jabatans->jabatan_nama,
                'golongan'              => $detGol->golonganpegawai_nama,
                'unit_kerja'            => $detPegawais->unitkerjas->namaunitkerja,
                'tgl_sppd'              => $this->tgl_sppd,
            ]);

            $this->dispatchBrowserEvent('close-modal');
            $this->resetInput();
            $this->emit(event:'refreshComponent');
            session()->flash('message', 'Pelaksana perjalanan dinas berhasil disimpan');
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

        session()->flash('message', "Rincian kegiatan SPPD : $this->no_sppd berhasil diperbarui");
        $this->resetInput();
    }

    public function hapusBiayaDanPelaksanaPerjal(int $pelaksanaperjalanandinas_id)
    {   
        $getDataPelaksanaPerjal = PelaksanaPerjalananDinas::findOrFail($pelaksanaperjalanandinas_id);
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

        PelaksanaPerjalananDinas::findOrFail($pelaksanaperjalanandinas_id)->delete();
        $this->emit(event:'refreshComponent');
        session()->flash('message', 'Pelaksana perjalanan dinas berhasil dihapus');
    }
}
