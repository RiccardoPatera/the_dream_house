<?php

namespace App\Http\Controllers;

use Auth;
use session;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function  cartsummary(){
        return view('product.cart-summary');
    }


}
