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
                <td width="60" rowspan="4">@if ($loop->iteration == 1)Kepada @endif</td>
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
            <td width="460">&nbsp;1.&nbsp; {{ $detail->maksud_perjalanan }}.</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td width="460">&nbsp;2.&nbsp; Tidak menerima gratifikasi dalam bentuk apapun sesuai ketentuan.</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td width="460">&nbsp;3.&nbsp; Melaporkan Hasil Kegiatan Kepada Direktur.</td>
        </tr> 
    </table>
    <br><br>
    <table>
        <tr>
            <td width="70" colspan="2"></td>
            <td width="380">Kegiatan dimaksud akan dilaksanakan pada :</td>
        </tr>
        <tr>
            <td width="70"></td>
            <td width="50">Hari</td>
            <td width="380">: {{ $detail->hari }}</td>
        </tr>
        <tr>
            <td width="70"></td>
            <td width="50">Tanggal</td>
            <td width="380">:
                @if ($detail->tgl_mulai == $detail->tgl_selesai)
                    {{ date('d-m-Y', strtotime($detail->tgl_mulai)) }}
                @else
                    {{ date('d-m-Y', strtotime($detail->tgl_mulai)).' s.d '.date('d-m-Y', strtotime($detail->tgl_selesai)) }}
                @endif
            </td>
        </tr>
        <tr>
            <td width="70"></td>
            <td width="50">Jam</td>
            <td width="380">: {{ date('H:i', strtotime($detail->jam_acara)).' - Selesai' }}</td>
        </tr>
        <tr>
            <td width="70"></td>
            <td width="50">Tempat</td>
            <td width="380">: {{ $detail->lokasi_ditetapkan }}</td>
        </tr>
    </table>
    
    <br>
    <table>
        <tr>
            <td width="320"></td>
            <td width="70">Ditetapkan di</td>
            <td>: Jepara</td>
        </tr>
        <tr>
            <td width="320"></td>
            <td width="70">Pada tanggal </td>
            <td>: {{ date('d F Y', strtotime($item->tgl_sppd)) }}</td>
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
            <td align="center"><b><u>{{ $konf_sppd->nama_direktur }} </u></b></td>
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
