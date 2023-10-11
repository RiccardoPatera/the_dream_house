<?php

namespace App\Http\Livewire;

use id;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Cartitem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartSummary extends Component
{
    public $cartitems;
    public $total;
    public $quantity;
    public $new_quantity;


    protected $listeners=['refresh_cart'=> 'refresh_cart'];

    public function refresh_cart(){
        $this->total=0;
        $this->cartitems=Auth::user()->cartitems;
     }

     public function remove($id)
    {
        if ($id) {
            $cartitem=Cartitem::find($id);
            $cartitem->delete();
            $this->emit('refresh_cart');
            $this->cartitems=Auth::user()->cartitems;
            $this->dispatchBrowserEvent('item_deleted');
        }
    }

     public function cart_redirect($id){
        $product=Product::find($id);
        return redirect(route('product_detail', compact('product')));
    }

    // public function update($id){
    //     if($id && $this->new_quantity){
    //         $cart[$id]["quantity"] = $this->new_quantity;
    //         session()->put('cart', $cart);
    //         $this->emit('refresh_cart');
    //         $this->dispatchBrowserEvent('item_updated');

    //     }
    //     elseif ($id && $this->new_quantity==0){
    //         $this->remove($id);
    //     }
    // }


    public function total_price(){
        if(count($this->cartitems)==0){
            $this->total =0;
        }
        else{
            $this->total=0;
            foreach($this->cartitems as $cartitem){
                $this->total += $cartitem->product->price * $cartitem->quantity;
            }
        }
     }

     public function add_qt($id){
        $cartitem=Cartitem::find($id);

        if($cartitem->product->quantity==0){

            $cartitem->delete();
            $this->dispatchBrowserEvent('item_update');


        }
        if($cartitem->quantity<$cartitem->product->quantity){
            $cartitem->quantity=$cartitem->quantity + 1 ;
            $cartitem->save();
            $this->refresh_cart();
            $this->dispatchBrowserEvent('item_update');
        }
        else {
            $this->dispatchBrowserEvent('item_max');
        }
    }


    public function remove_qt($id){
        $cartitem=Cartitem::find($id);

        if($cartitem->quantity>1){
            $cartitem->quantity=$cartitem->quantity - 1 ;
            $cartitem->save();
            $this->refresh_cart();
            $this->dispatchBrowserEvent('item_update');
        }
        else {
            // $cartitem->product()->detach();
            $cartitem->delete();
            $this->refresh_cart();
            $this->dispatchBrowserEvent('item_deleted');
        }
    }

     public function checkout(){
        return redirect(route('shipping'));
        // if(count($this->cartitems)>0){
        //  $lineItems = [];
        //  $user=Auth::user();

        // \Stripe\Stripe::setApiKey(config('stripe.sk'));


        // foreach ($this->cartitems as $cartitem) {


        //     $product_name=$cartitem->product->title;
        //     $product_image=$cartitem->product->images->first()->url;
        //     $total=$cartitem->product->price;
        //     $quantity=$cartitem->quantity;
        //     $image_url='127.0.0.1:8000'. Storage::url($product_image);

        //     $lineItems[]= [
        //         'price_data' => [
        //             'product_data' => [
        //                 'name' => $product_name,
        //                 'images' => ['https://picsum.photos/200/300'],
        //             ],
        //             'currency' => 'EUR',
        //             'unit_amount' => $total *100,
        //         ],
        //         'quantity' => $quantity,

        //     ];
        // }

        // $session = \Stripe\Checkout\Session::create([
        //     'line_items' => [$lineItems],
        //     'mode' => 'payment',
        //     'customer_email'=>$user->email,
        //     'success_url' => route('order_success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
        //     'cancel_url' => route('order_canceled', [], true),
        // ]);


        // $order = new Order();
        // $order->status = 'unpaid';
        // foreach ($this->cartitems as $cartitem) {
        //     $total += $cartitem->price * $cartitem->quantity;
        // }
        // $order->total_price=$total;
        // $order->save();
        // foreach ($this->cartitems as $cartitem) {
        //     $order->products()->attach($cartitem);
        // }
        // $order->users()->attach(Auth::id());

        // return redirect($session->url);
        // }

    }


    public function mount(){
        if(Auth::user()){
            $this->cartitems=Auth::user()->cartitems;
        }
        else{
             return redirect(route('login'));
        }
    }

    public function render()
    {
        $this->total_price();
        return view('livewire.cart-summary');
    }

}

