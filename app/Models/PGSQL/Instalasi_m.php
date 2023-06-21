<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalasi_m extends Model
{
    use HasFactory;
    protected $table = 'public.instalasi_m';

    protected $guarded = [];
}
