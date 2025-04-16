<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PrivacyPolicyController extends Controller
{
    public function showKvkk()
    {
        $token = session('api_token');
        $response = Http::withToken($token)->get("http://nginx_api/api/kvkk");

        
            return view('kvkk', [
                'kvkk' => $response->json()
            ]);
        

       
    }

    public function showPrivacyPolicy()
    {
        $token = session('api_token');
        $response = Http::withToken($token)->get("http://nginx_api/api/gizlilik-politikasi");
      
        return view('gizlilik-politikasi', [
            'privacy_policy' => $response->json()
        ]);
        

        
    }
}
