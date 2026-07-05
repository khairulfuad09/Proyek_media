<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FeedbackGuru;
use App\Models\ProgressSiswa;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $Users = User::where('role', 'unknown')->get();

        return view('admin.UpdateUsers', compact('Users'));
    }

    public function feedback()
    {
        return view('admin.feedback-guru');
    }

    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,guru,siswa',
        ]);

        $user = User::findOrFail($id);
        if ($user->role !== 'unknown') {
            return redirect()->route('admin.update-users')->with('error', 'User role cannot be updated.');
        }
        $user->role = $request->input('role');

        if($user->role == 'siswa'){
            
        }

        $user->save();

        return redirect()->route('admin.update-users')->with('success', 'User role updated successfully.');
    }
    public function beranda()
    {
        $siswaCount = User::where('role', 'siswa')->count();
        $guruCount = User::where('role', 'guru')->count();
        $unknownCount = User::where('role', 'unknown')->count();
        $progressSiswa = progresssiswa::with(['Materi', 'tahapan', 'User', 'Jawabansiswa', 'FeedbackGuru'])
            ->whereHas('user', function ($q) {
                $q->where('role', 'siswa');
            })
            ->get()
            ->groupBy('user_id');
            
            return view('admin.admin-dashboard')->with(compact('siswaCount', 'guruCount', 'unknownCount', 'progressSiswa'));
    }
    public function simpanFeedbackDanNilai(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $feedback = FeedbackGuru::updateOrCreate([
                'jawaban_siswa_id' => $request->jawaban_siswa_id,
                'user_id' => $request->user_id,
                'feedback' => $request->feedback,
            ], [
                'nilai' => $request->nilai,
            ]);

        if($request->nilai == 100){
            $status = 'selesai';
        } else if($request->nilai < 100 && $request->nilai > 0){
            $status = 'sedang_dikerjakan';
        }

        // dd($feedback->id);

        $progress = ProgressSiswa::updateOrCreate([
            'user_id' => $request->user_id, 
            'materi_id' => $request->materi_id,
            'tahapan_id' => $request->tahapan_id,
        ], [
            'jawaban_id' => $request->jawaban_siswa_id,
            'feedback_id' => $feedback->id ?? null,
            'status' => $status,
        ]);

        // dd($progress);

        return redirect()->back()->with('success', 'Feedback dan nilai berhasil disimpan.');
    }
}
