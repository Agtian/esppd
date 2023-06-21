<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat_m extends Model
{
    use HasFactory;
    protected $table = 'public.pangkat_m';

    protected $guarded = [];
}
