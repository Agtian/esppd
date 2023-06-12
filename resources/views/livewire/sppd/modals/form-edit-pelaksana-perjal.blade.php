<div wire:ignore.self class="modal fade" id="editPelaksanaPerjalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Pelaksana Perjal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden"></span>
                </div>Loading...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updatePelaksanaPerjal()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Pelaksana</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" wire:model.defer="nama_pegawai" value="{{ old('nama_pegawai') }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Pelaksana Baru</label>
                            <div class="col-sm-9">
                                <select class="form-control" wire:model.defer="pegawai_id">
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
                        <button type="submit" class="btn btn-primary text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>