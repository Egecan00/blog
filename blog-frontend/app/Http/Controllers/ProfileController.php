<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{

    public function show(Request $request)
    {
        $token = session('api_token');

        if (!$token) {
            return redirect('/index')->with('error', 'Lütfen giriş yapınız.');
        }

        $response = Http::timeout(1000)->withToken($token)->get("http://nginx_api/api/blog/profile");
        $userData = $response->json();
        return view('blog.profile', ['user' => $userData]);
       
    }

   public function update(Request $request)
   {
    $token = session('api_token');

    if (!$token) {
        return redirect('/index')->with('error', 'Lütfen giriş yapınız.');
    }

    $user = $request->user();

    $response = Http::withToken($token)
    ->put("http://nginx_api/api/profile", [
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
    ]);

    if ($response->successful()) {
        return redirect('/blog')->with('Giriş bilgileriniz başarılı bir şekilde değiştirildi başarılı bir şekilde değiştirildi');
    }
    else {
        return redirect()->back()->withErrors('Profil güncellenemedi.');
    }

   }

   
    
}
