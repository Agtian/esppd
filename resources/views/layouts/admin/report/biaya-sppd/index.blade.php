@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Biaya SPPD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Report</a></li>
                        <li class="breadcrumb-item active">Biaya SPPD</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> <br> {{ session('message') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Tabel Data Biaya SPPD</h3>
    
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
                <form action="{{ url('dashboard/admin/biaya-sppd-filter') }}" method="post" class="form-horizonal">
                    @csrf
                    
                    <div class="form-group row">
                        <label for="tanggal_mulai" class="col-form-label">Tanggal mulai</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai">
                            @error('tanggal_mulai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label class="col-form-label">s.d</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" name="tanggal_selesai">
                            @error('tanggal_selesai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-outline-primary btn-block">Tampilkan</button>
                        </div>
                    </div>
                </form>
                <hr>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered m-0">
                        <thead>
                            <tr>
                                <th width="30"><center>NO</center></th>
                                <th>TANGGAL</th>
                                <th>NO SPPD</th>
                                <th>PELAKSANA</th>
                                <th>TEMPAT TUJUAN</th>
                                <th>TOTAL BIAYA</th>
                                <th width="100"><center>AKSI</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($perjalananDinas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ date('d F Y', strtotime($item->tgl_sppd)) }}</td>
                                    <td>{{ $item->no_sppd }}</td>
                                    <td>
                                        @forelse ($item->pelaksanaPerjals as $list)
                                            <li>{{ $list->nama_pegawai.' '.$list->gelarbelakang_nama }}</li>
                                        @empty
                                            <li class="bg-danger">Data tidak tersedia</li>
                                        @endforelse
                                    </td>
                                    <td>{{ $item->tempat_tujuan }}</td>
                                    <td>{{ $item->total_biaya }}</td>
                                    <td align="center">
                                        <a href="{{ url('dashboard/admin/biaya-sppd/'.$item->id.'/edit') }}" class="btn btn-sm btn-outline-primary btn-block">DETAIL</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Data tidak tersedia !</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                {{ $perjalananDinas->links() }}
            </div>
        </div>
            
    </section>
@endsection
