<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- QR Scanner Card -->
            <a href="{{ route('filament.penjaga.resources.scans.select-type') }}" 
               class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="bg-blue-100 rounded-lg p-3 group-hover:bg-blue-200 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 16h4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">Scan QR Code</h3>
                        <p class="text-sm text-gray-500">Pindai kode QR</p>
                    </div>
                </div>
            </a>

            <!-- Rekapan Card -->
            <a href="{{ route('filament.penjaga.resources.rekapans.index') }}" 
               class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="bg-yellow-100 rounded-lg p-3 group-hover:bg-yellow-200 transition-colors">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">Rekapan Scan</h3>
                        <p class="text-sm text-gray-500">Laporan aktivitas</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h2>
            </div>
            <div class="p-6">
                @php
                    $recentScans = \App\Models\Rekapan::with(['user', 'ims', 'mjs'])
                        ->latest()
                        ->limit(5)
                        ->get();
                @endphp
                
                @if($recentScans->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentScans as $scan)
                            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                                <div class="flex items-center">
                                    <div class="bg-blue-100 rounded-lg p-2 mr-4">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 16h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">
                                            {{ $scan->user->name ?? 'User' }} scan 
                                        </p>
                                        <p class="text-sm text-gray-500">{{ $scan->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Success
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-gray-500">Belum ada aktivitas scan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>