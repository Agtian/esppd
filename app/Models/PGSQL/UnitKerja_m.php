<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja_m extends Model
{
    use HasFactory;
    protected $table = 'public.unitkerja_m';

    protected $guarded = [];
}
