<?php

namespace App\Models;

use App\Models\Materi;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FeedbackGuru extends Model
{
    protected $table = 'FeedbackGuru';

    protected $fillable = [
        'jawaban_siswa_id',
        'user_id',
        'feedback',
        'nilai',
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
    public function jawabanSiswa()
    {
        return $this->belongsTo(JawabanSiswa::class, 'jawaban_siswa_id');
    }
    public function progressSiswa()
    {
        return $this->hasOne(ProgressSiswa::class, 'feedback_id');
    }
}
