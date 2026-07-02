
<div class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-purple-900 text-white p-4 shadow">
        <h1 class="text-xl font-bold">Tahap 1: Stimulation</h1>
    </header>

    <!-- Content -->
    <main class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-6 space-y-6">

            <!-- Title -->
            <div>
                <h2 class="text-2xl font-bold mb-2">Amati dan Pahami</h2>
                <p class="text-gray-600">Perhatikan media berikut dan tuliskan pendapat awalmu.</p>
            </div>

            <!-- Media (Gambar / Video) -->
            <div class="w-full h-64 bg-gray-200 rounded flex items-center justify-center">
                <!-- Ganti dengan video/gambar -->
                <span class="text-gray-500">Media Preview (Video / Gambar)</span>
            </div>

            <!-- Pertanyaan Pemantik -->
            <div class="bg-purple-50 border-l-4 border-purple-600 p-4 rounded">
                <p class="font-semibold">Pertanyaan Pemantik:</p>
                <p>Mengapa fenomena ini bisa terjadi?</p>
            </div>

            <!-- Jawaban Siswa -->
            <form method="POST" action="/simpan-jawaban">
                @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="tahapan_id" value="1">
                    <input type="hidden" name="materi_id" value="3">
                    <input type="hidden" name="next_materi" value="hormon-manusia">
                    <input type="hidden" name="next_tahapan" value="identifikasi-masalah">
                <div class="space-y-2">
                    <label class="font-semibold">Pendapat Awal Kamu:</label>
                    <textarea 
                        name="jawaban" 
                        rows="5" 
                        class="w-full border rounded p-3 focus:ring-2 focus:ring-purple-500"
                        placeholder="Tuliskan pendapat awalmu di sini..."
                    >{{ $jawaban->jawaban[0] ?? '' }}</textarea>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end mt-4">
                    <button 
                        type="submit"
                        class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">
                        Simpan & Lanjut
                    </button>
                </div>
            </form>

            <!-- Feedback Guru (opsional) -->
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
