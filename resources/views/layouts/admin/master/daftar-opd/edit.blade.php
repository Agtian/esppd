@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Daftar OPD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/admin/daftar-opd') }}">Daftar OPD</a></li>
                        <li class="breadcrumb-item active">Edit Daftar OPD</li>
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
                <h3 class="card-title">Tabel Daftar OPD</h3>
    
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
                <form action="{{ url('dashboard/admin/daftar-opd/'.$getDaftarOPD->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kementerian</label>
                            <div class="col-sm-9">
                                <select name="kementerian_id" class="form-control">
                                    <option value="">-- Pilih Kementerian --</option>
                                    @foreach ($resultKementerian as $item)
                                        <option value="{{ $item->id }}" {{ $getDaftarOPD->id == $item->kementerian_id ? 'selected' : ''  }}>{{ $item->nama_kementerian }}</option>
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
                                        <option value="{{ $item->id }}" {{ $getDaftarOPD->provinsi_id == $item->id ? 'selected' : ''  }}>{{ $item->nama_provinsi }}</option>
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
                                <input type="text" class="form-control @error('nama_opd') is-invalid @enderror" name="nama_opd" value="{{ $getDaftarOPD->nama_opd }}">
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
                                    <option value="5">Organisasi Pemerintah Negara</option>
                                    <option value="1">Kementerian</option>
                                    <option value="2">Provinsi</option>
                                    <option value="3">Kabupaten</option>
                                    <option value="4">Organisasi / Lembaga / Rumah Sakit Swasta</option>
                                </select>
                                @error('status_opd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat OPD</label>
                            <div class="col-sm-9">
                                <textarea name="alamat_opd" class="form-control @error('alamat_opd') is-invalid @enderror" cols="30" rows="10">{{ $getDaftarOPD->alamat }}</textarea>
                                @error('alamat_opd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
            
    </section>
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