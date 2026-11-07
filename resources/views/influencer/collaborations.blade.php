<x-user-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Daftar Kolaborasi') }}
        </h2>
    </x-slot>

    <div class="p-8 max-w-5xl mx-auto">
        <div class="space-y-6">
            @forelse($endorsements as $endorsement)
                <div class="bg-white rounded-2xl shadow-sm border {{ $endorsement->status == 'pending' ? 'border-pink-200 bg-pink-50/10' : 'border-gray-100' }} p-6 flex flex-col md:flex-row gap-6 items-start md:items-center">
                    
                    <div class="flex-shrink-0">
                        @if($endorsement->vendor->profile && $endorsement->vendor->profile->avatar)
                            <img src="{{ $endorsement->vendor->profile->avatar_url }}" class="w-16 h-16 rounded-full object-cover shadow-sm border border-indigo-100">
                        @else
                            <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xl">
                                {{ strtoupper(substr($endorsement->vendor->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="font-bold text-lg text-gray-900">{{ $endorsement->vendor->name }}</h3>
                            <span class="px-3 py-1 rounded-full text-xs font-bold 
                                {{ $endorsement->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $endorsement->status == 'accepted' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $endorsement->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $endorsement->status == 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                            ">
                                {{ ucfirst($endorsement->status) }}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-3">{{ $endorsement->description }}</p>
                        <p class="font-bold text-gray-900">Tarif Ditawarkan: <span class="text-pink-600">Rp {{ number_format($endorsement->offered_price, 0, ',', '.') }}</span></p>
                    </div>

                    <div class="flex-1 flex flex-col items-end mt-4 md:mt-0 md:ml-6 md:border-l border-gray-100 md:pl-6 gap-3">
                        <a href="{{ route('collaborations.show', $endorsement->id) }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-xl transition-colors shadow-sm text-sm w-full md:w-auto">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            Buka Chat / Negosiasi
                        </a>
                        @if($endorsement->status === 'pending')
                            <div class="flex gap-2 w-full md:w-auto">
                                <form action="{{ route('collaborations.accept', $endorsement->id) }}" method="POST" class="flex-1 md:flex-none m-0">
                                    @csrf
                                    <button type="submit" class="w-full px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition-colors shadow-sm text-sm">
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('collaborations.reject', $endorsement->id) }}" method="POST" class="flex-1 md:flex-none m-0">
                                    @csrf
                                    <button type="submit" class="w-full px-6 py-2 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-xl transition-colors text-sm border border-red-200">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-12 text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <h3 class="text-lg font-bold text-gray-900">Belum Ada Tawaran</h3>
                    <p class="text-gray-500 mt-2">Anda belum menerima tawaran kolaborasi dari Vendor manapun. Terus perbarui portofolio Anda!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-user-layout>
