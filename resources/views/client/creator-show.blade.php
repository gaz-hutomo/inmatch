<x-user-layout>
    @php
        $avgRating = $creator->ratingsReceived()->avg('score') ?? 0;
        $ratingCount = $creator->ratingsReceived()->count();
    @endphp
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column: Creator Profile -->
            <div class="flex-1 space-y-8">
                <!-- Header -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row gap-6 items-start md:items-center">
                    <div class="flex-shrink-0 relative">
                        <div class="w-32 h-32 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 p-1">
                            <div class="w-full h-full rounded-full bg-white flex items-center justify-center border-4 border-white overflow-hidden">
                                @if($creator->profile && $creator->profile->avatar)
                                    <img src="{{ $creator->profile->avatar_url }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-5xl font-bold text-gray-300">{{ strtoupper(substr($creator->name, 0, 1)) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 w-full">
                        <h1 class="text-2xl font-bold text-gray-900 mb-1">{{ $creator->name }}</h1>
                        
                        <!-- Skill Badges -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            @if($creator->profile && $creator->profile->categories)
                                @forelse($creator->profile->categories as $cat)
                                    <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full border border-indigo-100 flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                        {{ $cat->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-gray-400 italic">Penyedia Jasa Umum</span>
                                @endforelse
                            @endif
                        </div>
                        
                        <div class="flex gap-6 mb-4">
                            <div class="text-center md:text-left">
                                <span class="font-bold text-gray-900 text-lg">{{ $creator->creatorEndorsements()->where('status', 'completed')->count() }}</span> 
                                <span class="text-gray-600 text-sm">Proyek Selesai</span>
                            </div>
                            <div class="text-center md:text-left">
                                <span class="font-bold text-gray-900 text-lg flex items-center justify-center md:justify-start gap-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> 
                                    {{ number_format($avgRating, 1) }}
                                </span> 
                                <span class="text-gray-600 text-sm">Rating ({{ $ratingCount }})</span>
                            </div>
                            <div class="text-center md:text-left">
                                <span class="font-bold text-gray-900 text-lg">Rp {{ number_format($creator->profile->min_price ?? 0, 0, ',', '.') }}</span> 
                                <span class="text-gray-600 text-sm">Tarif Mulai</span>
                            </div>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 flex items-center gap-1 text-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $creator->profile->city ?? 'Lokasi Belum Diatur' }}
                            </p>
                            <p class="text-gray-700 mt-2 text-sm whitespace-pre-line">{{ $creator->profile->bio ?? 'Tidak ada deskripsi bio.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Grid -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Portofolio & Hasil Karya
                    </h3>
                    <div x-data="{ activeVideo: null, activeImage: null }">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        @forelse($creator->mediaUploads as $media)
                            <div class="aspect-square bg-gray-100 rounded-lg relative overflow-hidden group">
                                @if($media->file_type === 'video')
                                    <div class="w-full h-full cursor-pointer" @click="activeVideo = '{{ $media->file_url }}'">
                                        <video src="{{ $media->file_url }}" class="w-full h-full object-cover" muted loop onmouseover="this.play()" onmouseout="this.pause()"></video>
                                        <div class="absolute top-2 right-2 text-white drop-shadow-md">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full h-full cursor-pointer" @click="activeImage = '{{ $media->file_url }}'">
                                        <img src="{{ $media->file_url }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-full py-8 text-center text-gray-500">
                                Creator ini belum mengunggah karya portofolio.
                            </div>
                        @endforelse
                        </div>

                        <!-- Media Modal -->
                        <template x-if="activeVideo || activeImage">
                            <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 p-4" @click="activeVideo = null; activeImage = null" x-transition>
                                <div class="relative w-full max-w-5xl flex justify-center" @click.stop>
                                    <button @click="activeVideo = null; activeImage = null" class="absolute -top-10 right-0 text-white hover:text-gray-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                    <template x-if="activeVideo">
                                        <video :src="activeVideo" class="w-full rounded-lg shadow-2xl" controls autoplay></video>
                                    </template>
                                    <template x-if="activeImage">
                                        <img :src="activeImage" class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Right Column: Project Proposal Form -->
            <div class="w-full lg:w-96 flex-shrink-0">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-indigo-100 sticky top-24">
                    <h3 class="font-bold text-indigo-900 mb-4 text-xl flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Kirim Tawaran Proyek
                    </h3>
                    <p class="text-sm text-gray-600 mb-6">Tertarik merekrut creator ini? Kirimkan detail kebutuhan proyek Anda langsung ke mereka.</p>

                    @if(session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('client.endorsements.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="creator_id" value="{{ $creator->id }}">

                        <div>
                            <label for="offered_price" class="block text-sm font-bold text-gray-700 mb-1">Tawaran Budget (Rp)</label>
                            <input type="number" id="offered_price" name="offered_price" required class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm" placeholder="Contoh: {{ $creator->profile->min_price ?? 500000 }}">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Kebutuhan Proyek</label>
                            <textarea id="description" name="description" rows="5" required class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm" placeholder="Jelaskan detail brief proyek (misal: durasi video yang diedit, style desain, jumlah revisi, dan deadline)..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-sm mt-4 text-sm">
                            Kirim Tawaran Proyek
                        </button>
                        <p class="text-xs text-center text-gray-500 mt-2">Tawaran akan berstatus 'Pending' hingga diterima oleh creator.</p>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-user-layout>

