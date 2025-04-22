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
@php
    $postsList = $posts['posts'] ?? [];
    $allCategories = [];
    $allTags = [];

    if (!empty($postsList)) {
        foreach ($postsList as $post) {
            if (isset($post['categories'])) {
                foreach ($post['categories'] as $category) {
                    $allCategories[$category['name']] = $category;
                }
            }
            if (isset($post['tags'])) {
                foreach ($post['tags'] as $tag) {
                    $allTags[$tag['name']] = $tag;
                }
            }
        }
    }
@endphp

<nav class="bg-green-600 shadow-lg fixed top-0 left-0 right-0 z-50">
    <header class="bg-green-600 shadow-sm sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a class="text-2xl font-bold text-gray-100">Blog</a>
                <div class="flex items-center gap-6">
                  
                    <div class="hidden md:flex items-center gap-4 relative">
                        <button id="filterToggle" class="flex items-center gap-2 px-4 py-2 bg-green-800 text-gray-300 rounded-lg hover:bg-green-900 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path d="M17 2.75a.75.75 0 0 0-1.5 0v5.5a.75.75 0 0 0 1.5 0v-5.5ZM17 15.75a.75.75 0 0 0-1.5 0v1.5a.75.75 0 0 0 1.5 0v-1.5ZM3.75 15a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5a.75.75 0 0 1 .75-.75ZM4.5 2.75a.75.75 0 0 0-1.5 0v5.5a.75.75 0 0 0 1.5 0v-5.5ZM10 11a.75.75 0 0 1 .75.75v5.5a.75.75 0 0 1-1.5 0v-5.5A.75.75 0 0 1 10 11ZM10.75 2.75a.75.75 0 0 0-1.5 0v1.5a.75.75 0 0 0 1.5 0v-1.5ZM10 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3.75 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM16.25 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                            </svg>
                            <span>Filtrele</span>
                        </button>

                     
                        <div id="filterDropdown" class="absolute top-full left-0 w-full bg-green-800 border border-gray-700 rounded-lg shadow-xl mt-1 overflow-hidden transition-all duration-300 max-h-0">
                            <div class="p-4 space-y-4">
                                @if(request()->has('category') || request()->has('tag'))
                                <div class="flex justify-end">
                                    <a href="?{{ http_build_query(request()->except(['category', 'tag'])) }}" 
                                       class="text-sm text-red-300 hover:text-red-200 transition-colors">
                                        Temizle
                                    </a>
                                </div>
                                @endif

                                <div class="space-y-4">
                                    <div>
                                        <h3 class="text-gray-300 text-sm font-medium mb-2">Kategoriler</h3>
                                        <div class="flex flex-col gap-2">
                                            @foreach($allCategories as $category)
                                            <a href="?{{ http_build_query(array_merge(request()->query(), ['category' => $category['name']])) }}" 
                                               class="w-full px-3 py-2 text-sm rounded-lg {{ request('category') == $category['name'] ? 'bg-indigo-600 text-white' : 'bg-green-700 hover:bg-green-600 text-gray-300' }}">
                                                {{ $category['name'] }}
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <h3 class="text-gray-300 text-sm font-medium mb-2">Etiketler</h3>
                                        <div class="flex flex-col gap-2">
                                            @foreach($allTags as $tag)
                                            <a href="?{{ http_build_query(array_merge(request()->query(), ['tag' => $tag['name']])) }}" 
                                               class="w-full px-3 py-2 text-sm rounded-lg {{ request('tag') == $tag['name'] ? 'bg-indigo-600 text-white' : 'bg-green-700 hover:bg-green-600 text-gray-300' }}">
                                                {{ $tag['name'] }}
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

          
            <div class="md:hidden px-4 py-3 bg-green-600 border-t border-green-600 mt-4">
    <div class="relative">
        <button id="mobileFilterToggle" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-green-800 text-gray-200 rounded-lg hover:bg-green-900 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            <span>Filtrele</span>
        </button>

      
        <div id="mobileFilterContent" class="absolute top-full left-0 w-full bg-green-800 border border-gray-700 rounded-lg shadow-xl mt-1 overflow-hidden transition-all duration-300 max-h-0">
            <div class="p-4 space-y-4">
                @if(request()->has('category') || request()->has('tag'))
                <div class="flex justify-end">
                    <a href="?{{ http_build_query(request()->except(['category', 'tag'])) }}" 
                       class="text-sm text-red-300 hover:text-red-200 transition-colors">
                        Temizle
                    </a>
                </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <h3 class="text-gray-300 text-sm font-medium mb-2">Kategoriler</h3>
                        <div class="flex flex-col gap-2">
                            @foreach($allCategories as $category)
                            <a href="?{{ http_build_query(array_merge(request()->query(), ['category' => $category['name']])) }}" 
                               class="w-full px-3 py-2 text-sm rounded-lg {{ request('category') == $category['name'] ? 'bg-indigo-600 text-white' : 'bg-green-700 hover:bg-green-600 text-gray-300' }}">
                                {{ $category['name'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-gray-300 text-sm font-medium mb-2">Etiketler</h3>
                        <div class="flex flex-col gap-2">
                            @foreach($allTags as $tag)
                            <a href="?{{ http_build_query(array_merge(request()->query(), ['tag' => $tag['name']])) }}" 
                               class="w-full px-3 py-2 text-sm rounded-lg {{ request('tag') == $tag['name'] ? 'bg-indigo-600 text-white' : 'bg-green-700 hover:bg-green-600 text-gray-300' }}">
                                {{ $tag['name'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        </nav>
    </header>
</nav>


<div class="max-w-7xl mx-auto px-4 mt-8">
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
                            @foreach($post['categories'] ?? [] as $category)
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    {{ $category['name'] }}
                                </span>
                            @endforeach
                            @foreach($post['tags'] ?? [] as $tag)
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
                                    #{{ $tag['name'] }}
                                </span>
                            @endforeach
                        </div>
                        <a href="{{route ('blog.show',$post['id']) }}">  
                            <h2 class="text-xl font-bold text-gray-800 mb-3 hover:text-green-600 transition-colors">
                                {{ $post['title'] }}
                            </h2>
                        </a>
                        <p class="text-gray-600 leading-relaxed">
                            {{ Str::limit(strip_tags($post['content']), 40) }}
                        </p>
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

<footer class="fixed bottom-0 left-0 w-full bg-green-600 text-gray-100 py-3 px-4 border-t border-gray-200">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row items-center justify-between text-sm">
            <div class="mb-2 md:mb-0">© 2025 Blog. Tüm hakları saklıdır.</div>
            <div class="flex space-x-4">
                <a href="/gizlilik-politikasi" class="text-gray-100 transition-colors duration-200">Gizlilik Politikası</a>
                <a href="/kvkk" class="text-gray-100 transition-colors duration-200">KVKK Metni</a>
            </div>
        </div>
    </div>
</footer>

<script>
    
    const filterToggle = document.getElementById('filterToggle');
    const filterDropdown = document.getElementById('filterDropdown');
    let isForceOpened = false;

    if(filterToggle && filterDropdown) {
        filterDropdown.style.width = `${filterToggle.offsetWidth}px`;
        
        filterToggle.addEventListener('click', (e) => {
            isForceOpened = !isForceOpened;
            filterDropdown.style.width = `${filterToggle.offsetWidth}px`;
            
            filterDropdown.classList.toggle('max-h-0', !isForceOpened);
            filterDropdown.classList.toggle('max-h-[600px]', isForceOpened);
            e.stopPropagation();
        });

        document.addEventListener('click', (e) => {
            if(!filterToggle.contains(e.target) && !filterDropdown.contains(e.target)) {
                isForceOpened = false;
                filterDropdown.classList.add('max-h-0');
                filterDropdown.classList.remove('max-h-[600px]');
            }
        });
    }

    
   
    const mobileFilterToggle = document.getElementById('mobileFilterToggle');
    const mobileFilterContent = document.getElementById('mobileFilterContent');
    if(mobileFilterToggle) {
        mobileFilterToggle.addEventListener('click', (e) => {
            const isOpen = mobileFilterContent.classList.contains('max-h-0');
            mobileFilterContent.style.width = `${mobileFilterToggle.offsetWidth}px`;
            
            mobileFilterContent.classList.toggle('max-h-0', !isOpen);
            mobileFilterContent.classList.toggle('max-h-[1000px]', isOpen);
            e.stopPropagation();
        });

        document.addEventListener('click', (e) => {
            if(!mobileFilterToggle.contains(e.target) && !mobileFilterContent.contains(e.target)) {
                mobileFilterContent.classList.add('max-h-0');
                mobileFilterContent.classList.remove('max-h-[1000px]');
            }
        });
    }


   
    const menuButton = document.getElementById('menuButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    menuButton.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
    });
    document.addEventListener('click', () => dropdownMenu.classList.add('hidden'));
</script>

</body>
</html>
@endsection
