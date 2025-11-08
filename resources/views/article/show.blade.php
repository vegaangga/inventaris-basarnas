{{-- resources/views/article/show.blade.php --}}
<x-guest-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Header (Breadcrumb + Aksi) -->
        <header class="bg-white/90 backdrop-blur supports-[backdrop-filter]:bg-white/70 border-b">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <nav class="text-sm text-gray-500">
                    <a href="{{ route('article.index') }}" class="hover:text-gray-900">Beranda</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('article.list') }}" class="hover:text-gray-900">Article</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-800 font-medium">{{ $article->name }}</span>
                </nav>
                <div class="flex items-center gap-2">
                    <a href="{{ route('article.index') }}" class="px-3 py-1.5 rounded-lg border text-sm text-gray-700 hover:bg-gray-50">← Kembali</a>
                    <button onclick="window.print()" class="px-3 py-1.5 rounded-lg bg-orange-600 text-white text-sm hover:bg-orange-700">Print</button>
                    @auth
                        <a href="{{ route('article.edit',$article) }}" class="px-3 py-1.5 rounded-lg border text-sm text-gray-700 hover:bg-gray-50">Edit</a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Hero -->
        <section class="relative">
            <img src="{{ $article->imageUrl() }}" alt="{{ $article->name }}" class="w-full h-72 object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0B2E4E]/80 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-6">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="text-white">
                        <div class="inline-flex items-center gap-2 bg-white/10 ring-1 ring-white/20 px-3 py-1.5 rounded-full text-xs mb-3">
                            <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                            Water Rescue
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-bold leading-tight">{{ $article->name }}</h1>
                        <p class="text-blue-100 text-sm mt-1">Panduan operasional, keselamatan, troubleshooting, dan penyimpanan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Konten + TOC -->
        <main class="max-w-7xl mx-auto px-6 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Sidebar TOC -->
                <aside class="lg:col-span-3">
                    <div class="lg:sticky lg:top-6 bg-white rounded-2xl ring-1 ring-gray-200 p-5">
                        <h3 class="text-sm font-semibold text-gray-900">Navigasi</h3>
                        <ul class="mt-3 space-y-2 text-sm">
                            <li><a href="#bagian-utama" class="text-gray-600 hover:text-gray-900">1. Bagian Utama</a></li>
                            <li><a href="#safety" class="text-gray-600 hover:text-gray-900">2. Prosedur Keselamatan</a></li>
                            <li><a href="#operasional" class="text-gray-600 hover:text-gray-900">3. Prosedur Operasional</a></li>
                            <li><a href="#troubleshooting" class="text-gray-600 hover:text-gray-900">4. Troubleshooting Ringan</a></li>
                            <li><a href="#penyimpanan" class="text-gray-600 hover:text-gray-900">5. Penyimpanan</a></li>
                        </ul>
                        <div class="mt-5 text-xs text-gray-500">
                            <p>Terakhir diperbarui:</p>
                            <p class="font-medium text-gray-700">{{ $article->updated_at?->format('d M Y') }}</p>
                        </div>
                    </div>
                </aside>

                <!-- Konten Utama -->
                <section class="lg:col-span-9 space-y-6">
                    <!-- Info bar kecil -->
                    <div class="bg-white rounded-xl ring-1 ring-gray-200 px-4 py-3 flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 text-xs text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-70" viewBox="0 0 20 20" fill="currentColor"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 9V5h2v6H9zM9 13h2v2H9v-2z"/></svg>
                            Baca dengan teliti, utamakan keselamatan.
                        </span>
                        <span class="ml-auto inline-flex items-center text-xs bg-orange-50 text-orange-700 px-2 py-1 rounded-full ring-1 ring-orange-100">Manual Resmi</span>
                    </div>

                    <!-- 1. Bagian Utama -->
                    @if(!blank($article->bagian_utama))
                    <article id="bagian-utama" class="bg-white rounded-2xl ring-1 ring-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900">1. Bagian Utama Peralatan</h2>
                        <div class="mt-3 prose max-w-none prose-li:marker:text-gray-400 leading-relaxed text-gray-700">
                            {!! nl2br(e($article->bagian_utama)) !!}
                        </div>
                    </article>
                    @endif

                    <!-- 2. Safety -->
                    @if(!blank($article->safety))
                    <article id="safety" class="bg-white rounded-2xl ring-1 ring-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900">2. Prosedur Keselamatan</h2>
                        <div class="mt-3 prose max-w-none leading-relaxed text-gray-700">
                            {!! nl2br(e($article->safety)) !!}
                        </div>
                        <div class="mt-4 flex items-center gap-2 text-xs text-orange-700 bg-orange-50 ring-1 ring-orange-100 px-3 py-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M11 7h2v6h-2V7zm0 8h2v2h-2v-2z"/></svg>
                            Ingat: APD wajib digunakan sebelum operasional.
                        </div>
                    </article>
                    @endif

                    <!-- 3. Operasional -->
                    @if(!blank($article->operasional))
                    <article id="operasional" class="bg-white rounded-2xl ring-1 ring-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900">3. Prosedur Operasional</h2>
                        <div class="mt-3 prose max-w-none leading-relaxed text-gray-700">
                            {!! nl2br(e($article->operasional)) !!}
                        </div>
                    </article>
                    @endif

                    <!-- 4. Troubleshooting -->
                    @if(!blank($article->troubleshooting))
                    <article id="troubleshooting" class="bg-white rounded-2xl ring-1 ring-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900">4. Troubleshooting Ringan</h2>
                        <div class="mt-3 prose max-w-none leading-relaxed text-gray-700">
                            {!! nl2br(e($article->troubleshooting)) !!}
                        </div>
                    </article>
                    @endif

                    <!-- 5. Penyimpanan -->
                    @if(!blank($article->penyimpanan))
                    <article id="penyimpanan" class="bg-white rounded-2xl ring-1 ring-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900">5. Penyimpanan</h2>
                        <div class="mt-3 prose max-w-none leading-relaxed text-gray-700">
                            {!! nl2br(e($article->penyimpanan)) !!}
                        </div>
                    </article>
                    @endif

                    <!-- CTA bawah -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('article.index') }}" class="inline-flex items-center gap-2 text-gray-700 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M7.707 14.707a1 1 0 01-1.414 0L1.586 10l4.707-4.707a1 1 0 011.414 1.414L4.414 9H18a1 1 0 110 2H4.414l3.293 3.293a1 1 0 010 1.414z"/></svg>
                            Kembali ke daftar
                        </a>
                        <a href="#top" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="text-sm text-gray-500 hover:text-gray-700">Kembali ke atas ↑</a>
                    </div>
                </section>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-6 border-t bg-white">
            <div class="max-w-7xl mx-auto px-6 py-8 text-sm text-gray-500 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p>© {{ date('Y') }} Basarnas Maumere — Manual Book Peralatan Water Rescue</p>
                <p class="text-gray-400">Tema: <span class="text-orange-600 font-medium">Basarnas</span> • Detail Article</p>
            </div>
        </footer>
    </div>
</x-guest-layout>
