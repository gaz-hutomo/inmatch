<x-user-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Edit Profil Client') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('client.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="avatar" value="Logo / Foto Profil Client" class="font-bold text-gray-700" />
                    <div class="mt-1 flex items-center gap-4">
                        @if($profile->avatar)
                            <img src="{{ $profile->avatar_url }}" class="w-16 h-16 rounded-full object-cover border border-gray-200">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <input id="avatar" name="avatar" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" />
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                </div>

                <div>
                    <x-input-label for="city" value="Kota / Domisili Client" class="font-bold text-gray-700" />
                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full rounded-xl" :value="old('city', $profile->city)" placeholder="Contoh: Jakarta" />
                    <x-input-error class="mt-2" :messages="$errors->get('city')" />
                </div>

                <div>
                    <x-input-label for="bio" value="Deskripsi Bisnis / Profil Singkat" class="font-bold text-gray-700" />
                    <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" placeholder="Ceritakan tentang profil bisnis atau proyek Anda...">{{ old('bio', $profile->bio) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('client.profile') }}" class="text-gray-500 hover:text-gray-700 font-semibold">
                        Batal
                    </a>
                </div>
            </form>

            <div class="mt-12 pt-8 border-t border-gray-100">
                <h3 class="font-bold text-gray-900 mb-2">Pengaturan Akun Dasar</h3>
                <p class="text-sm text-gray-500 mb-4">Jika Anda ingin mengubah nama akun, alamat email, atau kata sandi, silakan masuk ke pengaturan akun dasar.</p>
                <a href="{{ route('profile.edit') }}" class="inline-flex px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-900 font-semibold rounded-lg text-sm transition-colors">
                    Pergi ke Pengaturan Akun Dasar
                </a>
            </div>
        </div>
    </div>
</x-user-layout>

