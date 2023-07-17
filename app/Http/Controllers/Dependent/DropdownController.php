<?php

namespace App\Http\Controllers\Dependent;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function getProvinsi()
    {
        return Provinsi::all();
    }

    public function getKabupaten(Request $request)
    {
        return Kabupaten::where('provinsi_id', $request->provinsi_id)->get();
    }

}
