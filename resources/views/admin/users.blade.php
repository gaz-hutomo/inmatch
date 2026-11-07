<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <div class="bg-white shadow-sm border border-gray-200 rounded-2xl overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    Persetujuan & Manajemen Akun
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola akses akun client dan creator di platform.
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white text-gray-400 text-xs uppercase tracking-wider font-semibold border-b border-gray-200">
                        <th class="px-8 py-4">Pengguna</th>
                        <th class="px-8 py-4">Peran (Role)</th>
                        <th class="px-8 py-4">Status</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-100">
                    @foreach($users as $user)
                        @if(!$user->hasRole('admin'))
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-8 py-4">
                                <p class="font-bold text-gray-900">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </td>
                            <td class="px-8 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ ($user->hasRole('client') || $user->hasRole('vendor')) ? 'bg-indigo-100 text-indigo-700' : 'bg-pink-100 text-pink-700' }}">
                                    {{ ($user->hasRole('client') || $user->hasRole('vendor')) ? 'Client' : (($user->hasRole('creator') || $user->hasRole('influencer')) ? 'Creator' : ucfirst($user->roles->first()->name ?? '-')) }}
                                </span>
                            </td>
                            <td class="px-8 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $user->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $user->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $user->status === 'banned' ? 'bg-red-100 text-red-700' : '' }}
                                ">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="px-8 py-4 flex justify-end gap-3">
                                <form method="POST" action="{{ route('admin.users.updateStatus', $user->id) }}" class="m-0">
                                    @csrf
                                    @method('PATCH')
                                    @if($user->status !== 'approved')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="text-green-600 bg-green-50 hover:bg-green-100 px-4 py-2 rounded-lg font-bold text-sm transition-colors">Setujui</button>
                                    @endif
                                </form>
                                <form method="POST" action="{{ route('admin.users.updateStatus', $user->id) }}" class="m-0">
                                    @csrf
                                    @method('PATCH')
                                    @if($user->status !== 'banned')
                                        <input type="hidden" name="status" value="banned">
                                        <button type="submit" class="text-red-600 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-lg font-bold text-sm transition-colors">Blokir</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
