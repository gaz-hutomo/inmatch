<x-user-layout>
    <div x-data="{ activeMedia: null, mediaType: null, showPaymentModal: false, selectedPayment: null, paymentStep: 1 }">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('Ruang Diskusi & Negosiasi Proyek') }}
            </h2>
            <a href="{{ (auth()->user()->hasRole('client') || auth()->user()->hasRole('vendor')) ? route('client.collaborations') : route('creator.collaborations') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg text-sm transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Proyek
            </a>
        </div>
    </x-slot>

    @php
        $isClient = auth()->user()->hasRole('client') || auth()->user()->hasRole('vendor');
        $isVendor = $isClient;
        $partner = $isClient ? ($endorsement->creator ?? $endorsement->influencer) : ($endorsement->client ?? $endorsement->vendor);
        $partnerAvatar = $partner && $partner->profile && $partner->profile->avatar ? $partner->profile->avatar_url : null;
    @endphp

    <div class="p-8 max-w-7xl mx-auto flex flex-col lg:flex-row gap-6 items-start">
        <!-- Offer Box -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 w-full lg:w-[350px] shrink-0 sticky top-6">
            <div class="flex items-center gap-2 mb-6 text-indigo-600 font-bold text-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> 
                Offer Box
            </div>

            <div class="space-y-5 text-sm">
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Mitra Proyek</p>
                    <p class="font-bold text-gray-900 text-base">{{ $partner->name ?? 'Partner' }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Deskripsi Kebutuhan Proyek</p>
                    <div class="bg-gray-50 p-3 rounded-lg text-gray-700">
                        {{ $endorsement->description }}
                    </div>
                </div>

                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">Status Proyek</p>
                    <span class="px-3 py-1 rounded-full text-xs font-bold inline-block
                        {{ $endorsement->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $endorsement->status == 'accepted' ? 'bg-indigo-100 text-indigo-700' : '' }}
                        {{ $endorsement->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $endorsement->status == 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                    ">
                        {{ ucfirst($endorsement->status) }}
                    </span>
                </div>

                <div class="bg-indigo-50/50 p-4 rounded-xl border border-indigo-100 text-center">
                    <p class="text-xs text-indigo-400 font-bold uppercase tracking-wider mb-1">Tawaran Harga Saat Ini</p>
                    <p class="font-bold text-2xl text-indigo-900">Rp {{ number_format($endorsement->offered_price, 0, ',', '.') }}</p>
                </div>

                <hr class="border-gray-100">

                <!-- Vendor: Negotiate Price -->
                @if($isVendor && $endorsement->status === 'pending')
                    <form action="{{ route('collaborations.price', $endorsement->id) }}" method="POST">
                        @csrf
                        <label class="block text-xs text-gray-700 font-bold mb-1">Ubah Tawaran Harga (Rp)</label>
                        <input type="number" name="offered_price" value="{{ floor($endorsement->offered_price) }}" min="0" class="w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 mb-3" required>
                        <button type="submit" class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-colors text-sm">
                            Update Tawaran Harga
                        </button>
                    </form>
                @endif

                <!-- Influencer: Accept/Reject Offer -->
                @if(!$isVendor && $endorsement->status === 'pending')
                    <div class="flex gap-2 w-full mb-4">
                        <form action="{{ route('collaborations.accept', $endorsement->id) }}" method="POST" class="flex-1 m-0">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition-colors text-sm">
                                Terima Tawaran
                            </button>
                        </form>
                        <form action="{{ route('collaborations.reject', $endorsement->id) }}" method="POST" class="flex-1 m-0">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-xl transition-colors text-sm border border-red-200">
                                Tolak
                            </button>
                        </form>
                    </div>

                    <form action="{{ route('collaborations.price', $endorsement->id) }}" method="POST">
                        @csrf
                        <label class="block text-xs text-gray-700 font-bold mb-1">Tawarkan Ulang / Counter Price (Rp)</label>
                        <input type="number" name="offered_price" value="{{ floor($endorsement->offered_price) }}" min="0" class="w-full border-gray-300 rounded-lg focus:border-pink-500 focus:ring-pink-500 mb-3" required>
                        <button type="submit" class="w-full px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-lg transition-colors text-sm">
                            Ajukan Counter Price
                        </button>
                    </form>
                @endif

                <!-- Vendor: Pay -->
                @if($isVendor && $endorsement->status === 'accepted')
                    <button type="button" @click="showPaymentModal = true; paymentStep = 1; selectedPayment = null" class="w-full px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-sm">
                        Lakukan Pembayaran
                    </button>
                @endif

                <!-- Active status buttons -->
                @if($endorsement->status === 'active')
                    @if($isVendor)
                        @if(!$endorsement->vendor_completed_at)
                            <form action="{{ route('collaborations.complete', $endorsement->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition-colors shadow-sm">
                                    Selesaikan Proyek
                                </button>
                            </form>
                        @else
                            <div class="w-full px-4 py-3 bg-gray-100 text-gray-500 font-bold rounded-xl text-center border border-gray-200">
                                Menunggu Creator Menyelesaikan...
                            </div>
                        @endif
                    @else
                        @if(!$endorsement->influencer_completed_at)
                            <form action="{{ route('collaborations.complete', $endorsement->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition-colors shadow-sm">
                                    Selesaikan Proyek
                                </button>
                            </form>
                        @else
                            <div class="w-full px-4 py-3 bg-gray-100 text-gray-500 font-bold rounded-xl text-center border border-gray-200">
                                Menunggu Client Menyelesaikan...
                            </div>
                        @endif
                    @endif
                @endif

                <!-- Ratings Section for Completed Collaborations -->
                @if($endorsement->status === 'completed')
                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 text-center">
                        <p class="font-bold text-blue-900 mb-2">Proyek Selesai 🎉</p>
                        
                        @if($endorsement->rating)
                            <div class="bg-white p-3 rounded-lg border border-blue-100">
                                <p class="text-xs text-gray-500 font-bold uppercase mb-1">Penilaian Anda</p>
                                <div class="text-yellow-400 text-lg mb-1">
                                    {{ str_repeat('⭐', $endorsement->rating->score) }} {{ $endorsement->rating->score }}/5
                                </div>
                                <p class="text-sm text-gray-700 italic">"{{ $endorsement->rating->comment }}"</p>
                            </div>
                        @elseif($isVendor)
                            <form action="{{ route('collaborations.rate', $endorsement->id) }}" method="POST" class="mt-3 text-left">
                                @csrf
                                <label class="block text-xs text-gray-700 font-bold mb-1">Berikan Penilaian (1-5)</label>
                                <select name="score" class="w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 mb-2" required>
                                    <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                                    <option value="4">⭐⭐⭐⭐ (4/5)</option>
                                    <option value="3">⭐⭐⭐ (3/5)</option>
                                    <option value="2">⭐⭐ (2/5)</option>
                                    <option value="1">⭐ (1/5)</option>
                                </select>
                                <label class="block text-xs text-gray-700 font-bold mb-1">Catatan</label>
                                <textarea name="comment" rows="2" class="w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 mb-3" placeholder="Pekerjaan bagus..."></textarea>
                                <button type="submit" class="w-full px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-lg transition-colors text-sm">
                                    Kirim Penilaian
                                </button>
                            </form>
                        @endif
                    </div>
                @endif

            </div>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col h-[700px] w-full">
            <!-- Chat Header -->
            <div class="p-4 border-b border-gray-100 flex items-center gap-4 bg-white rounded-t-2xl">
                @if($partnerAvatar)
                    <img src="{{ $partnerAvatar }}" class="w-10 h-10 rounded-full object-cover">
                @else
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                        {{ strtoupper(substr($partner->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <h3 class="font-bold text-gray-900">{{ $partner->name }}</h3>
                    <p class="text-xs text-gray-500">{{ ucfirst($partner->roles->first()->name ?? '') }}</p>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="flex-1 p-6 overflow-y-auto space-y-6 bg-gray-50/50 flex flex-col" id="chat-container">
                @forelse($endorsement->chats as $chat)
                    @if($chat->is_system)
                        <!-- System Message -->
                        <div class="flex justify-center w-full">
                            @if(str_starts_with($chat->message, 'RECEIPT|'))
                                @php
                                    $parts = explode('|', $chat->message);
                                @endphp
                                <div class="bg-white border-2 border-dashed border-gray-300 rounded-xl p-4 max-w-sm w-full shadow-sm">
                                    <div class="text-center font-bold text-gray-800 border-b border-dashed border-gray-300 pb-2 mb-2">
                                        STRUK PEMBAYARAN RESMI
                                    </div>
                                    <div class="text-xs text-gray-600 space-y-1">
                                        <div class="flex justify-between"><span>No. Transaksi</span><span class="font-bold">{{ $parts[1] ?? '-' }}</span></div>
                                        <div class="flex justify-between"><span>Project</span><span>{{ Str::limit($parts[2] ?? '-', 20) }}</span></div>
                                        <div class="flex justify-between font-bold text-indigo-700 mt-1"><span>Total Bayar</span><span>Rp {{ number_format($parts[3] ?? 0, 0, ',', '.') }}</span></div>
                                        <div class="flex justify-between"><span>Metode</span><span class="font-bold uppercase">{{ $parts[4] ?? '-' }}</span></div>
                                        <div class="flex justify-between text-green-600 font-bold"><span>Status</span><span>LUNAS / BERHASIL</span></div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('collaborations.receipt', $endorsement->id) }}" target="_blank" class="block w-full text-center px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-xs font-bold rounded-lg transition-colors">
                                            🖨️ Print Struk
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="bg-gray-200/60 text-gray-600 text-xs text-center rounded-xl px-4 py-3 max-w-lg border border-gray-200 shadow-sm">
                                    <p class="whitespace-pre-wrap leading-relaxed">{{ $chat->message }}</p>
                                    <span class="block mt-1 text-[10px] text-gray-400">{{ $chat->created_at->format('H:i') }}</span>
                                </div>
                            @endif
                        </div>
                    @else
                        @if($chat->sender_id === auth()->id())
                            <!-- My Message -->
                            <div class="flex flex-col items-end">
                                <div class="{{ $isVendor ? 'bg-indigo-600' : 'bg-pink-600' }} text-white rounded-2xl rounded-tr-sm px-5 py-3 max-w-[80%] shadow-sm flex flex-col gap-2">
                                    @if($chat->attachment_path)
                                        @if($chat->attachment_type === 'image')
                                            <img src="{{ asset('storage/' . $chat->attachment_path) }}" @click="activeMedia = '{{ asset('storage/' . $chat->attachment_path) }}'; mediaType = 'image'" class="rounded-lg max-w-full h-auto max-h-60 object-cover cursor-pointer">
                                        @elseif($chat->attachment_type === 'video')
                                            <video src="{{ asset('storage/' . $chat->attachment_path) }}" class="rounded-lg max-w-full h-auto max-h-60 object-cover cursor-pointer" controls></video>
                                        @endif
                                    @endif
                                    @if($chat->message)
                                        <p class="whitespace-pre-wrap">{{ $chat->message }}</p>
                                    @endif
                                </div>
                                <span class="text-[10px] text-gray-400 mt-1 font-medium">{{ $chat->created_at->format('H:i') }}</span>
                            </div>
                        @else
                            <!-- Partner Message -->
                            <div class="flex flex-col items-start">
                                <span class="text-[10px] text-gray-400 mb-1 ml-1 font-medium">{{ $chat->sender->name }}</span>
                                <div class="bg-white text-gray-800 border border-gray-200 rounded-2xl rounded-tl-sm px-5 py-3 max-w-[80%] shadow-sm flex flex-col gap-2">
                                    @if($chat->attachment_path)
                                        @if($chat->attachment_type === 'image')
                                            <img src="{{ asset('storage/' . $chat->attachment_path) }}" @click="activeMedia = '{{ asset('storage/' . $chat->attachment_path) }}'; mediaType = 'image'" class="rounded-lg max-w-full h-auto max-h-60 object-cover cursor-pointer">
                                        @elseif($chat->attachment_type === 'video')
                                            <video src="{{ asset('storage/' . $chat->attachment_path) }}" class="rounded-lg max-w-full h-auto max-h-60 object-cover cursor-pointer" controls></video>
                                        @endif
                                    @endif
                                    @if($chat->message)
                                        <p class="whitespace-pre-wrap">{{ $chat->message }}</p>
                                    @endif
                                </div>
                                <span class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">{{ $chat->created_at->format('H:i') }}</span>
                            </div>
                        @endif
                    @endif
                @empty
                    <div class="flex-1 flex items-center justify-center text-center">
                        <div>
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada pesan.</p>
                            <p class="text-sm text-gray-400 mt-1">Mulai percakapan untuk bernegosiasi.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Chat Input -->
            <div class="p-4 border-t border-gray-100 bg-white rounded-b-2xl relative">
                @error('message')
                    <div class="absolute -top-10 left-4 bg-red-100 text-red-600 text-xs px-3 py-1.5 rounded-lg shadow-sm border border-red-200">
                        {{ $message }}
                    </div>
                @enderror
                <form action="{{ route('collaborations.chat', $endorsement->id) }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3 m-0" x-data="{ fileName: '' }">
                    @csrf
                    <input type="file" name="attachment" id="chat_attachment" class="hidden" accept="image/*,video/*" x-on:change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                    <button type="button" onclick="document.getElementById('chat_attachment').click()" class="p-2.5 text-gray-400 hover:text-gray-600 bg-gray-100 rounded-full transition-colors shrink-0 relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                        <span x-show="fileName" class="absolute -top-1 -right-1 flex h-3 w-3" x-cloak>
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
                        </span>
                    </button>
                    <div class="flex-1 relative flex items-center border border-gray-200 rounded-full bg-white px-5 py-3 shadow-sm focus-within:ring-1 focus-within:ring-indigo-500 focus-within:border-indigo-500 overflow-hidden">
                        <div x-show="fileName" class="absolute left-4 bg-gray-100 px-3 py-1 rounded-full text-xs text-gray-700 font-medium truncate max-w-[150px] z-10" x-text="fileName" x-cloak></div>
                        <input type="text" name="message" class="w-full border-none p-0 focus:ring-0 bg-transparent text-sm relative z-0" placeholder="Tulis pesan..." autocomplete="off" :class="fileName ? 'ml-40' : ''">
                    </div>
                    <button type="submit" class="p-2 {{ $isVendor ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-pink-600 hover:bg-pink-700' }} text-white rounded-full w-12 h-12 flex items-center justify-center font-bold shadow-md transition-colors shrink-0">
                        <svg class="w-5 h-5 ml-[-2px]" fill="currentColor" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Media Modal -->
    <div x-show="activeMedia" class="fixed inset-0 z-50 flex items-center justify-center bg-black/90" x-transition.opacity x-cloak>
        <button @click="activeMedia = null; mediaType = null" class="absolute top-6 right-6 text-white hover:text-gray-300">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="max-w-5xl max-h-[90vh] p-4 flex items-center justify-center">
            <template x-if="mediaType === 'image'">
                <img :src="activeMedia" class="max-w-full max-h-[85vh] rounded-lg shadow-2xl object-contain">
            </template>
            <template x-if="mediaType === 'video'">
                <video :src="activeMedia" class="max-w-full max-h-[85vh] rounded-lg shadow-2xl" controls autoplay></video>
            </template>
        </div>
    </div>

    <!-- Payment Modal -->
    <div x-show="showPaymentModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm" x-transition.opacity x-cloak>
        <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl relative" @click.stop>
            <button @click="showPaymentModal = false; paymentStep = 1; selectedPayment = null" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <h3 class="text-xl font-bold text-gray-900 mb-4" x-text="paymentStep === 1 ? 'Pilih Metode Pembayaran' : 'Selesaikan Pembayaran'"></h3>
            
            <!-- Step 1: Select Method -->
            <div x-show="paymentStep === 1" class="space-y-3">
                <template x-for="method in ['QRIS', 'GoPay', 'OVO', 'Kartu Kredit', 'Kartu Debit']">
                    <button @click="selectedPayment = method; paymentStep = 2" class="w-full flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:border-indigo-500 hover:bg-indigo-50 transition-all text-left group">
                        <span class="font-bold text-gray-700 group-hover:text-indigo-700" x-text="method"></span>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </template>
            </div>
            
            <!-- Step 2: Payment Details -->
            <div x-show="paymentStep === 2">
                <div class="bg-indigo-50 rounded-xl p-4 mb-6 border border-indigo-100 text-center">
                    <p class="text-sm text-indigo-800 mb-1">Total Pembayaran</p>
                    <p class="text-2xl font-bold text-indigo-900">Rp {{ number_format($endorsement->offered_price, 0, ',', '.') }}</p>
                </div>
                
                <!-- QR Code (QRIS, GoPay, OVO) -->
                <template x-if="['QRIS', 'GoPay', 'OVO'].includes(selectedPayment)">
                    <div class="flex flex-col items-center">
                        <p class="text-sm text-gray-600 mb-4 text-center">Scan QR Code di bawah menggunakan aplikasi <span class="font-bold" x-text="selectedPayment"></span> Anda.</p>
                        <div class="p-2 bg-white border border-gray-200 shadow-sm rounded-xl mb-4">
                            <!-- Static QR Code Placeholder -->
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=INMATCH_PAYMENT" alt="QR Code" class="w-48 h-48 rounded-lg">
                        </div>
                        <p class="text-xs text-gray-400 font-bold tracking-widest">INMATCH.ID</p>
                    </div>
                </template>
                
                <!-- Bank Transfer (Kredit, Debit) -->
                <template x-if="['Kartu Kredit', 'Kartu Debit'].includes(selectedPayment)">
                    <div class="space-y-4 text-sm">
                        <p class="text-gray-600 text-center">Silakan transfer menggunakan <span class="font-bold" x-text="selectedPayment"></span> ke rekening berikut:</p>
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-500">Bank</span>
                                <span class="font-bold text-gray-800">BCA</span>
                            </div>
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-500">No. Rekening</span>
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-xl text-indigo-600 tracking-wider">8293 1102 33</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Atas Nama</span>
                                <span class="font-bold text-gray-800">INMATCH.ID</span>
                            </div>
                        </div>
                    </div>
                </template>

                <form action="{{ route('collaborations.pay', $endorsement->id) }}" method="POST" class="mt-6">
                    @csrf
                    <input type="hidden" name="payment_method" :value="selectedPayment">
                    <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-sm">
                        Verifikasi Pembayaran
                    </button>
                    <button type="button" @click="paymentStep = 1" class="w-full py-3 mt-2 text-gray-500 hover:text-gray-700 font-bold text-sm">
                        Ganti Metode
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scroll to bottom script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chatContainer = document.getElementById('chat-container');
            if(chatContainer) {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        });
    </script>
</x-user-layout>
