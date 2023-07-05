<div wire:ignore.self class="modal fade" id="modal-update-rincian-biaya" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rincian Biaya</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="updateRincianBiaya()">
                <div class="modal-body">
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
                <div class="modal-footer">
                    
                </div>
            </form>
        </div>
    </div>
</div>