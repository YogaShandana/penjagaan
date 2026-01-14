<x-filament-panels::page class="select-type-page">
    <div class="select-type-wrapper" style="max-width: 600px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--primary); margin-bottom: 0.5rem;">
                Pilih Jenis Scan QR Code
            </h2>
            <p style="color: var(--gray-500);">
                Silakan pilih jenis QR yang akan Anda scan
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 2rem;">
            <!-- IMS Button -->
            <a href="{{ route('filament.penjaga.resources.scans.scan', ['type' => 'ims']) }}" 
               style="text-decoration: none;">
                <div class="type-card" 
                     style="background: #1e40af; 
                            padding: 3rem 2rem; 
                            border-radius: 1rem; 
                            text-align: center; 
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                            cursor: pointer;
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);"
                     onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)';">
                    
                    <!-- Icon -->
                    <div style="margin-bottom: 1.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             fill="none" 
                             viewBox="0 0 24 24" 
                             stroke-width="1.5" 
                             stroke="white" 
                             style="width: 4rem; height: 4rem; margin: 0 auto;">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                        </svg>
                    </div>
                    
                    <!-- Title -->
                    <h3 style="color: white; 
                               font-size: 2rem; 
                               font-weight: 700; 
                               margin-bottom: 0.5rem;
                               text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        IMS
                    </h3>
                    
                    <!-- Description -->
                    <p style="color: rgba(255, 255, 255, 0.9); 
                              font-size: 0.875rem;
                              margin: 0;">
                        Scan QR Code IMS
                    </p>
                </div>
            </a>

            <!-- MJS Button -->
            <a href="{{ route('filament.penjaga.resources.scans.scan', ['type' => 'mjs']) }}" 
               style="text-decoration: none;">
                <div class="type-card" 
                     style="background: black; 
                            padding: 3rem 2rem; 
                            border-radius: 1rem; 
                            text-align: center; 
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                            cursor: pointer;
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);"
                     onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)';">
                    
                    <!-- Icon -->
                    <div style="margin-bottom: 1.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             fill="none" 
                             viewBox="0 0 24 24" 
                             stroke-width="1.5" 
                             stroke="white" 
                             style="width: 4rem; height: 4rem; margin: 0 auto;">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                        </svg>
                    </div>
                    
                    <!-- Title -->
                    <h3 style="color: white; 
                               font-size: 2rem; 
                               font-weight: 700; 
                               margin-bottom: 0.5rem;
                               text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        MJS
                    </h3>
                    
                    <!-- Description -->
                    <p style="color: rgba(255, 255, 255, 0.9); 
                              font-size: 0.875rem;
                              margin: 0;">
                        Scan QR Code MJS
                    </p>
                </div>
            </a>
        </div>

        <!-- Additional Info -->
        <div style="margin-top: 3rem; text-align: center; padding: 1rem; background-color: var(--gray-50); border-radius: 0.5rem;">
            <p style="color: var(--gray-600); font-size: 0.875rem; margin: 0;">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     fill="none" 
                     viewBox="0 0 24 24" 
                     stroke-width="1.5" 
                     stroke="currentColor" 
                     style="width: 1.25rem; height: 1.25rem; display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                    <path stroke-linecap="round" 
                          stroke-linejoin="round" 
                          d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                Pilih salah satu untuk mulai scan QR Code
            </p>
        </div>
    </div>

    <style>
        @media (max-width: 640px) {
            .select-type-wrapper > div:first-child {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</x-filament-panels::page>
