<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pegawais extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $guarded = [];

    public function getDataPegawai()
    {
        $query = DB::select("SELECT p.*,  p2.pangkat_nama, p2.pangkat_namalainnya, pg.golonganpegawai_nama
                                FROM pegawais p
                                JOIN pangkats p2 ON p.pangkat_id = p2.id
                                JOIN golonganpegawais pg ON p2.golonganpegawai_id = pg.id");
        return $query;
                            
    }
}
