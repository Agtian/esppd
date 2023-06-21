<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Pegawais;
use App\Models\PGSQL\Pegawai_v;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {

        $pegawais = (new Pegawai_v())->getDataPegawai();
        return view('layouts.admin.master.pegawai.index', compact('pegawais'));
    }
}
