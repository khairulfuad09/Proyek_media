<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JawabanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscoveryLearningController extends Controller
{
    public function show($materi, $tahap){

        $jawaban = JawabanSiswa::with('feedbackGuru')
        ->where('user_id', Auth::id())
        ->whereHas('Materi', function($q) use($materi){
            $q->where('slug', $materi);
        })
        ->whereHas('Tahapan', function($q) use($tahap){
            $q->where('nama_tahapan', $tahap);
        })
        ->first();

        if ($jawaban && $jawaban->feedbackGuru && $jawaban->feedbackGuru->nilai !== null) {
            $nilai = $jawaban->feedbackGuru->nilai;
        } else {
            $nilai = 'belum ada nilai';
        }

        // dd($jawaban);

        $ValidMateri = [
        'sistem-koordinasi-manusia',
        'alat-indra-manusia',
        'hormon-manusia',
        'homeostasis-manusia',
        ];
        $ValidTahap = [
            'stimulasi',
            'identifikasi-masalah',
            'pengumpulan-data',
            'pengolahan-data',
            'verifikasi',
            'generalization'
        ];
        if (!in_array($tahap, $ValidTahap)){
            abort(404);
        }
        if (!in_array($materi, $ValidMateri)){
            abort(404);
        }

        // return view('siswa.DiscoveryLearning', [
        //     'materi' => $materi,
        //     'tahap' => $tahap,
        //     'jawaban' => $jawaban
        // ]);

        // dd($jawaban);

        return view('siswa.DiscoveryLearning', compact('materi', 'tahap', 'jawaban', 'nilai'));
    }
}
