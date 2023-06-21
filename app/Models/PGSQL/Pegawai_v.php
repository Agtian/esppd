<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pegawai_v extends Model
{
    use HasFactory;
    protected $table = 'public.pegawai_v';

    protected $guarded = [];

    public function getDataPegawai()
    {
        $query = DB::connection('pgsql')->table('public.pegawai_v')
                                ->join('pangkat_m', 'pegawai_v.pangkat_id', '=', 'pangkat_m.pangkat_id')
                                ->join('golonganpegawai_m', 'pangkat_m.golonganpegawai_id', '=', 'golonganpegawai_m.golonganpegawai_id')
                                ->select("*")->paginate(10);
                                
        // $query = DB::connection('pgsql')->select("SELECT p.*,  p2.pangkat_nama, p2.pangkat_nama, p2.pangkat_namalainnya, pg.golonganpegawai_nama
        //                         FROM public.pegawai_v p
        //                         JOIN pangkat_m p2 ON p.pangkat_id = p2.pangkat_id
        //                         JOIN golonganpegawai_m pg ON p2.golonganpegawai_id = pg.golonganpegawai_id");
        return $query;
                            
    }
}
