<?php

namespace App\Models;

use App\Models\Materi;
use App\Models\Tahapan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class JawabanSiswa extends Model
{
    protected $table = 'jawabansiswa';

    protected $fillable = [
        'user_id',
        'materi_id',
        'tahapan_id',
        'jawaban',
        'file_jawaban',
    ];

    protected $casts = [
        'jawaban' => 'array',
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class, 'tahapan_id');
    }
    public function feedbackGuru()
    {
        return $this->hasOne(FeedbackGuru::class, 'jawaban_siswa_id');
    }
    public function progressSiswa()
    {
        return $this->hasOne(ProgressSiswa::class, 'jawaban_id');
    }
}
