<x-user-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Dashboard Penyedia Jasa Digital') }}
        </h2>
    </x-slot>

    <div class="p-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
            <div class="flex items-start gap-5">
                <div class="p-4 bg-pink-50 text-pink-600 rounded-2xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Selamat datang, Creator Digital!</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Kelola keahlian Anda (Video Editor, Foto Editor, Graphic Designer), perbarui portofolio karya, dan terima tawaran proyek menarik langsung dari berbagai Client.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('creator.profile.edit') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-xl transition-colors shadow-sm text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Atur Skill & Profil
                        </a>
                        <a href="{{ route('creator.collaborations') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold rounded-xl transition-colors text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            Lihat Tawaran Proyek
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>

