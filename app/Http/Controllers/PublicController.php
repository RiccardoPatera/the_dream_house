<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function welcome() {
        return view('welcome');
    }



    public function profile(){
        if(!Auth::user()){
            return redirect(route('login'))->with('mustlog', 'Devi Accedere per visualizzare il tuo profilo');
        }
        else{
            return view('auth.profile');
        }
    }
}
