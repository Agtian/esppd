<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonfigurasiSPPDController extends Controller
{
    public function index()
    {
        return view('layouts.admin.master.konfig-sppd.index');
    }
}
