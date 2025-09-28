<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(){
          return response()->json([
            'message' => 'User registered successfully',

        ]);
    }
}
