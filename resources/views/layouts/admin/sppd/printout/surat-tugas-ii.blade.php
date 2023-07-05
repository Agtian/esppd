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
            <td align="center"><h3>SURAT PERINTAH TUGAS</h3></td>
        </tr>
        <tr>
            <td align="center">Nomor : {{ $detail->no_sppd }}</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td width="60">Dasar</td>
            <td width="10">:</td>
            <td width="470"> {{ $detail->dasar }}</td>
        </tr>
        <tr><td colspan="3"></td></tr>
        <tr><td colspan="3" align="center"><h3>MEMERINTAHKAN</h3></td></tr>
        <tr><td colspan="3"></td></tr>
        <tr>
            <td width="60">Kepada</td>
            <td width="10">:</td>
            <td width="330"> Terlampir dengan {{ $resultPelaksana->count() }} Pengikut</td>
        </tr>
        <tr><td colspan="3"></td></tr>
        <tr>
            <td width="60">Untuk</td>
            <td width="10">:</td>
            <td width="460">
                <ol>
                    <li>{{ $detail->maksud_perjalanan }}.</li>
                    <li>Tidak menerima gratifikasi dalam bentuk apapun sesuai ketentuan.</li>
                    <li>Melaporkan Hasil Kegiatan Kepada Direktur.</li>
                </ol> 
            </td>
        </tr>
        <tr><td colspan="3"></td></tr>
        <tr>
            <td colspan="2"></td>
            <td width="460">Kegiatan dimaksud akan dilaksanakan pada :</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td width="70">Hari</td>
            <td>: {{ $detail->hari }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td width="70">Tanggal</td>
            <td>: 
                @if ($detail->tgl_mulai == $detail->tgl_akhir)
                    {{ date('d-m-Y', strtotime($detail->tgl_mulai)) }}
                @else
                {{ date('d-m-Y', strtotime($detail->tgl_mulai)) }} s.d {{ date('d-M-Y', strtotime($detail->tgl_akhir)) }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td width="70">Jam</td>
            <td>: {{ date('H:i', strtotime($detail->jam_acara)) }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td width="70">Tempat</td>
            <td>: {{ $detail->tempat_tujuan }}</td>
        </tr>
        <tr><td colspan="3"></td></tr>
        <tr>
            <td colspan="3" width="540" class="justify">Demikian Surat Tugas ini dibuat kepada yang bersangkutan untuk dilaksanakan dengan penuh rasa tanggung jawab.</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td width="350"></td>
            <td width="70">Ditetapkan di</td>
            <td width="200">: Jepara</td>
        </tr>
        <tr>
            <td width="350"></td>
            <td width="70">Pada tanggal</td>
            <td width="200">: {{ date('d-m-Y', strtotime($detail->tgl_sppd)) }}</td>
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