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

    <br>
    <table>
        <tr>
            <td align="center"><h2><b>SURAT PERINTAH TUGAS</b></h2></td>
        </tr>
        <tr>
            <td align="center">Nomor : {{ $detail->no_sppd }}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td width="60">Dasar</td>
            <td width="5">: </td>
            <td width="460" class="justify">{{ $detail->dasar }}</td>
        </tr>
        <tr><td colspan="3"></td></tr>
        <tr>
            <td colspan="3" align="center">MEMERINTAHKAN</td>
        </tr>
    </table>
    <br><br>
    <table>
        @foreach ($detail->pelaksanaPerjals as $item)
            <tr>
                <td width="60" rowspan="4">
                    @if ($loop->iteration == 1) Kepada @endif
                </td>
                <td width="5" rowspan="4">@if ($loop->iteration == 1): @endif</td>
                <td width="15" rowspan="4">{{ $loop->iteration }}.</td>
                <td width="105"> Nama</td>
                <td width="10">: </td>
                <td width="430">{{ $item->nama_pegawai. ', ' .$item->gelarbelakang_nama }}</td>
            </tr>
            <tr>
                <td width="105"> NIP</td>
                <td width="10">: </td>
                <td width="430">{{ $item->nomorindukpegawai }}</td>
            </tr>
            <tr>
                <td width="105"> Pangkat, gol, ruang</td>
                <td width="10">: </td>
                <td width="430">{{ $item->pangkat.', '.$item->golongan. ', '.$item->unit_kerja }}</td>
            </tr>
            <tr>
                <td width="105"> Jabatan</td>
                <td width="10">: </td>
                <td width="430">{{ $item->jabatan }}</td>
            </tr>
        @endforeach
    </table>
    <br><br>
    <table>
        <tr>
            <td width="60">Untuk</td>
            <td width="5">:</td>
            <td width="460">{{ $detail->maksud_perjalanan }}</td>
        </tr>
    </table>
    
    <br><br><br>
    <table>
        <tr>
            <td width="320"></td>
            <td>Ditetapkan di Jepara</td>
        </tr>
        <tr>
            <td width="320"></td>
            <td>Pada tanggal {{ date('d F Y', strtotime($item->tgl_sppd)) }}</td>
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
