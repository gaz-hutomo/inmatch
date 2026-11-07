<x-user-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Edit Profil Profesional') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('influencer.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="primary_category_id" value="Kategori Utama" class="font-bold text-gray-700" />
                        <select id="primary_category_id" name="primary_category_id" class="mt-1 block w-full border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-xl shadow-sm">
                            <option value="">Pilih Kategori...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('primary_category_id', $profile->primary_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('primary_category_id')" />
                    </div>

                    <div>
                        <x-input-label for="secondary_category_id" value="Kategori Pendukung" class="font-bold text-gray-700" />
                        <select id="secondary_category_id" name="secondary_category_id" class="mt-1 block w-full border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-xl shadow-sm">
                            <option value="">Pilih Sub Kategori...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('secondary_category_id', $profile->secondary_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('secondary_category_id')" />
                    </div>
                </div>

                <div>
                    <x-input-label for="min_price" value="Tarif Mulai (Rp)" class="font-bold text-gray-700" />
                    <x-text-input id="min_price" name="min_price" type="number" class="mt-1 block w-full rounded-xl" :value="old('min_price', $profile->min_price)" placeholder="Contoh: 500000" />
                    <x-input-error class="mt-2" :messages="$errors->get('min_price')" />
                </div>

                <div>
                    <x-input-label for="city" value="Kota / Lokasi" class="font-bold text-gray-700" />
                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full rounded-xl" :value="old('city', $profile->city)" placeholder="Contoh: Jakarta" />
                    <x-input-error class="mt-2" :messages="$errors->get('city')" />
                </div>

                <div>
                    <x-input-label for="bio" value="Bio / Tentang Anda" class="font-bold text-gray-700" />
                    <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-xl shadow-sm" placeholder="Ceritakan tentang diri Anda dan konten Anda...">{{ old('bio', $profile->bio) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                    <button type="submit" class="px-6 py-2.5 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-xl transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('influencer.profile') }}" class="text-gray-500 hover:text-gray-700 font-semibold">
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
