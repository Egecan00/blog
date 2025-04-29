<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kayıt Ol</title>
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <form action="{{ route('register') }}" method="POST" class="w-full max-w-md space-y-6">
            @csrf
            
          
          

            <div class="bg-white rounded-xl shadow-2xl overflow-hidden transition-all duration-300 hover:shadow-3xl">
                
            

                <div class="bg-gradient-to-r from-green-600 to-green-950 p-6">
                    <h2 class="text-center text-2xl font-bold text-white tracking-wide">Kayıt ol</h2>
                </div>

                
                <div class="px-8 py-10 space-y-6">

                @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg shadow-sm">
                    <ul class="list-disc list-inside text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                   
                    <div class="space-y-2">
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            placeholder="İsminiz" 
                            
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 placeholder-gray-400 transition-all"
                        >
                    </div>

                    
                    <div class="space-y-2">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="E-posta adresiniz" 
                           
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 placeholder-gray-400 transition-all"
                        >
                    </div>

                  
                    <div class="space-y-2">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Şifreniz (min 8 karakter)" 
                           
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 placeholder-gray-400 transition-all"
                        >
                    </div>

                   
                    <div class="space-y-2">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="Şifrenizi tekrar girin" 
                          
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 placeholder-gray-400 transition-all"
                        >
                    </div>

                    <p class="text-center text-gray-600 text-sm">
                        Hesabınız var mı? 
                        <a href="{{ url('/login') }}" class="font-semibold text-green-600 hover:text-green-500 underline transition-colors">
                            Hemen Giriş Yapın
                        </a>
                    </p>

                   
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-green-600 to-green-950 text-white py-3 px-6 rounded-lg font-semibold hover:from-green-950 hover:to-green-600 transition-all transform hover:scale-[1.02] shadow-md"
                    >
                        Kayıt ol
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
