<?php

namespace App\Models;

use App\Models\Materi;
use App\Models\ProgressSiswa;
use Illuminate\Database\Eloquent\Model;

class Tahapan extends Model
{
    protected $table = 'tahapan';

    protected $fillable = [
        'nama_tahapan',
        'urutan',
    ];

    public function materis()
    {
        return $this->hasMany(Materi::class, 'tahapan_id');
    }
    public function progressSiswa()
    {
        return $this->hasMany(ProgressSiswa::class, 'tahapan_id');
    }
    public function JawabanSiswa()
    {
        return $this->hasMany('JawabanSiswa::class', 'tahapan_id');
    }
}
