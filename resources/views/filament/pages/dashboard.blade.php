<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- User Management Card -->
            <a href="{{ route('filament.admin.resources.users.index') }}" 
               class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="bg-purple-100 rounded-lg p-3 group-hover:bg-purple-200 transition-colors">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">Kelola User</h3>
                        <p class="text-sm text-gray-500">Manajemen User & Role</p>
                    </div>
                </div>
            </a>

            <!-- IMS Penjaga Management Card -->
            <a href="{{ route('filament.admin.resources.ims-penjagas.index') }}" 
               class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="bg-green-100 rounded-lg p-3 group-hover:bg-green-200 transition-colors">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">IMS Penjaga</h3>
                        <p class="text-sm text-gray-500">QR Code IMS Penjaga</p>
                    </div>
                </div>
            </a>

            <!-- IMS Mesin Management Card -->
            <a href="{{ route('filament.admin.resources.ims-mesins.index') }}" 
               class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="bg-blue-100 rounded-lg p-3 group-hover:bg-blue-200 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">IMS Mesin</h3>
                        <p class="text-sm text-gray-500">QR Code IMS Mesin</p>
                    </div>
                </div>
            </a>

            <!-- MJS Penjaga Management Card -->
            <a href="{{ route('filament.admin.resources.mjs-penjagas.index') }}" 
               class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="bg-green-100 rounded-lg p-3 group-hover:bg-green-200 transition-colors">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">MJS Penjaga</h3>
                        <p class="text-sm text-gray-500">QR Code MJS Penjaga</p>
                    </div>
                </div>
            </a>

            <!-- MJS Mesin Management Card -->
            <a href="{{ route('filament.admin.resources.mjs-mesins.index') }}" 
               class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="bg-blue-100 rounded-lg p-3 group-hover:bg-blue-200 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">MJS Mesin</h3>
                        <p class="text-sm text-gray-500">QR Code MJS Mesin</p>
                    </div>
                </div>
            </a>

            <!-- Rekapan Penjaga Card -->
            <a href="{{ route('filament.admin.resources.rekapan-penjagas.index') }}" 
               class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="bg-yellow-100 rounded-lg p-3 group-hover:bg-yellow-200 transition-colors">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">Rekapan Penjaga</h3>
                        <p class="text-sm text-gray-500">Laporan scan penjaga</p>
                    </div>
                </div>
            </a>

            <!-- Rekapan Mesin Card -->
            <a href="{{ route('filament.admin.resources.rekapan-mesins.index') }}" 
               class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="bg-orange-100 rounded-lg p-3 group-hover:bg-orange-200 transition-colors">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-900">Rekapan Mesin</h3>
                        <p class="text-sm text-gray-500">Laporan scan mesin</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Quick Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total IMS</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Ims::count() }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-lg p-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total MJS</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Mjs::count() }}</p>
                    </div>
                    <div class="bg-green-100 rounded-lg p-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Scan Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Rekapan::whereDate('created_at', today())->count() }}</p>
                    </div>
                    <div class="bg-purple-100 rounded-lg p-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 16h4"></path>
                        </svg>
                    </div>
                </div>
            </div>
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