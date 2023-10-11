<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }

    public function orders(){
        if(Auth::user()->is_admin){
            return view('admin.orders');
        }
        else{
            return redirect(route('welcome'))->with("message, Non sei autorizzato ad accedere a quest'area");
        }
        return view('admin.orders');
    }

}
