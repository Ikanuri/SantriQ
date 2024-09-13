<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinSantri extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
    public function surat()
    {
        return $this->belongsTo(SuratIzin::class, 'surat_izin_id', 'id');
    }
}
