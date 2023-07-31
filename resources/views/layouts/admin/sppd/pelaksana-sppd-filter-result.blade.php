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
                    <h1 class="m-0">Pelaksana SPPD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">SPPD</a></li>
                        <li class="breadcrumb-item active">Pelaksana SPPD</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="card card-dark">
            <div class="card-header  border-transparent">
                <h3 class="card-title">Filter Data</h3>
    
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
                <div class="row">
                    <div class="col-6">
                        <form action="{{ url('dashboard/admin/pelaksana-sppd/filter-data') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nama</label>
                                <div class="col-9">
                                    <select class="form-control" id="select_pegawais" name="pegawai_id"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Surat Dari</label>
                                <div class="col-9">
                                    <select class="form-control" id="select_surat_dari" name="daftar_opd_id"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Maksud Perjalanan Dinas</label>
                                <div class="col-9">
                                    <select class="form-control" id="select_maksud_perjalanan" name="maksud_perjalanan"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Tanggal SPPD</label>
                                <div class="col-4">
                                    <input type="date" class="form-control" name="tgl_awal" placeholder="Tanggal Awal">
                                </div>
                                <label class="col-1 col-form-label"><center>s.d</center></label>
                                <div class="col-4">
                                    <input type="date" class="form-control" name="tgl_akhir" placeholder="Tanggal Akhir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3"></label>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-outline-primary">Tampilkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> <br> {{ session('message') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card card-dark">
            <div class="card-body p-2">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i> Detail Filter Data
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered m-0">
                            <tr>
                                <td width="200">Nama</td>
                                <td>{{ $pegawais }}</td>
                            </tr>
                            <tr>
                                <td width="200">Surat Dari / OPD</td>
                                <td>{{ $daftarOPD }}</td>
                            </tr>
                            <tr>
                                <td width="200">Maksud Perjalanan Dinas</td>
                                <td>{{ $maksudPerjal }}</td>
                            </tr>
                            <tr>
                                <td width="200">Periode Tanggal SPPD</td>
                                <td>{{ $tanggalFilter }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-header border-transparent">
                <h3 class="card-title">Tabel Data Pelaksana SPPD</h3>
    
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
                            @forelse ($resultAktifSPPD as $item)
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
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark">OPTION</button>
                                            <button type="button" class="btn btn-dark dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <button class="dropdown-item" wire:click="openDetail({{ $item->id }})">Detail</button>
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
                {{ $resultAktifSPPD->links() }}
            </div>
        </div>
        
        {{-- <livewire:sppd.table-pelaksana-sppd> --}}
            
    </section>
@endsection

@push('script')
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $("#select_pegawais" ).select2({
                theme: 'bootstrap4',
                // closeOnSelect: true,
                ajax: { 
                    url: "{{ url('dashboard/admin/get-pegawais') }}",
                    type: "POST",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            searchpegawai: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }

            });
        });
    </script>

    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $("#select_surat_dari" ).select2({
                theme: 'bootstrap4',
                // closeOnSelect: true,
                ajax: { 
                    url: "{{ url('dashboard/admin/get-daftar-opd') }}",
                    type: "POST",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            searchsuratdari: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });
    </script>

    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $("#select_maksud_perjalanan" ).select2({
                theme: 'bootstrap4',
                // closeOnSelect: true,
                ajax: { 
                    url: "{{ url('dashboard/admin/get-maksud-perjalanan') }}",
                    type: "POST",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            searchmaksudperjalanan: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }

            });
        });
    </script>
@endpush