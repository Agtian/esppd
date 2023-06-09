<style>
    .print {
        font-family: "Times New Roman", Times, serif;
        font-size: 11pt;
    }

    .justify {
        text-align: justify;
        text-justify: inter-word;
    }
</style>

<div class="print">
    <table>
        <tr>
            <td width="700"></td>
            <td colspan="2">Lampiran SPPD</td>
        </tr>
        <tr>
            <td width="700"></td>
            <td width="60">Nomor</td>
            <td>: {{ $detail->no_sppd }}</td>
        </tr>
        <tr>
            <td width="700"></td>
            <td width="60">Tanggal</td>
            <td>: {{ date('d-m-Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="2" align="center"><h2>Rekapitulasi Rincian Biaya Perjalanan Dinas</h2></td>
        </tr>
        <tr><td colspan="2"></td></tr>
        <tr>
            <td width="170">Daftar Peserta</td>
            <td>: ...</td>
        </tr>
        <tr>
            <td width="170">Nama Kegiatan</td>
            <td width="700">: {{ $detail->maksud_perjalanan }}</td>
        </tr>
        <tr>
            <td width="170">Tanggal Pelaksanaan Kegiatan</td>
            <td width="700">: {{ date('d-m-Y', strtotime($detail->tgl_mulai)) }} s.d {{ date('d-m-Y', strtotime($detail->tgl_selesai)) }}</td>
        </tr>
        <tr>
            <td width="170">Tempat Pelaksanaan Kegiatan</td>
            <td width="700">: {{ $detail->tempat_tujuan }}</td>
        </tr>
        <tr>
            <td width="170">Bidang/UPT/Balai/Cabang Dinas</td>
            <td width="700">: {{ $detail->undangan_dari }}</td>
        </tr>
    </table>
    <br><br>
    <table border="0.3" cellpadding="2" width="100%">
        <tr>
            <td align="center" width="30" rowspan="2">No</td>
            <td align="center" width="130" rowspan="2">Nama Pelaksana Perjalanan Dinas & NIP</td>
            <td align="center" rowspan="2">Pangkat/ Golongan</td>
            <td align="center" rowspan="2">Jabatan</td>
            <td align="center" rowspan="2">Tempat Kedudukan Asal</td>
            <td align="center" rowspan="2">Transportasi Yang Digunakan</td>
            <td align="center" colspan="2">Surat Tugas</td>
            <td align="center" colspan="2">Tanggal</td>
            <td align="center" rowspan="2">Lama Perjalanan Dinas</td>
            <td align="center" rowspan="2">Keterangan</td>
        </tr>
        <tr>
            <td align="center">Nomor</td>
            <td align="center">Tanggal</td>
            <td align="center">Keberangkatan Dari Tempat Kedudukan Asal</td>
            <td align="center">Tiba Kembali Kedudukan Asal</td>
        </tr>
        @forelse ($resultPelaksana as $pelaksana)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $pelaksana->gelardepan.' '.$pelaksana->nama_pegawai.' '.$pelaksana->gelarbelakang_nama }}</td>
                <td>{{ $pelaksana->pangkat.' / '.$pelaksana->golongan }}</td>
                <td>{{ $pelaksana->jabatan }}</td>
                <td>RSUD dr. Rehatta</td>
                <td>Dinas</td>
                <td>{{ $detail->no_sppd }}</td>
                <td>{{ date('d-m-Y', strtotime($detail->tgl_sppd)) }}</td>
                <td>{{ date('d-m-Y', strtotime($detail->tgl_mulai)) }}</td>
                <td>{{ date('d-m-Y', strtotime($detail->tgl_selesai)) }}</td>
                <td>{{ $detail->jumlah_hari }} hari</td>
                <td></td>
            </tr>
        @empty
            <tr><td colspan="10">Data tidak tersedia</td></tr>
        @endforelse
    </table>
    <table>
        <tr>
            <td> Catatan : Perjalanan Dinas yang dilakukan beberapa orang dengan tujuan, waktu, dan jumlah hari yang sama.</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td width="550"></td>
            <td align="center">PA/KPA <br>PPTK</td>
        </tr>
        <tr><td colspan="2"></td></tr>
        <tr><td colspan="2"></td></tr>
        <tr>
            <td width="550"></td>
            <td align="center"><u>{{ $konf_sppd->nama_pptk }}</u> <br>NIP. {{ $konf_sppd->nip_pptk }}</td>
        </tr>
    </table>
</div>