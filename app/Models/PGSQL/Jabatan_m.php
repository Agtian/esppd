<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan_m extends Model
{
    use HasFactory;
    
    protected $connection = 'pgsql';
    protected $table = 'public.jabatan_m';
    protected $primaryKey = 'jabatan_id';
    protected $guarded = [];
}
