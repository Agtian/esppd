<div wire:ignore.self class="modal fade" id="modal-update-rincian-biaya" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rincian Biaya - {{ $nama_pegawai }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="updateRincianBiaya()">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Uang Harian</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control @error('uang_harian') is-invalid @enderror" wire:model="uang_harian" value="0">
                                    @error('uang_harian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Keterangan Uang Harian</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control @error('keterangan_uang_harian') is-invalid @enderror" wire:model="keterangan_uang_harian" rows="3"></textarea>
                                    @error('keterangan_uang_harian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Biaya Lainnya</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control @error('biaya_lainnya') is-invalid @enderror" wire:model="biaya_lainnya">
                                    @error('biaya_lainnya')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Keterangan Biaya Lainnya</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control @error('ket_biaya_lainnya') is-invalid @enderror" wire:model="ket_biaya_lainnya" cols="30" rows="3"></textarea>
                                    @error('ket_biaya_lainnya')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Uang Representasi</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control @error('uang_representasi') is-invalid @enderror" wire:model="uang_representasi" value="0">
                                    @error('uang_representasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Biaya Penginapan</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control @error('resultBiayaPenginapan') is-invalid @enderror" wire:model="resultBiayaPenginapan" value="{{ old('resultBiayaPenginapan') }}" readonly>
                                    @error('biaya_pesawat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Biaya Pesawat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('resultBiayaPesawat') is-invalid @enderror" wire:model.defer="resultBiayaPesawat" value="0" readonly>
                                    @error('resultBiayaPesawat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Biaya Transport</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('resultBiayaTransport') is-invalid @enderror" wire:model.defer="resultBiayaTransport" value="0" readonly>
                                    @error('biaya_transport')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Total Biaya</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control @error('resultTotalBiaya') is-invalid @enderror" wire:model.defer="resultTotalBiaya" value="0">
                                    @error('resultTotalBiaya')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 card card-secondary p-0">
                            <div class="card-header">
                                <h3 class="card-title">Biaya Transportasi</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Biaya Tol</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('biaya_transport_tol') is-invalid @enderror" wire:model="biaya_transport_tol" value="0">
                                                @error('biaya_transport_tol')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Biaya BBM</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('biaya_transport_bbm') is-invalid @enderror" wire:model="biaya_transport_bbm" value="0">
                                                @error('biaya_transport_bbm')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Biaya Travel</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('biaya_transport_travel') is-invalid @enderror" wire:model="biaya_transport_travel" value="0">
                                                @error('biaya_transport_travel')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Biaya Taxi</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('biaya_transport_taxi') is-invalid @enderror" wire:model="biaya_transport_taxi" value="0">
                                                @error('biaya_transport_taxi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 card card-secondary p-0">
                            <div class="card-header">
                                <h3 class="card-title">Biaya Riil</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Biaya Transport</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('biaya_transport_riil') is-invalid @enderror" wire:model="biaya_transport_riil" value="0">
                                                @error('biaya_transport_riil')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Biaya Penginapan</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('biaya_penginapan_riil') is-invalid @enderror" wire:model="biaya_penginapan_riil" value="0">
                                                @error('biaya_penginapan_riil')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Biaya Pesawat</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('biaya_pesawat_riil') is-invalid @enderror" wire:model="biaya_pesawat_rill" value="{{ old('biaya_pesawat_riil') }}">
                                                @error('biaya_pesawat_rill')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Biaya Tol</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('biaya_tol_riil') is-invalid @enderror" wire:model="biaya_tol_riil" value="{{ old('biaya_tol_riil') }}">
                                                @error('biaya_tol_riil')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Biaya Lainnya</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('biaya_lainnya_riil') is-invalid @enderror" wire:model="biaya_lainnya_riil" value="0">
                                                @error('biaya_lainnya_riil')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Keterangan Biaya Lainnya</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control @error('ket_biaya_lainnya_riil') is-invalid @enderror" wire:model="ket_biaya_lainnya_riil" cols="30" rows="3"></textarea>
                                                @error('ket_biaya_lainnya_riil')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 card card-secondary p-0">
                            <div class="card-header">
                                <h3 class="card-title">Biaya Penginapan / Hotel</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Nama Penginapan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('hotel_nama') is-invalid @enderror" wire:model="hotel_nama">
                                                @error('hotel_nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">No Kamar</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('hotel_no_kamar') is-invalid @enderror" wire:model="hotel_no_kamar">
                                                @error('hotel_no_kamar')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Tanggal Check In</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control @error('hotel_tgl_checkin') is-invalid @enderror" wire:model="hotel_tgl_checkin">
                                                @error('hotel_tgl_checkin')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Tanggal Check Out</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control @error('hotel_tgl_checkout') is-invalid @enderror" wire:model="hotel_tgl_checkout">
                                                @error('hotel_tgl_checkout')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Lama Menginap</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('hotel_lama_inap') is-invalid @enderror" wire:model="hotel_lama_inap" value="0">
                                                @error('hotel_lama_inap')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Harga Per Malam</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('hotel_harga_permalam') is-invalid @enderror" wire:model="hotel_harga_permalam" value="0">
                                                @error('hotel_harga_permalam')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Jumlah Dibayarkan</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('hotel_jumlah_dibayarkan') is-invalid @enderror" wire:model="hotel_jumlah_dibayarkan" value="0">
                                                @error('hotel_jumlah_dibayarkan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Nama Kuitansi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('hotel_nama_kuitansi') is-invalid @enderror" wire:model="hotel_nama_kuitansi" value="0">
                                                @error('hotel_nama_kuitansi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Total Biaya Penginapan</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control @error('hotel_jumlah_dibayarkan') is-invalid @enderror" wire:model="hotel_jumlah_dibayarkan" value="0" readonly>
                                                @error('hotel_jumlah_dibayarkan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 card card-secondary p-0">
                            <div class="card-header">
                                <h3 class="card-title">Biaya Pesawat</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-12 card card-outline card-secondary p-0">
                                    <div class="card-header">
                                        <h3 class="card-title">Berangkat</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nama Maskapai</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('pesawat_maskapai_berangkat') is-invalid @enderror" wire:model="pesawat_maskapai_berangkat">
                                                        @error('pesawat_maskapai_berangkat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nomor Tiket</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('pesawat_no_tiket_berangkat') is-invalid @enderror" wire:model="pesawat_no_tiket_berangkat">
                                                        @error('pesawat_no_tiket_berangkat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Kode Booking</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('pesawat_kode_booking_berangkat') is-invalid @enderror" wire:model="pesawat_kode_booking_berangkat">
                                                        @error('pesawat_kode_booking_berangkat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nomor Penerbangan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('pesawat_no_penerbangan_berangkat') is-invalid @enderror" wire:model="pesawat_no_penerbangan_berangkat">
                                                        @error('pesawat_no_penerbangan_berangkat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Tanggal Berangkat</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control @error('pesawat_tgl_berangkat') is-invalid @enderror" wire:model="pesawat_tgl_berangkat">
                                                        @error('pesawat_tgl_berangkat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Jumlah Dibayar</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control @error('pesawat_jumlah_dibayar_berangkat') is-invalid @enderror" wire:model="pesawat_jumlah_dibayar_berangkat">
                                                        @error('pesawat_jumlah_dibayar_berangkat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 card card-outline card-secondary p-0">
                                    <div class="card-header">
                                        <h3 class="card-title">Pulang</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nama Maskapai</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('pesawat_maskapai_pulang') is-invalid @enderror" wire:model="pesawat_maskapai_pulang">
                                                        @error('pesawat_maskapai_pulang')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nomor Tiket</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('pesawat_no_tiket_pulang') is-invalid @enderror" wire:model="pesawat_no_tiket_pulang">
                                                        @error('pesawat_no_tiket_pulang')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Kode Booking</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('pesawat_kode_booking_pulang') is-invalid @enderror" wire:model="pesawat_kode_booking_pulang">
                                                        @error('pesawat_kode_booking_pulang')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nomor Penerbangan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('pesawat_no_penerbangan_pulang') is-invalid @enderror" wire:model="pesawat_no_penerbangan_pulang">
                                                        @error('pesawat_no_penerbangan_pulang')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Tanggal Berangkat</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control @error('pesawat_tgl_pulang') is-invalid @enderror" wire:model="pesawat_tgl_pulang">
                                                        @error('pesawat_tgl_pulang')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Jumlah Dibayar</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control @error('pesawat_jumlah_dibayar_pulang') is-invalid @enderror" wire:model="pesawat_jumlah_dibayar_pulang" value="0">
                                                        @error('pesawat_jumlah_dibayar_pulang')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="closeModalRincianBiaya" class="btn btn-secondary"
                        data-dismiss="modal">Kembali</button>
                    @if ($status_update == 0)
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>