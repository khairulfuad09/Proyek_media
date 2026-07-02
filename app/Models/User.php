<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Materi;
use App\Models\ProgressSiswa;
use App\Models\Tahapan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nis',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function progressSiswa()
    {
        return $this->hasMany(ProgressSiswa::class, 'user_id');
    }

    protected static function booted()
    {
        static::updated(function ($user){
            if($user->isDirty('role') && $user->role == 'siswa'){
                $materis = Materi::all();
                $tahapans = Tahapan::all();
                foreach($materis as $materi){
                    foreach($tahapans as $tahapan)
                    {
                        if(!ProgressSiswa::where('user_id', $user->id)
                            ->where('materi_id', $materi->id)
                            ->where('tahapan_id', $tahapan->id)
                            ->exists())
                        {
                            ProgressSiswa::create([
                                'user_id' => $user->id,
                                'materi_id' => $materi->id,
                                'tahapan_id' => $tahapan->id,
                                'status' => 'belum_dikerjakan',
                            ]);
                        }
                    }
                }
            }
        });
    }
}
