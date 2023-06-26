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
                    <div class="col-sm-3">
                        {{-- <button type="button" class="btn btn-md btn-dark" wire:click="openSearchPegawaiPelaksana()">Tampilkan</button> --}}
                    </div>
                </div>
            </div>

            <div>
                <div class="modal-body">
                    <div class="form-group row">
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
                                            <td>
                                                @if ($item->pangkat_id == null)
                                                    <button class="btn btn-sm btn-outline-danger">TIDAK TERSEDIA !</button>
                                                @else
                                                    {{ $item->pangkat_nama }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->golonganpegawai_id == null)
                                                    <button class="btn btn-sm btn-outline-danger">TIDAK TERSEDIA !</button>
                                                @else
                                                    {{ $item->golonganpegawai_nama }}
                                                @endif
                                            </td>
                                            <td>{{ $item->namaunitkerja }}</td>
                                            <td align="center">
                                                <button class="btn btn-sm btn-outline-dark">UPDATE</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-white">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>