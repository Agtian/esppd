<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan_m extends Model
{
    use HasFactory;
    protected $table = 'public.jabatan_m';

    protected $guarded = [];
}
