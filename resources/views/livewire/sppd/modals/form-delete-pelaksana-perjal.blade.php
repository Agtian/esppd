<div wire:ignore.self class="modal fade" id="deletePelaksanaPerjalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Pelaksana Perjalanan Dinas</h4>
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
                <form wire:submit.prevent="destroyPelaksanaPerjal()">
                    <div class="modal-body">
                        <p>Apakah anda yakin akan menghapus pelaksana perjalanan dinas ini ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger text-white">Ya, hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>