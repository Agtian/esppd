<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DaftarOPD as ModelsDaftarOPD;
use App\Models\Kementerian;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class DaftarOPD extends Controller
{
    public function index()
    {
        $resultDaftarOPD    = ModelsDaftarOPD::paginate(10);
        $resultKementerian  = Kementerian::all();
        $resultProvinsi     = Provinsi::all();

        return view('layouts.admin.master.daftar-opd.index', compact('resultDaftarOPD', 'resultKementerian', 'resultProvinsi'));
    }

    public function edit(int $id)
    {
        $getDaftarOPD      = ModelsDaftarOPD::findOrFail($id);
        $resultKementerian  = Kementerian::all();
        $resultProvinsi     = Provinsi::all();

        return view('layouts.admin.master.daftar-opd.edit', compact('getDaftarOPD', 'resultKementerian', 'resultProvinsi'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kementerian_id'    => 'integer|nullable',
            'provinsi_id'       => 'required|integer',
            'kabupaten_id'      => 'required|integer',
            'nama_opd'          => 'required|max:150',
            'status_opd'        => 'required|integer',
            'alamat_opd'        => 'required|max:150',
        ]);

        $store = ModelsDaftarOPD::create([
            'kementerian_id'    => $validatedData['kementerian_id'],
            'provinsi_id'       => $validatedData['provinsi_id'],
            'kabupaten_id'      => $validatedData['kabupaten_id'],
            'nama_opd'          => $validatedData['nama_opd'],
            'status_opd'        => $validatedData['status_opd'],
            'alamat'            => $validatedData['alamat_opd'],
        ]);

        return redirect('dashboard/admin/daftar-opd')->with('message', 'Daftar OPD added successfully.');
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'kementerian_id'    => 'integer|nullable',
            'provinsi_id'       => 'required|integer',
            'kabupaten_id'      => 'required|integer',
            'nama_opd'          => 'required|max:150',
            'status_opd'        => 'required|integer',
            'alamat_opd'        => 'required|max:150',
        ]);

        $update = ModelsDaftarOPD::findOrFail($id)->update([
            'kementerian_id'    => $validatedData['kementerian_id'],
            'provinsi_id'       => $validatedData['provinsi_id'],
            'kabupaten_id'      => $validatedData['kabupaten_id'],
            'nama_opd'          => $validatedData['nama_opd'],
            'status_opd'        => $validatedData['status_opd'],
            'alamat'            => $validatedData['alamat_opd'],
        ]);

        return redirect('dashboard/admin/daftar-opd')->with('message', 'Daftar OPD updated successfully.');
    }
}
