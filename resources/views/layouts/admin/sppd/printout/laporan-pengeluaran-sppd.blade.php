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
    {{-- <img src="assets/image_akun/kop_surat.png" alt="Kop Surat">
    <br><br> --}}
    <table>
        <tr>
            <td align="center" colspan="2"><h3>LAPORAN PENGELUARAN SPPD</h3></td>
        </tr>
        <tr><td colspan="2"></td></tr>
        <tr>
            <td width="80">Periode</td>
            <td>: {{ date('d-m-Y', strtotime($tgl_awal)) }} s.d {{ date('d-m-Y', strtotime($tgl_selesai)) }}</td>
        </tr>
    </table>
    <br><br>
    <table border="0.2" cellpadding="2" width="100%">
        <tr>
            <td width="30" align="center">NO</td>
            <td width="80" align="center">TGL SPPD</td>
            <td width="140" align="center">TGL ACARA</td>
            <td width="180" align="center">NAMA | NIP/NRP</td>
            <td width="200" align="center">PERIHAL</td>
            <td width="200" align="center">TUJUAN</td>
            <td width="50" align="center">JAM</td>
        </tr>
        @forelse ($resultPengeluaranSPPD as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td align="center">{{ date('d-m-Y', strtotime($item->tgl_sppd)) }}</td>
                <td align="center">{{ date('d-m-Y', strtotime($item->tgl_mulai)).' s.d '.date('d-m-Y', strtotime($item->tgl_selesai)) }}</td>
                <td>
                    @forelse ($item->pelaksanaPerjals as $pelaksana)
                        {{ $pelaksana->nama_pegawai.', '.$pelaksana->gelarbelakang_nama }}<br>
                    
                    @empty
                        -
                    @endforelse
                </td>
                <td class="justify">{{ $item->maksud_perjalanan }}</td>
                <td class="justify">{{ $item->tempat_tujuan }}</td>
                <td align="center">{{ date('H:i', strtotime($item->jam_acara)) }}</td>
            </tr>
        @empty
            <tr><td colspan="7" align="center">Data tidak tersedia !</td></tr>
        @endforelse
    </table>
</div>
    