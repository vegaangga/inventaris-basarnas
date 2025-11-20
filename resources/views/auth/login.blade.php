{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-950 flex items-center justify-center relative overflow-hidden">

    {{-- Background motif: strip reflektif + grid gudang --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
      <!-- <div class="absolute -top-24 -right-24 w-[32rem] h-[32rem] rounded-full blur-3xl opacity-30"
           style="background: radial-gradient(circle at center, #ff7a00 100%, #ff7a00 100%, #111827 0%);"></div>
      <div class="absolute inset-0"
           style="background-image:
              linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px),
              linear-gradient(0deg, rgba(255,255,255,.06) 1px, transparent 1px);
              background-size: 28px 28px;"></div> -->

      {{-- reflective stripes (Basarnas vibe) --}}
      <!-- <div class="absolute -left-10 top-12 rotate-[-8deg] w-[140%] h-6 bg-[#111827]/90 shadow-md">
        <div class="h-full w-full bg-[repeating-linear-gradient(45deg,#fb923c_0_16px,#111827_16px_32px)] opacity-90"></div>
      </div>
      <div class="absolute -right-10 bottom-16 rotate-[10deg] w-[140%] h-4 bg-[#111827]/90 shadow-md">
        <div class="h-full w-full bg-[repeating-linear-gradient(45deg,#fb923c_0_12px,#111827_12px_24px)] opacity-90"></div>
      </div> -->
    </div>

    <div class="relative z-10 w-full max-w-5xl grid grid-cols-1 lg:grid-cols-2 gap-0 mx-4">

      {{-- BRAND PANEL --}}
      <aside class="hidden lg:flex flex-col justify-between p-10 rounded-l-2xl bg-gradient-to-b from-[#111827] to-[#0b0f1a] text-white border border-gray-800">
        <div class="flex items-center gap-3">
          {{-- ganti src logo berikut dengan aset kamu --}}
          <img src="/images/lambang-bpp.png" alt="Basarnas" style="width:50px; height:60px">
          <div>
            <p class="text-sm uppercase tracking-widest text-orange-300/90">Basarnas</p>
            <h1 class="text-2xl font-bold leading-tight">Inventaris &amp; Logistik</h1>
          </div>
        </div>

        <div class="mt-10 space-y-4">
          <h2 class="text-lg font-semibold">Selamat datang 👋</h2>
          <p class="text-sm text-gray-300">
            Masuk untuk mengelola stok gudang, pencatatan peralatan SAR, riwayat perawatan, dan
            distribusi ke <em>kegiatan</em>.
          </p>

          <ul class="mt-6 space-y-3 text-sm">
            <li class="flex items-center gap-3">
              <a href="/beranda"
                class="flex items-center gap-3 p-2 rounded-lg bg-white hover:bg-gray-50 transition">
                <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-orange-500/20">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6m6 6V7M4 20h16" />
                  </svg>
                </span>
                <span class="text-gray-800 font-medium">
                  Manual Books &amp; prosedur peralatan terlampir
                </span>
              </a>

            </li>
            <li class="flex items-center gap-3">
              <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-orange-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-7 4h8M5 8h14" />
                </svg>
              </span>
              Laporan stok &amp; mutasi real-time
            </li>
            <li class="flex items-center gap-3">
              <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-orange-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-4.553a1 1 0 00-1.414-1.414L13.586 8.586m0 0L8 14.172V16h1.828l5.586-5.586M13.586 8.586L15 10" />
                </svg>
              </span>
              Integrasi kegiatan &amp; perawatan
            </li>
          </ul>
        </div>

        <div class="pt-8 text-xs text-gray-400">
          © {{ date('Y') }} Basarnas • Sistem Inventaris Gudang
        </div>
      </aside>

      {{-- FORM PANEL --}}
      <section class="bg-white/90 dark:bg-gray-900/90 backdrop-blur rounded-2xl lg:rounded-l-none border border-gray-200 dark:border-gray-800 p-8 lg:p-12">
        {{-- Session Status --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="mb-8">
          <div class="flex items-center gap-3 lg:hidden mb-4">
            <img src="/images/lambang-bpp.png" alt="Basarnas" style="height: 60px; width:50px">
            <div>
              <p class="text-xs uppercase tracking-widest text-orange-600 dark:text-orange-400">Basarnas</p>
              <h1 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Inventaris &amp; Logistik</h1>
            </div>
          </div>
          <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-100">Masuk</h2>
          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Gunakan akun yang terdaftar.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" x-data="{ showPassword:false, caps:false, loading:false }" x-on:submit="loading=true">
          @csrf

         {{-- Email atau NIP --}}
        <div>
          <x-input-label for="login" :value="__('Email atau NIP')" />
          <x-text-input
            id="login"
            class="block mt-1 w-full"
            type="text"
            name="login"
            :value="old('login')"
            required
            autofocus
            autocomplete="username"
          />
          <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>


          {{-- Password --}}
          {{-- Password --}}
<div class="mt-4" x-data="{ showPassword:false, caps:false }">
  <div class="flex items-center justify-between">
    <x-input-label for="password" :value="__('Password')" />
    @if (Route::has('password.request'))
      <a class="text-sm text-orange-600 hover:text-orange-700 dark:text-orange-400 dark:hover:text-orange-300"
         href="{{ route('password.request') }}">
        <!-- {{ __('Lupa password?') }} -->
      </a>
    @endif
  </div>

  <div class="relative">
    <x-text-input id="password"
      class="block mt-1 w-full pr-12"
      x-bind:type="showPassword ? 'text' : 'password'"
      name="password"
      required
      autocomplete="current-password"
      x-on:keyup.capture="caps = ($event.getModifierState && $event.getModifierState('CapsLock'))" />

    <button type="button"
      x-on:click="showPassword = !showPassword"
      class="absolute right-2 top-2.5 inline-flex items-center justify-center h-8 w-9 rounded-md text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-orange-500">
      <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
      <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.216-3.568M6.219 6.219A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.043 5.197M15 12a3 3 0 01-3 3m0-6a3 3 0 013 3M3 3l18 18"/></svg>
    </button>
  </div>

  <p x-show="caps" class="mt-2 text-xs text-amber-600 dark:text-amber-400">Caps Lock aktif</p>
  <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>


          {{-- Remember Me --}}
          <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
              <input id="remember_me" type="checkbox"
                     class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-orange-600 shadow-sm focus:ring-orange-500 dark:focus:ring-orange-600 dark:focus:ring-offset-gray-800"
                     name="remember">
              <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat saya') }}</span>
            </label>
          </div>

          {{-- Submit --}}
          <div class="mt-6">
            <x-primary-button class="w-full justify-center" x-bind:class="loading && 'opacity-70 pointer-events-none'">
              <span x-show="!loading">{{ __('Masuk') }}</span>
              <span x-show="loading" class="inline-flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4A4 4 0 004 12z"></path>
                </svg>
                Memproses…
              </span>
            </x-primary-button>
          </div>
        </form>

        {{-- Footer kecil --}}
        <p class="mt-8 text-xs text-gray-500 dark:text-gray-400">
          Area akses terbatas. Aktivitas diawasi untuk keperluan audit stok &amp; peralatan.
        </p>
      </section>
    </div>
  </div>

  {{-- Tailwind micro-tune untuk komponen Breeze --}}
  <style>
    /* tombol utama -> warna Basarnas */
    .btn-basarnas, .btn-basarnas:where(button), .btn-basarnas:where(a), .btn-basarnas:where(input[type="submit"]) {
      @apply bg-orange-600 hover:bg-orange-700 focus:ring-2 focus:ring-orange-500 text-white font-medium;
    }
  </style>
</x-guest-layout>
