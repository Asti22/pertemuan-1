<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tugas Pertemuan 1 - Asti Nurul Utami</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] border rounded-sm text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18]">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] border rounded-sm text-sm">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow">
            <main class="flex max-w-[335px] w-full flex-col lg:max-w-4xl">
                <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg text-center">
                    
                    <h1 class="mb-2 text-2xl font-semibold">Tugas Pertemuan 1</h1>
                    <p class="mb-8 text-[#706f6c] dark:text-[#A1A09A]">Pemrograman Web Framework</p>
                    
                    <div class="max-w-md mx-auto bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] p-8 rounded-xl shadow-sm text-left">
                        <div class="flex flex-col gap-4">
                            <div class="flex border-b border-[#eee] dark:border-[#222] pb-3">
                                <span class="w-20 font-medium text-[#706f6c] dark:text-[#A1A09A]">NAMA</span>
                                <span class="font-bold text-lg">: Asti Nurul Utami</span>
                            </div>
                            <div class="flex">
                                <span class="w-20 font-medium text-[#706f6c] dark:text-[#A1A09A]">NIM</span>
                                <span class="font-bold text-lg">: 20230140217</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-center">
                        <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 rounded-full text-xs font-medium">
                            Tugas Pertemuan 1 - Asti Nurul Utami
                        </span>
                    </div>
                </div>
            </main>
        </div>

    </body>
</html>