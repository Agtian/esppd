<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GolonganPegawai_m extends Model
{
    use HasFactory;
    
    protected $connection = 'pgsql';

    protected $table = 'public.golonganpegawai_m';
    
    protected $primaryKey = 'golonganpegawai_id';

    protected $guarded = [];
}
