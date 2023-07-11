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
        <tr style="background-color: #D1E6F6">
            <td width="30" align="center"><b>NO</b></td>
            <td width="90" align="center"><b>TANGGAL / <br>NO SPPD</b></td>
            <td width="140" align="center"><b>TANGGAL ACARA</b></td>
            <td width="210" align="center"><b>DASAR</b></td>
            <td width="210" align="center"><b>PERIHAL</b></td>
            <td width="180" align="center"><b>TUJUAN</b></td>
            <td width="50" align="center"><b>JAM</b></td>
            <td width="210" align="center"><b>NAMA</b></td>
            <td width="90" align="center"><b>UANG HARIAN</b></td>
            <td width="90" align="center"><b>BIAYA TRANSPORT</b></td>
            <td width="90" align="center"><b>BIAYA PENGINAPAN</b></td>
            <td width="90" align="center"><b>UANG REPRESENTASI</b></td>
            <td width="90" align="center"><b>BIAYA PESAWAT</b></td>
            <td width="90" align="center"><b>BIAYA TOL</b></td>
            <td width="90" align="center"><b>BIAYA LAINNYA</b></td>
            <td width="90" align="center"><b>TOTAL</b></td>
        </tr>
        <tbody>
            @forelse ($resultPengeluaranSPPD as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td align="center">{{ date('d-m-Y', strtotime($item->tgl_sppd)) }} <br>{{ $item->no_sppd }}</td>
                <td align="center">{{ date('d-m-Y', strtotime($item->tgl_mulai)).' s.d '.date('d-m-Y', strtotime($item->tgl_selesai)) }}</td>
                <td class="justify">{{ $item->dasar }}</td>
                <td class="justify">{{ $item->maksud_perjalanan }}</td>
                <td class="justify">{{ $item->tempat_tujuan }}</td>
                <td align="center">{{ date('H:i', strtotime($item->jam_acara)) }}</td>
                <td>
                    @forelse ($item->pelaksanaPerjals as $pelaksana)
                        {{ $pelaksana->nama_pegawai.', '.$pelaksana->gelarbelakang_nama }}<br>
                    @empty
                        -
                    @endforelse
                </td>
                <td><table>
                        @forelse ($item->pelaksanaPerjals as $pelaksana)
                            @php
                                $uang_harians[] = $pelaksana->uang_harian;
                            @endphp
                            <tr>
                                <td align="center">{{ number_format($pelaksana->uang_harian, 2, '.',',') }}</td>
                            </tr>
                        @empty
                            <tr><td align="center">-</td></tr>
                        @endforelse
                    </table>
                </td>
                <td><table>
                        @forelse ($item->pelaksanaPerjals as $pelaksana)
                            <tr>
                                @php
                                    $biaya_transports[] = $pelaksana->biaya_transport;
                                @endphp
                                <td align="center">{{ number_format($pelaksana->biaya_transport, 2, '.',',') }}</td>
                            </tr>
                        @empty
                            <tr><td align="center">-</td></tr>
                        @endforelse
                    </table>
                </td>
                <td><table>
                        @forelse ($item->pelaksanaPerjals as $pelaksana)
                            <tr>
                                @php
                                    $biaya_penginapans[] = $pelaksana->biaya_penginapan;
                                @endphp
                                <td align="center">{{ number_format($pelaksana->biaya_penginapan, 2, '.',',') }}</td>
                            </tr>
                        @empty
                            <tr><td align="center">-</td></tr>
                        @endforelse
                    </table>
                </td>
                <td><table>
                        @forelse ($item->pelaksanaPerjals as $pelaksana)
                            <tr>
                                @php
                                    $uang_representasis[] = $pelaksana->uang_representasi;
                                @endphp
                                <td align="center">{{ number_format($pelaksana->uang_representasi, 2, '.',',') }}</td>
                            </tr>
                        @empty
                            <tr><td align="center">-</td></tr>
                        @endforelse
                    </table>
                </td>
                <td><table>
                        @forelse ($item->pelaksanaPerjals as $pelaksana)
                            <tr>
                                @php
                                    $biaya_pesawats[] = $pelaksana->biaya_pesawat;
                                @endphp
                                <td align="center">{{ number_format($pelaksana->biaya_pesawat, 2, '.',',') }}</td>
                            </tr>
                        @empty
                            <tr><td align="center">-</td></tr>
                        @endforelse
                    </table>
                </td>
                <td><table>
                        @forelse ($item->pelaksanaPerjals as $pelaksana)
                            <tr>
                                @php
                                    $biaya_tols[] = $pelaksana->biaya_tol;
                                @endphp
                                <td align="center">{{ number_format($pelaksana->biaya_tol, 2, '.',',') }}</td>
                            </tr>
                        @empty
                            <tr><td align="center">-</td></tr>
                        @endforelse
                    </table>
                </td>
                <td><table>
                        @forelse ($item->pelaksanaPerjals as $pelaksana)
                            <tr>
                                @php
                                    $biaya_lainnyas[] = $pelaksana->biaya_lainnya;
                                @endphp
                                <td align="center">{{ number_format($pelaksana->biaya_lainnya, 2, '.',',') }}</td>
                            </tr>
                        @empty
                            <tr><td align="center">-</td></tr>
                        @endforelse
                    </table>
                </td>
                <td><table>
                        @forelse ($item->pelaksanaPerjals as $pelaksana)
                            <tr>
                                @php
                                    $total_biayas[] = $pelaksana->total_biaya;
                                @endphp
                                <td align="center">{{ number_format($pelaksana->total_biaya, 2, '.',',') }}</td>
                            </tr>
                        @empty
                            <tr><td align="center">-</td></tr>
                        @endforelse
                    </table>
                </td>
            </tr>
        @empty
            <tr><td colspan="16" align="center">Data tidak tersedia !</td></tr>
        @endforelse
        </tbody>
        <tfoot>
            <tr style="background-color: #D1E6F6">
                <td colspan="8" align="center"><b>JUMLAH</b></td>
                <td align="center">{{ number_format(array_sum($uang_harians), 2, '.',',') }}</td>
                <td align="center">{{ number_format(array_sum($biaya_transports), 2, '.',',') }}</td>
                <td align="center">{{ number_format(array_sum($biaya_penginapans), 2, '.',',') }}</td>
                <td align="center">{{ number_format(array_sum($uang_representasis), 2, '.',',') }}</td>
                <td align="center">{{ number_format(array_sum($biaya_pesawats), 2, '.',',') }}</td>
                <td align="center">{{ number_format(array_sum($biaya_tols), 2, '.',',') }}</td>
                <td align="center">{{ number_format(array_sum($biaya_lainnyas), 2, '.',',') }}</td>
                <td align="center">{{ number_format(array_sum($total_biayas), 2, '.',',') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
    