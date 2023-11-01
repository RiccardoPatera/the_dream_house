<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Orders extends Component
{

    public $orders;
    public $date;



    public function search(){
        if(!$this->date==null){
            $this->orders=Order::whereDate('created_at', $this->date)->orderBy('created_at','Desc')->get();
        }
        else{
            $this->orders=Order::orderBy('created_at','Desc')->get();
        }
      
    }


    public function mount(){
        $this->orders=Order::orderBy('created_at','Desc')->get();
    }


    public function render()
    {
        return view('livewire.orders');
    }
}
