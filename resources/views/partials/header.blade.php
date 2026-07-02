{{-- top bar --}}
    <header class="bg-purple-400 shadow py-4 px-6 flex items-center px-6 h-16 fixed top-0 w-full z-10">
        <div class="rounded bg-white px-4 py-2 mr-2 hover:bg-purple-700 hover:text-white">
            <button id="burger-toggle" class="focus:outline-none  text-purple-600 text-2xl ">
          ☰
        </button>
        </div>
        <h1 class="text-3xl font-bold text-white" onclick="window.location.href = '/'">NeuroLearn</h1>
        <div class="ml-auto">
            @auth
            <form method="post" action="/logout">
            @csrf
            <button class="shadow ml-auto bg-purple-600 text-white px-6 py-2 rounded hover:bg-red-400" >Keluar</button>
        </form>
            @endauth

            </div>
    </header>
    {{-- top bar --}}
    {{-- side bar --}}
    <div class="flex pt-16">
        <aside id="sideBar" class="shadow fixed left-0 width-64 h-screen bg-purple-900 text-white transition-all transform -translate-x-full md:translate-x-0 z-20 ">
            <nav class="space-y-1 width-64 h-full flex flex-col width-64 py-20 overflow-y-auto ">
                <div class="text-2xl font-bold mb-6 px-4 text-center py-4 w-full">
                    Logo
                </div>
                @can('siswa')
                <div>
                    <a href="/Progress Siswa" class="block w-full text-white hover:bg-purple-700 px-20 py-7 text-center flex " onclick="toggleMenu()">
                        <span>
                            Progress
                        </span>
                    </a>
                </div>
                <div>
                    <a href="javascript:void(0)" class="block w-full text-white  px-20 py-7 text-center flex {{ request()->is('Discovery-Learning/sistem-koordinasi-manusia/*') ? 'bg-purple-600' : '' }} hover:bg-purple-700" onclick="toggleMenu(1)">
                        <span>
                            Koordinasi
                        </span>
                        <svg id="arrowIcon1" class="{{ request()->is('Discovery-Learning/sistem-koordinasi-manusia/*') ? 'rotate-180' : '' }} w-4 h-4 transform transition-transform duration-300 mt-1 ml-2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <div id="submenu1" class="{{ request()->is('Discovery-Learning/sistem-koordinasi-manusia/*') ? 'flex' : 'hidden' }} flex-col ml-4 mt-2 space-y-2">
                        <a href="/Discovery-Learning/sistem-koordinasi-manusia/stimulasi" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/sistem-koordinasi-manusia/stimulasi') ? 'bg-purple-600 text-white' : '' }}">Stimulasi</a>
                        <a href="/Discovery-Learning/sistem-koordinasi-manusia/identifikasi-masalah" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/sistem-koordinasi-manusia/identifikasi-masalah') ? 'bg-purple-600 text-white' : '' }}">Identifikasi Masalah</a>
                        <a href="/Discovery-Learning/sistem-koordinasi-manusia/pengumpulan-data" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/sistem-koordinasi-manusia/pengumpulan-data') ? 'bg-purple-600 text-white' : '' }}">Pengumpulan Data</a>
                        <a href="/Discovery-Learning/sistem-koordinasi-manusia/pengolahan-data" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/sistem-koordinasi-manusia/pengolahan-data') ? 'bg-purple-600 text-white' : '' }}">Pengolahan Data</a>
                        <a href="/Discovery-Learning/sistem-koordinasi-manusia/verifikasi" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/sistem-koordinasi-manusia/verifikasi') ? 'bg-purple-600 text-white' : '' }}">Verifikasi</a>
                        <a href="/Discovery-Learning/sistem-koordinasi-manusia/generalization" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/sistem-koordinasi-manusia/generalization') ? 'bg-purple-600 text-white' : '' }}">Kesimpulan</a>
                    </div>
                </div>
                <div>
                    <a href="javascript:void(0)" class=" w-full text-white hover:bg-purple-700 px-20 py-7 text-center flex {{ request()->is('Discovery-Learning/alat-indra-manusia/*') ? 'bg-purple-600' : '' }}" onclick="toggleMenu(2)">
                        <span>
                            Alat Indra
                        </span>
                        <svg id="arrowIcon2" class="{{ request()->is('Discovery-Learning/alat-indra-manusia/*') ? 'rotate-180' : '' }} w-4 h-4 transform transition-transform duration-300 mt-1 ml-2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <div id="submenu2" class="{{ request()->is('Discovery-Learning/alat-indra-manusia/*') ? 'flex' : 'hidden' }} flex flex-col ml-4 mt-2 space-y-2">
                        <a href="/Discovery-Learning/alat-indra-manusia/stimulasi" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/alat-indra-manusia/stimulasi') ? 'bg-purple-600 text-white' : '' }}">Stimulasi</a>
                        <a href="/Discovery-Learning/alat-indra-manusia/identifikasi-masalah" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/alat-indra-manusia/identifikasi-masalah') ? 'bg-purple-600 text-white' : '' }}">Identifikasi Masalah</a>
                        <a href="/Discovery-Learning/alat-indra-manusia/pengumpulan-data" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/alat-indra-manusia/pengumpulan-data') ? 'bg-purple-600 text-white' : '' }}">Pengumpulan Data</a>
                        <a href="/Discovery-Learning/alat-indra-manusia/pengolahan-data" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/alat-indra-manusia/pengolahan-data') ? 'bg-purple-600 text-white' : '' }}">Pengolahan Data</a>
                        <a href="/Discovery-Learning/alat-indra-manusia/verifikasi" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/alat-indra-manusia/verifikasi') ? 'bg-purple-600 text-white' : '' }}">Verifikasi</a>
                        <a href="/Discovery-Learning/alat-indra-manusia/generalization" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/alat-indra-manusia/generalization') ? 'bg-purple-600 text-white' : '' }}">Kesimpulan</a>
                    </div>
                </div>
                <div>
                    <a href="javascript:void(0)" class=" w-full text-white hover:bg-purple-700 px-20 py-7 text-center flex {{ request()->is('Discovery-Learning/hormon-manusia/*') ? 'bg-purple-600' : '' }}" onclick="toggleMenu(3)">
                        <span>
                            Hormon
                        </span>
                        <svg id="arrowIcon3" class="{{ request()->is('Discovery-Learning/hormon-manusia/*') ? 'rotate-180' : '' }} w-4 h-4 transform transition-transform duration-300 mt-1 ml-2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <div id="submenu3" class="{{ request()->is('Discovery-Learning/hormon-manusia/*') ? 'flex' : 'hidden' }} flex flex-col ml-4 mt-2 space-y-2">
                        <a href="/Discovery-Learning/hormon-manusia/stimulasi" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/hormon-manusia/stimulasi') ? 'bg-purple-600 text-white' : '' }}">Stimulasi</a>
                        <a href="/Discovery-Learning/hormon-manusia/identifikasi-masalah" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/hormon-manusia/identifikasi-masalah') ? 'bg-purple-600 text-white' : '' }}">Identifikasi Masalah</a>
                        <a href="/Discovery-Learning/hormon-manusia/pengumpulan-data" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/hormon-manusia/pengumpulan-data') ? 'bg-purple-600 text-white' : '' }}">Pengumpulan Data</a>
                        <a href="/Discovery-Learning/hormon-manusia/pengolahan-data" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/hormon-manusia/pengolahan-data') ? 'bg-purple-600 text-white' : '' }}">Pengolahan Data</a>
                        <a href="/Discovery-Learning/hormon-manusia/verifikasi" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/hormon-manusia/verifikasi') ? 'bg-purple-600 text-white' : '' }}">Verifikasi</a>
                        <a href="/Discovery-Learning/hormon-manusia/generalization" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/hormon-manusia/generalization') ? 'bg-purple-600 text-white' : '' }}">Kesimpulan</a>
                    </div>
                </div>
                <div>
                    <a href="javascript:void(0)" class=" w-full text-white hover:bg-purple-700 px-20 py-7 text-center flex {{ request()->is('Discovery-Learning/homeostasis-manusia/*') ? 'bg-purple-600' : '' }}" onclick="toggleMenu(4)">
                        <span>
                            Homeostasis
                        </span>
                        <svg id="arrowIcon4" class="{{ request()->is('Discovery-Learning/homeostasis-manusia/*') ? 'rotate-180' : '' }} w-4 h-4 transform transition-transform duration-300 mt-1 ml-2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <!-- Submenu -->
                    <div id="submenu4" class="{{ request()->is('Discovery-Learning/homeostasis-manusia/*') ? 'flex' : 'hidden' }} flex flex-col ml-4 mt-2 space-y-2">
                        <a href="/Discovery-Learning/homeostasis-manusia/stimulasi" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/homeostasis-manusia/stimulasi') ? 'bg-purple-600 text-white' : '' }}">Stimulasi</a>
                        <a href="/Discovery-Learning/homeostasis-manusia/identifikasi-masalah" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/homeostasis-manusia/identifikasi-masalah') ? 'bg-purple-600 text-white' : '' }}">Identifikasi Masalah</a>
                        <a href="/Discovery-Learning/homeostasis-manusia/pengumpulan-data" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/homeostasis-manusia/pengumpulan-data') ? 'bg-purple-600 text-white' : '' }}">Pengumpulan Data</a>
                        <a href="/Discovery-Learning/homeostasis-manusia/pengolahan-data" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/homeostasis-manusia/pengolahan-data') ? 'bg-purple-600 text-white' : '' }}">Pengolahan Data</a>
                        <a href="/Discovery-Learning/homeostasis-manusia/verifikasi" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/homeostasis-manusia/verifikasi') ? 'bg-purple-600 text-white' : '' }}">Verifikasi</a>
                        <a href="/Discovery-Learning/homeostasis-manusia/generalization" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('Discovery-Learning/homeostasis-manusia/generalization') ? 'bg-purple-600 text-white' : '' }}">Kesimpulan</a>
                    </div>
                </div>
                @endcan
                @can('admin')
                    <div>
                        <a href="/admin-dashboard" class="block w-full text-white hover:bg-purple-700 px-20 py-7 text-center flex " onclick="toggleMenu()">
                            <span>
                                Beranda Admin
                            </span>
                        </a>
                    </div>
                    <div>
                        <a href="/admin/update-users" class="block w-full text-white hover:bg-purple-700 px-20 py-7 text-center flex " onclick="toggleMenu()">
                            <span>
                                User unknown
                            </span>
                        </a>
                    </div>
                    @endcan
                    @can('guru')
                    <div>
                        <a href="/admin-dashboard" class="block w-full text-white hover:bg-purple-700 px-20 py-7 text-center flex " onclick="toggleMenu()">
                            <span>
                                Beranda Guru
                            </span>
                        </a>
                    </div>
                    <div>
                        <a href="/admin/update-users" class="block w-full text-white hover:bg-purple-700 px-20 py-7 text-center flex " onclick="toggleMenu()">
                            <span>
                                User unknown
                            </span>
                        </a>
                    </div>
                    @endcan
                </nav>
        </aside>
        {{-- side bar --}}
        {{-- Main --}}
        <main id="konten" class="md:px-15 pt-5 md:ml-60 w-full p-6 bg-purple-600 min-h-screen">