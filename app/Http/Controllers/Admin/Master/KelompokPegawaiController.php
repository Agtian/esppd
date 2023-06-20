<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelompokPegawaiController extends Controller
{
    public function index()
    {
        return view('layouts.admin.master.kel-pegawai.index');
    }
}
