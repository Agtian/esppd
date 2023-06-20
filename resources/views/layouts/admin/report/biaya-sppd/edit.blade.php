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
                        <li class="breadcrumb-item">Biaya SPPD</li>
                        <li class="breadcrumb-item active">Detail Biaya SPPD</li>
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

        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-12">
                    <h4>
                    <i class="fas fa-file"></i> NO SPPD : {{ $detail->no_sppd }}
                    <small class="float-right">Tanggal : {{ date('d/m/Y', strtotime($detail->tgl_sppd)) }}</small>
                    </h4>
                </div>
            </div>

            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Dari
                <address>
                    <strong>{{ $confSppd->nama_rs }}</strong><br>
                    Jalan Raya Jepara - Kelet km.37<br>
                    Kelet, Keling, Jepara, Jawa Tengah<br>
                    Telepon: {{ $confSppd->no_telp_rs }}<br>
                    Email: {{ $confSppd->email_rs }}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>{{ $detail->lokasi_ditetapkan }}</strong><br>
                    Dasar : {{ $detail->dasar }}<br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>No SPPD {{ $detail->no_sppd }}</b><br>
                <br>
                <b>Pelaksana SPPD :</b> {{ $pelaksanaArr->count() }} orang<br>
                <b>Tanggal Acara :</b> {{ $detail->tgl_mulai == $detail->tgl_selesai ? date('d/m/Y', strtotime($detail->tgl_mulai)) : date('d/m/Y', strtotime($detail->tgl_mulai)).' s.d '.date('d/m/Y', strtotime($detail->tgl_selesai))  }}<br>
                <b>Tempat :</b> {{ $detail->tempat_tujuan }} <br>
                <b>Jam :</b> {{ date('H:i', strtotime($detail->jam_acara)) }}
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pelaksana</th>
                                <th>NIP</th>
                                <th>Pangkat/Gol.</th>
                                <th>Unit Kerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelaksanaArr as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_pegawai.', '.$item->gelarbelakang_nama }}</td>
                                    <td>{{ $item->nomorindukpegawai }}</td>
                                    <td>{{ $item->pangkat.' / '.$item->golongan }}</td>
                                    <td>{{ $item->unit_kerja }}</td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a onclick="window.print();" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit Payment</button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="fas fa-download"></i> Generate PDF</button>
                </div>
            </div>
        </div>
            
    </section>
@endsection
