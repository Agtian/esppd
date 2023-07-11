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
    <img src="assets/image_akun/kop_surat.png" alt="Kop Surat">

    <table>
        <tr>
            <td align="center"><h3>RINCIAN BIAYA PERJALANAN DINAS</h3></td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td width="130">Lampiran SPPD Nomor</td>
            <td>: {{ $detail->no_sppd }}</td>
        </tr>
        <tr>
            <td width="130">Tanggal</td>
            <td>: {{ date('d-m-Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
    </table>
    <br><br>
    <table border="0.3" cellpadding="3" width="100%">
        <tr>
            <td width="30" align="center">NO</td>
            <td width="250" align="center">PERINCIAN BIAYA</td>
            <td width="150" align="center">JUMLAH</td>
            <td width="110" align="center">KETERANGAN</td>
        </tr>
        <tr>
            <td align="center">1.</td>
            <td>Uang Harian*</td>
            <td align="right">Rp. {{ number_format($detail->uang_harian, 2, '.',',') }}</td>
            <td rowspan="5" align="center">Terlampir</td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td>Biaya Transport*</td>
            <td align="right">Rp. {{ number_format($detail->biaya_transport, 2, '.',',') }}</td>
        </tr>
        <tr>
            <td align="center">3.</td>
            <td>Biaya Penginapan*</td>
            <td align="right">Rp. {{ number_format($detail->biaya_penginapan, 2, '.',',') }}</td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td>Uang Representasi*</td>
            <td align="right">Rp. {{ number_format($detail->uang_representasi, 2, '.',',') }}</td>
        </tr>
        <tr>
            <td align="center">5.</td>
            <td>Lain-lain*</td>
            <td align="right">Rp. {{ number_format($detail->biaya_lainnya, 2, '.',',') }}</td>
        </tr>
        <tr>
            <td colspan="2" align="center">Terbilang</td>
            <td colspan="2">...</td>
        </tr>
    </table>
    <table>
        <tr>
            <td> *Catatan : Jumlah merupakan total</td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="330"></td>
            <td>Jepara, {{ date('d-m-Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td>Telah dibayar sejumlah</td>
            <td width="145"></td>
            <td>Telah Menerima Uang Sejumlah</td>
        </tr>
        <tr>
            <td>Rp. {{ number_format($detail->total_biaya, 2, '.',',') }}</td>
            <td width="145"></td>
            <td>Rp. {{ number_format($detail->total_biaya, 2, '.',',') }}</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td>Bendahara Pengeluaran</td>
            <td width="145"></td>
            <td>Yang Menerima</td>
        </tr>
        <tr><td colspan="3"></td></tr>
        <tr><td colspan="3"></td></tr>
        <tr><td colspan="3"></td></tr>
        <tr>
            <td align="center"><u>{{ $konf_sppd->nama_bendahara }}</u> <br>NIP. {{ $konf_sppd->nip_bendahara }}</td>
            <td width="145"></td>
            <td><b>(Terlampir)</b></td>
        </tr>
    </table>
    <br>
    <hr>
    <table>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="3" align="center"><h3>PERHITUNGAN SPPD RAMPUNG</h3></td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td>Ditetapkan sejumlah</td>
            <td width="140"></td>
            <td>: Rp. {{ number_format($detail->total_biaya, 2, '.',',') }}</td>
        </tr>
        <tr>
            <td>Yang Telah Dibayarkan Semula</td>
            <td width="140"></td>
            <td>: Rp. 0</td>
        </tr>
        <tr>
            <td>Sisa Kurang/Lebih</td>
            <td width="140"></td>
            <td>: Rp. 0</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td width="250"></td>
            <td align="center">An.PA/KPA PPTK</td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="250"></td>
            <td align="center"><u>{{ $konf_sppd->nama_pptk }}</u> <br>NIP. {{ $konf_sppd->nip_pptk }}</td>
        </tr>
    </table>
    <br><br>
    <hr>
    <table>
        <tr><td></td></tr>
        <tr>
            <td>Catatan : Formulir ini untuk pelaksana perjalanan dinas lebih dari 4 (empat) orang.</td>
        </tr>
    </table>
</div>