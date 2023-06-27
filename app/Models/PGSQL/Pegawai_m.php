<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai_m extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'public.pegawai_m';
    protected $primaryKey = 'pegawai_id';
    public $timestamps = false;
    protected $guarded = [];
}
