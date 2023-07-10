<div>
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> <br> {{ session('message') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    @include('livewire.sppd.modals.form-update-rincian-biaya')

    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Pelaksana</th>
                <th>Uang Harian</th>
                <th>Biaya Transport</th>
                <th>Biaya Penginapan</th>
                <th>Uang Representasi</th>
                <th>Biaya Pesawat</th>
                <th>Biaya Tol</th>
                <th>Biaya Lainnya</th>
                <th>Total</th>
                <th><button type="button" wire:click="$emit('refreshComponent')" class="btn btn-sm btn-outline-primary">Reload</button></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($resultPelaksanaPerjal as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_pegawai }}</td>
                    <td>{{ $item->uang_harian }}</td>
                    <td>{{ $item->biaya_transport }}</td>
                    <td>{{ $item->biaya_penginapan }}</td>
                    <td>{{ $item->uang_representasi }}</td>
                    <td>{{ $item->biaya_pesawat }}</td>
                    <td>{{ $item->biaya_tol }}</td>
                    <td>{{ $item->biaya_lainnya }}</td>
                    <td>{{ $item->total_biaya }}</td>
                    <td>
                        @if ($item->status_update == 0)
                            <button type="button" class="btn btn-sm btn-outline-dark" wire:click="modalUpdateRincianBiaya({{ $item->id }})" data-toggle="modal"
                            data-target="#modal-update-rincian-biaya">Ubah</button>
                        @else
                            <button class="btn btn-sm btn-outline-danger" disabled>Done</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" align="center">Data pelaksana tidak tersedia !</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#modal-update-rincian-biaya').modal('hide');
        });
    </script>
@endpush