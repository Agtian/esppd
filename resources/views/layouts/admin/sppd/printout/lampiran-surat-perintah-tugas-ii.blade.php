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
            <td width="300">: ...</td>
        </tr>
        <tr>
            <td width="350"></td>
            <td width="50">Nomor</td>
            <td width="300">: ...</td>
        </tr>
    </table>
    <br><br>
    <table border="0.3" cellpadding="2" width="100%">
        <tr>
            <td width="40" align="center">No</td>
            <td width="330" align="center">Nama/NIP/Pangkat/Jabatan</td>
            <td width="170" align="center">Keterangan</td>
        </tr>
        @forelse ($resultPelaksana as $item)
            <tr>
                <td align="center">1.</td>
                <td width="330">Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $item->nama_pegawai. ', ' .$item->gelarbelakang_nama }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center"></td>
                <td width="330">NIP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $item->nomorindukpegawai }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center"></td>
                <td width="330">Pangkat/Gol : {{ $item->pangkat.' / '.$item->golongan }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center"></td>
                <td width="330">Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $item->jabatan }}</td>
                <td></td>
            </tr>
        @empty
            
        @endforelse
        
        <tr><td colspan="3"></td></tr>
    </table>
    <table>
        <tr>
            <td width="330"></td>
            <td>Ditetapkan di Jepara</td>
        </tr>
        <tr>
            <td width="330"></td>
            <td>Pada tanggal {{ date('d F Y', strtotime($detail->tgl_sppd)) }}</td>
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
            <td align="center"><b>Pembina TK I</b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>NIP. 19701111 2005 01 1 003</b></td>
        </tr>
    </table>
</div>