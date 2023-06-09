<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjalananDinas extends Model
{
    use HasFactory;
    protected $table = 'perjalanandinas';

    protected $guarded = [];

    public function pelaksanaPerjals()
    {
        return $this->hasMany(PelaksanaPerjalananDinas::class, 'perjalanandinas_id', 'id');
    }

}
