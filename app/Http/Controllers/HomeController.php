<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id =  Auth::id();
        //$roles = \App\User::with('roles')->orderBy('id')->get();
        $roles = \App\User::with('roles')->find($id);
        //dd($roles);
        return view('welcome', ['roles'=>$roles]);
       
    }
}
