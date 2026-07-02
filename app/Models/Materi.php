<?php

namespace App\Models;

use App\Models\ProgressSiswa;
use App\Models\Tahapan;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materis';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
    ];

    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class, 'tahapan_id');
    }
    public function progressSiswa()
    {
        return $this->hasMany(ProgressSiswa::class, 'materi_id');
    }
}