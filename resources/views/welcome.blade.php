<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem Penjagaan dan Mesin</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/intimas logo.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/intimas logo.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/intimas logo.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/intimas logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            'instrument': ['Instrument Sans', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-instrument bg-gradient-to-br from-blue-800 to-blue-700 min-h-screen flex items-center justify-center py-4 md:py-0">
        <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-6 text-center max-w-4xl w-[90%] md:w-full mx-4 my-4 md:my-0">
            <div class="mb-8">
                <img src="{{ asset('img/intimas logo.png') }}" alt="Logo Intimas" class="w-20 h-20 md:w-16 md:h-16 mx-auto mb-4 object-contain">
                <h1 class="text-gray-800 text-xl md:text-xl mb-2 font-semibold">Sistem Penjaga dan Mesin</h1>
                <p class="text-gray-600 text-base md:text-sm mb-8">Monitoring Intimas</p>
            </div>

            <div class="flex flex-col md:flex-row gap-3 md:gap-4 justify-center flex-wrap mt-8">
                <a href="/penjaga" class="w-full md:w-auto bg-transparent text-blue-800 border-2 border-blue-800 px-6 py-3 rounded-full text-sm font-medium cursor-pointer transition-all duration-200 no-underline inline-block hover:bg-blue-800 hover:text-white hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-800/30">Penjaga</a>
                <a href="/mesin" class="w-full md:w-auto bg-transparent text-blue-800 border-2 border-blue-800 px-6 py-3 rounded-full text-sm font-medium cursor-pointer transition-all duration-200 no-underline inline-block hover:bg-blue-800 hover:text-white hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-800/30">Mesin</a>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200 text-gray-400 text-xs">
                <p>&copy; {{ date('Y') }} By Yoga Shandana</p>
            </div>
        </div>
</html>
