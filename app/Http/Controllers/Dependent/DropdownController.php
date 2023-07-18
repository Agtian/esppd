<?php

namespace App\Http\Controllers\Dependent;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\PGSQL\Pegawai_m;
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

    public function getPegawai(Request $request)
    {
        $pegawais = [];
        if ($request->has('q')) {
            $search = $request->q;
            $pegawais = Pegawai_m::select('pegawai_id', 'nama_pegawai')
                            ->where('nama_pegawai', 'LIKE', "%$search%")
                            ->get();
        }
        return response()->json($pegawais);
    }
}
