<div wire:ignore.self class="modal fade" id="tambahPelaksanaPerjalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pelaksana Perjal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Pelaksana</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" wire:model="searchPegawaiPelaksana" autofocus>
                    </div>
                </div>
            </div>

            <div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr align="center">
                                        <th>NAMA</th>
                                        <th>NIP</th>
                                        <th>JABATAN</th>
                                        <th>PANGKAT</th>
                                        <th>GOLONGAN</th>
                                        <th>UNIT KERJA</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resultPegawais as $item)
                                        <tr>
                                            <td>{{ $item->nama_pegawai }}</td>
                                            <td>{{ $item->nomorindukpegawai }}</td>
                                            <td>{{ $item->jabatan_nama }}</td>
                                            <td align="center">
                                                @if ($item->pangkat_id == null)
                                                    <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="bottom" title="Pangkat pegawai ini belum tersedia, segera update biodata!" wire:click="openEditPangkat({{ $item->pegawai_id }})">TIDAK TERSEDIA !</button>
                                                    @if ($showSelectEditPangkat)
                                                        <form wire:submit.prevent="updatePangkatPegawai({{ $item->pegawai_id }})">
                                                            <div class="input-group mt-1">
                                                                <select wire:model.defer="pangkat_id" class="form-control">
                                                                    <option value="">Pangkat ?</option>
                                                                    @foreach ($resultPangkats as $item)
                                                                        <option value="{{ $item->pangkat_id }}">{{ $item->pangkat_nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-group-prepend">
                                                                    <button type="submit" class="btn btn-danger">Save</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endif
                                                @else
                                                    {{ $item->pangkat_nama }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->golonganpegawai_id == null)
                                                    <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="bottom" title="Golongan pegawai ini belum tersedia, segera update biodata!">TIDAK TERSEDIA !</button>
                                                @else
                                                    {{ $item->golonganpegawai_nama }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->namaunitkerja)
                                                    {{ $item->namaunitkerja }}
                                                @else
                                                    <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="bottom" title="Unit kerja pegawai ini belum tersedia, segera update biodata!">TIDAK TERSEDIA !</button>
                                                @endif
                                            </td>
                                            <td align="center">{{ $item->pegawai_id }}
                                                <button class="btn btn-sm btn-outline-dark" data-toggle="tooltip" data-placement="bottom" title="Update biodata pegawai" wire:click="openDetailEditPelaksanaPerjal({{ $item->pegawai_id }})">UPDATE</button>
                                                @if ($loop->count == 1)
                                                    <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="bottom" title="Pilih Pegawai ini sebagai pelaksana SPPD" wire:click="storePelaksanaPerjal({{ $item->pegawai_id }})"><i class="nav-icon fas fa-check"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if (session('message-sub'))
                            <div class="col-12 mt-2">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Sukses!</strong> <br> {{ session('message-sub') }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @elseif(session('message-sub-warning'))
                            <div class="col-12 mt-2">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Perhatian!</strong> <br> {{ session('message-sub-warning') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if ($showDetailEditPelaksanaPerjal)
                        <div class="card card-outline card-dark">
                            <form wire:submit.prevent="updateBiodataPegawai()">
                                <div class="card-body row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Gelar Depan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control @error('gelardepan') is-invalid @enderror" wire:model="gelardepan">
                                                @error('gelardepan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nama Pelaksana</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" wire:model="nama_pegawai">
                                                @error('nama_pegawai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Gelar Belakang</label>
                                            <div class="col-sm-9">
                                                <select class="form-control @error('gelarbelakang_id') is-invalid @enderror" wire:model="gelarbelakang_id">
                                                    <option value="">-- Pilih Gelar Belang --</option>
                                                    @foreach ($resultGelarBelakangs as $item)
                                                        <option value="{{ $item->gelarbelakang_id }}" {{ $gelarbelakang_id == $item->gelarbelakang_id ? 'selected' : '' }}>{{ $item->gelarbelakang_nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('gelarbelakang_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">NIP</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control @error('nomorindukpegawai') is-invalid @enderror" wire:model="nomorindukpegawai">
                                                @error('nomorindukpegawai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jabatan</label>
                                            <div class="col-sm-9">
                                                <select class="form-control @error('jabatan_id') is-invalid @enderror" wire:model="jabatan_id">
                                                    <option value="">-- Pilih Jabatan --</option>
                                                    @foreach ($resultJabatans as $item)
                                                        <option value="{{ $item->jabatan_id }}" {{ $jabatan_id == $item->jabatan_id ? 'selected' : '' }}>{{ $item->jabatan_nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('jabatan_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Pangkat</label>
                                            <div class="col-sm-9">
                                                <select class="form-control @error('pangkat_id') is-invalid @enderror" wire:model="pangkat_id">
                                                    <option value="">-- Pilih Pangkat --</option>
                                                    @foreach ($resultPangkats as $item)
                                                        <option value="{{ $item->pangkat_id }}" {{ $pangkat_id == $item->pangkat_id ? 'selected' : '' }}>{{ $item->pangkat_nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pangkat_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Golongan</label>
                                            <div class="col-sm-9">
                                                <select class="form-control @error('golonganpegawai_id') is-invalid @enderror" wire:model="golonganpegawai_id">
                                                    <option value="">-- Pilih Golongan --</option>
                                                    @foreach ($resultGolonganPegawais as $item)
                                                        <option value="{{ $item->golonganpegawai_id }}" {{ $golonganpegawai_id == $item->golonganpegawai_id ? 'selected' : '' }}>{{ $item->golonganpegawai_nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('golonganpegawai_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Unit Kerja</label>
                                            <div class="col-sm-9">
                                                <select class="form-control @error('unitkerja_id') is-invalid @enderror" wire:model="unitkerja_id">
                                                    <option value="">-- Pilih Unit Kerja --</option>
                                                    @foreach ($resultUnitKerjas as $item)
                                                        <option value="{{ $item->unitkerja_id }}" {{ $unitkerja_id == $item->unitkerja_id ? 'selected' : '' }}>{{ $item->namaunitkerja }}</option>
                                                    @endforeach
                                                </select>
                                                @error('unitkerja_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-md btn-dark float-right">Perbarui Biodata</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>