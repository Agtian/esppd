<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kementerian extends Model
{
    use HasFactory;

    protected $table = 'kementerian';

    protected $guarded = [];

    public function daftarKOPDs()
    {
        return $this->hasMany(DaftarOPD::class, 'kementerian_id', 'id');
    }
}
