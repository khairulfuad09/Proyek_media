@extends('template.main')
@section('container')
{{-- @dd($progressSiswa) --}}
<div class="min-h-screen p-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Progress Pembelajaran</h1>
        <p class="text-gray-600">Pantau perkembangan belajarmu pada setiap tahap.</p>
    </div>

    <!-- Progress Bar -->
    <div class="bg-white p-4 rounded shadow mb-6">
        <p class="mb-2 font-semibold">Progress Keseluruhan</p>
        <div class="w-full bg-gray-300 h-3 rounded">
                @php
                    $totalPS = 0;
                    $filteredSistemKoordinasi = $progressSiswa->filter(function ($p) {
                        return $p->materi && $p->materi->judul === 'Sistem Koordinasi Manusia';
                    });
                    $totalSK = 0;
                    $filteredAlatIndra = $progressSiswa->filter(function ($p) {
                        return $p->materi && $p->materi->judul === 'Alat Indra Manusia';
                    });
                    $totalAI = 0;
                    $filteredHormon = $progressSiswa->filter(function ($p) {
                        return $p->materi && $p->materi->judul === 'Hormon Manusia';
                    });
                    $totalHormon = 0;
                    $filteredHomeostasis = $progressSiswa->filter(function ($p) {
                        return $p->materi && $p->materi->judul === 'Homeostasis';
                    });
                    $totalHomeostasis = 0;
                @endphp
            @foreach ($progressSiswa as $ps)
                @php
                    if ($ps->status == 'belum_dikerjakan') {
                        $totalPS += 0;
                    }elseif ($ps->status == 'sedang_dikerjakan') {
                        $totalPS += 50;
                    }elseif ($ps->status == 'selesai') {
                        $totalPS += 100;
                    }
                @endphp
            @endforeach
            @php
                $totalPS /= 24;
            @endphp
            <div class="bg-purple-600 h-3 rounded" style="width: {{ $totalPS }}%"></div>
        </div>
        <p class="text-sm text-gray-500 mt-1">{{ $totalPS }}% selesai</p>
    </div>

    <!-- List Tahapan -->
    <div class="grid md:grid-cols-2 gap-4">

        <!-- Item Tahap -->
        <div class="bg-white p-4 rounded shadow flex justify-between items-center">
            <div>
                <p class="font-semibold">Sistem Koordinasi Manusia</p>
                <p class="text-sm text-gray-500"></p>
            </div>
            
            {{-- @dd($filteredSistemKoordinasi) --}}
            @foreach ($filteredSistemKoordinasi as $sk)
                @if ($sk->status == 'belum_dikerjakan' )
                    @php $totalSK += 0; @endphp
                @elseif ($sk->status == 'sedang_dikerjakan' )
                    @php $totalSK += 50; @endphp
                @elseif ($sk->status == 'selesai' )
                    @php $totalSK += 100; @endphp
                @endif
            @endforeach
            @php
                $totalSK /= 6;
            @endphp
            <span class="
                @if ($totalSK == 0)
                    text-red-600 
                @elseif ($totalSK > 0 && $totalSK < 100)
                    text-yellow-600 
                @elseif ($totalSK == 100)    
                    text-green-600 
                @endif
            text-green-600 
            font-bold">
                @if ($totalSK == 0)
                    Belum dikerjakan
                @elseif ($totalSK > 0 && $totalSK < 100)
                    ⏳ Sedang dikerjakan
                @elseif ($totalSK == 100)    
                    ✔ Selesai
                @endif
            </span>
        </div>

        <div class="bg-white p-4 rounded shadow flex justify-between items-center">
            <div>
                <p class="font-semibold">Alat Indra Manusia</p>
                <p class="text-sm text-gray-500"></p>
            </div>
            @foreach ($filteredAlatIndra as $ai)
                @if ($ai->status == 'belum_dikerjakan' )
                    @php $totalAI += 0; @endphp
                @elseif ($ai->status == 'sedang_dikerjakan' )
                    @php $totalAI += 50; @endphp
                @elseif ($ai->status == 'selesai' )
                    @php $totalAI += 100; @endphp
                @endif
            @endforeach
            @php
                $totalAI /= 6;
            @endphp
            <span class="
                @if ($totalAI == 0)
                    text-red-600 
                @elseif ($totalAI > 0 && $totalAI < 100)
                    text-yellow-600 
                @elseif ($totalAI == 100)    
                    text-green-600 
                @endif
            font-bold">
                @if ($totalAI == 0)
                    Belum dikerjakan
                @elseif ($totalAI > 0 && $totalAI < 100)
                    ⏳ Sedang dikerjakan
                @elseif ($totalAI == 100)    
                    ✔ Selesai
                @endif
            </span>
        </div>

        <div class="bg-white p-4 rounded shadow flex justify-between items-center">
            <div>
                <p class="font-semibold">Hormon Manusia</p>
                <p class="text-sm text-gray-500"></p>
            </div>
            @foreach ($filteredHormon as $hormon)
                @if ($hormon->status == 'belum_dikerjakan' )
                    @php $totalHormon += 0; @endphp
                @elseif ($hormon->status == 'sedang_dikerjakan' )
                    @php $totalHormon += 50; @endphp
                @elseif ($hormon->status == 'selesai' )
                    @php $totalHormon += 100; @endphp
                @endif
            @endforeach
            @php
                $totalHormon /= 6;
            @endphp
            <span class="
                @if ($totalHormon == 0)
                    text-red-600 
                @elseif ($totalHormon > 0 && $totalHormon < 100)
                    text-yellow-600 
                @elseif ($totalHormon == 100)    
                    text-green-600 
                @endif
            font-bold">
                @if ($totalHormon == 0)
                    Belum dikerjakan
                @elseif ($totalHormon > 0 && $totalHormon < 100)
                    ⏳ Sedang dikerjakan
                @elseif ($totalHormon == 100)    
                    ✔ Selesai
                @endif
            </span>
        </div>

        <div class="bg-white p-4 rounded shadow flex justify-between items-center">
            <div>
                <p class="font-semibold">Homeostasis</p>
                <p class="text-sm text-gray-500"></p>
            </div>
            @foreach ($filteredHomeostasis as $homeostasis)
                @if ($homeostasis->status == 'belum_dikerjakan' )
                    @php $totalHomeostasis += 0; @endphp
                @elseif ($homeostasis->status == 'sedang_dikerjakan' )
                    @php $totalHomeostasis += 50; @endphp
                @elseif ($homeostasis->status == 'selesai' )
                    @php $totalHomeostasis += 100; @endphp
                @endif
            @endforeach
            @php
                $totalHomeostasis /= 6;
            @endphp
            <span class="
                @if ($totalHomeostasis == 0)
                    text-red-600 
                @elseif ($totalHomeostasis > 0 && $totalHomeostasis < 100)
                    text-yellow-600 
                @elseif ($totalHomeostasis == 100)    
                    text-green-600 
                @endif
            font-bold">
                @if ($totalHomeostasis == 0)
                    Belum dikerjakan
                @elseif ($totalHomeostasis > 0 && $totalHomeostasis < 100)
                    ⏳ Sedang dikerjakan
                @elseif ($totalHomeostasis == 100)    
                    ✔ Selesai
                @endif
            </span>
        </div>

        

    </div>

    <!-- Button Lanjut -->
    <div class="mt-6 text-right">
        <a href="/LanjutPembelajaran" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700">
            Lanjutkan Pembelajaran
        </a>
    </div>

    @if(session('message'))
        <div class="flex items-center gap-3 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            
            <svg xmlns="http://www.w3.org/2000/svg" 
                class="h-5 w-5" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M5 13l4 4L19 7" />
            </svg>

            <span>
                {{ session('message') }}
            </span>
        </div>
    @endif

</div>

@endsection