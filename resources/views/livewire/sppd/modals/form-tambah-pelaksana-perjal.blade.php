<div wire:ignore.self class="modal fade" id="tambahPelaksanaPerjalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pelaksana Perjal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="storePelaksanaPerjal()">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Pelaksana</label>
                        <div class="col-sm-9">
                            <select class="form-control" wire:model.defer="addpegawai_id">
                                <option>--- Pilih Pegawai ---</option>
                                @foreach ($pegawaiPelaksana as $pelaksana)
                                    <option value="{{ $pelaksana->id }}">{{ $pelaksana->nama_pegawai }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>