<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProgressSiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        $progressSiswa = ProgressSiswa::with(['materi', 'tahapan'])->where('user_id', Auth::id())->get();
        return view('siswa.Progress', compact('progressSiswa'));
    }
}
