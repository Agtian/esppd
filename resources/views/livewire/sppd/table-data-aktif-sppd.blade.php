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
                                        @foreach ($item->pelaksanaPerjals as $listPelaksana)
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i> {{ $listPelaksana->nama_pegawai.' '.$listPelaksana->gelarbelakang_nama }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $item->dasar }}</td>
                                <td>{{ $item->maksud_perjalanan }}</td>
                                <td>{{ $item->tempat_tujuan }}</td>
                                <td align="center">{{ $item->jam_acara }}</td>
                                <td>{{ date('d M Y', strtotime($item->tgl_mulai)).' s.d '.date('d M Y', strtotime($item->tgl_selesai)) }}</td>
                                <td width="170" align="center">
                                    <button wire:click="openDetail({{ $item->id }})" class="btn btn-outline-dark btn-sm">DETAIL</button>
                                    <a href="" class="btn btn-outline-danger btn-sm">SELESAI</a>
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
                <form action="" method="POST" class="form-horizontal">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <button class="btn btn-md btn-outline-success">Simpan SPPD</button>
                        <button class="btn btn-md btn-outline-primary">Tambah Pelaksana</button>
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
                                                    <button class="btn btn-sm btn-outline-dark">Edit</button>
                                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Data tidak tersedia !</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <hr>

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
                </form>
            </div>
        </div>
    @endif
</div>