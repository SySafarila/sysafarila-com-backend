<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('origin');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required',
            'name' => 'required',
            'email' => 'required|email'
        ]);

        // return $validator;
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ], 200);
        }

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
