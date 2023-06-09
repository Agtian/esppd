<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat_m extends Model
{
    use HasFactory;
    
    protected $connection = 'pgsql';

    protected $table = 'public.pangkat_m';

    protected $primaryKey = 'pangkat_id';

    protected $guarded = [];
}
