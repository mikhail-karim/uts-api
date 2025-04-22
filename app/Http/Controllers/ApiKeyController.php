<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiKeyController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('apikey', ['apiKey' => $user->api_key]);
    }
}
