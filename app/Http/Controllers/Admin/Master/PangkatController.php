<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function index()
    {
        return view('layouts.admin.master.pangkat.index');
    }
}
