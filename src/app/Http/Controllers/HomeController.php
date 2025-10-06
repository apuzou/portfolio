<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * ポートフォリオトップページを表示
     */
    public function index()
    {
        return view('home');
    }
}
