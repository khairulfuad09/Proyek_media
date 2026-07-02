
<div class="min-h-screen flex flex-col">
    {{-- @dump($jawaban) --}}

    <!-- Header -->
    <header class="bg-purple-900 text-white p-4 shadow">
        <h1 class="text-xl font-bold">Tahap 2: Problem Statement</h1>
    </header>

    <!-- Content -->
    <main class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-6 space-y-6">

            <!-- Title -->
            <div>
                <h2 class="text-2xl font-bold mb-2">Identifikasi Masalah</h2>
                <p class="text-gray-600">Pilih atau buat pertanyaan berdasarkan hasil pengamatanmu sebelumnya.</p>
            </div>

            <!-- Pertanyaan Pilihan -->
            <form method="POST" action="/simpan-jawaban">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="tahapan_id" value="2">
                <input type="hidden" name="materi_id" value="1">    
                <div class="space-y-3">
                    <label class="block">
                        <input type="checkbox" name="jawaban[]" value="Apa yang dimaksud neuron?" {{ in_array('Apa yang dimaksud neuron?', $jawaban->jawaban ?? []) ? 'checked' : '' }}>
                        Apa yang dimaksud dengan neuron?
                    </label>

                    <label class="block">
                        <input type="checkbox" name="jawaban[]" value="Apa saja bagian utama dari neuron?" {{ in_array('Apa saja bagian utama dari neuron?', $jawaban->jawaban ?? []) ? 'checked' : '' }}  >
                        Apa saja bagian utama dari neuron?
                    </label>

                    <label class="block">
                        <input type="checkbox" name="jawaban[]" value="Apa saja jenis otot lurik dan bagaimana cara kerjanya?" {{ in_array('Apa saja jenis otot lurik dan bagaimana cara kerjanya?', $jawaban->jawaban ?? []) ? 'checked' : '' }}>
                        Apa saja jenis otot lurik dan bagaimana cara kerjanya?
                    </label>

                    <label class="block">
                        <input type="checkbox" name="jawaban[]" value="Mengapa tulang rawan penting dalam pertumbuhan manusia?" {{ in_array('Mengapa tulang rawan penting dalam pertumbuhan manusia?', $jawaban->jawaban ?? []) ? 'checked' : '' }}>
                        Mengapa tulang rawan penting dalam pertumbuhan manusia?
                    </label>

                    <label class="block">
                        <input type="checkbox" name="jawaban[]" value="Apa fungsi masing masing bagian dari neuron?" {{ in_array('Apa fungsi masing masing bagian dari neuron?', $jawaban->jawaban ?? []) ? 'checked' : '' }}>
                        Apa fungsi masing masing bagian dari neuron?
                    </label>

                    <label class="block">
                        <input type="checkbox" name="jawaban[]" value="Bagaimana impuls saraf dihantarkan dalam neuron?" {{ in_array('Bagaimana impuls saraf dihantarkan dalam neuron?', $jawaban->jawaban ?? []) ? 'checked' : '' }}>
                        Bagaimana impuls saraf dihantarkan dalam neuron?
                    </label>
                </div>

                <!-- Input Pertanyaan Sendiri -->
                <div class="mt-4 space-y-2">
                    <label class="font-semibold">Tambahkan Pertanyaan Sendiri:</label>
                    <input 
                        type="text" 
                        name="jawaban[]"
                        class="w-full border rounded p-3 focus:ring-2 focus:ring-purple-500"
                        placeholder="Tulis pertanyaanmu di sini..." value="{{ collect($jawaban->jawaban ?? [])->last() }}">
                    </div>
                    <input type="hidden" name="next_materi" value="sistem-koordinasi-manusia">
                    <input type="hidden" name="next_tahapan" value="pengumpulan-data">

                <!-- Tombol -->
                <div class="flex justify-between mt-6">
                    <a href="/stimulation" class="px-4 py-2 bg-gray-300 rounded">
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

