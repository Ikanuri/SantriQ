<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function rayon()
    {
        return $this->belongsTo(RayonKamar::class, 'rayon_kamar_id', 'id');
    }
}
