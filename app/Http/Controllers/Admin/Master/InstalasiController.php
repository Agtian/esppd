<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstalasiController extends Controller
{
    public function index()
    {
        return view('layouts.admin.master.instalasi.index');
    }
}
