<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultWebController extends Controller
{
    public function __invoke()
    {
      return view('app', [
        'auth_user' => Auth::user()
      ]);
    }
}
