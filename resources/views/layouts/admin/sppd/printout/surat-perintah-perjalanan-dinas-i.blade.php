<style>
    .print {
        font-family: "Times New Roman", Times, serif;
    }

    .justify {
        text-align: justify;
        text-justify: inter-word;
    }

    /* table, td, th {
        border: 1px solid;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    } */
</style>

@foreach ($resultPelaksana as $pelaksana)
    <div class="print">
        <img src="assets/image_akun/kop_surat.png" alt="Kop Surat">

        <br>
        <table>
            <tr>
                <td align="center"><b>SURAT PERINTAH PERJALANAN DINAS</b></td>
            </tr>
            <tr>
                <td align="center">Nomor : {{ $detail->no_sppd }}</td>
            </tr>
        </table>
        <br>
        <br>
        <table border="0.3" cellpadding="6" width="100%">
            <tr>
                <td width="30" align="right">1.</td>
                <td width="200">Pejabat yang memberi perintah</td>
                <td width="295">{{ $konf_sppd->nama_direktur }}</td>
            </tr>
            <tr>
                <td width="30" align="right">2.</td>
                <td width="200">Nama pegawai yang diperintahkan</td>
                <td width="295">{{ $pelaksana->gelardepan.' '.$pelaksana->nama_pegawai.', '.$pelaksana->gelarbelakang_nama }}</td>
            </tr>
            <tr>
                <td width="30" align="right">3.</td>
                <td width="200">Pangkat dan golongan menurut <br>a. PP No.6 Th.1997 <br>b. Jabatan <br>c. Tingkat menurut perjalanan</td>
                <td width="295">&nbsp; <br>{{ $pelaksana->pangkat }} ({{ $pelaksana->golongan }}) <br>{{ $pelaksana->unit_kerja }} </td>
            </tr>
            <tr>
                <td width="30" align="right">4.</td>
                <td width="200">Maksud Mengadakan Perjalanan</td>
                <td width="295">{{ $detail->maksud_perjalanan }}</td>
            </tr>
            <tr>
                <td width="30" align="right">5.</td>
                <td width="200">Alat Angkut yang Dipergunakan</td>
                <td width="295">Dinas</td>
            </tr>
            <tr>
                <td width="30" align="right">6.</td>
                <td width="200">a. Tempat Berangkat <br>b. Tempat Tujuan</td>
                <td width="295">a. RSUD dr. Rehatta <br>b. {{ $detail->tempat_tujuan }}</td>
            </tr>
            <tr>
                <td width="30" align="right">7.</td>
                <td width="200">a. Lamanya Perjalanan Dinas <br>b. Tanggal Berangkat <br>c. Tanggal Harus Kembali</td>
                <td width="295">a. {{ $detail->jumlah_hari }} hari <br>b. {{ date('d F Y', strtotime($detail->tgl_mulai)) }} <br>c. {{ date('d F Y', strtotime($detail->tgl_selesai)) }}</td>
            </tr>
            <tr>
                <td width="30" align="right">8.</td>
                <td width="200">Pengikut</td>
                <td width="295"></td>
            </tr>
            <tr>
                <td width="30" align="right">9.</td>
                <td width="200">Pembebanan Anggaran <br> a. Instansi <br> b. Mata Anggaran</td>
                <td width="295">&nbsp; <br>a. RSUD dr. Rehatta <br>b. 1.02.0.00.0.00.15.X.XX.01.1.10.5.01.5.1.2.99.99.9999</td>
            </tr>
            <tr>
                <td width="30" align="right">10.</td>
                <td width="200">Keterangan Lain-Lain</td>
                <td width="295"></td>
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
                <td width="300"></td>
                <td width="90">Dikeluarkan di </td>
                <td>: Jepara</td>
            </tr>
            <tr>
                <td width="300"></td>
                <td>Pada tanggal </td>
                <td>: {{ date('d F Y', strtotime($detail->tgl_sppd)) }}</td>
            </tr>
            <tr>
                <td width="300"></td>
                <td>Ditetapkan di </td>
                <td>: Jepara</td>
            </tr>
            <tr>
                <td width="300"></td>
                <td>Pada tanggal</td>
                <td>: {{ date('d F Y', strtotime($detail->tgl_sppd)) }}</td>
            </tr>
        </table>
        <br><br>
        <table>
            <tr>
                <td></td>
                <td align="center"><b>an. PA/KPA</b></td>
            </tr>
            <tr>
                <td></td>
                <td align="center"><b>PPTK</b></td>
            </tr>
        </table>
        <br><br><br><br><br>
        <table>
            <tr>
                <td></td>
                <td align="center"><b><u>{{ $konf_sppd->nama_pptk }}</u></b></td>
            </tr>
            <tr>
                <td></td>
                <td align="center"><b>NIP. {{ $konf_sppd->nip_pptk }}</b></td>
            </tr>
        </table>
    </div>
@endforeach

