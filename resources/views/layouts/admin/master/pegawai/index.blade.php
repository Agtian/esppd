@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pegawai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active">Data Pegawai</li>
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
                <h3 class="card-title">Tabel Data Pegawai</h3>
    
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
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>NIP</th>
                                <th>JNS KELAMIN</th>
                                <th>ALAMAT</th>
                                <th>TTL</th>
                                <th>AGAMA</th>
                                <th>GOL. DARAH</th>
                                <th>EMAIL</th>
                                <th>NO HP</th>
                                <th>NO TELP</th>
                                <th>FOTO</th>
                                <th>PENDIDIKAN</th>
                                <th>PANGKAT/GOLONGAN</th>
                                <th>JABATAN</th>
                                <th>UNIT KERJA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pegawais as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td width="150">{{ $item->gelardepan. ' ' .$item->nama_pegawai. ' ' .$item->gelarbelakang_nama }}</td>
                                    <td>{{ $item->nomorindukpegawai }}</td>
                                    <td>{{ $item->jeniskelamin }}</td>
                                    <td>{{ $item->alamat_pegawai }}</td>
                                    <td>{{ $item->tempatlahir_pegawai. ' ' .$item->tgl_lahirpegawai }}</td>
                                    <td>{{ $item->agama }}</td>
                                    <td>{{ $item->golongandarah }}</td>
                                    <td>{{ $item->alamatemail }}</td>
                                    <td>{{ $item->nomobile_pegawai }}</td>
                                    <td>{{ $item->notelp_pegawai }}</td>
                                    <td>{{ $item->photopegawai }}</td>
                                    <td>{{ $item->pendidikan_nama }}</td>
                                    <td>{{ $item->pangkat_nama. ' ' .$item->golonganpegawai_nama }}</td>
                                    <td>{{ $item->jabatan_nama }}</td>
                                    <td>{{ $item->namaunitkerja }}</td>
                                    <td></td>
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
                {{ $pegawais->links() }}
            </div>
        </div>
            
    </section>
@endsection
