<x-user-layout>
    @php
        $completedCount = $user->clientEndorsements()->where('status', 'completed')->count();
        $activeCount = $user->clientEndorsements()->whereIn('status', ['pending', 'accepted'])->count();
    @endphp
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <!-- Profile Header -->
        <div class="flex flex-col md:flex-row gap-8 items-start md:items-center mb-12">
            <!-- Avatar -->
            <div class="flex-shrink-0 relative">
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-gradient-to-tr from-purple-500 to-indigo-500 p-1">
                    <div class="w-full h-full rounded-full bg-white flex items-center justify-center border-4 border-white overflow-hidden">
                        @if($profile->avatar)
                            <img src="{{ $profile->avatar_url }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-5xl font-bold text-gray-300">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- User Info & Stats -->
            <div class="flex-1 w-full">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-4">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <a href="{{ route('client.profile.edit') }}" class="inline-block px-4 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-900 font-semibold rounded-lg text-sm transition-colors text-center">
                        Edit Profil Client
                    </a>
                </div>

                <!-- Stats -->
                <div class="flex gap-6 mb-4">
                    <div class="text-center sm:text-left">
                        <span class="font-bold text-gray-900 text-lg">{{ $activeCount }}</span> 
                        <span class="text-gray-600 text-sm">Proyek Berjalan</span>
                    </div>
                    <div class="text-center sm:text-left">
                        <span class="font-bold text-gray-900 text-lg">{{ $completedCount }}</span> 
                        <span class="text-gray-600 text-sm">Proyek Selesai</span>
                    </div>
                </div>

                <!-- Bio -->
                <div>
                    <p class="font-semibold text-gray-900 text-sm">{{ $profile->city ?? 'Lokasi Client Belum Diatur' }}</p>
                    <p class="text-gray-700 mt-1 text-sm whitespace-pre-line">{{ $profile->bio ?? 'Ceritakan tentang profil bisnis atau proyek Anda agar menarik minat para Creator profesional.' }}</p>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="border-t border-gray-200 mb-6">
            <div class="flex justify-center gap-12">
                <button class="py-4 border-t-2 border-gray-900 font-semibold text-gray-900 text-sm uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Media & Aset Brand
                </button>
            </div>
        </div>

        <!-- Grid (Media) -->
        <div x-data="{ activeVideo: null, activeImage: null }">
            <div class="grid grid-cols-3 gap-1 md:gap-4">
                <!-- Upload Form -->
                <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data" class="aspect-square bg-gray-100 rounded-md md:rounded-xl flex flex-col items-center justify-center text-gray-400 border-2 border-dashed border-gray-200 hover:bg-gray-50 transition-colors cursor-pointer group relative overflow-hidden">
                    @csrf
                    <input type="file" name="media" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="this.form.submit()" accept="image/*,video/*">
                    <svg class="w-8 h-8 mb-2 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span class="text-xs font-medium group-hover:text-indigo-500 transition-colors text-center px-2">Upload Media<br><span class="text-[10px] text-gray-400">(Auto-submit)</span></span>
                </form>
                
                <!-- Media Items -->
                @foreach($mediaUploads as $media)
                    <div class="aspect-square bg-gray-100 rounded-md md:rounded-xl relative overflow-hidden group">
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
                        
                        <!-- Delete Button Overlay -->
                        <form action="{{ route('media.destroy', $media->id) }}" method="POST" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 hover:scale-110 transition-all shadow-lg" onclick="return confirm('Hapus media ini?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                @endforeach
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
</x-user-layout>

