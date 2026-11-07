<x-user-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Edit Profil Penyedia Jasa') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('creator.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="avatar" value="Foto Profil (Avatar)" class="font-bold text-gray-700" />
                    <div class="mt-1 flex items-center gap-4">
                        @if($profile->avatar)
                            <img src="{{ $profile->avatar_url }}" class="w-16 h-16 rounded-full object-cover border border-gray-200">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                        <input id="avatar" name="avatar" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" accept="image/*" />
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                </div>

                <!-- Multi-Category Selection (1 - 3 categories) -->
                @php
                    $selectedCategories = old('categories', $profile->categories->pluck('id')->toArray());
                @endphp
                <div class="pt-2">
                    <div class="flex items-center justify-between mb-2">
                        <x-input-label value="Kategori Keahlian Jasa Digital (Pilih 1 s/d 3)" class="font-bold text-gray-900" />
                        <span class="text-xs text-pink-600 font-semibold bg-pink-50 px-2 py-0.5 rounded-full">Wajib dipilih (1-3)</span>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">Pilih keahlian yang Anda sediakan untuk ditampilkan kepada calon Client yang mencari jasa Anda.</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($categories as $category)
                            @php
                                $isChecked = in_array($category->id, $selectedCategories);
                            @endphp
                            <label class="relative flex flex-col p-4 bg-gray-50 hover:bg-pink-50/50 rounded-xl border-2 transition-all cursor-pointer {{ $isChecked ? 'border-pink-500 bg-pink-50/30' : 'border-gray-200' }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        @if($category->name === 'Video Editor')
                                            <span class="p-2 rounded-lg bg-purple-100 text-purple-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                            </span>
                                        @elseif($category->name === 'Foto Editor')
                                            <span class="p-2 rounded-lg bg-blue-100 text-blue-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </span>
                                        @else
                                            <span class="p-2 rounded-lg bg-emerald-100 text-emerald-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                                            </span>
                                        @endif
                                        <span class="font-bold text-gray-900 text-sm">{{ $category->name }}</span>
                                    </div>
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="w-5 h-5 text-pink-600 rounded border-gray-300 focus:ring-pink-500" {{ $isChecked ? 'checked' : '' }}>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('categories')" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="min_price" value="Tarif Mulai Jasa (Rp)" class="font-bold text-gray-700" />
                        <x-text-input id="min_price" name="min_price" type="number" class="mt-1 block w-full rounded-xl" :value="old('min_price', $profile->min_price)" placeholder="Contoh: 250000" />
                        <x-input-error class="mt-2" :messages="$errors->get('min_price')" />
                    </div>

                    <div>
                        <x-input-label for="city" value="Kota / Domisili" class="font-bold text-gray-700" />
                        <x-text-input id="city" name="city" type="text" class="mt-1 block w-full rounded-xl" :value="old('city', $profile->city)" placeholder="Contoh: Jakarta" />
                        <x-input-error class="mt-2" :messages="$errors->get('city')" />
                    </div>
                </div>

                <div>
                    <x-input-label for="bio" value="Bio & Pengalaman Keahlian" class="font-bold text-gray-700" />
                    <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-xl shadow-sm" placeholder="Ceritakan tentang diri Anda, software yang Anda kuasai (Premiere, Photoshop, Figma, Illustrator), dan pengalaman kerja Anda...">{{ old('bio', $profile->bio) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                    <button type="submit" class="px-6 py-2.5 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-xl transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('creator.profile') }}" class="text-gray-500 hover:text-gray-700 font-semibold">
                        Batal
                    </a>
                </div>
            </form>
            
            <div class="mt-12 pt-8 border-t border-gray-100">
                <h3 class="font-bold text-gray-900 mb-2">Pengaturan Akun Dasar</h3>
                <p class="text-sm text-gray-500 mb-4">Jika Anda ingin mengubah nama lengkap, alamat email, atau kata sandi, silakan masuk ke pengaturan akun.</p>
                <a href="{{ route('profile.edit') }}" class="inline-flex px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-900 font-semibold rounded-lg text-sm transition-colors">
                    Pergi ke Pengaturan Akun
                </a>
            </div>
        </div>
    </div>
</x-user-layout>

