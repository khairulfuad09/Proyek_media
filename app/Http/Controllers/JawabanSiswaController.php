<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FeedbackGuru;
use App\Models\JawabanSiswa;
use App\Models\ProgressSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JawabanSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd(Auth::check(), Auth::id());
        $jawaban = $request->jawaban;

        if (!$jawaban) {
        $jawaban = collect($request->all())
            ->filter(function ($value, $key) {
                return str_starts_with($key, 'q');
            })
            ->toArray();
        }

        if(!is_array($jawaban)){
            $jawaban = [$jawaban];
        }
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'materi_id' => 'required|exists:materis,id',
            'tahapan_id' => 'required|integer',
        ]);

        $jawaban = JawabanSiswa::updateOrCreate([
            'user_id' => $request->user_id,
            'materi_id' => $request->materi_id,
            'tahapan_id' => $request->tahapan_id,
        ], [
            'jawaban' => $jawaban,
        ]);

        // dd($jawaban->id);

        

        // dd($progress);

        if($request->nilai == 100){
           $id_jawaban = JawabanSiswa::where('user_id', $request->user_id)
            ->where('materi_id', $request->materi_id)
            ->where('tahapan_id', $request->tahapan_id)
            ->first()
            ->id;

            $feedback = FeedbackGuru::updateOrCreate([
                'jawaban_siswa_id' => $id_jawaban,
                'user_id' => $request->user_id,
                'feedback' => 'nilai otomatis sistem',
            ], [
                'nilai' => $request->nilai,
            ]);
        }

        $progress = ProgressSiswa::updateOrCreate([
            'user_id' => $request->user_id, 
            'materi_id' => $request->materi_id,
            'tahapan_id' => $request->tahapan_id,
        ], [
            'jawaban_id' => $jawaban->id,
            'feedback_id' => $feedback->id ?? null,
            'status' => 'sedang_dikerjakan',
        ]);

        // return redirect()->back()->with('success', 'Jawaban berhasil disimpan!');
        return redirect(url('/Discovery-Learning/' . $request->next_materi . '/' . $request->next_tahapan))->with('success', 'jawaban berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JawabanSiswa $jawabanSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JawabanSiswa $jawabanSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JawabanSiswa $jawabanSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JawabanSiswa $jawabanSiswa)
    {
        //
    }
}
