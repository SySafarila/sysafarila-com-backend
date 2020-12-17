<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if (User::where('email', $request->email)->first()) {
            return response()->json([
                'message' => 'Failed',
                'status' => false
            ]);
        } else {
            User::create([
                // $table->string('uid');
                // $table->string('name');
                // $table->string('email')->unique();
                'uid' => $request->uid,
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now()
            ]);

            return response()->json([
                'message' => 'Success',
                'status' => true
            ]);
        }
    }
}
