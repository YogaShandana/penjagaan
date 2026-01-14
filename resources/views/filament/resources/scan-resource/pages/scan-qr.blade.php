<x-filament-panels::page class="scan-qr-page" data-component="scan-qr">
    <div class="scan-qr-wrapper">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Camera Scan Section -->
            <div id="camera-content">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h2 class="text-xl font-semibold text-black flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 16h4"></path>
                            </svg>
                            QR Code Scanner
                        </h2>
                        <p class="text-blue-100 text-sm mt-1">Arahkan kamera ke QR code untuk memindai</p>
                    </div>
                    
                    <!-- Camera Controls -->
                    <div class="px-6 py-4 bg-blue border-b border-blue">
                        <div class="flex flex-wrap gap-3 justify-center">
                            <button 
                                onclick="startQrScanner()" 
                                id="start-qr-btn"
                                class="flex items-center px-4 py-2 bg-blue-500 text-black rounded-lg hover:bg-blue-600 transition-colors shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8m-9-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Start Scanner
                            </button>
                        </div>
                    </div>

                    <!-- Camera Viewport -->
                    <div class="p-6">
                        <!-- Status Display -->
                        <div id="scan-status" class="text-center p-4 mb-4 bg-blue-50 text-blue-700 rounded-lg border border-blue-200">
                            <div class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Klik "Start Scanner" untuk memulai...
                            </div>
                        </div>
                        
                        <!-- Camera Container -->
                        <div class="flex justify-center">
                            <!-- Simple Camera Preview -->
                            <div id="simple-camera" class="relative bg-black rounded-xl overflow-hidden shadow-2xl border-4 border-gray-800" style="display: none; max-width: 500px; width: 100%; height: 300px;">
                                <video 
                                    id="simple-video" 
                                    class="w-full h-full camera-video"
                                    autoplay 
                                    muted 
                                    playsinline>
                                </video>
                                <!-- Scanner Animation Overlay -->
                                <div class="scanner-overlay">
                                    <div class="scanner-frame"></div>
                                    <div class="scanner-line"></div>
                                </div>
                                <!-- Camera Info Overlay -->
                                <div class="absolute top-4 left-4 right-4">
                                    <div class="bg-black bg-opacity-50 text-white px-3 py-2 rounded-lg text-sm">
                                        📷 Kamera Aktif - Arahkan ke QR Code
                                    </div>
                                </div>
                            </div>
                            
                            <!-- QR Scanner Camera -->
                            <div id="camera-container" class="relative bg-black rounded-xl overflow-hidden shadow-2xl border-4 border-gray-800" style="display: none; max-width: 500px; width: 100%; height: 300px;">
                                <div id="camera-feed" class="w-full h-full camera-feed"></div>
                                <!-- Scanner Animation Overlay -->
                                <div class="scanner-overlay-qr">
                                    <div class="scanner-frame"></div>
                                    <div class="scanner-line"></div>
                                </div>
                                <!-- QR Scanner Info Overlay -->
                                <div class="absolute top-4 left-4 right-4">
                                    <div class="bg-black bg-opacity-50 text-white px-3 py-2 rounded-lg text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 16h4"></path>
                                        </svg>
                                        QR Scanner Aktif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Debug Info (collapsible) -->
                        <div class="mt-6">
                            <button onclick="toggleDebug()" class="text-sm text-gray-500 hover:text-gray-700 flex items-center">
                                <svg id="debug-chevron" class="w-4 h-4 mr-1 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                Debug Info
                            </button>
                            <div id="debug-info" class="hidden mt-2 text-xs text-gray-500 p-3 bg-gray-50 rounded-lg border border-gray-200 max-h-40 overflow-y-auto">
                                <div id="debug-text">Debug info akan muncul di sini...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hasil Scan QR -->
            @if($scanResult)
                <div class="bg-white rounded-lg border border-gray-300 p-6">
                    <h3 class="text-lg font-semibold mb-4">Hasil Scan QR Code</h3>
                    
                    @if($scanResult['found'])
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-green-700 font-medium">QR Code Valid</span>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Jenis:</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $scanResult['type'] === 'ims' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ strtoupper($scanResult['type']) }}
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Token:</label>
                                    <span class="text-gray-900 font-mono text-sm">{{ $qrToken }}</span>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Nama Pos:</label>
                                    <span class="text-gray-900">{{ $scanResult['nama_pos'] }}</span>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Nomor Urut:</label>
                                    <span class="text-gray-900">{{ $scanResult['nomor_urut'] }}</span>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Dibuat:</label>
                                    <span class="text-gray-900">{{ $scanResult['created_at']->format('d M Y H:i:s') }}</span>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Terakhir Diupdate:</label>
                                    <span class="text-gray-900">{{ $scanResult['updated_at']->format('d M Y H:i:s') }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="space-y-3">
                            @if(isset($scanResult['status']) && $scanResult['status'] === 'wrong_sequence')
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <span class="text-yellow-700 font-medium">Nomor Urut Tidak Sesuai</span>
                                </div>
                                
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <p class="text-yellow-800">
                                        QR Code valid, tetapi nomor urut tidak sesuai urutan scan.
                                    </p>
                                    <div class="mt-2 grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="font-medium text-yellow-700">Nama Pos:</span>
                                            <span class="text-yellow-800">{{ $scanResult['nama_pos'] }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-yellow-700">Nomor urut QR ini:</span>
                                            <span class="text-yellow-800">{{ $scanResult['actual_urut'] }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-yellow-700">Nomor urut yang diharapkan:</span>
                                            <span class="text-yellow-800">{{ $scanResult['expected_urut'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @elseif(isset($scanResult['status']) && $scanResult['status'] === 'wrong_type')
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                    <span class="text-orange-700 font-medium">Jenis QR Tidak Sesuai</span>
                                </div>
                                
                                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                    <p class="text-orange-800">
                                        QR Code yang di-scan adalah jenis <strong>{{ $scanResult['actual'] }}</strong>, 
                                        tetapi Anda memilih untuk scan <strong>{{ $scanResult['expected'] }}</strong>.
                                    </p>
                                    <p class="text-orange-700 mt-2">
                                        Nama Pos: <strong>{{ $scanResult['nama_pos'] }}</strong>
                                    </p>
                                </div>
                            @else
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <span class="text-red-700 font-medium">QR Code Tidak Valid</span>
                                </div>
                                
                                <p class="text-gray-600">
                                    Token QR "<span class="font-mono bg-gray-100 px-1 rounded">{{ $qrToken }}</span>" tidak ditemukan dalam sistem.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>

    <style>
        #scan-region {
            max-width: 400px; /* match video max-width */
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            right: auto;
            width: 100%;
            height: 300px; /* match video height */
        }
        
        #camera-feed {
            background-color: #000;
            min-height: 300px;
            height: 300px;
            transform: scaleX(-1);
            -webkit-transform: scaleX(-1);
        }
        
        #camera-container {
            background-color: #000;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        
        /* Ensure video is visible */
        video {
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        /* Responsive Camera Heights */
        .camera-video {
            height: 300px;
            object-fit: cover;
        }
        
        .camera-feed {
            height: 300px;
            transform: scaleX(-1);
            -webkit-transform: scaleX(-1);
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .camera-video {
                height: 280px;
            }
            
            .camera-feed {
                height: 280px;
            }
            
            #simple-camera {
                max-width: 100% !important;
                margin: 0 -1rem;
                height: 280px !important;
            }
            
            #camera-container {
                max-width: 100% !important;
                margin: 0 -1rem;
                height: 280px !important;
            }
        }
        
        /* Small Mobile */
        @media (max-width: 480px) {
            .camera-video {
                height: 240px;
            }
            
            .camera-feed {
                height: 240px;
            }
            
            #simple-camera {
                height: 240px !important;
            }
            
            #camera-container {
                height: 240px !important;
            }
        }
        
        /* Scanner Animation Overlay */
        .scanner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        
        .scanner-overlay-qr {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        
        /* Scanner Frame - Hidden */
        .scanner-frame {
            display: none;
        }
        
        .scanner-frame::before,
        .scanner-frame::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 50px;
            border: 3px solid #22c55e;
        }
        
        /* Top-left corner */
        .scanner-frame::before {
            top: 0;
            left: 0;
            border-right: none;
            border-bottom: none;
        }
        
        /* Bottom-right corner */
        .scanner-frame::after {
            bottom: 0;
            right: 0;
            border-left: none;
            border-top: none;
        }
        
        /* Top-right and bottom-left corners using pseudo elements */
        .scanner-frame {
            position: relative;
        }
        
        .scanner-frame::before,
        .scanner-frame::after,
        .scanner-frame:first-child::before,
        .scanner-frame:first-child::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 50px;
            border: 3px solid #22c55e;
        }
        
        /* All four corners */
        .scanner-frame::before {
            top: 0;
            left: 0;
            border-right: none;
            border-bottom: none;
        }
        
        .scanner-frame::after {
            top: 0;
            right: 0;
            border-left: none;
            border-bottom: none;
        }
        
        .scanner-frame {
            box-shadow: 
                inset 50px 0 0 -47px #22c55e,
                inset -50px 0 0 -47px #22c55e,
                inset 0 50px 0 -47px #22c55e,
                inset 0 -50px 0 -47px #22c55e,
                inset 50px 50px 0 -47px #22c55e,
                inset -50px 50px 0 -47px #22c55e,
                inset 50px -50px 0 -47px #22c55e,
                inset -50px -50px 0 -47px #22c55e;
        }
        
        /* Simpler frame approach */
        .scanner-frame {
            box-shadow: none;
            border: none;
        }
        
        .scanner-frame::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(to right, #22c55e 3px, transparent 3px, transparent calc(100% - 3px), #22c55e calc(100% - 3px)),
                linear-gradient(to bottom, #22c55e 3px, transparent 3px, transparent calc(100% - 3px), #22c55e calc(100% - 3px));
            opacity: 0;
            animation: frameAppear 2s ease-in-out infinite;
        }
        
        /* Corner brackets only */
        .scanner-frame::before {
            background: none;
            box-shadow:
                /* Top-left corner */
                0 0 0 3px #22c55e inset,
                50px 0 0 -47px transparent inset,
                0 50px 0 -47px transparent inset,
                /* Top-right corner */
                -50px 0 0 -47px transparent inset,
                0 0 0 3px #22c55e inset,
                0 50px 0 -47px transparent inset,
                /* Bottom-left corner */
                0 -50px 0 -47px transparent inset,
                50px 0 0 -47px transparent inset,
                0 0 0 3px #22c55e inset,
                /* Bottom-right corner */
                -50px 0 0 -47px transparent inset,
                0 -50px 0 -47px transparent inset,
                0 0 0 3px #22c55e inset;
        }
        
        /* Much simpler corner approach */
        .scanner-frame {
            border: none;
            background: none;
        }
        
        .scanner-frame::before,
        .scanner-frame::after {
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            border: 3px solid #22c55e;
            opacity: 0.8;
        }
        
        .scanner-frame::before {
            top: -3px;
            left: -3px;
            border-right: none;
            border-bottom: none;
            animation: pulse 2s ease-in-out infinite;
        }
        
        .scanner-frame::after {
            bottom: -3px;
            right: -3px;
            border-left: none;
            border-top: none;
            animation: pulse 2s ease-in-out infinite 1s;
        }
        
        /* Additional corners using box-shadow */
        .scanner-frame {
            position: relative;
        }
        
        .scanner-frame {
            box-shadow:
                /* Top-right corner */
                calc(250px - 30px) -3px 0 -247px #22c55e,
                calc(250px - 3px) -3px 0 -247px #22c55e,
                calc(250px - 3px) 27px 0 -247px #22c55e,
                /* Bottom-left corner */
                -3px calc(250px - 30px) 0 -247px #22c55e,
                27px calc(250px - 3px) 0 -247px #22c55e,
                -3px calc(250px - 3px) 0 -247px #22c55e;
        }
        
        /* Scanning Line Animation */
        .scanner-line {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 400px;
            height: 6px;
            background: linear-gradient(90deg, transparent, #22c55e, transparent);
            box-shadow: 0 0 15px #22c55e;
            animation: scannerMove 2s ease-in-out infinite;
            opacity: 0.9;
        }
        
        @keyframes scannerMove {
            0% {
                top: calc(50% - 200px);
                opacity: 0;
            }
            25% {
                opacity: 1;
            }
            50% {
                top: calc(50% + 200px);
                opacity: 1;
            }
            75% {
                opacity: 1;
            }
            100% {
                top: calc(50% - 200px);
                opacity: 0;
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 0.8;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.1);
            }
        }
        
        @keyframes frameAppear {
            0%, 100% {
                opacity: 0.6;
            }
            50% {
                opacity: 1;
            }
        }
    </style>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        let html5QrCode = null;
        let isScanning = false;
        let simpleStream = null;
        let lastScanTime = 0;
        let lastScannedToken = '';
        const SCAN_COOLDOWN = 3000; // 3 seconds cooldown between scans

        function addDebugInfo(message) {
            const debugText = document.getElementById('debug-text');
            debugText.innerHTML += new Date().toLocaleTimeString() + ': ' + message + '<br>';
            console.log(message);
            
            // Auto scroll to bottom
            debugText.scrollTop = debugText.scrollHeight;
        }

        function toggleDebug() {
            const debugInfo = document.getElementById('debug-info');
            const debugChevron = document.getElementById('debug-chevron');
            
            if (debugInfo.classList.contains('hidden')) {
                debugInfo.classList.remove('hidden');
                debugChevron.classList.add('rotate-90');
            } else {
                debugInfo.classList.add('hidden');
                debugChevron.classList.remove('rotate-90');
            }
        }

        function updateStatus(message, type = 'info') {
            const status = document.getElementById('scan-status');
            const colors = {
                'info': 'bg-blue-50 text-blue-700 border-blue-200',
                'success': 'bg-green-50 text-green-700 border-green-200',
                'error': 'bg-red-50 text-red-700 border-red-200',
                'warning': 'bg-yellow-50 text-yellow-700 border-yellow-200'
            };
            
            status.className = `text-center p-4 mb-4 rounded-lg border ${colors[type]}`;
            
            const icons = {
                'info': `<svg class="animate-spin -ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`,
                'success': `<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`,
                'error': `<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>`,
                'warning': `<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>`
            };
            
            status.innerHTML = `<div class="flex items-center justify-center">${icons[type]}${message}</div>`;
        }

        function testCameraOnly() {
            addDebugInfo('Testing camera access...');
            updateStatus('Testing akses kamera...', 'info');

            navigator.mediaDevices.getUserMedia({ 
                video: {
                    width: { ideal: 640 },
                    height: { ideal: 480 }
                } 
            })
            .then(function(stream) {
                addDebugInfo('✓ Camera access successful!');
                updateStatus('✓ Kamera berhasil diakses! Klik "Start Scanner"', 'success');
                
                // Stop the test stream
                stream.getTracks().forEach(track => track.stop());
            })
            .catch(function(err) {
                addDebugInfo('✗ Camera test failed: ' + err.message);
                updateStatus('✗ Gagal akses kamera: ' + err.message, 'error');
            });
        }

        function startSimpleCamera() {
            addDebugInfo('Starting simple camera...');
            const simpleCamera = document.getElementById('simple-camera');
            const simpleVideo = document.getElementById('simple-video');
            const status = document.getElementById('scan-status');

            status.textContent = 'Memulai kamera...';
            status.style.color = '#6b7280';

            navigator.mediaDevices.getUserMedia({
                video: {
                    width: { ideal: 640 },
                    height: { ideal: 480 },
                    facingMode: 'user' // Use front camera for laptop
                }
            })
            .then(function(stream) {
                addDebugInfo('Simple camera started successfully');
                simpleStream = stream;
                simpleVideo.srcObject = stream;
                simpleCamera.style.display = 'block';
                
                document.getElementById('start-btn').style.display = 'none';
                document.getElementById('stop-btn').style.display = 'inline-block';
                
                status.textContent = 'Kamera aktif! Arahkan ke QR Code dan klik "Scan QR Code"';
                status.style.color = '#16a34a';
            })
            .catch(function(err) {
                addDebugInfo('Simple camera failed: ' + err.message);
                status.textContent = 'Error: ' + err.message;
                status.style.color = '#dc2626';
            });
        }

        function captureAndScan() {
            const status = document.getElementById('scan-status');
            const simpleCamera = document.getElementById('simple-camera');
            const cameraContainer = document.getElementById('camera-container');
            
            addDebugInfo('Switching to QR scanner mode...');
            status.textContent = 'Memulai QR scanner...';
            status.style.color = '#6b7280';

            // Hide simple camera
            simpleCamera.style.display = 'none';
            
            // Stop simple stream
            if (simpleStream) {
                simpleStream.getTracks().forEach(track => track.stop());
                simpleStream = null;
            }

            // Start QR scanner
            startQrScanner();
        }

        function startQrScanner() {
            const cameraContainer = document.getElementById('camera-container');
            const status = document.getElementById('scan-status');

            try {
                cameraContainer.style.display = 'block';
                html5QrCode = new Html5Qrcode("camera-feed");
                addDebugInfo('QR Scanner instance created');

                const config = {
                    fps: 10,
                    qrbox: { width: 300, height: 300 },
                    aspectRatio: 1.0
                };

                html5QrCode.start(
                    { facingMode: "user" }, // Use front camera for laptop
                    config,
                    (decodedText, decodedResult) => {
                        addDebugInfo('QR Code detected: ' + decodedText);
                        
                        // Debounce: Prevent duplicate scans of same QR within cooldown period
                        const currentTime = Date.now();
                        if (decodedText === lastScannedToken && (currentTime - lastScanTime) < SCAN_COOLDOWN) {
                            addDebugInfo('Duplicate scan ignored (cooldown active)');
                            return;
                        }
                        
                        lastScannedToken = decodedText;
                        lastScanTime = currentTime;
                        
                        updateStatus('🎉 QR Code berhasil di-scan!', 'success');
                        
                        // Stop scanning immediately to prevent multiple reads
                        setTimeout(() => {
                            stopCamera();
                        }, 500);
                        
                        // Send to Livewire - Updated approach with specific component targeting
                        try {
                            let component = null;
                            
                            // Method 1: Target specific scan component by class or data attribute
                            const scanPageElement = document.querySelector('.scan-qr-page') || 
                                                   document.querySelector('[data-component="scan-qr"]') ||
                                                   document.querySelector('div[wire\\:id]');
                                                   
                            if (scanPageElement && window.Livewire && window.Livewire.find) {
                                const wireId = scanPageElement.getAttribute('wire:id');
                                if (wireId) {
                                    component = window.Livewire.find(wireId);
                                    addDebugInfo('Found specific scan component: ' + wireId);
                                }
                            }
                            
                            // Method 2: Use Livewire Wire directive with @this
                            if (!component) {
                                try {
                                    // Try to use @this if available in Alpine context
                                    if (window.Alpine && document.querySelector('[x-data]')) {
                                        const alpineEl = document.querySelector('[x-data]');
                                        if (alpineEl && alpineEl.__livewire) {
                                            component = alpineEl.__livewire;
                                            addDebugInfo('Found Alpine Livewire component');
                                        }
                                    }
                                } catch (alpineErr) {
                                    addDebugInfo('Alpine method failed: ' + alpineErr.message);
                                }
                            }
                            
                            // Method 3: Use Livewire.all() to find correct component
                            if (!component && window.Livewire && window.Livewire.all) {
                                const allComponents = window.Livewire.all();
                                // Look for component that has qrToken property or processQrScan method
                                component = allComponents.find(comp => 
                                    comp.hasOwnProperty('qrToken') || 
                                    comp.get('qrToken') !== undefined ||
                                    comp.__instance.effects.path.includes('scan')
                                );
                                if (component) {
                                    addDebugInfo('Found component via Livewire.all()');
                                }
                            }
                            
                            if (component) {
                                // Set the token and process
                                if (typeof component.set === 'function') {
                                    component.set('qrToken', decodedText);
                                    addDebugInfo('Set qrToken to: ' + decodedText);
                                }
                                
                                if (typeof component.call === 'function') {
                                    component.call('processQrScan');
                                    addDebugInfo('Called processQrScan method');
                                } else if (typeof component.call === 'function') {
                                    component.call('handleQrScanned', decodedText);
                                    addDebugInfo('Called handleQrScanned method');
                                } else {
                                    addDebugInfo('No suitable method found on component');
                                }
                            } else {
                                addDebugInfo('No suitable Livewire component found, trying emit');
                                
                                // Try global emit as fallback
                                if (window.Livewire && window.Livewire.emit) {
                                    try {
                                        window.Livewire.emit('qrScanned', decodedText);
                                        addDebugInfo('Emitted qrScanned event globally');
                                    } catch (emitErr) {
                                        addDebugInfo('Emit failed: ' + emitErr.message);
                                    }
                                }
                                
                                // Fallback: Try to trigger via direct form submission
                                const form = document.querySelector('form');
                                const tokenInput = document.querySelector('input[wire\\:model*="qrToken"]') || 
                                                 document.querySelector('input[wire\\:model*="data.qrToken"]') ||
                                                 document.querySelector('input[name*="qrToken"]');
                                                 
                                if (tokenInput) {
                                    tokenInput.value = decodedText;
                                    tokenInput.dispatchEvent(new Event('input', { bubbles: true }));
                                    tokenInput.dispatchEvent(new Event('change', { bubbles: true }));
                                    addDebugInfo('Updated form input and triggered events');
                                    
                                    // Try to submit form or trigger form processing
                                    if (form) {
                                        setTimeout(() => {
                                            const submitBtn = form.querySelector('button[type="submit"]');
                                            if (submitBtn) {
                                                submitBtn.click();
                                                addDebugInfo('Triggered form submission');
                                            }
                                        }, 100);
                                    }
                                } else {
                                    addDebugInfo('No suitable input field found');
                                }
                            }
                            
                        } catch (err) {
                            addDebugInfo('Livewire error: ' + err.message);
                            console.error('Full Livewire error:', err);
                        }
                    },
                    (errorMessage) => {
                        // Ignore scan errors
                    }
                ).then(() => {
                    addDebugInfo('QR Scanner started successfully');
                    isScanning = true;
                    status.textContent = 'QR Scanner aktif! Arahkan ke QR Code...';
                    status.style.color = '#2563eb';
                }).catch(err => {
                    addDebugInfo('QR Scanner failed: ' + err.message);
                    status.textContent = 'QR Scanner error: ' + err.message;
                    status.style.color = '#dc2626';
                    stopCamera();
                });

            } catch (err) {
                addDebugInfo('QR Scanner initialization error: ' + err.message);
                status.textContent = 'Error: ' + err.message;
                status.style.color = '#dc2626';
            }
        }

        function startCamera() {
            const cameraContainer = document.getElementById('camera-container');
            const cameraOverlay = document.getElementById('camera-overlay');
            const videoElement = document.getElementById('camera-feed');
            const startBtn = document.getElementById('start-btn');
            const stopBtn = document.getElementById('stop-btn');
            const status = document.getElementById('scan-status');
            
            addDebugInfo('Starting camera...');
            
            // Show camera container and overlay
            cameraContainer.style.display = 'block';
            cameraOverlay.style.display = 'flex';
            
            // Show loading status
            status.textContent = 'Menginisialisasi kamera...';
            status.style.color = '#6b7280';
            
            // Check if browser supports camera
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                status.textContent = 'Browser tidak mendukung akses kamera';
                status.style.color = '#dc2626';
                addDebugInfo('Browser does not support camera access');
                return;
            }
            
            try {
                // First try to get camera stream manually to test
                navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: 'environment',
                        width: { ideal: 400 },
                        height: { ideal: 300 }
                    } 
                }).then(stream => {
                    addDebugInfo('Manual camera stream obtained successfully');
                    
                    // Test if video can display the stream
                    videoElement.srcObject = stream;
                    videoElement.play();
                    
                    // Stop the test stream
                    setTimeout(() => {
                        stream.getTracks().forEach(track => track.stop());
                        videoElement.srcObject = null;
                        
                        // Now start the QR scanner
                        initializeQrScanner();
                    }, 2000);
                    
                }).catch(err => {
                    addDebugInfo('Manual camera test failed: ' + err.message);
                    status.textContent = 'Error: Tidak dapat mengakses kamera - ' + err.message;
                    status.style.color = '#dc2626';
                    resetCameraUI();
                });
                
            } catch (err) {
                addDebugInfo('Error initializing camera: ' + err.message);
                status.textContent = 'Error: Gagal inisialisasi kamera. ' + (err.message || '');
                status.style.color = '#dc2626';
                resetCameraUI();
            }
        }
        
        function initializeQrScanner() {
            const cameraOverlay = document.getElementById('camera-overlay');
            const startBtn = document.getElementById('start-btn');
            const stopBtn = document.getElementById('stop-btn');
            const status = document.getElementById('scan-status');
            
            try {
                html5QrCode = new Html5Qrcode("camera-feed");
                addDebugInfo('Html5Qrcode instance created');
                
                Html5Qrcode.getCameras().then(cameras => {
                    addDebugInfo('Cameras found: ' + cameras.length);
                    
                    if (cameras && cameras.length > 0) {
                        // Try to use back camera first, then any camera
                        let selectedCamera = cameras.find(camera => 
                            camera.label && (camera.label.toLowerCase().includes('back') || camera.label.toLowerCase().includes('environment'))
                        ) || cameras[0];
                        
                        addDebugInfo('Using camera: ' + (selectedCamera.label || selectedCamera.id));
                        
                        const config = {
                            fps: 10,
                            qrbox: { width: 250, height: 250 },
                            aspectRatio: 1.0,
                            disableFlip: false,
                            videoConstraints: {
                                facingMode: 'environment',
                                width: { ideal: 400 },
                                height: { ideal: 300 }
                            }
                        };
                        
                        html5QrCode.start(
                            selectedCamera.id,
                            config,
                            (decodedText, decodedResult) => {
                                addDebugInfo('QR Code detected: ' + decodedText);
                                
                                // QR code successfully scanned
                                status.textContent = 'QR Code berhasil di-scan!';
                                status.style.color = '#16a34a';
                                
                                // Set the token and process (using Livewire)
                                try {
                                    if (window.Livewire && window.Livewire.find) {
                                        const component = window.Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id'));
                                        if (component) {
                                            component.set('qrToken', decodedText);
                                            component.call('processQrScan');
                                            addDebugInfo('QR token sent to Livewire component');
                                        } else {
                                            addDebugInfo('Livewire component not found');
                                        }
                                    } else {
                                        addDebugInfo('Livewire not available');
                                    }
                                } catch (err) {
                                    addDebugInfo('Error sending to Livewire: ' + err.message);
                                }
                                
                                // Stop scanning after successful scan
                                setTimeout(() => {
                                    stopCamera();
                                }, 1500);
                            },
                            (errorMessage) => {
                                // Ignore scan errors (normal when no QR code in view)
                            }
                        ).then(() => {
                            addDebugInfo('QR Scanner started successfully');
                            isScanning = true;
                            cameraOverlay.style.display = 'none';
                            startBtn.style.display = 'none';
                            stopBtn.style.display = 'inline-block';
                            status.textContent = 'Arahkan kamera ke QR Code...';
                            status.style.color = '#2563eb';
                        }).catch(err => {
                            addDebugInfo('Unable to start QR scanning: ' + err.message);
                            status.textContent = 'Error: ' + (err.message || 'Tidak dapat memulai scan QR. Pastikan kamera berfungsi.');
                            status.style.color = '#dc2626';
                            resetCameraUI();
                        });
                        
                    } else {
                        addDebugInfo('No cameras found on device');
                        status.textContent = 'Error: Kamera tidak ditemukan pada perangkat ini.';
                        status.style.color = '#dc2626';
                        resetCameraUI();
                    }
                }).catch(err => {
                    addDebugInfo('Error getting cameras: ' + err.message);
                    status.textContent = 'Error: Tidak dapat mengakses daftar kamera. ' + (err.message || '');
                    status.style.color = '#dc2626';
                    resetCameraUI();
                });
                
            } catch (err) {
                addDebugInfo('Error initializing QR scanner: ' + err.message);
                status.textContent = 'Error: Gagal inisialisasi QR scanner. ' + (err.message || '');
                status.style.color = '#dc2626';
                resetCameraUI();
            }
        }

        function stopCamera() {
            const simpleCamera = document.getElementById('simple-camera');
            const cameraContainer = document.getElementById('camera-container');
            const startBtn = document.getElementById('start-qr-btn');
            const stopBtn = document.getElementById('stop-btn');
            
            addDebugInfo('Stopping camera...');
            
            // Stop simple stream
            if (simpleStream) {
                simpleStream.getTracks().forEach(track => track.stop());
                simpleStream = null;
                addDebugInfo('Simple stream stopped');
            }
            
            // Stop QR scanner
            if (html5QrCode && isScanning) {
                html5QrCode.stop().then(() => {
                    addDebugInfo('QR Scanner stopped');
                    html5QrCode = null;
                }).catch(err => {
                    addDebugInfo('Error stopping QR scanner: ' + err.message);
                });
            }
            
            // Reset UI
            isScanning = false;
            simpleCamera.style.display = 'none';
            cameraContainer.style.display = 'none';
            startBtn.style.display = 'inline-flex';
            stopBtn.style.display = 'none';
            
            updateStatus('Scanner dihentikan. Klik "Start Scanner" untuk scan lagi.', 'info');
        }

        // Auto start on page load - start QR scanner directly
        document.addEventListener('DOMContentLoaded', function() {
            addDebugInfo('Page loaded - starting QR scanner...');
            
            setTimeout(() => {
                // Show debug and status by default
                document.getElementById('scan-status').style.display = 'block';
                
                // Try to start QR scanner directly instead of simple camera
                startQrScanner();
            }, 1000);
        });

        // Handle page visibility change
        document.addEventListener('visibilitychange', function() {
            if (document.hidden && (isScanning || simpleStream)) {
                addDebugInfo('Page hidden - stopping camera');
                stopCamera();
            }
        });
    </script>
</x-filament-panels::page>