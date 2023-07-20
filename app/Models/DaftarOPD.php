<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarOPD extends Model
{
    use HasFactory;

    protected $table = 'daftaropd';

    protected $guarded = [];

    public function kementerians()
    {
        return $this->belongsTo(Kementerian::class, 'kementerian_id', 'id');
    }

    public function provinsis()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function kabupatens()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'id');
    }
}
