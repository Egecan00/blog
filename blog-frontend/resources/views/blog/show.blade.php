<!DOCTYPE html>

<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post['title'] ?? 'Blog Gönderisi' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen">
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

    <div class="max-w-3xl mx-auto px-4 py-8">
        <!-- geri dönüş butonu -->
        <a href="/blog" class="inline-block mb-6 text-gray-600 hover:text-gray-800 transition-colors">
            ← Geri Dön
        </a>

        <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
            <!-- post Resmi -->
            @if(isset($post['image']) && !empty($post['image']))
            <img src="{{ ('http://localhost:8000'.'/'. $post['image']) }}" 
                 alt="{{ $post['title'] ?? '' }}"  
                 class="w-full h-64 object-cover mb-6 rounded-lg">
            @else
            <div class="w-full h-64 bg-gray-200 mb-6 rounded-lg flex items-center justify-center">
                <span class="text-gray-500">Resim Yok</span>
            </div>
            @endif

            <!-- kategori ve etiketler -->
            <div class="flex flex-wrap gap-2 mb-4">
                <!-- kategori -->
                @foreach($post['categories'] ?? [] as $category)
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                    {{ $category['name'] }}
                </span>
                @endforeach
                
                
                <!-- etiketler -->
                    @foreach($post['tags'] ?? [] as $tag)
                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                        #{{ $tag['name'] }}
                    </span>
                    @endforeach
            </div>

            <!-- post Başlığı -->
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                {{ $post['title'] ?? 'Başlıksız Gönderi' }}
            </h1>

            <!-- post İçeriği -->
            <div class="prose max-w-none text-gray-700">
                {!! $post['content'] ?? '<p class="text-red-500">İçerik bulunamadı</p>' !!}
            </div>
        </div>

        <!-- tarih ve okuma Süresi -->
        <div class="mt-4 text-sm text-gray-500">
            @if(isset($post['created_at']))
                {{ \Carbon\Carbon::parse($post['created_at'])->translatedFormat('d F Y') }}
            @endif
            
            @if(isset($post['read_time']))
             • {{ $post['read_time'] }}
            @endif
        </div>

        <!-- Yorumlar Bölümü -->
<div class="max-w-3xl mx-auto px-4 py-8 mt-12">
    <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">
            Yorumlar ({{ isset($post['comments']) ? count($post['comments']) : 0 }})
        </h2>

       
       <!-- Yorum Formu -->
        @if(session('api_token'))
        <form action="{{ route('comments.store', $post['id']) }}" method="POST" class="mb-8">
            @csrf
            <div class="mb-4">
                <textarea 
                    name="content" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('body') border-red-500 @enderror" 
                    rows="4" 
                    placeholder="Yorumunuzu buraya yazın..."
                ></textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
            >
                Yorumu Gönder
            </button>
        </form>
      @endif
      
    
      <!-- Yorum Listesi -->
<div class="space-y-6">
    @if(isset($post['comments']) && is_array($post['comments']))
        @foreach($post['comments'] as $comment)
            <!-- Yorum Kartı -->
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between mb-2">
                    <!-- Yorum Yazan -->
                    <span class="font-semibold text-gray-700">
                        {{ $comment['user']['name']}}
                    </span>
                    
                    <!-- Yorum Tarihi -->
                    <span class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($comment['created_at'])->translatedFormat('d F Y H:i') }}
                    </span>
                </div>
                
                <!-- Yorum Metni -->
                <p class="text-gray-600 whitespace-pre-wrap">{{ $comment['content'] }}</p>
            </div>
        @endforeach

        @if(count($post['comments']) === 0)
            <div class="text-center py-8 text-gray-500">
                Henüz yorum yapılmamış. İlk yorumu siz yazın!
            </div>
        @endif
    @else
        <div class="text-center py-8 text-gray-500">
            Yorumlar yüklenirken bir hata oluştu
        </div>
    @endif
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