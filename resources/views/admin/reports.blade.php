<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('Manajemen Laporan & Sengketa') }}
            </h2>
            @if(isset($pendingCount) && $pendingCount > 0)
                <span class="px-3 py-1 bg-red-100 text-red-700 font-bold text-xs rounded-full">
                    {{ $pendingCount }} Laporan Menunggu Ditinjau
                </span>
            @endif
        </div>
    </x-slot>

    @if(session('status'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-semibold flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white shadow-sm border border-gray-200 rounded-2xl overflow-hidden" x-data="{ activeProof: null }">
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/30 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    Daftar Pengaduan Masalah Pengguna
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Tinjau sengketa kerja sama, dugaan pelanggaran, atau ketidaksesuaian hasil kerja.
                </p>
            </div>
            
            <!-- Status Filter Tabs -->
            <div class="flex items-center gap-2 text-xs font-semibold">
                <a href="{{ route('admin.reports') }}" class="px-3 py-1.5 rounded-lg transition-colors {{ !request('status') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Semua</a>
                <a href="{{ route('admin.reports', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-lg transition-colors {{ request('status') === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Pending</a>
                <a href="{{ route('admin.reports', ['status' => 'reviewed']) }}" class="px-3 py-1.5 rounded-lg transition-colors {{ request('status') === 'reviewed' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Ditinjau</a>
                <a href="{{ route('admin.reports', ['status' => 'resolved']) }}" class="px-3 py-1.5 rounded-lg transition-colors {{ request('status') === 'resolved' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Selesai</a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white text-gray-400 text-xs uppercase tracking-wider font-semibold border-b border-gray-200">
                        <th class="px-6 py-4">Pelapor & Terlapor</th>
                        <th class="px-6 py-4">Proyek Terkait</th>
                        <th class="px-6 py-4">Alasan & Rincian</th>
                        <th class="px-6 py-4">Bukti Lampiran</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Tindakan Admin</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-100 text-sm">
                    @forelse($reports as $report)
                        <tr class="hover:bg-gray-50/70 transition-colors">
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <p class="font-bold text-gray-900 flex items-center gap-1.5">
                                        <span class="text-xs text-gray-400 font-normal">Dari:</span>
                                        {{ $report->reporter->name ?? 'User Dihapus' }}
                                    </p>
                                    <p class="font-bold text-red-600 flex items-center gap-1.5">
                                        <span class="text-xs text-gray-400 font-normal">Terlapor:</span>
                                        {{ $report->reported->name ?? 'User Dihapus' }}
                                        @if($report->reported && $report->reported->status === 'banned')
                                            <span class="text-[10px] bg-red-100 text-red-700 px-1.5 py-0.5 rounded font-bold">Banned</span>
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-400">{{ $report->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($report->endorsement)
                                    <p class="font-bold text-indigo-700 text-xs mb-1">#TX-IM-{{ $report->endorsement->id }}</p>
                                    <p class="text-xs text-gray-600 line-clamp-2 max-w-xs">{{ $report->endorsement->description }}</p>
                                @else
                                    <span class="text-xs text-gray-400 italic">Tidak terikat proyek</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 max-w-sm">
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded font-bold text-xs inline-block mb-1">
                                    {{ $report->reason }}
                                </span>
                                <p class="text-xs text-gray-700 whitespace-pre-line">{{ $report->description }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($report->proof_path)
                                    @php $url = asset('storage/' . $report->proof_path); @endphp
                                    <button type="button" @click="activeProof = '{{ $url }}'" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 underline flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat Bukti
                                    </button>
                                @else
                                    <span class="text-xs text-gray-400 italic">Tanpa lampiran</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold
                                    {{ $report->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $report->status === 'reviewed' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $report->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}
                                ">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex flex-col items-end gap-2">
                                    <form method="POST" action="{{ route('admin.reports.updateStatus', $report->id) }}" class="flex items-center gap-1.5">
                                        @csrf
                                        @method('PATCH')
                                        
                                        @if($report->status === 'pending')
                                            <input type="hidden" name="status" value="reviewed">
                                            <button type="submit" class="px-3 py-1 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold rounded-lg text-xs transition-colors">Tandai Ditinjau</button>
                                        @elseif($report->status === 'reviewed')
                                            <input type="hidden" name="status" value="resolved">
                                            <button type="submit" class="px-3 py-1 bg-green-50 hover:bg-green-100 text-green-700 font-bold rounded-lg text-xs transition-colors">Tandai Selesai</button>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Kasus Tuntas</span>
                                        @endif
                                    </form>

                                    <!-- Option to Ban Reported User if still active -->
                                    @if($report->reported && $report->reported->status !== 'banned')
                                        <form method="POST" action="{{ route('admin.reports.updateStatus', $report->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin memblokir akun terlapor?')">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="resolved">
                                            <input type="hidden" name="ban_reported" value="1">
                                            <button type="submit" class="px-2.5 py-1 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-lg text-[11px] transition-colors border border-red-200">
                                                Blokir Terlapor
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="font-bold text-gray-600">Tidak ada laporan sengketa ditemukan</p>
                                <p class="text-xs text-gray-400 mt-1">Platform berjalan aman tanpa adanya pengaduan tertunda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reports->hasPages())
            <div class="p-6 border-t border-gray-100">
                {{ $reports->links() }}
            </div>
        @endif

        <!-- Proof Preview Modal -->
        <template x-if="activeProof">
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" @click="activeProof = null">
                <div class="relative bg-white rounded-2xl max-w-3xl max-h-[90vh] overflow-hidden p-4" @click.stop>
                    <div class="flex justify-between items-center pb-2 mb-2 border-b">
                        <span class="font-bold text-sm text-gray-800">Bukti Lampiran Pengaduan</span>
                        <button type="button" @click="activeProof = null" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    <div class="overflow-auto max-h-[75vh] flex justify-center">
                        <img :src="activeProof" class="max-w-full rounded-lg object-contain">
                    </div>
                </div>
            </div>
        </template>
    </div>
</x-admin-layout>
