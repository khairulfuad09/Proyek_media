<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProgressSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $PorgressSiswa = ProgressSiswa::with(['Materi', 'Tahapan'])
        ->where('user_id', Auth::id())->get();
        // dd($PorgressSiswa);
        foreach ($PorgressSiswa as $progress) {
            if($progress->status == 'belum_dikerjakan'){
                $materi = $progress->Materi->slug;
                $tahap = $progress->Tahapan->nama_tahapan;
                return redirect()->route('discovery.learning', ['materi' => $materi, 'tahap' => $tahap]);
            }
            // else{
            //     return back()->with('message', 'Semua materi sudah dikerjakan!, menunggu penilaian guru');
            // }
        // Process each progress item
        }
        return back()->with('message', 'Semua materi sudah dikerjakan!, menunggu penilaian guru');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgressSiswa $progressSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgressSiswa $progressSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgressSiswa $progressSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgressSiswa $progressSiswa)
    {
        //
    }
}
