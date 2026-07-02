@extends('template.main')
@section('container')
    <div class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-purple-900 text-white p-4 shadow">
        <h1 class="text-xl font-bold">Tahap 4: Data Processing</h1>
    </header>

    <!-- Content -->
    <main class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg p-6 space-y-6">

            <!-- Title -->
            <div>
                <h2 class="text-2xl font-bold mb-2">Pengolahan Data</h2>
                <p class="text-gray-600">Gunakan informasi yang telah kamu pelajari untuk menjawab pertanyaan berikut.</p>
            </div>

            <!-- Soal Analisis -->
            <form method="POST" action="/simpan-jawaban">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="tahapan_id" value="4">
                    <input type="hidden" name="materi_id" value="3">
                    <input type="hidden" name="next_materi" value="hormon-manusia">
                    <input type="hidden" name="next_tahapan" value="verifikasi">
                <!-- Soal 1 -->
                <div class="space-y-2">
                    <label class="font-semibold">1. Jelaskan proses yang terjadi berdasarkan materi yang telah kamu pelajari:</label>
                    <textarea 
                        name="jawaban[]" 
                        rows="4" 
                        class="w-full border rounded p-3"
                        placeholder="Tuliskan jawabanmu..."
                        >{{ $jawaban->jawaban[0] ?? '' }}</textarea>
                </div>

                <!-- Soal 2 (Tabel sederhana) -->
                <div class="space-y-2 mt-4">
                    <label class="font-semibold">2. Isi tabel berikut:</label>

                    <table class="w-full border text-left">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-2 border">Komponen</th>
                                <th class="p-2 border">Fungsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-2 border">Bagian 1</td>
                                <td class="p-2 border">
                                    <input type="text" name="jawaban[]" class="w-full p-2 border rounded" value="{{ $jawaban->jawaban[1] ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2 border">Bagian 2</td>
                                <td class="p-2 border">
                                    <input type="text" name="jawaban[]" class="w-full p-2 border rounded" value="{{ $jawaban->jawaban[2] ?? '' }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Navigation -->
                <div class="flex justify-between mt-6">
                    <a href="/data-collection" class="px-4 py-2 bg-gray-300 rounded">
                        Kembali
                    </a>

                    <button 
                        type="submit"
                        class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700">
                        Simpan & Lanjut
                    </button>
                </div>
            </form>

            <!-- Feedback Guru -->
            <div class="bg-gray-100 p-4 rounded">
                <p class="font-semibold">💬 Feedback Guru:</p>
                <p class="text-gray-600">{{ $jawaban->feedbackGuru->feedback ?? 'Belum ada feedback' }}</p>
            </div>
            <div class="bg-gray-100 p-4 rounded">
                <p class="font-semibold">💬 Status</p>
                <p class="text-gray-600">
                    @if ($jawaban?->feedbackGuru?->nilai != null)
                        @if ($jawaban->feedbackGuru->nilai == 100)
                            sudah direview guru dan disetujui

                        @elseif ($jawaban->feedbackGuru->nilai > 0 && $jawaban->feedbackGuru->nilai < 100)
                            sudah direview guru dan perhatikan feedback guru

                        @else
                            belum direview guru
                        @endif

                    @else
                        'belum dikerjakan'
                    @endif
                </p>
            </div>

        </div>
    </main>

</div>
@endsection