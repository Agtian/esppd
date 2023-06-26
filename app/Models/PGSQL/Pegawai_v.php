<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pegawai_v extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'public.pegawai_v';

    protected $guarded = [];

    public function getDataPegawai()
    {
        $query = DB::connection('pgsql')->table('public.pegawai_v')
                                ->join('pangkat_m', 'pegawai_v.pangkat_id', '=', 'pangkat_m.pangkat_id')
                                ->join('golonganpegawai_m', 'pangkat_m.golonganpegawai_id', '=', 'golonganpegawai_m.golonganpegawai_id')
                                ->select("*")
                                ->paginate(10);
        return $query;
    }

    public function getDataPegawais($search)
    {
        $query = DB::connection('pgsql')->table('public.pegawai_v')
                                ->where('nama_pegawai', 'like', $search)
                                ->leftJoin('pangkat_m', 'pegawai_v.pangkat_id', '=', 'pangkat_m.pangkat_id')
                                ->leftJoin('golonganpegawai_m', 'pangkat_m.golonganpegawai_id', '=', 'golonganpegawai_m.golonganpegawai_id')
                                ->select("*")
                                ->limit(10)
                                ->get();
        return $query;
    }
}
