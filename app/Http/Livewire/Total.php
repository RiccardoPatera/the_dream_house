<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Total extends Component
{

    public $user;
    public $total;

    public function mount(){
        foreach($this->user->cartitems as $cartitem){
            $this->total+=$cartitem->quantity * $cartitem->product->price;
        }
    }


    public function render()
    {
        return view('livewire.total');
    }
}
