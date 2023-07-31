<?php

namespace App\Http\Livewire\Sppd;

use App\Models\PelaksanaPerjalananDinas;
use App\Models\PerjalananDinas;
use Livewire\Component;

class TableRincianBiayaPerjal extends Component
{
    public $resultTotalBiaya, $resultBiayaPesawat, $resultBiayaPenginapan, $resultBiayaTransport;

    public $perjalanandinas_id, $pelaksanaperjalanandinas_id, $uang_harian, $keterangan_uang_harian, $biaya_transport, $biaya_penginapan, $uang_representasi, $biaya_pesawat, $biaya_lainnya = 0, $biaya_tol, $total_biaya, $keterangan_biaya_lainnya, $nama_pegawai, $status_update, $status_sppd;

    public $biaya_transport_bbm = 0, $biaya_transport_travel = 0, $biaya_transport_taxi = 0, $biaya_transport_tol = 0;

    public $biaya_taksi_trevel = 0, $travel_taxi = 0;

    public $hotel_nama, $hotel_no_kamar, $hotel_tgl_checkin, $hotel_tgl_checkout, $hotel_lama_inap = 0, $hotel_harga_permalam = 0, $hotel_jumlah_dibayarkan, $hotel_nama_kuitansi;

    public $pesawat_maskapai_berangkat, $pesawat_no_tiket_berangkat, $pesawat_kode_booking_berangkat, $pesawat_no_penerbangan_berangkat, $pesawat_tgl_berangkat, $pesawat_jumlah_dibayar_berangkat = 0, $pesawat_maskapai_pulang, $pesawat_no_tiket_pulang, $pesawat_kode_booking_pulang, $pesawat_no_penerbangan_pulang, $pesawat_tgl_pulang, $pesawat_jumlah_dibayar_pulang = 0;

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
        $this->resultBiayaPesawat = (($this->pesawat_jumlah_dibayar_berangkat == '') ? 0 : $this->pesawat_jumlah_dibayar_berangkat) + (($this->pesawat_jumlah_dibayar_pulang == '') ? 0 : $this->pesawat_jumlah_dibayar_pulang);

        $this->resultBiayaTransport = (($this->biaya_transport_tol == '') ? 0 : $this->biaya_transport_tol) + (($this->biaya_transport_bbm == '') ? 0 : $this->biaya_transport_bbm) + (($this->biaya_transport_travel == '') ? 0 : $this->biaya_transport_travel) + (($this->biaya_transport_taxi == '') ? 0 : $this->biaya_transport_taxi);
        
        $this->hotel_jumlah_dibayarkan = (($this->hotel_harga_permalam == '') ? 0 : $this->hotel_harga_permalam) * (($this->hotel_lama_inap == '') ? 0 : $this->hotel_lama_inap);

        $this->resultBiayaPenginapan = (($this->hotel_jumlah_dibayarkan == '') ? 0 : $this->hotel_jumlah_dibayarkan);
        
        $this->resultTotalBiaya = (($this->uang_harian == '') ? 0 : $this->uang_harian) + (($this->biaya_transport == '') ? 0 : $this->biaya_transport) + (($this->biaya_penginapan == '') ? 0 : $this->biaya_penginapan) + (($this->uang_representasi == '') ? 0 : $this->uang_representasi) + (($this->biaya_pesawat == '') ? 0 : $this->biaya_pesawat) + (($this->biaya_tol == '') ? 0 : $this->biaya_tol) + (($this->biaya_lainnya == '') ? 0 : $this->biaya_lainnya) + $this->resultBiayaPenginapan + $this->resultBiayaTransport + $this->resultBiayaPesawat;

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
        if ($this->uang_harian == 0) {
            session()->flash('message-danger', "Rincian biaya $this->nama_pegawai gagal diperbarui, uang harian tidak boleh kosong");
            $this->dispatchBrowserEvent('close-modal');
            $this->resetModalUpdateRincianBiaya();
        } else {
            $validatedUpdate = $this->validate([
                'uang_harian'            => 'required|integer',
                'biaya_transport'        => 'integer',
                'biaya_penginapan'       => 'integer',
                'uang_representasi'      => 'integer',
                'biaya_pesawat'          => 'integer',
                'biaya_tol'              => 'integer',
                'biaya_lainnya'          => 'integer',
                'resultTotalBiaya'       => 'integer',
                'resultBiayaTransport'   => 'integer',
                'resultBiayaPenginapan'  => 'integer',
                'resultBiayaPesawat'     => 'integer',

                'travel_taxi'               => 'integer',
                'keterangan_biaya_lainnya'  => 'max:255',
                'keterangan_uang_harian'    => 'max:255',
                
                'biaya_transport_bbm'    => 'integer',
                'biaya_transport_travel' => 'integer',
                'biaya_transport_taxi'   => 'integer',
                'biaya_transport_tol'    => 'integer',
                'biaya_taksi_trevel'     => 'integer',

                'hotel_nama'             => 'max:255',
                'hotel_no_kamar'         => 'max:150',
                'hotel_tgl_checkin'      => '',
                'hotel_tgl_checkout'     => '',
                'hotel_lama_inap'        => 'integer',
                'hotel_harga_permalam'   => 'integer',
                'hotel_jumlah_dibayarkan'=> 'integer',
                'hotel_nama_kuitansi'    => 'max:255',
                
                'pesawat_maskapai_berangkat'        => 'max:255',
                'pesawat_no_tiket_berangkat'        => 'max:150',
                'pesawat_kode_booking_berangkat'    => 'max:150',
                'pesawat_no_penerbangan_berangkat'  => 'max:150',
                'pesawat_tgl_berangkat'             => '',
                'pesawat_jumlah_dibayar_berangkat'  => 'integer',
                'pesawat_maskapai_pulang'           => 'max:255',
                'pesawat_no_tiket_pulang'           => 'max:150',
                'pesawat_kode_booking_pulang'       => 'max:150',
                'pesawat_no_penerbangan_pulang'     => 'max:150',
                'pesawat_tgl_pulang'                => '',
                'pesawat_jumlah_dibayar_pulang'     => 'integer',
            ]);

            PelaksanaPerjalananDinas::findOrFail($this->pelaksanaperjalanandinas_id)->update([
                'uang_harian'            => $validatedUpdate['uang_harian'],
                'biaya_transport'        => $validatedUpdate['resultBiayaTransport'],
                'biaya_penginapan'       => $validatedUpdate['resultBiayaPenginapan'],
                'uang_representasi'      => $validatedUpdate['uang_representasi'],
                'biaya_pesawat'          => $validatedUpdate['resultBiayaPesawat'],
                'biaya_lainnya'          => $validatedUpdate['biaya_lainnya'],
                'biaya_tol'              => $validatedUpdate['biaya_tol'],
                'total_biaya'            => $validatedUpdate['resultTotalBiaya'],
                'status_update'          => 1,

                'travel_taxi'               => $validatedUpdate['travel_taxi'],
                'keterangan_biaya_lainnya'  => $validatedUpdate['keterangan_biaya_lainnya'],
                'keterangan_uang_harian'    => $validatedUpdate['keterangan_uang_harian'],
                
                'biaya_transport_bbm'    => $validatedUpdate['biaya_transport_bbm'],
                'biaya_transport_travel' => $validatedUpdate['biaya_transport_travel'],
                'biaya_transport_taxi'   => $validatedUpdate['biaya_transport_taxi'],
                'biaya_transport_tol'    => $validatedUpdate['biaya_transport_tol'],
                'biaya_taksi_trevel'     => $validatedUpdate['biaya_taksi_trevel'],

                'hotel_nama'             => $validatedUpdate['hotel_nama'],
                'hotel_no_kamar'         => $validatedUpdate['hotel_no_kamar'],
                'hotel_tgl_checkin'      => $validatedUpdate['hotel_tgl_checkin'],
                'hotel_tgl_checkout'     => $validatedUpdate['hotel_tgl_checkout'],
                'hotel_lama_inap'        => $validatedUpdate['hotel_lama_inap'],
                'hotel_harga_permalam'   => $validatedUpdate['hotel_harga_permalam'],
                'hotel_jumlah_dibayarkan'=> $validatedUpdate['hotel_jumlah_dibayarkan'],
                'hotel_nama_kuitansi'    => $validatedUpdate['hotel_nama_kuitansi'],

                'pesawat_maskapai_berangkat'        => $validatedUpdate['pesawat_maskapai_berangkat'],
                'pesawat_no_tiket_berangkat'        => $validatedUpdate['pesawat_no_tiket_berangkat'],
                'pesawat_kode_booking_berangkat'    => $validatedUpdate['pesawat_kode_booking_berangkat'],
                'pesawat_no_penerbangan_berangkat'  => $validatedUpdate['pesawat_no_penerbangan_berangkat'],
                'pesawat_tgl_berangkat'             => $validatedUpdate['pesawat_tgl_berangkat'],
                'pesawat_jumlah_dibayar_berangkat'  => $validatedUpdate['pesawat_jumlah_dibayar_berangkat'],
                'pesawat_maskapai_pulang'           => $validatedUpdate['pesawat_maskapai_pulang'],
                'pesawat_no_tiket_pulang'           => $validatedUpdate['pesawat_no_tiket_pulang'],
                'pesawat_kode_booking_pulang'       => $validatedUpdate['pesawat_kode_booking_pulang'],
                'pesawat_no_penerbangan_pulang'     => $validatedUpdate['pesawat_no_penerbangan_pulang'],
                'pesawat_tgl_pulang'                => $validatedUpdate['pesawat_tgl_pulang'],
                'pesawat_jumlah_dibayar_pulang'     => $validatedUpdate['pesawat_jumlah_dibayar_pulang'],
            ]);

            $getDataPerjal = PerjalananDinas::findOrFail($this->perjalanandinas_id);
            PerjalananDinas::findOrFail($this->perjalanandinas_id)->update([
                'uang_harian'            => $getDataPerjal->uang_harian + $validatedUpdate['uang_harian'],
                'biaya_transport'        => $getDataPerjal->biaya_transport + $validatedUpdate['resultBiayaTransport'],
                'biaya_penginapan'       => $getDataPerjal->biaya_penginapan + $validatedUpdate['resultBiayaPenginapan'],
                'uang_representasi'      => $getDataPerjal->uang_representasi + $validatedUpdate['uang_representasi'],
                'biaya_pesawat'          => $getDataPerjal->biaya_pesawat + $validatedUpdate['resultBiayaPesawat'],
                'biaya_lainnya'          => $getDataPerjal->biaya_lainnya + $validatedUpdate['biaya_lainnya'],
                'biaya_tol'              => $getDataPerjal->biaya_tol + $validatedUpdate['biaya_tol'],
                'total_biaya'            => $getDataPerjal->total_biaya + $validatedUpdate['resultTotalBiaya'],
            ]);

            session()->flash('message', "Rincian biaya $this->nama_pegawai berhasil diperbarui");
            $this->dispatchBrowserEvent('close-modal');
            $this->resetModalUpdateRincianBiaya();
        }
    }
}
