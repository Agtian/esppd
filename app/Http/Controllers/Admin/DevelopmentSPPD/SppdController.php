<?php

namespace App\Http\Controllers\Admin\DevelopmentSPPD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SppdController extends Controller
{
    public function index()
    {
        return view('layouts.admin.sppd.index');
    }

    public function create()
    {
        return view('layouts.admin.sppd.create');
    }
}
