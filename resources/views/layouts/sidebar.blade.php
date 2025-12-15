<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" 
     class="flex flex-col w-64 h-full bg-slate-800 text-slate-300 transition-all duration-300 z-30 flex-shrink-0 border-r border-slate-700">
    
    {{-- HEADER: LOGO & USER INFO --}}
    <div class="px-6 py-5 border-b border-slate-700 bg-slate-900 sticky top-0 z-10">
        <div class="flex items-center space-x-3 mb-4">
            <div class="bg-slate-800 p-2 rounded-lg border border-slate-700">
                <img src="{{ asset('images/uns.webp') }}" alt="Logo UNS" class="w-8 h-8 object-contain">
            </div>
            <h1 class="text-xl font-bold text-white tracking-tight">Sistem Wisuda</h1>
        </div>
        
        <div class="flex items-center space-x-3 bg-slate-800 p-3 rounded-lg border border-slate-700">
            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-slate-600">
                <i class="fas fa-user text-slate-300 text-sm"></i>
            </span>
            <div class="text-left overflow-hidden">
                <p class="text-sm font-semibold text-white truncate w-32">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-400 truncate">{{ Auth::user()->role == 'admin' ? 'Administrator' : 'Mahasiswa' }}</p>
            </div>
        </div>
    </div>

    {{-- NAVIGATION MENU --}}
    <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
        <p class="px-2 text-xs font-bold uppercase text-slate-500 tracking-wider mb-2">Menu Utama</p>

        {{-- ================================== --}}
        {{--          MENU ADMIN                --}}
        {{-- ================================== --}}
        @if(Auth::user()->role == 'admin')
            
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-3 py-2.5 rounded-lg transition duration-200 hover:bg-slate-700 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="ml-3 font-medium">Dashboard Admin</span>
            </a>

            <a href="{{ route('admin.verification.index') }}" 
               class="flex items-center px-3 py-2.5 rounded-lg transition duration-200 hover:bg-slate-700 hover:text-white {{ request()->routeIs('admin.verification.*') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                <i class="fas fa-check-double w-5 text-center"></i>
                <span class="ml-3 font-medium">Verifikasi</span>
            </a>

            <a href="{{ route('admin.announcements.index') }}" 
               class="flex items-center px-3 py-2.5 rounded-lg transition duration-200 hover:bg-slate-700 hover:text-white {{ request()->routeIs('admin.announcements.*') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                <i class="fas fa-bullhorn w-5 text-center"></i>
                <span class="ml-3 font-medium">Pengumuman</span>
            </a>

            <a href="{{ route('admin.periods.index') }}" 
               class="flex items-center px-3 py-2.5 rounded-lg transition duration-200 hover:bg-slate-700 hover:text-white {{ request()->routeIs('admin.periods.*') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                <i class="fas fa-calendar-alt w-5 text-center"></i>
                <span class="ml-3 font-medium">Jadwal & Kuota</span>
            </a>

            <a href="{{ route('admin.reports.index') }}" 
               class="flex items-center px-3 py-2.5 rounded-lg transition duration-200 hover:bg-slate-700 hover:text-white {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                <i class="fas fa-file-pdf w-5 text-center"></i>
                <span class="ml-3 font-medium">Laporan</span>
            </a>

        {{-- ================================== --}}
        {{--          MENU MAHASISWA            --}}
        {{-- ================================== --}}
        @else 
            
            {{-- 1. Dashboard --}}
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-3 py-2.5 rounded-lg transition duration-200 hover:bg-slate-700 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="ml-3 font-medium">Dashboard</span>
            </a>

            {{-- 2. Daftar Wisuda --}}
            <a href="{{ route('graduation.create') }}" 
               class="flex items-center px-3 py-2.5 rounded-lg transition duration-200 hover:bg-slate-700 hover:text-white {{ request()->routeIs('graduation.create') ? 'bg-blue-600 text-white shadow-md' : '' }}">
                <i class="fas fa-user-graduate w-5 text-center"></i>
                <span class="ml-3 font-medium">Daftar Wisuda</span>
            </a>
            
            {{-- 3. Dropdown Cetak Dokumen (HANYA MUNCUL JIKA SUDAH VERIFIED) --}}
            @php
                $registration = Auth::user()->registration;
                // Menggunakan optional chaining ($registration?->status) untuk PHP 8+ atau pengecekan manual
                $isVerified = $registration && $registration->status === 'verified';
            @endphp

            @if($isVerified)
                <div x-data="{ openCetak: {{ request()->routeIs('graduation.print.*') ? 'true' : 'false' }} }">
                    <button @click="openCetak = !openCetak" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition duration-200 hover:bg-slate-700 hover:text-white text-slate-300 {{ request()->routeIs('graduation.print.*') ? 'bg-slate-700 text-white' : '' }}">
                        <span class="flex items-center">
                            <i class="fas fa-print w-5 text-center"></i>
                            <span class="ml-3 font-medium">Cetak Dokumen</span>
                        </span>
                        {{-- FIX: Ganti karakter kotak dengan fa-chevron-down --}}
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200" 
                           :class="openCetak ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <div x-show="openCetak" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         class="mt-1 ml-3 border-l-2 border-slate-600 pl-2 space-y-1">
                         
                        <a href="{{ route('graduation.print.biodata') }}" target="_blank" 
                           class="block px-4 py-2 text-sm rounded-r transition {{ request()->routeIs('graduation.print.biodata') ? 'text-white bg-slate-700' : 'text-slate-400 hover:text-white hover:bg-slate-700' }}">
                            Biodata
                        </a>
                        
                        <a href="{{ route('graduation.print.draft') }}" target="_blank" 
                           class="block px-4 py-2 text-sm rounded-r transition {{ request()->routeIs('graduation.print.draft') ? 'text-white bg-slate-700' : 'text-slate-400 hover:text-white hover:bg-slate-700' }}">
                            Draft Ijazah
                        </a>
                        
                        <a href="{{ route('graduation.print.invitation') }}" target="_blank" 
                           class="block px-4 py-2 text-sm rounded-r transition {{ request()->routeIs('graduation.print.invitation') ? 'text-white bg-slate-700' : 'text-slate-400 hover:text-white hover:bg-slate-700' }}">
                            Undangan
                        </a>
                    </div>
                </div>
            @endif

            {{-- 4. Dropdown Pantau --}}
            <div x-data="{ openPantau: {{ request()->routeIs('graduation.list') || request()->routeIs('graduation.yearbook') ? 'true' : 'false' }} }">
                <button @click="openPantau = !openPantau" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition duration-200 hover:bg-slate-700 hover:text-white text-slate-300">
                    <span class="flex items-center">
                        <i class="fas fa-eye w-5 text-center"></i>
                        <span class="ml-3 font-medium">Pantau</span>
                    </span>
                    {{-- FIX: Ganti karakter kotak dengan fa-chevron-down --}}
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="openPantau ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openPantau" x-transition class="mt-1 ml-3 border-l-2 border-slate-600 pl-2 space-y-1">
                    <a href="{{ route('graduation.list') }}" class="block px-4 py-2 text-sm text-slate-400 hover:text-white hover:bg-slate-700 rounded-r">
                        Daftar Peserta
                    </a>
                    <a href="{{ route('graduation.yearbook') }}" class="block px-4 py-2 text-sm text-slate-400 hover:text-white hover:bg-slate-700 rounded-r">
                        Buku Kenangan
                    </a>
                </div>
            </div>
            
            {{-- 5. Buku Panduan --}}
            <a href="{{ route('manual.book') }}" 
               class="flex items-center px-3 py-2.5 rounded-lg transition-colors duration-200 {{ request()->routeIs('manual.book') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                <i class="fas fa-book-open w-5 text-center"></i>
                <span class="ml-3 font-medium">Buku Panduan</span>
            </a>

        @endif 
    </nav>

    {{-- FOOTER: LOGOUT --}}
    <div class="px-4 py-4 border-t border-slate-700 bg-slate-900 mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-3 py-2.5 rounded-lg transition duration-200 hover:bg-red-600 bg-red-600/10 text-red-500 hover:text-white group">
                <i class="fas fa-sign-out-alt w-5 text-center group-hover:text-white"></i>
                <span class="ml-3 font-medium">Logout</span>
            </button>
        </form>
    </div>
</div>