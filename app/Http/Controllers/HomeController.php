<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function addelection()
    {
        return view('admin.addelection');
    }
    public function addcandidate()
    {
        return view('admin.addcandidate');
    }
    public function voterslist()
    {
        return view('admin.voters');
    }
    public function result()
    {
        return view('admin.result');
    }
    public function showresult()
    {
        return view('admin.showresult');
    }
}
