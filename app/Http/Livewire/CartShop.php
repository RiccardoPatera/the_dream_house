<?php

namespace App\Http\Livewire;


use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Cartitem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class CartShop extends Component
{

    public $quantity;
    public $products;
    public $total;
    public $cartitems;

    protected $listeners=['refresh_cart'=> 'refresh_cart'];

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




    // public function update($id){
    //     if($id && $this->new_quantity){
    //         $cart[$id]["quantity"] = $this->new_quantity;
    //         session()->put('cart', $cart);
    //         $this->dispatchBrowserEvent('item_updated');
    //     }
    //         elseif ($id && $this->new_quantity==0){
    //             $this->remove($id);
    //         }
    // }

    public function cart_redirect($id){
        $product=Product::find($id);
        return redirect(route('product_detail', compact('product')));
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


         public function refresh_cart(){
            $this->total=0;
            // $this->products=session('cart');
            $this->cartitems=Auth::user()->cartitems;
            $this->emit('refresh_cart');
         }

         public function total_price(){
            if(count($this->cartitems)==0){
                $this->total =0;
            }
            else{
                foreach($this->cartitems as $cartitem){
                    $this->total += $cartitem->product->price * $cartitem->quantity;
                }
            }
         }

     public function mount(){
        if(Auth::user() && Auth::user()->cartitems){
            $this->cartitems=Auth::user()->cartitems;
        }
         else{
             $this->cartitems=[];
     }
        // dd($this->products)
     }

    public function render()
    {

        $this->total_price();
        return view('livewire.cart-shop');
    }

}

