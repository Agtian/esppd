<style>
    .print {
        font-family: "Times New Roman", Times, serif;
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
            <td align="center" colspan="2"><h3><b>RINCIAN BIAYA PERJALANAN DINAS</b></h3></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td width="130">Lampiran SPPD Nomor</td>
            <td>: {{ $detail->no_sppd }}</td>
        </tr>
        <tr>
            <td width="130">Tanggal</td>
            <td>: {{ date('d F Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
    </table>
    <br><br>
    <table border="0.3" cellpadding="6" width="100%">
        <tr>
            <td width="40" align="center">NO</td>
            <td width="200" align="center">PERINCIAN BIAYA</td>
            <td width="120" align="center">JUMLAH</td>
            <td width="180" align="center">KETERANGAN</td>
        </tr>
        <tr>
            <td align="center">1.</td>
            <td>Uang Harian</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td>Biaya Transport</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td align="center">3.</td>
            <td>Biaya Penginapan</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td align="center">4.</td>
            <td>Uang Representasi</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td align="center">5.</td>
            <td>Lain-lain</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" align="center">Terbilang</td>
            <td colspan="2">...</td>
        </tr>
    </table>

    <table>
        <tr>
            <td width="380"></td>
            <td>Jepara, {{ date('d F Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td>Telah dibayar sejumlah</td>
            <td width="200"></td>
            <td>Telah Menerima Uang Sejumlah</td>
        </tr>
        <tr>
            <td>Rp ...........</td>
            <td width="200"></td>
            <td>Rp ...........</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td>Bendahara Pengeluaran</td>
            <td width="200"></td>
            <td>Yang Menerima</td>
        </tr>
        <tr>
            <td></td>
            <td width="200"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td width="200"></td>
            <td></td>
        </tr>
        <tr>
            <td>(.................................) <br>NIP............................</td>
            <td width="200"></td>
            <td>(.................................) <br>NIP............................</td>
        </tr>
    </table>
    <hr>
    <p align="center">PERHITUNGAN SPPD RAMPUNG</p>
    <br>
    <table>
        <tr>
            <td>Ditetapkan sejumlah</td>
            <td width="200"></td>
            <td>: Rp...........................</td>
        </tr>
        <tr>
            <td>Yang Telah Dibayarkan Semula</td>
            <td width="200"></td>
            <td>: Rp...........................</td>
        </tr>
        <tr>
            <td>Sisa Kurang/Lebih</td>
            <td width="200"></td>
            <td>: Rp...........................</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td width="300"></td>
            <td width="200" align="center">Pengguna Anggaran/Kuasa Pengguna Anggaran atau An. PA/KPA PPTK</td>
        </tr>
        <tr><td></td><td></td></tr>
        <tr>
            <td width="300"></td>
            <td width="200" align="center">(....................................) <br>NIP.</td>
        </tr>
    </table>
    <br>
    <hr>
    <p>Catatan : Formulir ini untuk pelasana perjalanan dinas maksimal 4 orang</p>
</div>