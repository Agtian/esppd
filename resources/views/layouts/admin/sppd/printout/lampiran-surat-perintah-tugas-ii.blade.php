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
    <table>
        <tr>
            <td width="350"></td>
            <td colspan="2">Lampiran Surat Perintah Tugas</td>
        </tr>
        <tr>
            <td width="350"></td>
            <td width="50">Tanggal</td>
            <td width="300">: {{ date('d-m-Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
        <tr>
            <td width="350"></td>
            <td width="50">Nomor</td>
            <td width="300">: {{ $detail->no_sppd }}</td>
        </tr>
    </table>
    <br><br>
    <table border="0.3" cellpadding="2" width="100%">
        <tr>
            <td width="40" align="center">No</td>
            <td width="330" align="center">Nama/NIP/Pangkat/Jabatan</td>
            <td width="170" align="center">Keterangan</td>
        </tr>
        @forelse ($resultPelaksana as $pelaksana)
            <tr>
                <td align="center">{{ $loop->iteration }}.</td>
                <td width="330">Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $pelaksana->nama_pegawai. ', ' .$pelaksana->gelarbelakang_nama }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center"></td>
                <td width="330">{{ ($pelaksana->golongan == 'Badan Layanan Umum') ? 'NRP' : 'NIP' }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $pelaksana->nomorindukpegawai }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center"></td>
                <td width="330">Pangkat/Gol : {{ $pelaksana->pangkat.' / '.$pelaksana->golongan }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center"></td>
                <td width="330">Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $pelaksana->jabatan }}</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @empty
            <tr>
                <td colspan="3" style="background-color: red" align="center">DATA PELAKSANA TIDAK TERSEDIA !</td>
            </tr>
        @endforelse
    </table>
    <br><br>
    <table>
        <tr>
            <td width="330"></td>
            <td width="70">Ditetapkan di</td>
            <td width="200">: Jepara</td>
        </tr>
        <tr>
            <td width="330"></td>
            <td wdith="70">Pada tanggal</td>
            <td width="200">: {{ date('d-m-Y', strtotime($detail->tgl_sppd)) }}</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td></td>
            <td align="center"><b>DIREKTUR RSUD dr. Rehatta</b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>PROVINSI JAWA TENGAH</b></td>
        </tr>
    </table>
    <br><br><br><br>
    <table>
        <tr>
            <td></td>
            <td align="center"><b><u>{{ $konf_sppd->nama_direktur }}</u></b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>{{ $konf_sppd->pangkat_direktur }}</b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>NIP. {{ $konf_sppd->nip_direktur }}</b></td>
        </tr>
    </table>
</div>