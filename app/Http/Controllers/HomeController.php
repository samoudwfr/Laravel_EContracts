<?php

namespace App\Http\Controllers;

use App\Models\Civil;
use App\Models\Contract;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()->customer->role_id == 2){
            return redirect()->route('pendingContracts');
        }

        $allContracts = Contract::where('sender_id',  Auth::user()->customer->civil->id)->get();
        
        return view('home',compact('allContracts'));
    }
}
