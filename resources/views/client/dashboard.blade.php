<x-user-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Cari Penyedia Jasa Digital') }}
        </h2>
    </x-slot>

    <div class="p-8 max-w-7xl mx-auto space-y-8">
        
        <!-- Search Filter Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form method="GET" action="{{ route('client.dashboard') }}" class="space-y-5">
                
                @php
                    $selectedCats = (array) request('categories', []);
                    if (request()->has('category_id') && empty($selectedCats)) {
                        $selectedCats = [request('category_id')];
                    }
                    $selectedCats = array_map('intval', array_filter($selectedCats));
                    $hasAnyFilter = !empty($selectedCats) || request()->filled('budget') || request()->filled('location');
                @endphp

                <!-- Kategori Keahlian (Desain A: Clickable Badge/Pill Checkboxes) -->
                <div>
                    <div class="flex items-center justify-between mb-2.5">
                        <label class="block text-sm font-bold text-gray-800">
                            Kategori Keahlian yang Dicari <span class="text-xs text-gray-500 font-normal">(Centang 1 atau lebih keahlian)</span>
                        </label>
                        @if($hasAnyFilter)
                            <a href="{{ route('client.dashboard') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-semibold flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Reset Filter
                            </a>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        @foreach($categories as $category)
                            @php
                                $isChecked = in_array($category->id, $selectedCats);
                            @endphp
                            <label x-data="{ checked: {{ $isChecked ? 'true' : 'false' }} }"
                                   :class="checked ? 'border-indigo-600 bg-indigo-50/60 shadow-sm' : 'border-gray-200 bg-gray-50/50 hover:bg-gray-100/70 hover:border-gray-300'"
                                   class="relative flex items-center justify-between p-3.5 rounded-xl border-2 transition-all cursor-pointer">
                                <div class="flex items-center gap-3">
                                    @if($category->name === 'Video Editor')
                                        <span :class="checked ? 'bg-indigo-600 text-white' : 'bg-purple-100 text-purple-700'" class="p-2 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        </span>
                                    @elseif($category->name === 'Foto Editor')
                                        <span :class="checked ? 'bg-indigo-600 text-white' : 'bg-blue-100 text-blue-700'" class="p-2 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </span>
                                    @else
                                        <span :class="checked ? 'bg-indigo-600 text-white' : 'bg-emerald-100 text-emerald-700'" class="p-2 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                                        </span>
                                    @endif
                                    <span :class="checked ? 'text-indigo-950 font-extrabold' : 'text-gray-700'" class="font-bold text-sm">{{ $category->name }}</span>
                                </div>
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" @change="checked = $event.target.checked" class="w-4 h-4 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500 cursor-pointer" {{ $isChecked ? 'checked' : '' }}>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Budget, Location & Submit -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-1 items-end">
                    <div>
                        <label for="budget" class="block text-sm font-bold text-gray-700 mb-1">Maks. Budget (Rp)</label>
                        <input type="number" id="budget" name="budget" value="{{ request('budget') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm" placeholder="Contoh: 1000000">
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-bold text-gray-700 mb-1">Lokasi (Kota)</label>
                        <input type="text" id="location" name="location" value="{{ request('location') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm" placeholder="Contoh: Jakarta">
                    </div>
                    <div>
                        <button type="submit" class="w-full px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Search Results Grid -->
        <div>
            @if($hasAnyFilter)
                <h3 class="font-bold text-gray-900 mb-4 text-lg">Hasil Pencarian Teratas</h3>
            @else
                <h3 class="font-bold text-gray-900 mb-4 text-lg">Semua Penyedia Jasa Tersedia</h3>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($creators as $creator)
                    <a href="{{ route('client.creator.show', $creator->id) }}" class="flex flex-col h-full bg-white rounded-2xl border border-gray-100 hover:border-indigo-300 hover:shadow-md transition-all overflow-hidden group relative">
                        
                        @if($creator->match_score !== null)
                            <!-- Match Score Badge -->
                            <div class="absolute top-3 right-3 z-10 px-3 py-1 bg-white/90 backdrop-blur-sm text-indigo-700 font-extrabold text-sm rounded-full shadow-sm border border-indigo-100 flex items-center gap-1">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                {{ $creator->match_score }}%
                            </div>
                        @endif

                        <div class="aspect-square bg-gradient-to-tr from-indigo-500 to-purple-500 flex flex-col items-center justify-center text-white relative overflow-hidden shrink-0">
                            @if($creator->profile && $creator->profile->avatar)
                                <img src="{{ $creator->profile->avatar_url }}" class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                            @else
                                <span class="text-6xl font-bold opacity-50">{{ strtoupper(substr($creator->name, 0, 1)) }}</span>
                            @endif
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-indigo-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="px-4 py-2 bg-white text-indigo-900 font-bold rounded-full text-sm">Lihat Portofolio</span>
                            </div>
                        </div>

                        <div class="p-5 flex flex-col flex-1 justify-between">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg truncate mb-2" title="{{ $creator->name }}">{{ $creator->name }}</h4>
                                
                                <!-- Skill Badges with fixed min-height for uniform alignment across 1, 2, or 3 skills -->
                                <div class="min-h-[52px] flex flex-wrap content-start items-start gap-1.5">
                                    @if($creator->profile && $creator->profile->categories)
                                        @forelse($creator->profile->categories as $cat)
                                            <span class="text-[11px] font-semibold bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-md leading-tight">
                                                {{ $cat->name }}
                                            </span>
                                        @empty
                                            <span class="text-[11px] text-gray-400 italic">Jasa Umum</span>
                                        @endforelse
                                    @else
                                        <span class="text-[11px] text-gray-400 italic">Jasa Umum</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between text-sm pt-3 border-t border-gray-100 mt-4">
                                <div class="flex items-center gap-1 text-gray-600">
                                    <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="truncate max-w-[90px]">{{ $creator->profile->city ?? '-' }}</span>
                                </div>
                                <div class="font-bold text-indigo-600 shrink-0">
                                    Mulai Rp {{ number_format($creator->profile->min_price ?? 0, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full bg-white rounded-2xl border border-dashed border-gray-300 p-12 text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-lg font-bold text-gray-900">Tidak Ada Penyedia Jasa Ditemukan</h3>
                        <p class="text-gray-500 mt-2">Coba sesuaikan filter kategori keahlian atau naikkan budget pencarian Anda.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-user-layout>

