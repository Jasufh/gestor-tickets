<?php

namespace App\Http\Controllers;

use App\Models\Problematica;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $problematicas = Problematica::all();

        return view('welcome', compact('problematicas'));
    }
}
