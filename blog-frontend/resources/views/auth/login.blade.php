<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Giriş Yap</title>
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <form action="{{ route('login') }}" method="POST" class="w-full max-w-md space-y-6">
            @csrf
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden transition-all duration-300 hover:shadow-3xl">
                
                
                <div class="bg-gradient-to-r from-green-600 to-green-900 p-6">
                    <h5 class="text-center text-2xl font-bold text-white tracking-wide">Giriş Yap</h5>
                </div>

                
                <div class="px-8 py-10 space-y-6">

                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                            <ul class="list-disc list-inside text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                   
                    <div class="space-y-2">
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="E-posta adresiniz" 
                            required 
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all placeholder-gray-400"
                        >
                    </div>

                  
                    <div class="space-y-2">
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Şifreniz" 
                            required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all placeholder-gray-400"
                        >
                    </div>

                   
                    <p class="text-center text-gray-600 text-sm">
                        Hesabınız yok mu? 
                        <a href="{{ url('/register') }}" class="font-semibold text-green-600 hover:text-green-500 underline transition-colors">
                            Hemen Kayıt Olun
                        </a>
                    </p>

                  
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-green-600 to-green-900 text-white py-3 px-6 rounded-lg font-semibold hover:from-green-950 hover:to-green-600 transition-all transform hover:scale-[1.02] shadow-md"
                    >
                        Giriş Yap
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
