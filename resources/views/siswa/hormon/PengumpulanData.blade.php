@extends('template.main')
@section('container')
    <div class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-purple-900 text-white p-4 shadow">
        <h1 class="text-xl font-bold">Tahap 3: Data Collection</h1>
    </header>

    <!-- Content -->
    <main class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg p-6 space-y-6">

            <!-- Title -->
            <div>
                <h2 class="text-2xl font-bold mb-2">Pengumpulan Data</h2>
                <p class="text-gray-600">Pelajari materi berikut untuk menjawab pertanyaan yang telah kamu buat.</p>
            </div>

            <!-- PDF Viewer -->
            <div class="space-y-2">
                <h3 class="font-semibold">📄 Modul Pembelajaran</h3>
                <iframe src="/storage/materi.pdf" class="w-full h-72 rounded border"></iframe>
            </div>

            <!-- Video Pembelajaran -->
            <div class="space-y-2">
                <h3 class="font-semibold">🎥 Video Penjelasan</h3>
                <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded">
                    Video Player
                </div>
            </div>

            <!-- Referensi Tambahan -->
            <div class="space-y-2">
                <h3 class="font-semibold">📚 Referensi Tambahan</h3>
                <ul class="list-disc ml-6 text-blue-600">
                    <li><a href="#">Artikel 1</a></li>
                    <li><a href="#">Artikel 2</a></li>
                </ul>
            </div>

            <!-- Catatan Siswa -->
            <form method="POST" action="/simpan-jawaban">
                @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="tahapan_id" value="3">
                    <input type="hidden" name="materi_id" value="3">
                    <input type="hidden" name="next_materi" value="hormon-manusia">
                    <input type="hidden" name="next_tahapan" value="pengolahan-data">
                <div class="space-y-2">
                    <label class="font-semibold">Catatan Penting:</label>
                    <textarea 
                        name="jawaban" 
                        rows="4"
                        class="w-full border rounded p-3"
                        placeholder="Tuliskan poin penting yang kamu temukan...">{{ $jawaban->jawaban[0] ?? '' }}</textarea>
                </div>

                <!-- Navigation -->
                <div class="flex justify-between mt-6">
                    <a href="/problem-statement" class="px-4 py-2 bg-gray-300 rounded">
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