<x-guest-layout>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <!-- Header -->
        <header class="bg-white/90 backdrop-blur supports-[backdrop-filter]:bg-white/70 border-b">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/lambang-bpp.png') }}" alt="Basarnas" class="h-9 w-9 rounded-md object-contain ring-1 ring-gray-200">
                    <div class="leading-tight">
                        <p class="text-sm text-gray-500">Kantor Pencarian & Pertolongan</p>
                        <h1 class="text-lg font-semibold text-gray-900">Basarnas Maumere</h1>
                    </div>
                </div>
                <nav class="flex items-center gap-2">
                    <a href="{{ route('article.index') }}" class="hidden sm:inline-flex text-gray-600 hover:text-gray-900 px-3 py-2 rounded-lg">Beranda</a>
                    <a href="{{ route('article.list') }}" class="hidden sm:inline-flex text-gray-900 px-3 py-2 rounded-lg font-medium">Article</a>
                    <a href="{{ url('/login') }}" class="inline-flex items-center gap-2 bg-orange-600 text-white px-4 py-2 rounded-xl hover:bg-orange-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m0 0l4-4m-4 4l4 4m8-8h2a2 2 0 012 2v8a2 2 0 01-2 2h-2"/></svg>
                        Login
                    </a>
                </nav>
            </div>
        </header>

        <main class="flex-1">
            <!-- Toolbar -->
            <section class="max-w-7xl mx-auto px-6 pt-6">
                <form method="GET" action="{{ route('article.index') }}" class="flex items-center gap-2">
                    <input type="search" name="q" value="{{ $q }}"
                           placeholder="Cari: Ring Buoy, Life Jacket, ..."
                           class="w-full sm:w-96 px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <button class="px-4 py-2 rounded-xl bg-orange-600 text-white hover:bg-orange-700">Cari</button>
                    @if($q)
                        <a href="{{ route('article.index') }}" class="px-3 py-2 text-sm text-gray-600 hover:text-gray-900">Reset</a>
                    @endif
                </form>
            </section>

            <!-- Grid Cards -->
            <section class="max-w-7xl mx-auto px-6 py-8">
                @if($articles->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($articles as $a)
                            <article class="group bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 hover:shadow-md hover:ring-orange-200 transition overflow-hidden">
                                <div class="relative h-48 bg-gray-100">
                                    <img src="{{ $a->imageUrl() }}" alt="{{ $a->name }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
                                    <span class="absolute top-3 left-3 text-xs bg-orange-600 text-white px-2 py-1 rounded-full">Water Rescue</span>
                                </div>
                                <div class="p-5">
                                    <h2 class="text-lg font-semibold text-gray-900">{{ $a->name }}</h2>
                                    <p class="mt-1 text-sm text-gray-600">Operasional • Safety • Troubleshooting • Penyimpanan</p>
                                    <div class="mt-4 flex items-center justify-between">
                                        <a href="{{ route('article.show', $a) }}"
                                           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-900 text-white hover:bg-gray-800">
                                            Buka Manual
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M12.293 5.293a1 1 0 011.414 0L18 9.586a2 2 0 010 2.828l-4.293 4.293a1 1 0 01-1.414-1.414L14.586 12H4a1 1 0 110-2h10.586l-2.293-2.293a1 1 0 010-1.414z"/></svg>
                                        </a>
                                        <a href="{{ route('article.show', $a) }}#struktur"
                                           class="text-sm text-gray-500 hover:text-gray-700">Lihat struktur</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-10">
                        {{ $articles->onEachSide(1)->links() }}
                    </div>
                @else
                    <div class="text-center text-gray-500 py-16">
                        @if($q)
                            Tidak ada hasil untuk “<span class="font-semibold">{{ $q }}</span>”.
                        @else
                            Belum ada artikel.
                        @endif
                    </div>
                @endif
            </section>
        </main>

        <!-- Footer (tetap di bawah) -->
        <footer class="mt-6 border-t bg-white">
            <div class="max-w-7xl mx-auto px-6 py-8 text-sm text-gray-500 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p>© {{ date('Y') }} Basarnas Maumere — Manual Book Peralatan Water Rescue</p>
                <p class="text-gray-400">Studio: <span class="text-orange-600 font-medium">CursedBlessed</span> • List Article</p>
            </div>
        </footer>
    </div>
</x-guest-layout>
