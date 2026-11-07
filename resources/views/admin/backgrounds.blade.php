<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Animasi Background') }}
        </h2>
    </x-slot>

    <div class="bg-white shadow-sm border border-gray-200 rounded-2xl overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30">
            <h2 class="text-xl font-bold text-gray-900">
                Manajemen Elemen Animasi
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Kelola elemen mengambang yang ditampilkan pada halaman Login dan Register untuk desain UI Glassmorphism.
            </p>
        </div>

        <div class="p-8 flex flex-col xl:flex-row gap-12">
            <!-- Form Tambah -->
            <div class="w-full xl:w-1/3">
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 sticky top-8">
                    <h3 class="font-bold text-gray-900 mb-4">Tambah Elemen Baru</h3>
                    <form method="POST" action="{{ route('admin.backgrounds.store') }}" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div>
                            <x-input-label for="type" value="Tipe Elemen" class="text-gray-700 font-semibold" />
                            <select id="type" name="type" onchange="toggleInputType()" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" required>
                                <option value="emoji">Emoji (Teks)</option>
                                <option value="image">Gambar (Upload File)</option>
                                <option value="shape">Bentuk 3D (CSS Shape)</option>
                            </select>
                        </div>
                        
                        <div id="emoji_input_group">
                            <x-input-label for="content" value="Konten Emoji" class="text-gray-700 font-semibold" />
                            <x-text-input id="content" name="content" type="text" class="mt-1 block w-full rounded-xl shadow-sm" placeholder="Contoh: 🚀, ✨" />
                        </div>

                        <div id="image_input_group" style="display: none;">
                            <x-input-label for="image_file" value="Upload File Gambar" class="text-gray-700 font-semibold" />
                            <input id="image_file" name="image_file" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        </div>

                        <div id="shape_input_group" style="display: none;">
                            <x-input-label for="shape_content" value="Pilih Bentuk 3D" class="text-gray-700 font-semibold" />
                            <select id="shape_content" name="shape_content" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                <option value="cube">Kubus (3D Hexagon)</option>
                                <option value="cylinder">Silinder</option>
                                <option value="pyramid">Piramida (Segitiga)</option>
                                <option value="rhombus">Ketupat</option>
                                <option value="sphere">Bola (3D Sphere)</option>
                                <option value="capsule">Kapsul</option>
                                <option value="star">Bintang</option>
                                <option value="hexagon">Segi Enam</option>
                            </select>
                        </div>

                        <script>
                            function toggleInputType() {
                                const type = document.getElementById('type').value;
                                document.getElementById('emoji_input_group').style.display = (type === 'emoji') ? 'block' : 'none';
                                document.getElementById('image_input_group').style.display = (type === 'image') ? 'block' : 'none';
                                document.getElementById('shape_input_group').style.display = (type === 'shape') ? 'block' : 'none';
                            }
                        </script>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-sm">
                            Tambah ke Animasi
                        </button>
                    </form>
                </div>
            </div>

            <!-- List & Settings -->
            <div class="w-full xl:w-2/3 flex flex-col gap-8">
                
                <!-- Settings Form -->
                <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6">
                    <h3 class="font-bold text-indigo-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan Animasi Global
                    </h3>
                    <form method="POST" action="{{ route('admin.backgrounds.settings') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                        @csrf
                        <div>
                            <x-input-label for="speed" value="Kecepatan Animasi" class="text-indigo-800 font-semibold" />
                            <select id="speed" name="speed" class="mt-1 block w-full rounded-xl border-indigo-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                <option value="slow" {{ $speed == 'slow' ? 'selected' : '' }}>Lambat</option>
                                <option value="medium" {{ $speed == 'medium' ? 'selected' : '' }}>Sedang</option>
                                <option value="fast" {{ $speed == 'fast' ? 'selected' : '' }}>Cepat</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="count" value="Jumlah Elemen Tampil" class="text-indigo-800 font-semibold" />
                            <x-text-input id="count" name="count" type="number" min="1" max="100" class="mt-1 block w-full rounded-xl border-indigo-200 shadow-sm" value="{{ $count }}" required />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="shape" value="Bentuk Elemen" class="text-indigo-800 font-semibold" />
                            <select id="shape" name="shape" class="mt-1 block w-full rounded-xl border-indigo-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                <option value="circle" {{ ($shape ?? 'circle') == 'circle' ? 'selected' : '' }}>Bulat</option>
                                <option value="square" {{ ($shape ?? 'circle') == 'square' ? 'selected' : '' }}>Persegi</option>
                                <option value="cube" {{ ($shape ?? 'circle') == 'cube' ? 'selected' : '' }}>Kubus (3D Hexagon)</option>
                                <option value="cylinder" {{ ($shape ?? 'circle') == 'cylinder' ? 'selected' : '' }}>Silinder</option>
                                <option value="pyramid" {{ ($shape ?? 'circle') == 'pyramid' ? 'selected' : '' }}>Piramida (Segitiga)</option>
                                <option value="rhombus" {{ ($shape ?? 'circle') == 'rhombus' ? 'selected' : '' }}>Ketupat</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 flex justify-end mt-2">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-xl transition-colors shadow-sm">
                                Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>

                <div>
                    <h3 class="font-bold text-gray-900 mb-4">Elemen Aktif & Tersimpan</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($backgrounds as $bg)
                        <div class="border {{ $bg->is_active ? 'border-indigo-200 bg-indigo-50/50 shadow-md' : 'border-gray-200 bg-gray-50' }} rounded-2xl p-6 flex flex-col items-center justify-center relative transition-all hover:-translate-y-1">
                            <div class="text-5xl mb-4 h-16 flex items-center justify-center drop-shadow-sm">
                                @if($bg->type == 'emoji')
                                    {{ $bg->content }}
                                @elseif($bg->type == 'shape')
                                    <span class="text-sm font-bold text-indigo-500">{{ ucfirst($bg->content) }}</span>
                                @else
                                    <img src="{{ $bg->content_url }}" class="w-16 h-16 object-cover rounded-full shadow-sm">
                                @endif
                            </div>
                            <div class="flex w-full gap-2 text-xs font-bold">
                                <form method="POST" action="{{ route('admin.backgrounds.toggle', $bg->id) }}" class="flex-1 m-0">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full py-2 rounded-lg transition-colors {{ $bg->is_active ? 'bg-orange-100 text-orange-700 hover:bg-orange-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                        {{ $bg->is_active ? 'Matikan' : 'Aktifkan' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.backgrounds.delete', $bg->id) }}" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
