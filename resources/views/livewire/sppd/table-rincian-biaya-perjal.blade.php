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
                    <td>{{ number_format($item->uang_harian, 2, '.',',') }}</td>
                    <td>{{ number_format($item->biaya_transport, 2, '.',',') }}</td>
                    <td>{{ number_format($item->biaya_penginapan, 2, '.',',') }}</td>
                    <td>{{ number_format($item->uang_representasi, 2, '.',',') }}</td>
                    <td>{{ number_format($item->biaya_pesawat, 2, '.',',') }}</td>
                    <td>{{ number_format($item->biaya_tol, 2, '.',',') }}</td>
                    <td>{{ number_format($item->biaya_lainnya, 2, '.',',') }}</td>
                    <td>{{ number_format($item->total_biaya, 2, '.',',') }}</td>
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
                    <td colspan="11" align="center" class="bg-danger">Data pelaksana tidak tersedia !</td>
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