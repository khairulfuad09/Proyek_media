@extends('template.main')
@section('container')
<div class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-purple-900 text-white p-4 shadow">
        <h1 class="text-xl font-bold">Tahap 6: Generalization</h1>
    </header>

    <!-- Content -->
    <main class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-6 space-y-6">

            <!-- Title -->
            <div>
                <h2 class="text-2xl font-bold mb-2">Menarik Kesimpulan</h2>
                <p class="text-gray-600">Tuliskan kesimpulanmu mengenai bagaimana sistem koordinasi manusia bekerja dalam menerima rangsangan dan menghasilkan respons!</p>
            </div>

            <!-- Form Kesimpulan -->
            <form method="POST" action="/simpan-jawaban">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="tahapan_id" value="6">
                <input type="hidden" name="materi_id" value="1">
                <input type="hidden" name="next_materi" value="alat-indra-manusia">
                <input type="hidden" name="next_tahapan" value="stimulasi">

                <div class="space-y-2">
                    <label class="font-semibold">Kesimpulan Kamu:</label>
                    <textarea 
                        name="jawaban" 
                        rows="5" 
                        class="w-full border rounded p-3"
                        placeholder="Tuliskan kesimpulanmu di sini...">{{ $jawaban->jawaban[0] ?? ''}}</textarea>
                </div>

                <!-- Navigation -->
                <div class="flex justify-between mt-6">
                    <a href="/verification" class="px-4 py-2 bg-gray-300 rounded">
                        Kembali
                    </a>

                    <button 
                        type="submit"
                        class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700">
                        Selesai
                    </button>
                </div>
            </form>

            <!-- Jawaban Ideal -->
            <div class="bg-purple-50 border-l-4 border-purple-600 p-4 rounded">
                <p class="font-semibold">📘Contoh Kesimpulan Ideal:</p>
                <p class="text-gray-700">
                    Sistem koordinasi manusia berfungsi mengatur dan mengendalikan seluruh aktivitas tubuh agar dapat bekerja dengan baik. Sistem ini melibatkan alat indra sebagai penerima rangsangan, sistem saraf sebagai penghantar dan pengolah informasi, serta otak sebagai pusat pengendali. Setelah informasi diproses, tubuh akan menghasilkan respons yang sesuai terhadap rangsangan yang diterima.
                </p>
            </div>

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