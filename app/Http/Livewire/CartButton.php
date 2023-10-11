<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartButton extends Component
{

    public $cartitems;


    protected $listeners=['refresh_cart'=> 'refresh_cart'];


    public function refresh_cart(){
        $this->cartitems=Auth::user()->cartitems;
    }


    public function render()
    {
        if(isset(Auth::user()->cartitems)){
            $this->cartitems=Auth::user()->cartitems;
        }
        else{
            $this->cartitems=[];
        }
        return view('livewire.cart-button');
    }
}
