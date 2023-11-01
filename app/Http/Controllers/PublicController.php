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

    public function privacy(){ 
        return view('privacy');  
    }

    public function about_us(){ 
        return view('about_us');  
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
