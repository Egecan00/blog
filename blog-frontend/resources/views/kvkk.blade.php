<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Kvkk Aydınlatma Metni</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 overflow-y-hidden">

     <!-- Navbar -->
     <nav class="bg-slate-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-white text-2xl font-bold">Blog</span>
                </div>

                <div class="relative">
                    <button id="menuButton" class="flex items-center space-x-1 text-gray-300 hover:text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>

                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                    <a href="/profile">
                        <button type="button" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            <span>Profil</span>
                        </button>
                    </a>

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/>
                                </svg>
                                <span>Çıkış Yap</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 max-w-4xl min-h-screen">
          <!-- geri dönüş butonu -->
          <a href="/blog" class="inline-block mb-6 text-gray-600 hover:text-gray-800 transition-colors">
            ← Geri Dön
        </a>
        <!-- Başlık -->
        <header class="mb-8 border-b pb-6">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                Kvkk Aydınlatma Metni
            </h1>
        </header>

        <!-- Name Kutusu -->
        <div class="border border-gray-200 rounded-lg p-4 md:p-6 bg-white mb-6 shadow-sm">
            <div class="flex items-center">
                <span class="text-gray-500 mr-3">•</span>
                <div class="text-lg md:text-base font-medium text-gray-700">
            @if($kvkk)
                <p>{{ $kvkk['name'] ?? '' }}</p>
            @else
                <p>Kvkk Aydınlatma metni yüklenemedi.</p>
            @endif
                </div>
            </div>
        </div>

        <footer class="fixed bottom-0 left-0 w-full bg-slate-800 text-gray-100 py-4 px-4 border-t border-gray-200">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row items-center justify-between text-sm">
            <!-- Telif Hakkı Bilgisi -->
            <div class="mb-2 md:mb-0">
                © 2025 Site Adı. Tüm hakları saklıdır.
            </div>
            
            <!-- Hukuki Linkler -->
            <div class="flex space-x-4">
                <a href="/gizlilik-politikasi" 
                   class="text-gray-100 transition-colors duration-200">
                    Gizlilik Politikası
                </a>
                <a href="/kvkk" 
                   class="text-gray-100 transition-colors duration-200">
                    KVKK Aydınlatma Metni
                </a>
            </div>
        </div>
    </div>
</footer>

      
    </div>

    <script>
        const menuButton = document.getElementById('menuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        menuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', () => {
            dropdownMenu.classList.add('hidden');
        });

        dropdownMenu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    </script>

</body>
</html>