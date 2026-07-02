<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="scroll-smooth">
    {{-- top bar --}}
    <header class="bg-purple-400 shadow py-4  flex items-center px-6 h-16 fixed top-0 w-full z-10">
        <div class="rounded bg-white px-4 py-2 mr-2 hover:bg-purple-700 hover:text-white">
            <button id="burger-toggle" class="focus:outline-none  text-purple-600 text-2xl ">
          ☰
        </button>
        </div>
        <h1 class="text-3xl font-bold text-white">NeuroLearn</h1>
        <div class="ml-auto">
            @guest
            <button class="shadow ml-auto bg-purple-600 text-white px-6 py-2 rounded hover:bg-blue-400" onclick="smoothScroll('Login'); Login()">Masuk</button>
            <button class="shadow ml-auto bg-purple-600 text-white px-6 py-2 rounded hover:bg-green-400" onclick="smoothScroll('registrasi'); Regis()">Daftar</button>
            @endguest   
            @auth
            <form method="post" action="/logout">
            @csrf
            <button class="shadow ml-auto bg-purple-600 text-white px-6 py-2 rounded hover:bg-green-400" >Keluar</button>
        </form>
            @endauth           

        </div>
    </header>
    {{-- top bar --}}
    {{-- side bar --}}
    <div class="flex pt-16">
        <aside id="sideBar" class="shadow fixed left-0 width-64 h-screen bg-purple-900 text-white transition-all transform -translate-x-full md:translate-x-0 z-20">
            <nav class="space-y-1 width-64 h-full flex flex-col width-64 py-20">
                <div class="text-2xl font-bold mb-6 px-4 text-center py-4 w-full">
                    Logo
                </div>
                <a href="javascript:void(0)" class="block w-full text-white hover:bg-purple-700 px-20 py-7 text-center" onclick="smoothScroll('dashboard')">Dashboard </a>
                <a href="javascript:void(0)" class="block w-full text-white hover:bg-purple-700 px-20 py-7 text-center" onclick="smoothScroll('materi')">Materi </a>
                <a href="javascript:void(0)" class="block w-full text-white hover:bg-purple-700 px-20 py-7 text-center" onclick="smoothScroll('registrasi')">Daftar</a>
                <a href="javascript:void(0)" class="block w-full text-white hover:bg-purple-700 px-20 py-7 text-center" onclick="smoothScroll('tentang-pembuat')">Tentang Pembuat</a>
            </nav>
        </aside>
        {{-- side bar --}}
        {{-- Main --}}
        @if(session('success'))
            <div id="popup-success" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                
                <div class="bg-white p-6 rounded-xl shadow-lg text-center w-80">
                    
                    <h2 class="text-xl font-bold text-green-600 mb-2">Berhasil!</h2>
                    
                    <p class="mb-4">{{ session('success') }}</p>
                    <p class="mb-4">{{ session('error') }}</p>

                    <button onclick="closePopup()" 
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        OK
                    </button>

                </div>

            </div>
        @endif
        <main id="konten" class="md:px-15 pt-5 md:ml-60 w-full p-6 bg-purple-600 min-h-screen">
            <div id="dashboard" class="container mx-auto px-4 py-8 text-white">
                <h2 class="text-3xl font-bold mb-4">Selamat Datang di NeuroLearn</h2>
                <div class=" grid cols-1 md:grid-cols-2 gap-4">
                    <img class="md:h-150" src="/img/hero-img.svg" alt="">
                    <div class="flex flex-col justify-center">
                        <p class="mb-6 text-2xl ">Platform pembelajaran untuk meningkatkan kemampuan kognitif Anda.</p>
                        <button class="mb-10 rounded bg-purple-950 text-white p-2 hover:bg-purple-400 text-xl font-bold" onclick="window.location.href='{{ route('progress.siswa') }}'">
                            Mulai Belajar!
                        </button>
                    </div>
                </div >
                    <div id="materi" class="pt-5 grid grid-cols-1 md:grid-cols-2 gap-10 text-black bg-purple-500 p-10 rounded scroll-mt-16">
                        <div class="md:h-64 bg-white p-6 rounded-lg shadow">
                            <h3 class="text-xl font-semibold mb-2">Sistem Koordinasi Manusia</h3>
                            <p>Akses berbagai modul pembelajaran yang dirancang khusus untuk meningkatkan kemampuan kognitif Anda.</p>
                            {{-- <button class="mb-10 rounded bg-blue-600 text-white p-2 hover:bg-blue-900 font-bold ">Pelajari</button> --}}
                            <div class="mt-auto flex justify-end">
                                <a href="/Discovery-Learning/sistem-koordinasi-manusia/stimulasi" class="rounded bg-blue-600 text-white px-4 py-2 font-bold hover:bg-blue-900 transition mt-20">
                                    Pelajari
                                </a>
                            </div>
                        </div>
                        <div class="md:h-64 bg-white p-6 rounded-lg shadow">
                            <h3 class="text-xl font-semibold mb-2">Analisis Performa</h3>
                            <p>Dapatkan analisis mendalam tentang performa belajar Anda dan rekomendasi untuk perbaikan.</p>
                            <div class="mt-auto flex justify-end">
                                <a href="" class="rounded bg-blue-600 text-white px-4 py-2 font-bold hover:bg-blue-900 transition mt-20">
                                    Pelajari
                                </a>
                            </div>
                        </div>
                        <div class="md:h-64 bg-white p-6 rounded-lg shadow">
                            <h3 class="text-xl font-semibold mb-2">Komunitas Belajar</h3>
                            <p>Bergabung dengan komunitas pembelajar lainnya untuk berbagi pengalaman dan tips belajar.</p>
                            <div class="mt-auto flex justify-end">
                                <a href="" class="rounded bg-blue-600 text-white px-4 py-2 font-bold hover:bg-blue-900 transition mt-20">
                                    Pelajari
                                </a>
                            </div>
                        </div>
                        <div class="md:h-64 bg-white p-6 rounded-lg shadow">
                            <h3 class="text-xl font-semibold mb-2">Komunitas Belajar</h3>
                            <p>Bergabung dengan komunitas pembelajar lainnya untuk berbagi pengalaman dan tips belajar.</p>
                            <div class="mt-auto flex justify-end">
                                <a href="" class="rounded bg-blue-600 text-white px-4 py-2 font-bold hover:bg-blue-900 transition mt-20">
                                    Pelajari
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="registrasi" class="grid place-content-center scroll-mt-16 ">
                        <div  class="bg-purple-800 rounded-lg mt-5 w-100 justify-center shadow-lg">
                            <p class="text-center py-5 text-3xl font-bold">Daftar</p>
                            <form action="/register" method="POST">
                                 @csrf
                                <div class="flex flex-col p-10 space-y-4 bg-white text-black rounded">
                                    <input type="text" placeholder="Nama Lengkap" class="p-2 rounded outline-1" name="name">
                                    <input type="text" placeholder="NIS" class="p-2 rounded outline-1" name="nis">
                                    <input type="email" placeholder="Email" class="p-2 rounded outline-1" name="email">
                                    <input type="password" placeholder="Password" class="p-2 rounded outline-1" name="password">
                                    <button type="submit" class="bg-purple-600 text-white p-2 rounded hover:bg-purple-400">Daftar</button>
                                    <a href="#" class="text-purple-600 hover:text-purple-800" onclick="Login(); return false;">Sudah punya akun? Masuk di sini</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="Login" class="place-content-center scroll-mt-16 hidden">
                        <div  class="bg-purple-800 rounded-lg mt-5 w-100 justify-center shadow-lg">
                            <p class="text-center py-5 text-3xl font-bold">Masuk</p>
                            <form action="/login" method="post">
                                 @csrf
                                <div class="flex flex-col p-10 space-y-4 bg-white text-black rounded">
                                    <input type="text" placeholder="NIS" class="p-2 rounded outline-1" name="nis">
                                    <input type="email" placeholder="Email" class="p-2 rounded outline-1" name="email">
                                    <input type="password" placeholder="Password" class="p-2 rounded outline-1" name="password">
                                    <button class="bg-purple-600 text-white p-2 rounded hover:bg-purple-400">Masuk</button>
                                    <a href="#" class="text-purple-600 hover:text-purple-800" onclick="Regis(); return false;">Belum Punya akun? Daftar sini</a>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        <section id="tentang-pembuat" class=" min-h-screen bg-purple-50 flex items-center justify-center px-6">
            <div class="max-w-5xl w-full bg-white rounded-2xl shadow-lg p-8 md:p-12 grid grid-cols-1 md:grid-cols-2 gap-10">

                <!-- Ilustrasi / Foto -->
                <div class="flex justify-center items-center">
                <div class="w-64 h-64 bg-purple-100 rounded-full flex items-center justify-center">
                    <span class="text-purple-600 text-lg font-semibold">
                    Ilustrasi
                    </span>
                </div>
                </div>

                <!-- Konten -->
                <div class="flex flex-col justify-center">
                <h2 class="text-3xl font-bold text-purple-700 mb-4">
                    Tentang Pembuat Ilustrasi
                </h2>

                <p class="text-gray-700 mb-4 leading-relaxed">
                    Ilustrasi pada platform ini dibuat untuk mendukung pengalaman belajar yang
                    lebih visual, menarik, dan mudah dipahami oleh pengguna dari berbagai
                    latar belakang.
                </p>

                <p class="text-gray-700 mb-6 leading-relaxed">
                    Setiap ilustrasi dirancang dengan pendekatan edukatif, mengutamakan
                    kesederhanaan visual, konsistensi warna, serta kesesuaian dengan konteks
                    materi pembelajaran.
                </p>

                <div class="border-l-4 border-purple-600 pl-4 mb-6">
                    <p class="text-sm text-gray-600 italic">
                    “Ilustrasi bukan sekadar hiasan, tetapi jembatan antara konsep dan pemahaman.”
                    </p>
                </div>

                <div class="flex gap-4">
                    <a href="#" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    Lihat Portofolio
                    </a>
                    <a href="#" class="px-6 py-2 border border-purple-600 text-purple-600 rounded-lg hover:bg-purple-50 transition">
                    Hubungi
                    </a>
                </div>
                </div>

            </div>
        </section>

        </main>
    </div>
    <footer id="footer" class="text-center py-4 text-white bg-purple-950 md:ml-58">@copyright 2026</footer>
        {{-- Main --}}
<script src="js/dashboard.js"></script>
</body>
</html>