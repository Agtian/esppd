@push('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

<div>
    <div class="card card-dark">
        <div class="card-header border-transparent">
            <h3 class="card-title">Tabel Data SPPD Aktif</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered m-0">
                    <thead>
                        <tr align="center">
                            <th>TANGGAL SPPD</th>
                            <th>NO SPPD</th>
                            <th>NAMA</th>
                            <th>DASAR</th>
                            <th>MAKSUD PERJALANAN</th>
                            <th>TEMPAT TUJUAN</th>
                            <th>JAM</th>
                            <th>TANGGAL</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($resultAktifSPPD as $item)
                            <tr>
                                <td width="150">{{ $item->tgl_sppd }}</td>
                                <td>{{ $item->no_sppd }}</td>
                                <td>
                                    <ul class="nav nav-pills flex-column">
                                        @forelse ($item->pelaksanaPerjals as $listPelaksana)
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i> {{ $listPelaksana->nama_pegawai.' '.$listPelaksana->gelarbelakang_nama }}</a>
                                            </li>
                                        @empty
                                            <button class="btn btn-md btn-outline-danger">Pelaksana SPPD tidak tersedia !</button>
                                        @endforelse
                                    </ul>
                                </td>
                                <td>{{ $item->dasar }}</td>
                                <td>{{ $item->maksud_perjalanan }}</td>
                                <td>{{ $item->tempat_tujuan }}</td>
                                <td align="center">{{ $item->jam_acara }}</td>
                                <td>{{ date('d M Y', strtotime($item->tgl_mulai)).' s.d '.date('d M Y', strtotime($item->tgl_selesai)) }}</td>
                                <td width="100" align="center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark">OPTION</button>
                                        <button type="button" class="btn btn-dark dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <button class="dropdown-item" wire:click="openDetail({{ $item->id }})">Detail</button>
                                            @if ($item->pelaksanaPerjals->count() <= 4)
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ url('printout/surat-tugas-i/'.$item->id) }}" target="_blank">Surat Tugas</a>
                                                <a class="dropdown-item" href="{{ url('printout/sppd/'.$item->id) }}" target="_blank">SPPD</a>
                                                <a class="dropdown-item" href="{{ url('printout/rincian-biaya-i/'.$item->id) }}" target="_blank">Rincian Biaya</a>
                                            @else
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ url('printout/surat-tugas-ii/'.$item->id) }}" target="_blank">Surat Tugas</a>
                                                <a class="dropdown-item" href="{{ url('printout/sppd-iii/'.$item->id) }}" target="_blank">SPPD</a>
                                                <a class="dropdown-item" href="{{ url('printout/rincian-biaya-ii/'.$item->id) }}" target="_blank">Rincian Biaya</a>
                                            @endif
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="">SELESAI</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">Data Not Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $resultAktifSPPD->links() }}
        </div>
    </div>
    
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> <br> {{ session('message') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    
    @include('livewire.sppd.modals.form-tambah-pelaksana-perjal')
    @include('livewire.sppd.modals.form-delete-pelaksana-perjal')
    
    @if ($showDetail)
        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Detail SPPD : {{ $no_sppd }}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="updateSPPD()" class="form-horizontal">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <button type="submit" class="btn btn-md btn-outline-success">Simpan SPPD</button>
                        <button type="button" wire:click="$emit('refreshComponent')" class="btn btn-md btn-outline-primary">Reload Data</button>
                        <button type="button" class="btn btn-md btn-outline-primary" data-toggle="modal"
                        data-target="#tambahPelaksanaPerjalModal" wire:click="openAddPelaksanaModal">Tambah Pelaksana</button>
                    </div>

                    <div class="card card-outline card-secondary">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr class="bg-secondary">
                                            <th width="50">No</th>
                                            <th>Nama Pelaksana</th>
                                            <th>NIP</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($detailResultAktifSPPD->pelaksanaPerjals as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_pegawai.' '.$item->gelarbelakang_nama }}</td>
                                                <td>{{ $item->nomorindukpegawai }}</td>
                                                <td>
                                                    <button type="button" wire:click="$emit('refreshComponent')" class="btn btn-sm btn-outline-primary">Reload</button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" wire:click="deletePelaksanaPerjal({{ $item->id }})" data-toggle="modal"
                                                        data-target="#deletePelaksanaPerjalModal">Hapus</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" align="center" class="bg-danger">Data pelaksana tidak tersedia, silahkan input pelaksana perjalanan dinas!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="card card-secondary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="pt-2 px-3"><h3 class="card-title">Rincian SPPD</h3></li>
                                <li class="nav-item">
                                    <a class="nav-link" id="kegiatan-tab" data-toggle="pill" href="#custom-tabs-two-kegiatan" role="tab" aria-controls="custom-tabs-two-kegiatan" aria-selected="true">Kegiatan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="biaya-tab" data-toggle="pill" href="#custom-tabs-two-biaya" role="tab" aria-controls="custom-tabs-two-biaya" aria-selected="false">Biaya</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Messages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Settings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                <div class="tab-pane fade" id="custom-tabs-two-kegiatan" role="tabpanel" aria-labelledby="kegiatan-tab">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Dasar</label>
                                        <div class="col-sm-9">
                                            <textarea wire:model.defer="dasar" cols="20" rows="3" class="form-control @error('dasar') is-invalid @enderror">{{ old('dasar') }}</textarea>
                                            @error('dasar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Lokasi Ditetapkan</label>
                                        <div class="col-sm-9">
                                            <textarea wire:model.defer="lokasi_ditetapkan" cols="20" rows="3" class="form-control @error('lokasi_ditetapkan') is-invalid @enderror">{{ old('dasar') }}</textarea>
                                            @error('lokasi_ditetapkan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Jumlah Hari</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control @error('jumlah_hari') is-invalid @enderror" wire:model.defer="jumlah_hari" value="{{ old('jumlah_hari') }}">
                                            @error('jumlah_hari')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Hari</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('hari') is-invalid @enderror" wire:model.defer="hari" value="{{ old('hari') }}">
                                            @error('hari')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" wire:model.defer="tgl_mulai" value="{{ old('tgl_mulai') }}">
                                            @error('tgl_mulai')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tanggal Selesai</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" wire:model.defer="tgl_selesai" value="{{ old('tgl_selesai') }}">
                                            @error('tgl_selesai')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tanggal SPPD Dibuat</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control @error('tgl_sppd') is-invalid @enderror" wire:model.defer="tgl_sppd" value="{{ old('tgl_sppd') }}">
                                            @error('tgl_sppd')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Maksud Perjalanan</label>
                                        <div class="col-sm-9">
                                            <textarea wire:model.defer="maksud_perjalanan" cols="20" rows="3" class="form-control @error('maksud_perjalanan') is-invalid @enderror">{{ old('maksud_perjalanan') }}</textarea>
                                            @error('maksud_perjalanan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tempat Tujuan</label>
                                        <div class="col-sm-9">
                                            <textarea wire:model.defer="tempat_tujuan" cols="20" rows="3" class="form-control @error('tempat_tujuan') is-invalid @enderror">{{ old('tempat_tujuan') }}</textarea>
                                            @error('tempat_tujuan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Jam Acara</label>
                                        <div class="col-sm-9">
                                            <input type="time" class="form-control @error('jam_acara') is-invalid @enderror" wire:model.defer="jam_acara" value="{{ old('jam_acara') }}">
                                            @error('jam_acara')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="custom-tabs-two-biaya" role="tabpanel" aria-labelledby="biaya-tab">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Uang Harian</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control @error('uang_harian') is-invalid @enderror" wire:model="uang_harian" value="0">
                                                    @error('uang_harian')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Biaya Transport</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control @error('biaya_transport') is-invalid @enderror" wire:model="biaya_transport" value="0">
                                                    @error('biaya_transport')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Biaya Penginapan</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control @error('biaya_penginapan') is-invalid @enderror" wire:model="biaya_penginapan" value="0">
                                                    @error('biaya_penginapan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Total Biaya</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control @error('resultTotalBiaya') is-invalid @enderror" wire:model="resultTotalBiaya" value="0">
                                                    @error('resultTotalBiaya')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Uang Representasi</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control @error('uang_representasi') is-invalid @enderror" wire:model="uang_representasi" value="0">
                                                    @error('uang_representasi')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Biaya Pesawat</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control @error('biaya_pesawat') is-invalid @enderror" wire:model="biaya_pesawat" value="{{ old('biaya_pesawat') }}">
                                                    @error('biaya_pesawat')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Biaya Lainnya</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control @error('biaya_lainnya') is-invalid @enderror" wire:model="biaya_lainnya" value="0">
                                                    @error('biaya_lainnya')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                                    Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                                    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#tambahPelaksanaPerjalModal').modal('hide');
            $('#deletePelaksanaPerjalModal').modal('hide');
        });
    </script>
@endpush