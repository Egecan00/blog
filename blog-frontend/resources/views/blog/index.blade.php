@extends('blog.layout')

@section('content')
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Sitesi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 pt-16">
    <!-- navbar üst -->
    <nav class="bg-slate-800 shadow-lg fixed top-0 left-0 right-0 z-50">
    <header class="bg-gray-800 shadow-sm sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a class="text-2xl font-bold text-gray-100">Blog</a>
                <div class="flex items-center gap-6">
                    <div class="hidden md:flex items-center gap-4">
                        <button id="filterToggle" class="flex items-center gap-2 px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span>Filtrele</span>
                        </button>

                      
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

            <div class="md:hidden px-4 py-3 bg-gray-800 border-t border-gray-700 mt-4">
                <button id="mobileFilterToggle" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filtrele</span>
                </button>

                <div id="mobileFilterContent" class="max-h-0 overflow-hidden transition-all duration-900 space-y-4">
                   

                    @if(request()->has('category') || request()->has('tag'))
                    <div class="flex justify-end">
                        <a href="?{{ http_build_query(request()->except(['category', 'tag'])) }}" 
                           class="px-3 py-1 text-sm text-red-400 hover:text-red-300 transition-colors">
                            Kategori/Etiket Temizle
                        </a>
                    </div>
                    @endif

                    <div>
                        <h3 class="text-gray-400 text-sm font-medium mb-2">Kategoriler</h3>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $allCategories = [];
                            if(!empty($postsList) && count($postsList) > 0){
                                foreach($postsList as $post) {
                                    
                                    if(isset($post['categories'])) {
                                        foreach($post['categories'] as $category) {
                                            $allCategories[$category['name']] = $category;
                                        }
                                    }
                                }
                            }
                            @endphp
                            @foreach($allCategories as $category)
                                <a href="?{{ http_build_query(array_merge(request()->query(), ['category' => $category['slug']])) }}" 
                                   class="px-3 py-1 text-sm rounded-full {{ request('category') == $category['slug'] ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                                    {{ $category['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-gray-400 text-sm font-medium mb-2">Etiketler</h3>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $allTags = [];
                            if(!empty($postsList) && count($postsList) > 0){
                                foreach($postsList as $post) {
                                    if(isset($post['tags'])) {
                                        foreach($post['tags'] as $tag) {
                                            $allTags[$tag['name']] = $tag;
                                        }
                                    }
                                }
                            }
                            @endphp
                            @foreach($allTags as $tag)
                                <a href="?{{ http_build_query(array_merge(request()->query(), ['tag' => $tag['slug']])) }}" 
                                   class="px-3 py-1 text-sm rounded-full {{ request('tag') == $tag['slug'] ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                                    {{ $tag['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div id="filterDropdown" class="bg-gray-800 border-t border-gray-700 overflow-hidden transition-all duration-300 max-h-0">
            <div class="max-w-6xl mx-auto px-4 py-4">
                @if(request()->has('category') || request()->has('tag'))
                <div class="mb-4 flex justify-end">
                    <a href="?{{ http_build_query(request()->except(['category', 'tag'])) }}" 
                       class="px-3 py-1 text-sm text-red-400 hover:text-red-300 transition-colors">
                        Kategori/Etiket Temizle
                    </a>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-gray-400 text-sm font-medium mb-3">Kategoriler</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($allCategories as $category)
                                <a href="?{{ http_build_query(array_merge(request()->query(), ['category' => $category['slug']])) }}" 
                                   class="px-3 py-1 text-sm rounded-full {{ request('category') == $category['slug'] ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                                    {{ $category['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-gray-400 text-sm font-medium mb-3">Etiketler</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($allTags as $tag)
                                <a href="?{{ http_build_query(array_merge(request()->query(), ['tag' => $tag['slug']])) }}" 
                                   class="px-3 py-1 text-sm rounded-full {{ request('tag') == $tag['slug'] ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                                    {{ $tag['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    </nav>

    <!-- hata Mesajları -->
    @if($errors->any())
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

    
    
    <!-- post Container -->
     
    <div class="max-w-7xl mx-auto px-4 mt-8">
        @php
            $postsList = $posts['posts'] ?? [];
        @endphp
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            @if(!empty($postsList) && count($postsList) > 0)
                @foreach($postsList as $post)
                
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <a href="{{route ('blog.show',$post['id']) }}">
                    <img src="{{ ('http://localhost:8000'.'/'. $post['image']) }}" 
                             alt="{{ $post['title'] }}" 
                             class="w-full h-48 object-cover">
                    </a>
                        <div class="p-6">
                          
                            <div class="flex flex-wrap gap-2 mb-2">
                                <!-- Kategoriler -->
                                @foreach($post['categories'] ?? [] as $category)
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    {{ $category['name'] }}
                                </span>
                                @endforeach
                                
                                <!-- Etiketler -->
                                @foreach($post['tags'] ?? [] as $tag)
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
                                    #{{ $tag['name'] }}
                                </span>
                                @endforeach
                            </div>
                            <a href="{{route ('blog.show',$post['id']) }}">  
                                
                            <h2 class="text-xl font-bold text-gray-800 mb-3 hover:text-blue-950 transition-colors">
                                {{ $post['title'] }}
                            </h2>
                            </a>
                            
                            <a href="{{route ('blog.show',$post['id']) }}">
                            <p class="text-gray-600 leading-relaxed">
                                {{ Str::limit(strip_tags($post['content']), 40) }}
                            </p>
                            </a>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 text-lg">Henüz bir blog yazısı bulunmamaktadır.</p>
                </div>
            @endif
        </div>
    </div>

    <footer class="fixed bottom-0 left-0 w-full bg-slate-800 text-gray-100 py-3 px-4 border-t border-gray-200">
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

    
    
    <script>
         const filterToggle = document.getElementById('filterToggle');
        
        const filterDropdown = document.getElementById('filterDropdown');
        let isForceOpened = false;

        if(filterToggle && filterDropdown) {
            filterToggle.addEventListener('mouseenter', () => {
                if(!isForceOpened) {
                    filterDropdown.classList.remove('max-h-0');
                    filterDropdown.classList.add('max-h-[500px]', 'py-4');
                }
            });

            const handleHoverClose = (e) => {
                if(!isForceOpened && 
                !filterDropdown.contains(e.relatedTarget) && 
                !filterToggle.contains(e.relatedTarget)) {
                    filterDropdown.classList.add('max-h-0');
                    filterDropdown.classList.remove('max-h-[500px]', 'py-4');
                }
            };
            filterToggle.addEventListener('mouseleave', handleHoverClose);
            filterDropdown.addEventListener('mouseleave', handleHoverClose);

            filterToggle.addEventListener('click', (e) => {
                isForceOpened = !isForceOpened;
                if(isForceOpened) {
                    filterDropdown.classList.remove('max-h-0');
                    filterDropdown.classList.add('max-h-[500px]', 'py-4');
                } else {
                    filterDropdown.classList.add('max-h-0');
                    filterDropdown.classList.remove('max-h-[500px]', 'py-4');
                }
                e.stopPropagation();
            });

            document.addEventListener('click', (e) => {
                if(!filterToggle.contains(e.target) && 
                !filterDropdown.contains(e.target)) {
                    isForceOpened = false;
                    filterDropdown.classList.add('max-h-0');
                    filterDropdown.classList.remove('max-h-[500px]', 'py-4');
                }
            });
        }

        const mobileFilterToggle = document.getElementById('mobileFilterToggle');
        const mobileFilterContent = document.getElementById('mobileFilterContent');
        if(mobileFilterToggle) {
            mobileFilterToggle.addEventListener('click', () => {
                const isOpen = mobileFilterContent.classList.contains('max-h-0');
                if(isOpen) {
                    mobileFilterContent.classList.remove('max-h-0');
                    mobileFilterContent.classList.add('max-h-[1000px]');
                } else {
                    mobileFilterContent.classList.remove('max-h-[1000px]');
                    mobileFilterContent.classList.add('max-h-0');
                }
            });
        }



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
@endsection
