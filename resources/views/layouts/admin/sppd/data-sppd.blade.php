@extends('layouts.app')

@push('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data SPPD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">SPPD</a></li>
                        <li class="breadcrumb-item active">Data SPPD</li>
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
                <h3 class="card-title">Tabel Data SPPD</h3>
    
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
                                <th width="115">TANGGAL <br>SPPD</th>
                                <th>NO SPPD</th>
                                <th>NAMA</th>
                                <th>DASAR</th>
                                <th>MAKSUD PERJALANAN</th>
                                <th>TEMPAT TUJUAN</th>
                                <th>TANGGAL & JAM</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resultDataSPPD as $item)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($item->tgl_sppd)) }}</td>
                                    <td>{{ $item->no_sppd }}</td>
                                    <td>
                                        <ul class="nav nav-pills flex-column">
                                            @forelse ($item->pelaksanaPerjals as $listPelaksana)
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#"> {{ $listPelaksana->nama_pegawai.' '.$listPelaksana->gelarbelakang_nama }}</a>
                                                </li>
                                            @empty
                                                <button class="btn btn-md btn-outline-danger">Pelaksana SPPD tidak tersedia !</button>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>{{ $item->dasar }}</td>
                                    <td>{{ $item->maksud_perjalanan }}</td>
                                    <td>{{ $item->tempat_tujuan }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tgl_mulai)) }}  <br>s.d<br> {{ date('d-m-Y', strtotime($item->tgl_selesai)) }} <br>({{ $item->jumlah_hari }} hari) <br>Jam {{ date('H:i', strtotime($item->jam_acara)) }}</td>
                                    <td width="100" align="center">
                                        <form action="{{ url('dashboard/admin/sppd/'.$item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-md btn-danger m-1">Unvalidated</button>
                                        </form>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark">OPTION</button>
                                            <button type="button" class="btn btn-dark dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                @if ($item->pelaksanaPerjals->count() <= 4)
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ url('printout/surat-tugas-i/'.$item->id) }}" target="_blank">Surat Tugas</a>
                                                    <a class="dropdown-item" href="{{ url('printout/sppd/'.$item->id) }}" target="_blank">SPPD</a>
                                                    <a class="dropdown-item" href="{{ url('printout/rincian-biaya-i/'.$item->id) }}" target="_blank">Rincian Biaya</a>
                                                @else
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ url('printout/surat-tugas-ii/'.$item->id) }}" target="_blank">Surat Tugas</a>
                                                    <a class="dropdown-item" href="{{ url('printout/sppd-iii/'.$item->id) }}" target="_blank">SPPD</a>
                                                    <a class="dropdown-item" href="{{ url('printout/rincian-biaya-ii/'.$item->id) }}" target="_blank">Rincian Biaya</a>
                                                @endif
                                            </div>
                                        </div>
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
                {{ $resultDataSPPD->links() }}
            </div>
        </div>

    </section>
@endsection

@push('script')
    
@endpush