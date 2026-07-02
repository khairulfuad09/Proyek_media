@extends('template.main')

@section('container')

<div class="p-6">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="mb-6">

        <h1 class="text-3xl font-bold text-white">
            Dashboard Guru
        </h1>

        <p class="text-purple-200">
            Kelola materi dan pantau progres siswa
        </p>

    </div>

    {{-- ========================================= --}}
    {{-- CARD STATS --}}
    {{-- ========================================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- USER UNKNOWN --}}
        <div class="bg-white p-4 rounded-xl shadow">

            <h2 class="text-gray-500">
                User Unknown
            </h2>

            <p class="text-2xl font-bold text-purple-600">
                {{ $unknownCount }}
            </p>

        </div>

        {{-- TOTAL SISWA --}}
        <div class="bg-white p-4 rounded-xl shadow">

            <h2 class="text-gray-500">
                Total Siswa
            </h2>

            <p class="text-2xl font-bold text-purple-600">
                {{ $siswaCount }}
            </p>

        </div>

        {{-- TOTAL GURU --}}
        @can('admin')
            <div class="bg-white p-4 rounded-xl shadow">

                <h2 class="text-gray-500">
                    Total Guru
                </h2>

                <p class="text-2xl font-bold text-purple-600">
                    {{ $guruCount }}
                </p>

            </div>
        @endcan

    </div>

    {{-- ========================================= --}}
    {{-- DATA SISWA --}}
    {{-- ========================================= --}}
    <div class="bg-white p-6 rounded-xl shadow">

        {{-- TITLE --}}
        <div class="flex items-center justify-between mb-6">

            <h2 class="text-xl font-semibold">
                Progress Siswa
            </h2>

            {{-- OPTIONAL SEARCH --}}
            <div class="hidden md:block">
                <input
                    type="text"
                    placeholder="Cari siswa..."
                    class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-purple-500"
                >
            </div>

        </div>

        {{-- RESPONSIVE TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full border-collapse min-w-[700px]">

                {{-- TABLE HEADER --}}
                <thead>

                    <tr class="border-b text-left bg-gray-50">

                        <th class="py-3 px-2">
                            Nama
                        </th>

                        <th class="py-3 px-2">
                            Progress Keseluruhan
                        </th>

                        <th class="py-3 px-2 text-center">
                            Detail
                        </th>

                    </tr>

                </thead>

                {{-- TABLE BODY --}}
                <tbody>

                    @forelse ($progressSiswa as $userId => $progressSiswaID)

                        @php
                            $groupMateri = $progressSiswaID->groupBy(function ($item) {
                                return $item->materi->judul;
                            });

                            $totalPS = 0;

                            foreach ($progressSiswaID as $ps) {

                                if ($ps->status == 'belum_dikerjakan') {
                                    $totalPS += 0;

                                } elseif ($ps->status == 'sedang_dikerjakan') {
                                    $totalPS += 50;

                                } elseif ($ps->status == 'selesai') {
                                    $totalPS += 100;
                                }
                            }

                            $totalPS /= 24;
                        @endphp

                        {{-- ========================================= --}}
                        {{-- ROW SISWA --}}
                        {{-- ========================================= --}}
                        <tr class="border-b hover:bg-gray-50 transition">

                            {{-- NAMA --}}
                            <td class="py-4 px-2 font-medium">

                                {{ $progressSiswaID->first()->user->name ?? 'Nama tidak tersedia' }}

                            </td>

                            {{-- PROGRESS --}}
                            <td class="py-4 px-2 w-1/2">

                                <div class="flex items-center gap-3">

                                    {{-- BAR --}}
                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">

                                        <div
                                            class="bg-purple-600 h-3 rounded-full transition-all duration-500"
                                            style="width: {{ $totalPS }}%">
                                        </div>

                                    </div>

                                    {{-- PERCENT --}}
                                    <span class="text-sm font-medium min-w-[50px]">

                                        {{ number_format($totalPS, 0) }}%

                                    </span>

                                </div>

                            </td>

                            {{-- BUTTON DETAIL --}}
                            <td class="py-4 px-2 text-center">

                                <button
                                    onclick="toggleDetail('detail-{{ $userId }}')"
                                    class="bg-purple-100 hover:bg-purple-200 text-purple-700 px-3 py-2 rounded-lg transition"
                                >

                                    <svg
                                        id="icon-detail-{{ $userId }}"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 transition-transform duration-300 mx-auto"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 9l-7 7-7-7"
                                        />

                                    </svg>

                                </button>

                            </td>

                        </tr>

                        {{-- ========================================= --}}
                        {{-- DETAIL SISWA --}}
                        {{-- ========================================= --}}
                        <tr
                            id="detail-{{ $userId }}"
                            class="hidden bg-gray-50"
                        >

                            <td colspan="3" class="p-5">

                                <div class="space-y-5">

                                    {{-- ========================================= --}}
                                    {{-- LOOP MATERI --}}
                                    {{-- ========================================= --}}
                                    @foreach ($groupMateri as $judulMateri => $materiItems)

                                        @php
                                            $totalMateri = 0;

                                            foreach ($materiItems as $item) {

                                                if ($item->status == 'belum_dikerjakan') {
                                                    $totalMateri += 0;

                                                } elseif ($item->status == 'sedang_dikerjakan') {
                                                    $totalMateri += 50;

                                                } elseif ($item->status == 'selesai') {
                                                    $totalMateri += 100;
                                                }
                                            }

                                            $persenMateri = $totalMateri / $materiItems->count();

                                            // dd($totalMateri, $materiItems->count(), $persenMateri);
                                        @endphp

                                        {{-- CARD MATERI --}}
                                        <div class="bg-white border rounded-xl p-5 shadow-sm">

                                            {{-- HEADER --}}
                                            <button
                                                onclick="toggleDetail('materi-{{ $userId }}-{{ Str::slug($judulMateri) }}')"
                                                class="w-full flex justify-between items-center"
                                            >

                                                <div class="text-left w-full">

                                                    <div class="flex justify-between mb-3">

                                                        {{-- JUDUL --}}
                                                        <h3 class="font-semibold text-gray-700 text-lg">

                                                            {{ $judulMateri }}

                                                        </h3>

                                                        {{-- PERSEN --}}
                                                        <span class="text-sm text-purple-600 font-medium">

                                                            {{ number_format($persenMateri, 0) }}%

                                                        </span>

                                                    </div>

                                                    {{-- PROGRESS BAR --}}
                                                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">

                                                        <div
                                                            class="bg-purple-600 h-2 rounded-full transition-all duration-500"
                                                            style="width: {{ $persenMateri }}%"
                                                        >
                                                        </div>

                                                    </div>

                                                </div>

                                            </button>

                                            {{-- ========================================= --}}
                                            {{-- COLLAPSE TAHAPAN --}}
                                            {{-- ========================================= --}}
                                            <div
                                                id="materi-{{ $userId }}-{{ Str::slug($judulMateri) }}"
                                                class="hidden mt-6 space-y-6"
                                            >

                                                {{-- ========================================= --}}
                                                {{-- STIMULASI --}}
                                                {{-- ========================================= --}}
                                                <div class="border rounded-xl p-5 bg-gray-50 shadow-sm">

                                                    {{-- HEADER --}}
                                                    <div class="mb-5">

                                                        <h4 class="font-bold text-purple-700 text-lg">

                                                            {{ $materiItems[0]->tahapan->nama_tahapan ?? 'Nama Tahapan Tidak Tersedia' }}

                                                        </h4>

                                                        <p class="text-sm text-gray-500 mt-1">
                                                            Perhatikan media berikut dan tuliskan pendapat awalmu.
                                                        </p>

                                                    </div>

                                                    {{-- CONTENT --}}
                                                    <div class="bg-white rounded-2xl shadow-md p-6 space-y-6">

                                                        {{-- TITLE --}}
                                                        <div>

                                                            <h2 class="text-2xl font-bold text-gray-800">
                                                                Amati dan Pahami
                                                            </h2>

                                                            <p class="text-gray-600 mt-1">
                                                                Perhatikan media berikut dan tuliskan pendapat awalmu.
                                                            </p>

                                                        </div>

                                                        {{-- MEDIA --}}
                                                        <div class="w-full h-64 bg-gray-200 rounded-xl flex items-center justify-center">

                                                            <span class="text-gray-500">
                                                                Media Preview (Video / Gambar)
                                                            </span>

                                                        </div>

                                                        {{-- PERTANYAAN --}}
                                                        <div class="bg-purple-50 border-l-4 border-purple-600 p-4 rounded-lg">

                                                            <p class="font-semibold text-purple-700">
                                                                Pertanyaan Pemantik
                                                            </p>

                                                            <p class="text-gray-700 mt-1">
                                                                Mengapa fenomena ini bisa terjadi?
                                                            </p>

                                                        </div>

                                                        {{-- FORM --}}
                                                        <form method="POST" action="/simpan-feedback" class="space-y-5">

                                                            @csrf

                                                            {{-- JAWABAN --}}
                                                            <div>

                                                                <label class="block font-semibold mb-2">
                                                                    Jawaban Siswa
                                                                </label>

                                                                <textarea
                                                                    disabled
                                                                    rows="5"
                                                                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500"
                                                                    placeholder="Tuliskan pendapat awalmu di sini..."
                                                                >{{ $materiItems[0]->jawabanSiswa->jawaban[0] ?? '' }}</textarea>
                                                                {{-- @dd( $materiItems[0]->jawabanSiswa->id ) --}}

                                                            </div>

                                                            {{-- FEEDBACK --}}
                                                            {{-- @dd( $materiItems[0] ) --}}
                                                            <input type="hidden" name="user_id" value="{{ $materiItems[0]->user_id ?? '' }}">
                                                            <input type="hidden" name="materi_id" value="{{ $materiItems[0]->materi_id ?? '' }}">
                                                            <input type="hidden" name="tahapan_id" value="{{ $materiItems[0]->tahapan_id ?? '' }}">
                                                            <input type="hidden" name="jawaban_siswa_id" value={{ $materiItems[0]->jawabanSiswa->id ?? '' }}>
                                                            {{-- <input type="hidden" name="status" value="selesai"> --}}
                                                            <div class="bg-gray-100 p-4 rounded-xl">

                                                                <label class="block font-semibold mb-2">
                                                                    💬 Feedback Guru
                                                                </label>

                                                                <textarea
                                                                    rows="3"
                                                                    name="feedback"
                                                                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500"
                                                                    placeholder="Tuliskan feedback Anda di sini..."
                                                                >{{ $materiItems[0]->feedbackGuru->feedback ?? '' }}</textarea>

                                                            </div>

                                                            {{-- NILAI --}}
                                                            <div>

                                                                <label class="block font-semibold mb-2">
                                                                    Nilai
                                                                </label>

                                                                <input
                                                                    type="number"
                                                                    name="nilai"
                                                                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500"
                                                                    placeholder="Masukkan nilai"
                                                                    value="{{ $materiItems[0]->feedbackGuru->nilai ?? '' }}"
                                                                >

                                                            </div>

                                                            {{-- BUTTON --}}
                                                            <div class="flex justify-end">

                                                                <button
                                                                    type="submit"
                                                                    class="bg-purple-600 hover:bg-purple-700 transition text-white px-5 py-2 rounded-lg shadow"
                                                                >
                                                                    Simpan
                                                                </button>

                                                            </div>

                                                        </form>

                                                    </div>

                                                </div>

                                                {{-- ========================================= --}}
                                                {{-- IDENTIFIKASI MASALAH --}}
                                                {{-- ========================================= --}}
                                                <div class="border rounded-xl p-5 bg-gray-50 shadow-sm">

                                                    {{-- HEADER --}}
                                                    <div class="mb-5">

                                                        <h4 class="font-bold text-lg text-purple-700">
                                                            {{ $materiItems[1]->tahapan->nama_tahapan ?? 'Nama Tahapan Tidak Tersedia' }}
                                                        </h4>

                                                        <p class="text-sm text-gray-500 mt-1">
                                                            Pilih atau buat pertanyaan berdasarkan hasil pengamatanmu sebelumnya.
                                                        </p>

                                                    </div>

                                                    {{-- CONTENT --}}
                                                    <main class="flex-1 flex items-center justify-center">

                                                        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-md p-6 space-y-6">

                                                            {{-- TITLE --}}
                                                            <div>

                                                                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                                                    Identifikasi Masalah
                                                                </h2>

                                                                <p class="text-gray-600">
                                                                    Pilih atau buat pertanyaan berdasarkan hasil pengamatanmu sebelumnya.
                                                                </p>

                                                            </div>

                                                            {{-- FORM --}}
                                                            <form
                                                                method="POST"
                                                                action="/simpan-feedback"
                                                                class="space-y-6"
                                                            >

                                                                @csrf

                                                                @php
                                                                    $jawabanIdentifikasi = $materiItems[1]->jawabanSiswa->jawaban ?? [];
                                                                @endphp

                                                                {{-- PERTANYAAN PILIHAN --}}
                                                                <input type="hidden" name="user_id" value="{{ $materiItems[1]->user_id ?? '' }}">
                                                                <input type="hidden" name="materi_id" value="{{ $materiItems[1]->materi_id ?? '' }}">
                                                                <input type="hidden" name="tahapan_id" value="{{ $materiItems[1]->tahapan_id ?? '' }}">
                                                                <input type="hidden" name="jawaban_siswa_id" value={{ $materiItems[1]->jawabanSiswa->id ?? '' }}>
                                                                <div class="space-y-4">

                                                                    <label class="flex items-center gap-3 p-3 border rounded-lg hover:bg-gray-50 transition">

                                                                        <input
                                                                            disabled
                                                                            type="checkbox"
                                                                            name="jawaban[]"
                                                                            value="Bagaimana proses terjadi?"
                                                                            class="w-4 h-4 text-purple-600"
                                                                            {{ in_array('Bagaimana proses terjadi?', $jawabanIdentifikasi) ? 'checked' : '' }}
                                                                        >

                                                                        <span class="text-gray-700">
                                                                            Bagaimana proses terjadi?
                                                                        </span>

                                                                    </label>

                                                                    <label class="flex items-center gap-3 p-3 border rounded-lg hover:bg-gray-50 transition">

                                                                        <input
                                                                            disabled
                                                                            type="checkbox"
                                                                            name="jawaban[]"
                                                                            value="Apa fungsi bagian tersebut?"
                                                                            class="w-4 h-4 text-purple-600"
                                                                            {{ in_array('Apa fungsi bagian tersebut?', $jawabanIdentifikasi) ? 'checked' : '' }}
                                                                        >

                                                                        <span class="text-gray-700">
                                                                            Apa fungsi bagian tersebut?
                                                                        </span>

                                                                    </label>

                                                                    <label class="flex items-center gap-3 p-3 border rounded-lg hover:bg-gray-50 transition">

                                                                        <input
                                                                            disabled
                                                                            type="checkbox"
                                                                            name="jawaban[]"
                                                                            value="Mengapa hal ini bisa terjadi?"
                                                                            class="w-4 h-4 text-purple-600"
                                                                            {{ in_array('Mengapa hal ini bisa terjadi?', $jawabanIdentifikasi) ? 'checked' : '' }}
                                                                        >

                                                                        <span class="text-gray-700">
                                                                            Mengapa hal ini bisa terjadi?
                                                                        </span>

                                                                    </label>

                                                                </div>

                                                                {{-- INPUT TAMBAHAN --}}
                                                                <div>

                                                                    <label class="block font-semibold text-gray-700 mb-2">
                                                                        Jawaban Tambahan Siswa
                                                                    </label>

                                                                    <input
                                                                        disabled
                                                                        type="text"
                                                                        name="jawaban[]"
                                                                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Tulis pertanyaanmu di sini..."
                                                                        value="{{ collect($jawabanIdentifikasi)->last() }}"
                                                                    >

                                                                </div>

                                                                {{-- FEEDBACK --}}
                                                                <div class="bg-gray-100 p-4 rounded-xl">

                                                                    <label class="block font-semibold mb-2 text-gray-700">
                                                                        💬 Feedback Guru
                                                                    </label>

                                                                    <textarea
                                                                        rows="3"
                                                                        name="feedback"
                                                                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Tuliskan feedback Anda di sini..."
                                                                    >{{ $materiItems[1]->feedbackGuru->feedback ?? '' }}</textarea>

                                                                </div>

                                                                {{-- NILAI --}}
                                                                <div>

                                                                    <label class="block font-semibold text-gray-700 mb-2">
                                                                        Nilai
                                                                    </label>

                                                                    <input
                                                                        type="number"
                                                                        name="nilai"
                                                                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Masukkan nilai"
                                                                        value="{{ $materiItems[1]->feedbackGuru->nilai ?? '' }}"
                                                                    >

                                                                </div>

                                                                {{-- BUTTON --}}
                                                                <div class="flex justify-end">

                                                                    <button
                                                                        type="submit"
                                                                        class="bg-purple-600 hover:bg-purple-700 transition duration-300 text-white px-5 py-2 rounded-lg shadow"
                                                                    >
                                                                        Simpan
                                                                    </button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </main>

                                                </div>
                                                {{-- ========================================= --}}
                                                {{-- PENGUMPULAN DATA --}}
                                                {{-- ========================================= --}}
                                                <div class="border rounded-xl p-5 bg-gray-50 shadow-sm">

                                                    {{-- HEADER --}}
                                                    <div class="mb-5">

                                                        <h4 class="font-bold text-lg text-purple-700">
                                                            {{ $materiItems[2]->tahapan->nama_tahapan ?? 'Nama Tahapan Tidak Tersedia' }}
                                                        </h4>

                                                        <p class="text-sm text-gray-500 mt-1">
                                                            Pelajari materi berikut untuk menjawab pertanyaan yang telah dibuat siswa.
                                                        </p>

                                                    </div>

                                                    {{-- CONTENT --}}
                                                    <main class="flex-1 flex items-center justify-center">

                                                        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-md p-6 space-y-8">

                                                            {{-- TITLE --}}
                                                            <div>

                                                                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                                                    Pengumpulan Data
                                                                </h2>

                                                                <p class="text-gray-600">
                                                                    Pelajari materi berikut untuk menjawab pertanyaan yang telah kamu buat.
                                                                </p>

                                                            </div>

                                                            {{-- PDF VIEWER --}}
                                                            <div class="space-y-3">

                                                                <div class="flex items-center gap-2">
                                                                    <span class="text-xl">📄</span>
                                                                    <h3 class="font-semibold text-gray-700">
                                                                        Modul Pembelajaran
                                                                    </h3>
                                                                </div>

                                                                <div class="border rounded-xl overflow-hidden shadow-sm">
                                                                    <iframe
                                                                        src="/storage/materi.pdf"
                                                                        class="w-full h-80"
                                                                    ></iframe>
                                                                </div>

                                                            </div>

                                                            {{-- VIDEO PEMBELAJARAN --}}
                                                            <div class="space-y-3">

                                                                <div class="flex items-center gap-2">
                                                                    <span class="text-xl">🎥</span>
                                                                    <h3 class="font-semibold text-gray-700">
                                                                        Video Penjelasan
                                                                    </h3>
                                                                </div>

                                                                <div class="w-full h-72 bg-gray-200 flex items-center justify-center rounded-xl border">

                                                                    <div class="text-center text-gray-500">
                                                                        <p class="text-lg font-medium">
                                                                            Video Player
                                                                        </p>

                                                                        <p class="text-sm">
                                                                            Tempat video pembelajaran ditampilkan
                                                                        </p>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            {{-- REFERENSI TAMBAHAN --}}
                                                            <div class="space-y-3">

                                                                <div class="flex items-center gap-2">
                                                                    <span class="text-xl">📚</span>
                                                                    <h3 class="font-semibold text-gray-700">
                                                                        Referensi Tambahan
                                                                    </h3>
                                                                </div>

                                                                <ul class="list-disc ml-6 space-y-2 text-blue-600">

                                                                    <li>
                                                                        <a href="#" class="hover:underline">
                                                                            Artikel 1
                                                                        </a>
                                                                    </li>

                                                                    <li>
                                                                        <a href="#" class="hover:underline">
                                                                            Artikel 2
                                                                        </a>
                                                                    </li>

                                                                </ul>

                                                            </div>

                                                            {{-- FORM --}}
                                                            <form
                                                                method="POST"
                                                                action="/simpan-feedback"
                                                                class="space-y-6"
                                                            >

                                                                @csrf

                                                                {{-- CATATAN SISWA --}}
                                                                <input type="hidden" name="user_id" value="{{ $materiItems[2]->user_id ?? '' }}">
                                                                <input type="hidden" name="materi_id" value="{{ $materiItems[2]->materi_id ?? '' }}">
                                                                <input type="hidden" name="tahapan_id" value="{{ $materiItems[2]->tahapan_id ?? '' }}">
                                                                <input type="hidden" name="jawaban_siswa_id" value={{ $materiItems[2]->jawabanSiswa->id ?? '' }}>
                                                                <div>

                                                                    <label class="block font-semibold text-gray-700 mb-2">
                                                                        Catatan Penting Siswa
                                                                    </label>

                                                                    <textarea
                                                                        disabled
                                                                        name="jawaban"
                                                                        rows="5"
                                                                        class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Tuliskan poin penting yang ditemukan siswa..."
                                                                    >{{ $materiItems[2]->jawabanSiswa->jawaban[0] ?? '' }}</textarea>

                                                                </div>

                                                                {{-- FEEDBACK GURU --}}
                                                                <div class="bg-gray-100 p-5 rounded-xl">

                                                                    <label class="block font-semibold text-gray-700 mb-3">
                                                                        💬 Feedback Guru
                                                                    </label>

                                                                    <textarea
                                                                        rows="4"
                                                                        name="feedback"
                                                                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Tuliskan feedback Anda di sini..."
                                                                    >{{ $materiItems[2]->feedbackGuru->feedback ?? '' }}</textarea>

                                                                </div>

                                                                {{-- NILAI --}}
                                                                <div>

                                                                    <label class="block font-semibold text-gray-700 mb-2">
                                                                        Nilai
                                                                    </label>

                                                                    <input
                                                                        type="number"
                                                                        name="nilai"
                                                                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Masukkan nilai"
                                                                        value="{{ $materiItems[2]->feedbackGuru->nilai ?? '' }}"
                                                                    >

                                                                </div>

                                                                {{-- BUTTON --}}
                                                                <div class="flex justify-end">

                                                                    <button
                                                                        type="submit"
                                                                        class="bg-purple-600 hover:bg-purple-700 transition duration-300 text-white px-6 py-3 rounded-xl shadow-md"
                                                                    >
                                                                        Simpan
                                                                    </button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </main>

                                                </div>
                                                {{-- ========================================= --}}
                                                {{-- PENGOLAHAN DATA --}}
                                                {{-- ========================================= --}}
                                                <div class="border rounded-xl p-5 bg-gray-50 shadow-sm">

                                                    {{-- HEADER --}}
                                                    <div class="mb-5">

                                                        <h4 class="font-bold text-lg text-purple-700">
                                                            {{ $materiItems[3]->tahapan->nama_tahapan ?? 'Nama Tahapan Tidak Tersedia' }}
                                                        </h4>

                                                        <p class="text-sm text-gray-500 mt-1">
                                                            Gunakan informasi yang telah dipelajari siswa untuk menjawab pertanyaan berikut.
                                                        </p>

                                                    </div>

                                                    {{-- CONTENT --}}
                                                    <main class="flex-1 flex items-center justify-center">

                                                        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-md p-6 space-y-8">

                                                            {{-- TITLE --}}
                                                            <div>

                                                                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                                                    Pengolahan Data
                                                                </h2>

                                                                <p class="text-gray-600">
                                                                    Gunakan informasi yang telah kamu pelajari untuk menjawab pertanyaan berikut.
                                                                </p>

                                                            </div>

                                                            {{-- FORM --}}
                                                            <form
                                                                method="POST"
                                                                action="/simpan-feedback"
                                                                class="space-y-8"
                                                            >

                                                                @csrf
                                                               <input type="hidden" name="user_id" value="{{ $materiItems[3]->user_id ?? '' }}">
                                                                <input type="hidden" name="materi_id" value="{{ $materiItems[3]->materi_id ?? '' }}">
                                                                <input type="hidden" name="tahapan_id" value="{{ $materiItems[3]->tahapan_id ?? '' }}">
                                                                <input type="hidden" name="jawaban_siswa_id" value={{ $materiItems[3]->jawabanSiswa->id ?? '' }}>

                                                                {{-- SOAL 1 --}}
                                                                <div class="space-y-3">

                                                                    <label class="block font-semibold text-gray-700">
                                                                        1. Jelaskan proses yang terjadi berdasarkan materi yang telah kamu pelajari:
                                                                    </label>

                                                                    <textarea
                                                                        disabled
                                                                        name="jawaban[]"
                                                                        rows="5"
                                                                        class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Tuliskan jawaban siswa..."
                                                                    >{{ $materiItems[3]->jawabanSiswa->jawaban[0] ?? '' }}</textarea>

                                                                </div>

                                                                {{-- SOAL 2 --}}
                                                                <div class="space-y-4">

                                                                    <label class="block font-semibold text-gray-700">
                                                                        2. Isi tabel berikut:
                                                                    </label>

                                                                    <div class="overflow-x-auto border rounded-xl">

                                                                        <table class="w-full text-left border-collapse">

                                                                            <thead class="bg-gray-100">

                                                                                <tr>

                                                                                    <th class="p-3 border font-semibold text-gray-700">
                                                                                        Komponen
                                                                                    </th>

                                                                                    <th class="p-3 border font-semibold text-gray-700">
                                                                                        Fungsi
                                                                                    </th>

                                                                                </tr>

                                                                            </thead>

                                                                            <tbody>

                                                                                <tr class="hover:bg-gray-50">

                                                                                    <td class="p-3 border font-medium text-gray-700">
                                                                                        Bagian 1
                                                                                    </td>

                                                                                    <td class="p-3 border">

                                                                                        <input
                                                                                            disabled
                                                                                            type="text"
                                                                                            name="jawaban[]"
                                                                                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-purple-500"
                                                                                            value="{{ $materiItems[3]->jawabanSiswa->jawaban[1] ?? '' }}"
                                                                                        >

                                                                                    </td>

                                                                                </tr>

                                                                                <tr class="hover:bg-gray-50">

                                                                                    <td class="p-3 border font-medium text-gray-700">
                                                                                        Bagian 2
                                                                                    </td>

                                                                                    <td class="p-3 border">

                                                                                        <input
                                                                                            disabled
                                                                                            type="text"
                                                                                            name="jawaban[]"
                                                                                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-purple-500"
                                                                                            value="{{ $materiItems[3]->jawabanSiswa->jawaban[2] ?? '' }}"
                                                                                        >

                                                                                    </td>

                                                                                </tr>

                                                                            </tbody>

                                                                        </table>

                                                                    </div>

                                                                </div>

                                                                {{-- FEEDBACK GURU --}}
                                                                <div class="bg-gray-100 p-5 rounded-xl">

                                                                    <label class="block font-semibold text-gray-700 mb-3">
                                                                        💬 Feedback Guru
                                                                    </label>

                                                                    <textarea
                                                                        name="feedback"
                                                                        rows="4"
                                                                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Tuliskan feedback Anda di sini..."
                                                                    >{{ $materiItems[3]->feedbackGuru->feedback ?? '' }}</textarea>

                                                                </div>

                                                                {{-- NILAI --}}
                                                                <div>

                                                                    <label class="block font-semibold text-gray-700 mb-2">
                                                                        Nilai
                                                                    </label>

                                                                    <input
                                                                        name="nilai"
                                                                        type="number"
                                                                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Masukkan nilai"
                                                                        value="{{ $materiItems[3]->feedbackGuru->nilai ?? '' }}"
                                                                    >

                                                                </div>

                                                                {{-- BUTTON --}}
                                                                <div class="flex justify-end">

                                                                    <button
                                                                        type="submit"
                                                                        class="bg-purple-600 hover:bg-purple-700 transition duration-300 text-white px-6 py-3 rounded-xl shadow-md"
                                                                    >
                                                                        Simpan
                                                                    </button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </main>

                                                </div>
                                                {{-- ========================================= --}}
                                                {{-- PEMBUKTIAN / VERIFIKASI --}}
                                                {{-- ========================================= --}}
                                                <div class="border rounded-xl p-5 bg-gray-50 shadow-sm">

                                                    {{-- HEADER --}}
                                                    <div class="mb-5">

                                                        <h4 class="font-bold text-lg text-purple-700">
                                                            {{ $materiItems[4]->tahapan->nama_tahapan ?? 'Nama Tahapan Tidak Tersedia' }}
                                                        </h4>

                                                        <p class="text-sm text-gray-500 mt-1">
                                                            Tahap pembuktian untuk mengukur pemahaman siswa berdasarkan materi yang telah dipelajari.
                                                        </p>

                                                    </div>

                                                    {{-- CONTENT --}}
                                                    <main class="flex-1 flex items-center justify-center">

                                                        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-md p-6 space-y-8">

                                                            {{-- TITLE --}}
                                                            <div>

                                                                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                                                    Pembuktian
                                                                </h2>

                                                                <p class="text-gray-600">
                                                                    Pilih jawaban yang paling tepat berdasarkan pemahamanmu.
                                                                </p>

                                                            </div>

                                                            {{-- FORM --}}
                                                            <form
                                                                method="POST"
                                                                action="/simpan-feedback"
                                                                id="form-verifikasi"
                                                                class="space-y-8"
                                                            >

                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ $materiItems[4]->user_id ?? '' }}">
                                                                <input type="hidden" name="materi_id" value="{{ $materiItems[4]->materi_id ?? '' }}">
                                                                <input type="hidden" name="tahapan_id" value="{{ $materiItems[4]->tahapan_id ?? '' }}">
                                                                <input type="hidden" name="jawaban_siswa_id" value={{ $materiItems[4]->jawabanSiswa->id ?? '' }}>
                                                                @php
                                                                    $dataJawaban = $materiItems[4]->jawabanSiswa->jawaban ?? [];
                                                                    $isAnswered = !empty($dataJawaban);
                                                                    // dd($materiItems[4]->feedbackGuru->feedback ?? '');
                                                                @endphp

                                                                {{-- ========================================= --}}
                                                                {{-- SOAL 1 --}}
                                                                {{-- ========================================= --}}
                                                                <div class="space-y-4">

                                                                    <h3 class="font-semibold text-gray-800">
                                                                        1. Cahaya pertama kali masuk ke mata melalui:
                                                                    </h3>

                                                                    <div class="space-y-3">

                                                                        <label class="flex items-center gap-3 border rounded-lg p-3 hover:bg-gray-50 transition">

                                                                            <input
                                                                                type="radio"
                                                                                name="q1"
                                                                                value="a"
                                                                                class="text-purple-600"
                                                                                {{ ($dataJawaban['q1'] ?? '') == 'a' ? 'checked' : '' }}
                                                                                {{ $isAnswered ? 'disabled' : '' }}
                                                                            >

                                                                            <span>Kornea</span>

                                                                        </label>

                                                                        <label class="flex items-center gap-3 border rounded-lg p-3 hover:bg-gray-50 transition">

                                                                            <input
                                                                                type="radio"
                                                                                name="q1"
                                                                                value="b"
                                                                                class="text-purple-600"
                                                                                {{ ($dataJawaban['q1'] ?? '') == 'b' ? 'checked' : '' }}
                                                                                {{ $isAnswered ? 'disabled' : '' }}
                                                                            >

                                                                            <span>Retina</span>

                                                                        </label>

                                                                        <label class="flex items-center gap-3 border rounded-lg p-3 hover:bg-gray-50 transition">

                                                                            <input
                                                                                type="radio"
                                                                                name="q1"
                                                                                value="c"
                                                                                class="text-purple-600"
                                                                                {{ ($dataJawaban['q1'] ?? '') == 'c' ? 'checked' : '' }}
                                                                                {{ $isAnswered ? 'disabled' : '' }}
                                                                            >

                                                                            <span>Lensa</span>

                                                                        </label>

                                                                    </div>

                                                                </div>

                                                                {{-- ========================================= --}}
                                                                {{-- SOAL 2 --}}
                                                                {{-- ========================================= --}}
                                                                <div class="space-y-4">

                                                                    <h3 class="font-semibold text-gray-800">
                                                                        2. Fungsi retina adalah:
                                                                    </h3>

                                                                    <div class="space-y-3">

                                                                        <label class="flex items-center gap-3 border rounded-lg p-3 hover:bg-gray-50 transition">

                                                                            <input
                                                                                type="radio"
                                                                                name="q2"
                                                                                value="a"
                                                                                class="text-purple-600"
                                                                                {{ ($dataJawaban['q2'] ?? '') == 'a' ? 'checked' : '' }}
                                                                                {{ $isAnswered ? 'disabled' : '' }}
                                                                            >

                                                                            <span>Menangkap cahaya</span>

                                                                        </label>

                                                                        <label class="flex items-center gap-3 border rounded-lg p-3 hover:bg-gray-50 transition">

                                                                            <input
                                                                                type="radio"
                                                                                name="q2"
                                                                                value="b"
                                                                                class="text-purple-600"
                                                                                {{ ($dataJawaban['q2'] ?? '') == 'b' ? 'checked' : '' }}
                                                                                {{ $isAnswered ? 'disabled' : '' }}
                                                                            >

                                                                            <span>Memfokuskan cahaya</span>

                                                                        </label>

                                                                        <label class="flex items-center gap-3 border rounded-lg p-3 hover:bg-gray-50 transition">

                                                                            <input
                                                                                type="radio"
                                                                                name="q2"
                                                                                value="c"
                                                                                class="text-purple-600"
                                                                                {{ ($dataJawaban['q2'] ?? '') == 'c' ? 'checked' : '' }}
                                                                                {{ $isAnswered ? 'disabled' : '' }}
                                                                            >

                                                                            <span>Melindungi mata</span>

                                                                        </label>

                                                                    </div>

                                                                </div>

                                                                {{-- ========================================= --}}
                                                                {{-- FEEDBACK GURU --}}
                                                                {{-- ========================================= --}}
                                                                <div class="bg-gray-100 p-5 rounded-xl">

                                                                    <label class="block font-semibold text-gray-700 mb-3">
                                                                        💬 Feedback Guru
                                                                    </label>
                                                                    <p class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-500">{{ $materiItems[4]->feedbackGuru->feedback ?? '' }}</p>

                                                                    <textarea
                                                                        rows="4"
                                                                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Tuliskan feedback Anda di sini..."
                                                                        name="feedback"
                                                                        hidden
                                                                    >{{ $materiItems[4]->feedbackGuru->feedback ?? '' }}</textarea>
                                                                    {{-- @dd($materiItems[4]->feedbackGuru->feedback ?? '') --}}

                                                                </div>

                                                                {{-- ========================================= --}}
                                                                {{-- NILAI --}}
                                                                {{-- ========================================= --}}
                                                                <div>

                                                                    <label class="block font-semibold text-gray-700 mb-2">
                                                                        Nilai
                                                                    </label>
                                                                    <p class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-500">{{ $materiItems[4]->feedbackGuru->nilai ?? '' }}</p>

                                                                    <input
                                                                    hidden
                                                                        type="number"
                                                                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Masukkan nilai"
                                                                        name="nilai"
                                                                        value="{{ $materiItems[4]->feedbackGuru->nilai ?? '' }}"
                                                                    >

                                                                </div>

                                                                {{-- ========================================= --}}
                                                                {{-- BUTTON --}}
                                                                {{-- ========================================= --}}
                                                                <div class="flex justify-end">

                                                                    <button
                                                                    
                                                                        type="submit"
                                                                        class="bg-purple-600 hover:bg-purple-700 transition duration-300 text-white px-6 py-3 rounded-xl shadow-md"
                                                                    >
                                                                        Konfirmasi Selesai
                                                                    </button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </main>

                                                </div>
                                                {{-- ========================================= --}}
                                                {{-- MENARIK KESIMPULAN / GENERALISASI --}}
                                                {{-- ========================================= --}}
                                                <div class="border rounded-xl p-5 bg-gray-50 shadow-sm">

                                                    {{-- HEADER --}}
                                                    <div class="mb-5">

                                                        <h4 class="font-bold text-lg text-purple-700">
                                                            {{ $materiItems[5]->tahapan->nama_tahapan ?? 'Nama Tahapan Tidak Tersedia' }}
                                                        </h4>

                                                        <p class="text-sm text-gray-500 mt-1">
                                                            Tahap generalisasi untuk menyimpulkan hasil pembelajaran yang telah dilakukan siswa.
                                                        </p>

                                                    </div>

                                                    {{-- CONTENT --}}
                                                    <main class="flex-1 flex items-center justify-center">

                                                        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-md p-6 space-y-8">

                                                            {{-- TITLE --}}
                                                            <div>

                                                                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                                                    Menarik Kesimpulan
                                                                </h2>

                                                                <p class="text-gray-600">
                                                                    Tuliskan kesimpulan berdasarkan seluruh proses pembelajaran yang telah kamu lakukan.
                                                                </p>

                                                            </div>

                                                            {{-- FORM --}}
                                                            <form
                                                                method="POST"
                                                                action="/simpan-feedback"
                                                                class="space-y-8"
                                                            >

                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ $materiItems[5]->user_id ?? '' }}">
                                                                <input type="hidden" name="materi_id" value="{{ $materiItems[5]->materi_id ?? '' }}">
                                                                <input type="hidden" name="tahapan_id" value="{{ $materiItems[5]->tahapan_id ?? '' }}">
                                                                <input type="hidden" name="jawaban_siswa_id" value={{ $materiItems[5]->jawabanSiswa->id ?? '' }}>
                                                                {{-- KESIMPULAN SISWA --}}
                                                                <div class="space-y-3">

                                                                    <label class="block font-semibold text-gray-700">
                                                                        Kesimpulan Siswa
                                                                    </label>

                                                                    <textarea
                                                                        name="jawaban"
                                                                        rows="6"
                                                                        class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Tuliskan kesimpulan siswa di sini..."
                                                                    >{{ $materiItems[5]->jawabanSiswa->jawaban[0] ?? '' }}</textarea>

                                                                </div>

                                                                {{-- KESIMPULAN IDEAL --}}
                                                                <div class="bg-purple-50 border-l-4 border-purple-600 p-5 rounded-xl">

                                                                    <h3 class="font-semibold text-purple-700 mb-2">
                                                                        📘 Kesimpulan Ideal
                                                                    </h3>

                                                                    <p class="text-gray-700 leading-relaxed">
                                                                        Cahaya masuk melalui kornea, diteruskan ke lensa,
                                                                        kemudian difokuskan ke retina yang berfungsi menangkap
                                                                        cahaya dan mengubahnya menjadi impuls saraf.
                                                                    </p>

                                                                </div>

                                                                {{-- FEEDBACK GURU --}}
                                                                <div class="bg-gray-100 p-5 rounded-xl">

                                                                    <label class="block font-semibold text-gray-700 mb-3">
                                                                        💬 Feedback Guru
                                                                    </label>

                                                                    <textarea
                                                                        rows="4"
                                                                        name="feedback"
                                                                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Tuliskan feedback Anda di sini..."
                                                                    >{{ $materiItems[5]->feedbackGuru->feedback ?? '' }}</textarea>

                                                                </div>

                                                                {{-- NILAI --}}
                                                                <div>

                                                                    <label class="block font-semibold text-gray-700 mb-2">
                                                                        Nilai
                                                                    </label>

                                                                    <input
                                                                        type="number"
                                                                        name="nilai"
                                                                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-500"
                                                                        placeholder="Masukkan nilai"
                                                                        value="{{ $materiItems[5]->feedbackGuru->nilai ?? '' }}"
                                                                    >

                                                                </div>

                                                                {{-- BUTTON --}}
                                                                <div class="flex justify-end">

                                                                    <button
                                                                        type="submit"
                                                                        class="bg-purple-600 hover:bg-purple-700 transition duration-300 text-white px-6 py-3 rounded-xl shadow-md"
                                                                    >
                                                                        Simpan
                                                                    </button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </main>

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- EMPTY STATE --}}
                        <tr>

                            <td colspan="3" class="text-center py-10 text-gray-500">

                                Tidak ada progress siswa.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection