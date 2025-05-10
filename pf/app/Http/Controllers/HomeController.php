<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function home()
    {
        return view('home');
    }


    public function createPost()
    {
        return view('createPost');
    }

    public function userProfile()
    {
        return view('userProfile');
    }
}
