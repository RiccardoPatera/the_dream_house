<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{

    public $orders;




    public function search(){

        // $stripe = new \Stripe\StripeClient('sk_test_51Ng5glFmUvlHusW192qiad03Zfy1H7wRVi8B6vyfyCXtIMJoI8e1ODL4pWQJjeQQ16x0ENHTkBTmRqpeIjQsq9FA00vz60OfMg');
        // $stripe->invoices->search([
        // 'query' => 'total>999 AND metadata[\'order_id\']:\'6735\'',
        // ]);
    }


    public function mount(){
        // $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        // $this->orders=$stripe->invoices->all(['limit' =>100]);
        // dd($this->orders->data);
        $this->orders=Order::orderBy('created_at','Desc')->get();
    }


    public function render()
    {
        return view('livewire.orders');
    }
}
