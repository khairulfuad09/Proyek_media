
<div class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-purple-900 text-white p-4 shadow">
        <h1 class="text-xl font-bold">Tahap 5: Verification</h1>
    </header>

    <!-- Content -->
    <main class="flex-1 flex items-center justify-center p-6">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-6 space-y-6">

            <!-- Title -->
            <div>
                <h2 class="text-2xl font-bold mb-2">Pembuktian</h2>
                <p class="text-gray-600">Pilih jawaban yang paling tepat berdasarkan pemahamanmu.</p>
            </div>

            <!-- Quiz -->
            <form method="POST" action="/simpan-jawaban" id="form-verifikasi">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="tahapan_id" value="5">
                <input type="hidden" name="materi_id" value="1">
                <input type="hidden" name="next_materi" value="sistem-koordinasi-manusia">
                <input type="hidden" name="next_tahapan" value="generalization">
                <input type="hidden" name="nilai" value=0 id="nilai-input">
                <!-- Soal 1 -->
                @php
                    $dataJawaban = $jawaban->jawaban ?? [];
                    $isAnswered = !empty($dataJawaban);
                @endphp
                <div class="space-y-2">
                    <p class="font-semibold">1. Bagian sistem saraf pusat yang berfungsi mengatur aktivitas tubuh adalah:</p>
                    <label class="block"><input type="radio" name="q1" value="a"  {{ ($dataJawaban['q1'] ?? '') == 'a' ? 'checked' : '' }} {{ ($isAnswered ?? false) ? 'disabled' : '' }}> Otak</label>
                    <label class="block"><input type="radio" name="q1" value="b" {{ ($dataJawaban['q1'] ?? '') == 'b' ? 'checked' : '' }} {{ ($isAnswered ?? false) ? 'disabled' : '' }}> Neuron</label>
                    <label class="block"><input type="radio" name="q1" value="c" {{ ($dataJawaban['q1'] ?? '') == 'c' ? 'checked' : '' }} {{ ($isAnswered ?? false) ? 'disabled' : '' }}> Reseptor</label>
                </div>

                <!-- Soal 2 -->
                <div class="space-y-2 mt-4">
                    <p class="font-semibold">2. Fungsi neuron dalam sistem koordinasi manusia adalah:</p>
                    <label class="block"><input type="radio" name="q2" value="a" {{ ($dataJawaban['q2'] ?? '') == 'a' ? 'checked' : '' }} {{ ($isAnswered ?? false) ? 'disabled' : '' }}> Mengangkut impuls saraf</label>
                    <label class="block"><input type="radio" name="q2" value="b" {{ ($dataJawaban['q2'] ?? '') == 'b' ? 'checked' : '' }} {{ ($isAnswered ?? false) ? 'disabled' : '' }}> Menghasilkan darah</label>
                    <label class="block"><input type="radio" name="q2" value="c" {{ ($dataJawaban['q2'] ?? '') == 'c' ? 'checked' : '' }} {{ ($isAnswered ?? false) ? 'disabled' : '' }}> Mencerna makanan</label>
                </div>

                <!-- Navigation -->
                <div class="flex justify-between mt-6">
                    <a href="/data-processing" class="px-4 py-2 bg-gray-300 rounded">
                        Kembali
                    </a>

                    <button 
                        type="button"
                        onclick="cekJawabanVerifikasi('VSK')"
                        class=" px-6 py-2 rounded {{ ($isAnswered ?? false) ? 'bg-gray-700 cursor-not-allowed' : 'text-white bg-purple-600 hover:bg-purple-700' }}"
                        {{ ($isAnswered ?? false) ? 'disabled' : '' }}
                         title="{{ $isAnswered ? 'Anda sudah menjawab, silakan lanjut ke tahapan berikutnya' : '' }}">
                        Periksa Jawaban
                    </button>
                </div>
            </form>

            <!-- Feedback Hasil -->
            <div class="bg-gray-100 p-4 rounded">
                <p class="font-semibold">📊 Hasil: {{ $nilai }}</p>
                <p id="nilai" class="text-gray-600">Nilai kamu akan muncul di sini setelah menjawab.</p>
            </div>
            

        </div>
    </main>

</div>
