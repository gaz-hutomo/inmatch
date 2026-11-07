<x-user-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Cari Influencer') }}
        </h2>
    </x-slot>

    <div class="p-8 max-w-7xl mx-auto space-y-8">
        
        <!-- Search Filter Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form method="GET" action="{{ route('vendor.dashboard') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label for="category_id" class="block text-sm font-bold text-gray-700 mb-1">Kategori</label>
                    <select id="category_id" name="category_id" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="budget" class="block text-sm font-bold text-gray-700 mb-1">Maks. Budget (Rp)</label>
                    <input type="number" id="budget" name="budget" value="{{ request('budget') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" placeholder="Contoh: 1000000">
                </div>
                <div>
                    <label for="location" class="block text-sm font-bold text-gray-700 mb-1">Lokasi (Kota)</label>
                    <input type="text" id="location" name="location" value="{{ request('location') }}" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" placeholder="Contoh: Jakarta">
                </div>
                <div>
                    <button type="submit" class="w-full px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari Influencer
                    </button>
                </div>
            </form>
        </div>

        <!-- Search Results Grid -->
        <div>
            @if(request()->has('category_id') || request()->has('budget') || request()->has('location'))
                <h3 class="font-bold text-gray-900 mb-4 text-lg">Hasil Pencarian Teratas</h3>
            @else
                <h3 class="font-bold text-gray-900 mb-4 text-lg">Semua Influencer Tersedia</h3>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($influencers as $influencer)
                    <a href="{{ route('vendor.influencer.show', $influencer->id) }}" class="block bg-white rounded-2xl border border-gray-100 hover:border-indigo-300 hover:shadow-md transition-all overflow-hidden group relative">
                        
                        @if($influencer->match_score !== null)
                            <!-- Match Score Badge -->
                            <div class="absolute top-3 right-3 z-10 px-3 py-1 bg-white/90 backdrop-blur-sm text-indigo-700 font-extrabold text-sm rounded-full shadow-sm border border-indigo-100 flex items-center gap-1">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                {{ $influencer->match_score }}%
                            </div>
                        @endif

                        <div class="aspect-square bg-gradient-to-tr from-pink-500 to-orange-400 flex flex-col items-center justify-center text-white relative overflow-hidden">
                            @if($influencer->profile && $influencer->profile->avatar)
                                <img src="{{ $influencer->profile->avatar_url }}" class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                            @else
                                <!-- Avatar Placeholder -->
                                <span class="text-6xl font-bold opacity-50">{{ strtoupper(substr($influencer->name, 0, 1)) }}</span>
                            @endif
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-indigo-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="px-4 py-2 bg-white text-indigo-900 font-bold rounded-full text-sm">Lihat Profil</span>
                            </div>
                        </div>

                        <div class="p-5">
                            <h4 class="font-bold text-gray-900 text-lg truncate">{{ $influencer->name }}</h4>
                            <p class="text-sm text-gray-500 mb-3 truncate">{{ $influencer->profile->primaryCategory->name ?? 'Kategori Umum' }}</p>
                            
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-1 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="truncate max-w-[80px]">{{ $influencer->profile->city ?? '-' }}</span>
                                </div>
                                <div class="font-bold text-indigo-600">
                                    Rp {{ number_format($influencer->profile->min_price ?? 0, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full bg-white rounded-2xl border border-dashed border-gray-300 p-12 text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-lg font-bold text-gray-900">Tidak Ada Influencer Ditemukan</h3>
                        <p class="text-gray-500 mt-2">Coba sesuaikan filter pencarian Anda, misalnya dengan menaikkan budget atau menghapus filter lokasi.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-user-layout>
