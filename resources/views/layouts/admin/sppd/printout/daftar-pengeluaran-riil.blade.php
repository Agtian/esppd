<style>
    .print {
        font-family: "Times New Roman", Times, serif;
    }

    .justify {
        text-align: justify;
        text-justify: inter-word;
    }
</style>

@forelse ($resultPelaksana as $pelaksana)
    <div class="print">
        <img src="assets/image_akun/kop_surat.png" alt="Kop Surat">
        <br>
        <table>
            <tr>
                <td colspan="3" align="center"><b>DAFTAR PENGELUARAN RIIL</b></td>
            </tr>
            <tr><td colspan="3"></td></tr>
            <tr>
                <td colspan="3">Yang bertanda taangan dibawah ini:</td>
            </tr>
            <tr><td colspan="3"></td></tr>
            <tr>
                <td width="20"></td>
                <td width="70">Nama</td>
                <td width="300">: {{ $pelaksana->gelardepan.' '.$pelaksana->nama_pegawai.' '.$pelaksana->gelarbelakang_nama }}</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="70">NIP</td>
                <td width="300">: {{ $pelaksana->nomorindukpegawai }}</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="70">Jabatan</td>
                <td width="300">: {{ $pelaksana->jabatan }}</td>
            </tr>
            <tr><td colspan="3"></td></tr>
            <tr>
                <td colspan="3" width="530" class="justify">Berdasarkan Surat Perintah Perjalanan Dinas (SPPD) Nomor {{ $detail->no_sppd }} Tanggal @if($detail->tgl_mulai == $detail->tgl_selesai)  {{ date('d-m-Y', strtotime($detail->tgl_mulai)) }} @else {{ date('d-m-Y', strtotime($detail->tgl_mulai)).' s.d '.date('d-m-Y', strtotime($detail->tgl_selesai)) }} @endif dengan ini kami menyatakan dengan sesungguhnya  bahwa:</td>
            </tr>
            <tr><td colspan="3"></td></tr>
            <tr>
                <td width="20"></td>
                <td width="20">1.</td>
                <td width="490" class="justify">Biaya transport pejabat / pegawai dan / atau biaya penginapan dibawah ini yang tidak dapat diperoleh bukti – bukti pengeluarannya, meliputi:</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>
                    <table border="0.3" cellpadding="2" width="100%">
                        <tr>
                            <th align="center" width="30">NO</th>
                            <th align="center" width="160">PERINCIAN BIAYA</th>
                            <th align="center" width="100">JUMLAH</th>
                            <th align="center" width="190">KETERANGAN</th>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>Uang Harian</td>
                            <td>Rp. {{ $pelaksana->uang_harian }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="center">2</td>
                            <td>Uang Transportasi</td>
                            <td>Rp. {{ $pelaksana->biaya_trasnport }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>Penginapan / Tarif Hotel</td>
                            <td>Rp. {{ $pelaksana->biaya_penginapan }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="center">4</td>
                            <td>Biaya Tol</td>
                            <td>Rp. {{ $pelaksana->biaya_tol }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="center">5</td>
                            <td>Biaya Pesawat</td>
                            <td>Rp. {{ $pelaksana->biaya_pesawat }}</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr><td colspan="3"></td></tr>
            <tr>
                <td width="20"></td>
                <td width="20">2.</td>
                <td width="490" class="justify">Jumlah uang tersebut pada angka 1 diatas benar – benar di keluarkan untuk pelaksanaan Perjalanan Dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetorkan kelebihan tersebut ke kas Daerah.</td>
            </tr>
            <tr><td colspan="3"></td></tr>
            <tr>
                <td colspan="3" width="490">Demikian pernyataan ini kami buat dengan sebenarnya ,untuk dipergunakan sebagaimana mestinya.</td>
            </tr>
        </table>

        <br><br>
        <table>
            <tr>
                <td width="350"></td>
                <td width="200"> Jepara, {{ date('d F Y') }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td align="center" width="200">Mengetahui/Menyetujui <br>PPTK BLUD RSUD dr Rehatta</td>
                <td width="50"></td>
                <td align="center" width="300">Pelaksana SPPD</td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr>
                <td align="center" width="200"><u>{{ $konf_sppd->nama_pptk }}</u></td>
                <td width="50"></td>
                <td align="center" width="300"><u>{{ $pelaksana->gelardepan.' '.$pelaksana->nama_pegawai.' '.$pelaksana->gelarbelakang_nama }}</u></td>
            </tr>
            <tr>
                <td align="center" width="200">{{ $konf_sppd->nip_pptk }}</td>
                <td width="50"></td>
                <td align="center" width="300">{{ $pelaksana->nomorindukpegawai }}</td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br><br>
    </div>
@empty
    <div class="print">
        <img src="assets/image_akun/kop_surat.png" alt="Kop Surat">
        <br>
        <table>
            <tr>
                <td colspan="3" align="center">DAFTAR PENGELUARAN RIIL</td>
            </tr>
        </table>
    </div>
@endforelse