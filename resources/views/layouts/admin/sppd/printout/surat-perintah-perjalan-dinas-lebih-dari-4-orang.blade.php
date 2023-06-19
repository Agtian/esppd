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
            <td width="330">Pengguna Anggaran/ Kuasa Pengguna Anggaran</td>
            <td></td>
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
            <td></td>
        </tr>
        <tr>
            <td width="30" align="center">5.</td>
            <td>Alat Angkut yang Dipergunakan</td>
            <td></td>
        </tr>
        <tr>
            <td width="30" align="center">6.</td>
            <td>a. Tempat Berangkat <br>b. Tempat Tujuan</td>
            <td>a. ...<br>b. ...</td>
        </tr>
        <tr>
            <td width="30" align="center">7.</td>
            <td>a. Lamanya Pejalanan Dinas <br>b. Tanggal Berangkat <br>c. Tanggal Harus Kembali/Tiba Di Tempat Baru *)</td>
            <td>a. ...<br>b. ... <br>c. ...</td>
        </tr>
        <tr>
            <td width="30" align="center">8.</td>
            <td>Pengikut</td>
            <td></td>
        </tr>
        <tr>
            <td width="30" align="center">9.</td>
            <td>Pembebanan Anggaran <br>a. SKPD <br>a. Akun</td>
            <td>&nbsp; <br>a. ...<br>b. (sesuai DPA kegiatan)</td>
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
            <td>Dikeluarkan di Jepara</td>
        </tr>
        <tr>
            <td width="330"></td>
            <td>Pada tanggal {{ date('d F Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
        <tr>
            <td width="330"></td>
            <td>Ditetapkan di Jepara</td>
        </tr>
        <tr>
            <td width="330"></td>
            <td>tanggal {{ date('d F Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td></td>
            <td align="center"><b>DIREKTUR RSUD KELET</b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>PROVINSI JAWA TENGAH</b></td>
        </tr>
    </table>
    <br><br><br><br><br>
    <table>
        <tr>
            <td></td>
            <td align="center"><b><u>dr. Agung Pribadi, M,Kes. M.Si. Med. Sp.B</u></b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>NIP. 19701111 2005 01 1 003</b></td>
        </tr>
    </table>
</div>
    