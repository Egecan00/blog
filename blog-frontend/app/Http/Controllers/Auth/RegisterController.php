<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Laravel HTTP İstemcisi
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    // Kayıt formunu göstermek için bir yöntem
    public function showRegistrationForm()
    {
        return view('auth.register'); // Kayıt formunun yer aldığı view dosyası
    }

    public function register(Request $request)
    {
        // Gelen verileri doğrula
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

     
       
        $backendResponse = Http::post(env('API_URL').'/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

           

        return redirect()->back()->withErrors([
            'email' => 'Zaten bu E-posta kullanılıyor. Lütfen tekrar deneyin.',
            'password' => 'Şifreniz Şifre Tekrarıyla Uyuşmuyor. Lütfen Tekrar Deneyiniz',
            'password_confirmation' => 'Şifre Tekrarı Şifre İle Uyuşmuyor. Lütfen Tekrar Deneyin',
        ])->withInput();
        
        if ($backendResponse->successful()) { return redirect('http://localhost:8001/login')->with('success', 'Kayıt başarılı!'); } 
        
          if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }   
       

       
    }
}
