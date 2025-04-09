<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        $token = session('api_token');

        // if (!$token) {
        //     return redirect('/index')->with('error', 'Lütfen giriş yapınız.');
        // }

        $user = $request->user();

        $validator = $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|string|min:8',
        ]);

        if ($request->filled('password')) {
            $validator['password'] = Hash::make($validator['password']);
        }
       
        if(!$validator) {
            return response()->json($validator->errors(), 422);
        }

        $user->update($validator);

        return response()->json(['message' => 'Profil başarıyla güncellendi']);



    }


        
}
