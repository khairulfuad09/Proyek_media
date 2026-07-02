@extends('template.main')

@section('container')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-white">Penilaian & Tanggapan</h1>
        <p class="text-purple-200">Materi: Sistem Koordinasi - Tahap Stimulasi</p>
    </div>

    <!-- FILTER -->
    <div class="bg-white p-4 rounded-xl shadow mb-6 flex gap-4">

        <select class="border p-2 rounded w-1/3">
            <option>Sistem Koordinasi</option>
        </select>

        <select class="border p-2 rounded w-1/3">
            <option>Stimulasi</option>
            <option>Problem Statement</option>
            <option>Data Collection</option>
        </select>

        <button class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
            Tampilkan
        </button>

    </div>

    <!-- LIST JAWABAN SISWA -->
    <div class="space-y-6">

        <!-- CARD SISWA -->
        <div class="bg-white p-6 rounded-xl shadow">

            <div class="mb-4">
                <h2 class="font-bold text-lg">Ahmad</h2>
            </div>

            <!-- Jawaban -->
            <div class="mb-4">
                <p class="text-gray-600 font-semibold">Jawaban Siswa:</p>
                <div class="bg-gray-100 p-3 rounded mt-1">
                    Mata berfungsi untuk menangkap cahaya dan meneruskannya ke otak...
                </div>
            </div>

            <!-- Feedback -->
            <form method="POST">
                @csrf

                <div class="mb-3">
                    <label class="block font-semibold text-gray-600">Tanggapan Guru</label>
                    <textarea name="feedback" class="w-full border p-2 rounded" placeholder="Tulis tanggapan..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="block font-semibold text-gray-600">Nilai</label>
                    <input type="number" name="nilai" class="w-full border p-2 rounded" placeholder="0 - 100">
                </div>

                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Simpan
                </button>
            </form>

        </div>

    </div>

</div>

@endsection