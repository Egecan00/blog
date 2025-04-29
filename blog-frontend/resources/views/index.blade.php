<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden bg-gradient-to-r from-green-600 to-green-900">
            <div class="p-12 text-center space-y-8">
                <div class="space-y-4">
                    <h2 class="text-4xl font-bold text-white leading-tight">
                        Hoş Geldiniz
                    </h2>
                    <p class="text-xl text-white/90 mt-2">
                       Sitemizi ziyaret etmek için aşşağıdan giriş yapabilirsiniz.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/register') }}" 
                       class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-green-600 hover:text-white bg-white hover:bg-green-600 transition-colors duration-300 shadow-lg hover:shadow-xl">
                        Kayıt Ol
                    </a>
                    <a href="{{ url('/login') }}" 
                       class="inline-flex items-center justify-center px-8 py-3 border border-white text-base font-medium rounded-md text-white hover:text-green-600 bg-transparent hover:bg-white transition-colors duration-300">
                        Giriş Yap
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
