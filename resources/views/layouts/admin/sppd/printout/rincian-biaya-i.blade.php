<style>
    .print {
        font-family: "Times New Roman", Times, serif;
    }

    .justify {
        text-align: justify;
        text-justify: inter-word;
    }
</style>

@foreach ($resultPelaksana as $pelaksana)
    <div class="print">
        <img src="assets/image_akun/kop_surat.png" alt="Kop Surat">

        <table>
            <tr>
                <td align="center" colspan="2"><h3><b>RINCIAN BIAYA PERJALANAN DINAS</b></h3></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td width="130">Lampiran SPPD Nomor</td>
                <td width="360">: {{ $detail->no_sppd }} / {{ $pelaksana->nama_pegawai.', '.$pelaksana->gelarbelakang_nama }}</td>
            </tr>
            <tr>
                <td width="130">Tanggal</td>
                <td>: {{ date('d-m-Y', strtotime($detail->tgl_mulai)).' s.d '.date('d-m-Y', strtotime($detail->tgl_selesai)) }}</td>
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
                <td align="center">{{ $pelaksana->uang_harian }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center">2.</td>
                <td>Biaya Transport</td>
                <td align="center">{{ $pelaksana->biaya_transport }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center">3.</td>
                <td>Biaya Penginapan</td>
                <td align="center">{{ $pelaksana->biaya_penginapan }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center">4.</td>
                <td>Uang Representasi</td>
                <td align="center">{{ $pelaksana->uang_representasi }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center">4.</td>
                <td>Biaya Tol</td>
                <td align="center">{{ $pelaksana->biaya_tol }}</td>
                <td></td>
            </tr>
            <tr>
                <td align="center">5.</td>
                <td>Lain-lain</td>
                <td align="center">{{ $pelaksana->biaya_lainnya }}</td>
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
                <td>Jepara, {{ date('d-m-Y', strtotime($detail->tgl_sppd)) }}</td>
            </tr>
        </table>
        <br><br>
        <table>
            <tr>
                <td>Telah dibayar sejumlah</td>
                <td width="150"></td>
                <td>Telah Menerima Uang Sejumlah</td>
            </tr>
            <tr>
                <td>Rp. {{ $pelaksana->total_biaya }}</td>
                <td width="150"></td>
                <td>Rp. {{ $pelaksana->total_biaya }}</td>
            </tr>
        </table>
        <br><br>
        <table>
            <tr>
                <td align="center">Bendahara Pengeluaran</td>
                <td width="130"></td>
                <td align="center">Yang Menerima</td>
            </tr>
            <tr>
                <td></td>
                <td width="100"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td width="100"></td>
                <td></td>
            </tr>
            <tr>
                <td align="center">{{ $konf_sppd->nama_bendahara }} <br>NIP. {{ $konf_sppd->nip_bendahara }}</td>
                <td width="70"></td>
                <td width="300" align="center">{{ $pelaksana->nama_pegawai.', '.$pelaksana->gelarbelakang_nama }} <br>{{ ($pelaksana->golongan == 'Badan Layanan Umum') ? 'NRP' : 'NIP' }}. {{ $pelaksana->nomorindukpegawai }}</td>
            </tr>
        </table>
        <hr>
        <p align="center">PERHITUNGAN SPPD RAMPUNG</p>
        <br>
        <table>
            <tr>
                <td>Ditetapkan sejumlah</td>
                <td width="200"></td>
                <td>: Rp. {{ $pelaksana->total_biaya }}</td>
            </tr>
            <tr>
                <td>Yang Telah Dibayarkan Semula</td>
                <td width="200"></td>
                <td>: Rp. 0</td>
            </tr>
            <tr>
                <td>Sisa Kurang/Lebih</td>
                <td width="200"></td>
                <td>: Rp. 0</td>
            </tr>
        </table>
        <br><br>
        <table>
            <tr>
                <td width="300"></td>
                <td width="200" align="center">An. PA/KPA <br>PPTK</td>
            </tr>
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr>
                <td width="300"></td>
                <td width="200" align="center"><b><u>{{ $konf_sppd->nama_pptk }}</u></b> <br>NIP. {{ $konf_sppd->nip_pptk }}</td>
            </tr>
        </table>
        <br>
        <hr>
        <p>Catatan : Formulir ini untuk pelasana perjalanan dinas maksimal 4 orang</p>
    </div>   
@endforeach
