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

    public function unitkerjas()
    {
        return $this->belongsTo(UnitKerja_m::class, 'unitkerja_id', 'unitkerja_id');
    }

    public function gelarbelakangs()
    {
        return $this->belongsTo(GelarBelakang_m::class, 'gelarbelakang_id', 'gelarbelakang_id');
    }

    public function jabatans()
    {
        return $this->belongsTo(Jabatan_m::class, 'jabatan_id', 'jabatan_id');
    }
}
