<x-guest-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Top Bar -->
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
                    <a href="{{ route('article.index') }}" class="hidden sm:inline-flex text-gray-900 px-3 py-2 rounded-lg font-medium">Beranda</a>
                    <a href="{{ route('article.list') }}" class="hidden sm:inline-flex text-gray-600 hover:text-gray-900 px-3 py-2 rounded-lg">Article</a>
                    <a href="{{ url('/login') }}" class="inline-flex items-center gap-2 bg-orange-600 text-white px-4 py-2 rounded-xl hover:bg-orange-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m0 0l4-4m-4 4l4 4m8-8h2a2 2 0 012 2v8a2 2 0 01-2 2h-2"/></svg>
                        Login
                    </a>
                </nav>
            </div>
        </header>

        <!-- Hero -->
        <section class="relative isolate">
            <div class="absolute inset-0 -z-10">
                <img src="{{ asset('images/77250_water-rescue.jpg') }}" alt="Water Rescue" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(11,46,78,0.80),rgba(11,46,78,0.70))]"></div>
                <!-- subtle pattern -->
                <div class="absolute inset-0 mix-blend-overlay opacity-20"
                     style="background-image: radial-gradient(#ffffff22 1px, transparent 1px); background-size: 16px 16px;"></div>
            </div>

            <div class="max-w-7xl mx-auto px-6 py-20 text-white text-center">
                <span class="inline-flex items-center gap-2 bg-white/10 ring-1 ring-white/20 px-3 py-1.5 rounded-full text-sm">
                    <span class="w-2 h-2 rounded-full bg-orange-400 animate-pulse"></span>
                    Manual Book Peralatan Water Rescue
                </span>
                <h2 class="mt-5 text-3xl sm:text-5xl font-bold leading-tight">
                    Panduan Operasional & Perawatan yang <span class="text-orange-300">Ringkas</span> dan <span class="text-orange-300">Terstandar</span>
                </h2>
                <p class="mt-4 max-w-2xl mx-auto text-blue-100">
                    Pelajari prosedur keselamatan, pengoperasian, troubleshooting ringan, dan penyimpanan untuk tiap peralatan SAR.
                </p>

                <!-- Quick search (opsional) -->
                <form action="{{ url('/article') }}" method="GET" class="mt-8 max-w-xl mx-auto">
                    <label class="sr-only" for="q">Cari peralatan</label>
                    <div class="flex rounded-2xl overflow-hidden ring-1 ring-white/20 bg-white/10 backdrop-blur">
                        <input id="q" name="q" type="search" placeholder="Cari: Ring Buoy, Life Jacket, dsb."
                               class="w-full px-4 py-3 bg-transparent text-white placeholder-blue-100/70 focus:outline-none">
                        <button class="px-5 py-3 bg-orange-600 hover:bg-orange-700 transition">Cari</button>
                    </div>
                </form>

                <!-- Hero stats -->
                <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-3xl mx-auto">
                    <div class="bg-white/10 ring-1 ring-white/15 rounded-2xl p-4">
                        <p class="text-2xl font-semibold">{{ $barangCount }}+</p><p class="text-blue-100 text-sm">Jenis peralatan</p>
                    </div>
                    <div class="bg-white/10 ring-1 ring-white/15 rounded-2xl p-4">
                        <p class="text-2xl font-semibold">4</p><p class="text-blue-100 text-sm">Bab utama panduan</p>
                    </div>
                    <div class="bg-white/10 ring-1 ring-white/15 rounded-2xl p-4">
                        <p class="text-2xl font-semibold">100%</p><p class="text-blue-100 text-sm">Fokus keselamatan</p>
                    </div>
                    <div class="bg-white/10 ring-1 ring-white/15 rounded-2xl p-4">
                        <p class="text-2xl font-semibold">24/7</p><p class="text-blue-100 text-sm">Akses cepat</p>
                    </div>
                </div>
            </div>

            <!-- wave divider -->
            <svg class="text-gray-50 -mb-1 block" viewBox="0 0 1440 70" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path fill="currentColor" d="M0,64L60,64C120,64,240,64,360,53.3C480,43,600,21,720,21.3C840,21,960,43,1080,48C1200,53,1320,43,1380,37.3L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"/>
            </svg>
        </section>

        <!-- Stock Cards -->
         <!-- Informasi Stok (modern cards) -->
<!-- Informasi Stok (tabel modern) -->
        <section class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-end justify-between mb-6">
            <h3 class="text-2xl font-semibold text-gray-900">Informasi Stok Peralatan</h3>
            <div class="text-sm text-gray-500">Publik • Tanpa login</div>
            </div>

            @if($stokBarangs->count())
            <div class="overflow-hidden rounded-2xl ring-1 ring-gray-200 bg-white">
                <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 sticky top-0 z-10">
                    <tr class="text-left text-gray-600 uppercase text-xs tracking-wide">
                        <th class="px-5 py-3">Nama Barang</th>
                        <th class="px-5 py-3">Stok</th>
                        <th class="px-5 py-3">Min</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Kecukupan</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @foreach ($stokBarangs as $b)
                        @php
                        $min  = max((int)($b->stok_minimum ?? 0), 0);
                        $stok = max((int)($b->stok ?? 0), 0);
                        $pct  = $min > 0 ? min(100, round(($stok / max($min,1)) * 100)) : ($stok > 0 ? 100 : 0);

                        if ($stok <= 0)      { $badge = ['Habis','bg-red-50 text-red-700 ring-red-100','bg-red-500']; }
                        elseif ($stok < $min){ $badge = ['Low','bg-yellow-50 text-yellow-700 ring-yellow-100','bg-yellow-500']; }
                        else                 { $badge = ['OK','bg-emerald-50 text-emerald-700 ring-emerald-100','bg-emerald-500']; }

                        $satuan = $b->satuan->nama_satuan ?? 'unit';
                        $slug   = $articleMap[$b->nama_barang] ?? null;
                        @endphp
                        <tr class="hover:bg-gray-50/70 transition">
                        <!-- Nama -->
                        <td class="px-5 py-4">
                            <div class="font-medium text-gray-900">{{ $b->nama_barang }}</div>
                            <div class="text-xs text-gray-500">Satuan: {{ $satuan }}</div>
                        </td>

                        <!-- Stok -->
                        <td class="px-5 py-4">
                            <div class="inline-flex items-baseline gap-1">
                            <span class="text-lg font-semibold text-gray-900">{{ $stok }}</span>
                            <span class="text-xs text-gray-500">{{ $satuan }}</span>
                            </div>
                        </td>

                        <!-- Min -->
                        <td class="px-5 py-4">
                            <span class="text-gray-700">{{ $min }}</span>
                        </td>

                        <!-- Status badge -->
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 text-xs px-2 py-1 rounded-full ring-1 {{ $badge[1] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $badge[2] }}"></span>
                            {{ $badge[0] }}
                            </span>
                        </td>

                        <!-- Progress kecukupan -->
                        <td class="px-5 py-4 w-64">
                            <div class="h-2.5 w-full rounded-full bg-gray-100 overflow-hidden ring-1 ring-gray-100">
                            <div class="h-full {{ $badge[2] }} rounded-full" style="width: {{ $pct }}%"></div>
                            </div>
                            <div class="mt-1 text-[11px] text-gray-500">{{ $pct }}% dari kebutuhan minimum</div>
                        </td>

                        <!-- Aksi -->
                        <td class="px-5 py-4 text-right">
                            @if($slug)
                            <a href="{{ route('article.show', $slug) }}"
                                class="inline-flex items-center gap-1.5 text-sm text-gray-700 hover:text-gray-900">
                                Lihat Manual
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M12.293 5.293a1 1 0 011.414 0L18 9.586a2 2 0 010 2.828l-4.293 4.293a1 1 0 01-1.414-1.414L14.586 12H4a1 1 0 110-2h10.586l-2.293-2.293a1 1 0 010-1.414z"/></svg>
                            </a>
                            @else
                            <span class="text-sm text-gray-400">Manual belum tersedia</span>
                            @endif
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>

                <!-- Footer bar di bawah tabel: jumlah & pagination -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 px-5 py-4 bg-white border-t">
                <div class="text-xs text-gray-500">
                    Menampilkan {{ $stokBarangs->firstItem() }}–{{ $stokBarangs->lastItem() }} dari {{ $stokBarangs->total() }} barang
                </div>
                <div>
                    {{ $stokBarangs->onEachSide(1)->links() }}
                </div>
                </div>
            </div>
            @else
            <div class="text-center text-gray-500 py-10">Belum ada data stok peralatan.</div>
            @endif
        </div>
        </section>


   <!-- Grid Cards -->
        <section class="max-w-7xl mx-auto px-6 py-8">
                <div class="flex items-end justify-between mb-6">
                    <h3 class="text-2xl font-semibold text-gray-900">Article Terbaru</h3>
                    <p class="text-sm text-gray-500">Klik “Baca Manual” untuk melihat detail.</p>
                </div>
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
                                        Baca Manual
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M12.293 5.293a1 1 0 011.414 0L18 9.586a2 2 0 010 2.828l-4.293 4.293a1 1 0 01-1.414-1.414L14.586 12H4a1 1 0 110-2h10.586l-2.293-2.293a1 1 0 010-1.414z"/></svg>
                                    </a>
                                    <a href="{{ route('article.show', $a) }}#struktur"
                                       class="text-sm text-gray-500 hover:text-gray-700">Lihat struktur</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
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


        <!-- Info Section -->
        <section class="py-12">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl p-6 ring-1 ring-gray-200">
                        <h5 class="font-semibold text-gray-900">Standar Isi Manual</h5>
                        <ul class="mt-3 space-y-2 text-sm text-gray-600">
                            <li>1. Bagian utama peralatan</li>
                            <li>2. Prosedur keselamatan</li>
                            <li>3. Prosedur operasional</li>
                            <li>4. Troubleshooting ringan</li>
                            <li>5. Penyimpanan</li>
                        </ul>
                    </div>
                    <div class="bg-white rounded-2xl p-6 ring-1 ring-gray-200">
                        <h5 class="font-semibold text-gray-900">Integrasi Sistem</h5>
                        <p class="mt-3 text-sm text-gray-600">
                            Manual book ini terhubung langsung dengan sistem inventaris gudang Basarnas Maumere,
                            sehingga setiap alat dapat ditelusuri kondisi dan riwayat perawatannya.
                        </p>
                    </div>
                    <div class="bg-white rounded-2xl p-6 ring-1 ring-gray-200">
                        <h5 class="font-semibold text-gray-900">Akses Cepat</h5>
                        <p class="mt-3 text-sm text-gray-600">
                            Bisa ditambahkan pencarian, filter kategori, dan role-based access (admin/editor/pembaca).
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="mt-6 border-t bg-white">
            <div class="max-w-7xl mx-auto px-6 py-8 text-sm text-gray-500 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p>© {{ date('Y') }} Basarnas Maumere — Manual Book Peralatan Water Rescue</p>
                <p class="text-gray-400">Studio: <span class="text-orange-600 font-medium">CursedBlessed</span> • Landing Page</p>
            </div>
        </footer>
    </div>
</x-guest-layout>
