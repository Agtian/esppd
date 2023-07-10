<style>
    .print {
        font-family: "Times New Roman", Times, serif;
        font-size: 12pt;
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
            <td colspan="2">Rincian Biaya Perjalanan Dinas</td>
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
            <td>: {{ $detail->dasar }}</td>
        </tr>
        <tr>
            <td width="170">Tanggal Pelaksanaan Kegiatan</td>
            <td>: {{ date('d-m-Y', strtotime($detail->tgl_mulai)).' s.d '.date('d-m-Y', strtotime($detail->tgl_selesai)) }}</td>
        </tr>
        <tr>
            <td width="170">Tempat Pelaksanaan Kegiatan</td>
            <td>: {{ $detail->tempat_tujuan }}</td>
        </tr>
        <tr>
            <td width="170">Bidang/UPT/Balai/Cabang Dinas</td>
            <td>: {{ $detail->undangan_dari }}</td>
        </tr>
    </table>
    <br><br>
    <table border="0.3" cellpadding="1" width="100%">
        <tr>
            <td width="30" align="center">No.</td>
            <td width="150" align="center">Nama Penerima Biaya Perjalanan Dinas/NIP</td>
            <td align="center">Uang Harian</td>
            <td align="center">Biaya Transport</td>
            <td align="center">Biaya Penginapan</td>
            <td align="center">Uang Representasi</td>
            <td align="center">Lain-lain</td>
            <td align="center">Total</td>
            <td align="center">Tanda Tangan</td>
            <td align="center">Keterangan</td>
        </tr>
        @forelse ($resultPelaksana as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_pegawai.', '.$item->gelarbelakang_nama.' | '.$item->nomorindukpegawai }}</td>
                <td align="center">{{ $item->uang_harian }}</td>
                <td align="center">{{ $item->biaya_transport }}</td>
                <td align="center">{{ $item->biaya_penginapan }}</td>
                <td align="center">{{ $item->uang_representasi }}</td>
                <td align="center">{{ $item->biaya_lainnya }}</td>
                <td align="center">{{ $item->total_biaya }}</td>
                <td></td>
                <td></td>
            </tr>
        @empty
            <tr><td colspan="10" align="center">Data pelaksana tidak tersedia !</td></tr>
        @endforelse
        
        <tr>
            <td></td>
            <td align="center">Jumlah</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table>
        <tr><td> Catatan : Formulir ini  digunakan untuk perjalanan dinas lebih dari 4 orang</td></tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td align="center">Bendahara Pengeluaran</td>
            <td width="300"></td>
            <td align="center">An.PA/KPA PPTK</td>
        </tr>
        <tr><td colspan="3"></td></tr>
        <tr><td colspan="3"></td></tr>
        <tr><td colspan="3"></td></tr>
        <tr>
            <td align="center"><u>{{ $konf_sppd->nama_bendahara }}</u> <br>NIP. {{ $konf_sppd->nip_bendahara }}</td>
            <td width="300"></td>
            <td align="center"><u>{{ $konf_sppd->nama_pptk }}</u> <br>NIP. {{ $konf_sppd->nip_pptk }}</td>
        </tr>
    </table>
</div>