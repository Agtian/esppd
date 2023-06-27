<?php

namespace App\Models\PGSQL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GelarBelakang_m extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'public.gelarbelakang_m';

    protected $primaryKey = 'gelarbelakang_id';

    protected $guarded = [];
}
