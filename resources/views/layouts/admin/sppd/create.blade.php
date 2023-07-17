@push('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

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
                @elseif (session('warning'))
                    <h5 class="alert alert-warning mb-2">Perhatian</h5><p><br> {{ session('warning') }}</p>
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
                    <form action="{{ url('dashboard/admin/sppd') }}" method="POST" class="form-horizontal">
                        @csrf

                        <div class="card-body">
                            {{-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Pegawai</label>
                                <div class="col-sm-9">
                                    <div class="select2-purple">
                                        <select class="livesearch_pegawai" name="pegawai_id[]" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;"></select>
                                    </div>
                                    @error('pegawai_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
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
                            <hr>
                            <div class="form-group row">
                                <label for="undangan_dari" class="col-sm-3 col-form-label">Tujuan OPD / Undangan Dari</label>
                                <div class="col-sm-7">
                                    <select class="form-control @error('daftar_opd_id') is-invalid @enderror" name="daftar_opd_id" id="select_daftar_opd" style="width: 100%;">
                                        <option selected="selected" class="">-- Pilih OPD --</option>
                                        @foreach ($resultOPD as $item)
                                            <option value="{{ $item->id }}">{{ $item->provinsis->nama_provinsi.' - '.$item->kabupatens->nama_kabupaten.' - '.$item->nama_opd }}</option>
                                        @endforeach
                                    </select>
                                    @error('daftar_opd_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-dark btn-block" data-toggle="modal" data-target="#modal-add-opd">Tambah OPD</button>
                                </div>
                            </div>
                            <hr>
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

    <div class="modal fade" id="modal-add-opd">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Daftar OPD</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('dashboard/admin/sppd/add-opd') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kementerian</label>
                            <div class="col-sm-9">
                                <select name="kementerian_id" class="form-control">
                                    <option value="">-- Pilih Kementerian --</option>
                                    @foreach ($resultKementerian as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kementerian }}</option>
                                    @endforeach
                                </select>
                                @error('kementerian_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                <select name="provinsi_id" id="provinsi_id" class="form-control @error('provinsi_id') is-invalid @enderror">
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach ($resultProvinsi as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_provinsi }}</option>
                                    @endforeach
                                </select>
                                @error('provinsi_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kabupaten</label>
                            <div class="col-sm-9">
                                <select name="kabupaten_id" id="kabupaten_id" class="form-control @error('kabupaten_id') is-invalid @enderror">
                                    <option value=""> -- Pilih Kabupaten -- </option>
                                </select>
                                @error('kabupaten_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama OPD / Kantor</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nama_opd') is-invalid @enderror" name="nama_opd" value="{{ old('nama_opd') }}">
                                @error('nama_opd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status OPD</label>
                            <div class="col-sm-9">
                                <select name="status_opd" class="form-control @error('status_opd') is-invalid @enderror">
                                    <option value=""> -- Pilih Status OPD -- </option>
                                    <option value="1">Kementerian</option>
                                    <option value="2">Provinsi</option>
                                    <option value="3">Kabupaten</option>
                                    <option value="4">Organisasi / Lembaga</option>
                                </select>
                                @error('status_opd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea name="alamat_opd" class="form-control @error('alamat_opd') is-invalid @enderror" cols="30" rows="10"></textarea>
                                @error('alamat_opd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan OPD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $('#select_daftar_opd').select2({
                theme: 'bootstrap4',
                closeOnSelect : true,
            });
        });
        // $(function () {
        //     $('.livesearch_pegawai').select2({
        //         placeholder: 'Pilih Pegawai',
        //         ajax: {
        //             url: '/dashboard/admin/sppd/autocomplete-get-pegawai',
        //             dataType: 'json',
        //             delay: 250,
        //             processResults: function (data) {
        //                 return {
        //                     results: $.map(data, function (item) {
        //                         return {
        //                             text: item.nama_pegawai,
        //                             id: item.pegawai_id,
        //                             selected: 'false'
        //                         }
        //                     })
        //                 };
        //             },
        //             cache: true
        //         }
        //     })
        // });

        function onChangeSelect(url, id, name) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    provinsi_id: id
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option> -- Pilih Kabupaten -- </option>');
                    $.each(data, function (key, value) {
                        $('#' + name).append('<option value="' + value.id + '">' + value.nama_kabupaten + '</option>');
                    });
                }
            });
        }

        $(function () {
            $('#provinsi_id').on('change', function () {
                onChangeSelect('{{ route("getkabupaten") }}', $(this).val(), 'kabupaten_id');
            });
        });
    </script>
@endpush