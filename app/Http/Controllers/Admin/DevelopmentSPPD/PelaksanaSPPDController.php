<?php

namespace App\Http\Controllers\Admin\DevelopmentSPPD;

use App\Http\Controllers\Controller;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;

class PelaksanaSPPDController extends Controller
{
    public function index()
    {
        return view('layouts.admin.sppd.pelaksana-sppd');
    }
}