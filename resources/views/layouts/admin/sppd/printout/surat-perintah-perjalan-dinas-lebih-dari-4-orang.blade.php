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
            <td align="center"><h3>SURAT PERINTAH PERJALANAN DINAS</h3></td>
        </tr>
        <tr>
            <td align="center">Nomor : {{ $detail->no_sppd }}</td>
        </tr>
    </table>
    <br><br>
    <table border="0.3" cellpadding="4" width="100%">
        <tr>
            <td width="30" align="center">1.</td>
            <td width="300">Pengguna Anggaran/ Kuasa Pengguna Anggaran</td>
            <td width="210"></td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td>Nama Gubernur/Wakil Gubernur/Pimpinan dan 
                Anggota DPRD/Pegawai ASN dan NIP/CPNS dan
                NIP/Pegawai Non ASN/Bukan Pegawai yang
                melaksanakan Perjalanan Dinas </td>
            <td>Terlampir</td>
        </tr>
        <tr>
            <td align="center">3.</td>
            <td>a. Pangkat dan Golongan <br>b. Jabatan/Instansi</td>
            <td>a. Terlampir<br>b. Terlampir</td>
        </tr>
        <tr>
            <td width="30" align="center">4.</td>
            <td>Maksud Mengadakan Perjalanan</td>
            <td>{{ $detail->maksud_perjalanan }}</td>
        </tr>
        <tr>
            <td width="30" align="center">5.</td>
            <td>Alat Angkut yang Dipergunakan</td>
            <td>Dinas</td>
        </tr>
        <tr>
            <td width="30" align="center">6.</td>
            <td>a. Tempat Berangkat <br>b. Tempat Tujuan</td>
            <td>a. RSUD dr. Rehatta<br>b. {{ $detail->tempat_tujuan }}</td>
        </tr>
        <tr>
            <td width="30" align="center">7.</td>
            <td>a. Lamanya Pejalanan Dinas <br>b. Tanggal Berangkat <br>c. Tanggal Harus Kembali/Tiba Di Tempat Baru *)</td>
            <td>a. {{ $detail->jumlah_hari }} Hari
                <br>b. {{ date('d-m-Y', strtotime($detail->tgl_mulai)) }}
                <br>c. {{ date('d-m-Y', strtotime($detail->tgl_selesai)) }}
            </td>
        </tr>
        <tr>
            <td width="30" align="center">8.</td>
            <td>Pengikut</td>
            <td></td>
        </tr>
        <tr>
            <td width="30" align="center">9.</td>
            <td>Pembebanan Anggaran <br>a. SKPD <br>a. Akun</td>
            <td>&nbsp; <br>a. RSUD dr. Rehatta<br>b. 1.02.0.00.0.00.15.X.XX.01.1.10.5.01.5.1.2.99.99.9999</td>
        </tr>
        <tr>
            <td width="30" align="center">10.</td>
            <td>Keterangan Lain-lain</td>
            <td></td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="30"></td>
            <td>*) Coret yang tidak perlu</td>
        </tr>
    </table>

    <br><br>
    <table>
        <tr>
            <td width="330"></td>
            <td width="80">Dikeluarkan di</td>
            <td width="200">: Jepara</td>
        </tr>
        <tr>
            <td width="330"></td>
            <td width="80">Pada tanggal </td>
            <td width="200">: {{ date('d F Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
        <tr>
            <td width="330"></td>
            <td width="80">Ditetapkan di</td>
            <td width="200">: Jepara</td>
        </tr>
        <tr>
            <td width="330"></td>
            <td width="80">Pada tanggal </td>
            <td width="200">: {{ date('d F Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td></td>
            <td align="center"><b>an.PA/KPA</b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>PPTK</b></td>
        </tr>
    </table>
    <br><br><br><br>
    <table>
        <tr>
            <td></td>
            <td align="center"><b><u>{{ $konf_sppd->nama_pptk }}</u></b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center">NIP. {{ $konf_sppd->nip_pptk }}</td>
        </tr>
    </table>
</div>
    