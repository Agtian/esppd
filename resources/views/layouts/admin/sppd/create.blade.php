@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form SPPD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">SPPD</a></li>
                        <li class="breadcrumb-item active">Form SPPD</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">

                @if (session('message'))
                    <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
                @endif

                <div class="card card-dark">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Form SPPD</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ url('dashboard/admin/user') }}" method="POST" class="form-horizontal">
                        @csrf

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="no_sppd" class="col-sm-3 col-form-label">NO SPPD</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('no_sppd') is-invalid @enderror"
                                        id="no_sppd" name="no_sppd" placeholder="No SPPD" value="{{ old('no_sppd') }}">
                                    @error('no_sppd')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_pegawai" class="col-sm-3 col-form-label">Nama Pegawai</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai" value="{{ old('nama_pegawai') }}">
                                    @error('nama_pegawai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dasar" class="col-sm-3 col-form-label">Dasar</label>
                                <div class="col-sm-9">
                                    <textarea name="dasar" id="dasar" cols="20" rows="3" class="form-control @error('dasar') is-invalid @enderror">{{ old('dasar') }}</textarea>
                                    @error('dasar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lokasi_ditetapkan" class="col-sm-3 col-form-label">Lokasi Ditetapkan</label>
                                <div class="col-sm-9">
                                    <textarea name="lokasi_ditetapkan" id="lokasi_ditetapkan" cols="20" rows="3" class="form-control @error('lokasi_ditetapkan') is-invalid @enderror">{{ old('dasar') }}</textarea>
                                    @error('lokasi_ditetapkan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jumlah_hari" class="col-sm-3 col-form-label">Jumlah Hari</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control @error('jumlah_hari') is-invalid @enderror"
                                        id="jumlah_hari" name="jumlah_hari" placeholder="Jumlah Hari" value="{{ old('jumlah_hari') }}">
                                    @error('jumlah_hari')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hari" class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('hari') is-invalid @enderror"
                                        id="hari" name="hari" placeholder="Senin s.d Kamis" value="{{ old('hari') }}">
                                    @error('hari')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror"
                                        id="tgl_mulai" name="tgl_mulai" value="{{ old('tgl_mulai') }}">
                                    @error('tgl_mulai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_selesai" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror"
                                        id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai') }}">
                                    @error('tgl_selesai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_sppd" class="col-sm-3 col-form-label">Tanggal SPPD Dibuat</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control @error('tgl_sppd') is-invalid @enderror"
                                        id="tgl_sppd" name="tgl_sppd" value="{{ old('tgl_sppd') }}">
                                    @error('tgl_sppd')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="maksud_perjalanan" class="col-sm-3 col-form-label">Maksud Perjalanan</label>
                                <div class="col-sm-9">
                                    <textarea name="maksud_perjalanan" id="maksud_perjalanan" cols="20" rows="3" class="form-control @error('maksud_perjalanan') is-invalid @enderror">{{ old('maksud_perjalanan') }}</textarea>
                                    @error('maksud_perjalanan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempat_tujuan" class="col-sm-3 col-form-label">Tempat Tujuan</label>
                                <div class="col-sm-9">
                                    <textarea name="tempat_tujuan" id="tempat_tujuan" cols="20" rows="3" class="form-control @error('tempat_tujuan') is-invalid @enderror">{{ old('tempat_tujuan') }}</textarea>
                                    @error('tempat_tujuan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jam_acara" class="col-sm-3 col-form-label">Jam Acara</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control @error('jam_acara') is-invalid @enderror"
                                        id="jam_acara" name="jam_acara" value="{{ old('jam_acara') }}">
                                    @error('jam_acara')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
