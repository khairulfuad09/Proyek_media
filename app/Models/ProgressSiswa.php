<?php

namespace App\Models;

use App\Models\Materi;
use App\Models\Tahapan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ProgressSiswa extends Model
{
    protected $table = 'ProgressSiswa';

    protected $fillable = [
        'user_id',
        'materi_id',
        'tahapan_id',
        'jawaban_id',
        'feedback_id',
        'status',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function JawabanSiswa()
    {
        return $this->belongsTo(JawabanSiswa::class, 'jawaban_id');
    }
    public function feedbackGuru()
    {
        return $this->belongsTo(FeedbackGuru::class, 'feedback_id');
    }
}
