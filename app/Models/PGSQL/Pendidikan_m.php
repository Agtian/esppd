<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan_m extends Model
{
    use HasFactory;
    
    protected $table = 'public.pendidikan_m';

    protected $guarded = [];
}
