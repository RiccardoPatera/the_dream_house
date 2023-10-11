<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use Maize\Markable\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class WishlistPage extends Component
{

    public $products;

    public function favoriteRemove($id)
    {
        $product = Product::find($id);
        $user = auth()->user();
        Favorite::remove($product, $user);
        $this->dispatchBrowserEvent('item_remove_fav');
    }

    public function AddToCart($id)
    {

        $cart=session('cart');
        if (!Auth::user()){
            return redirect(route('login'))->with('mustlog', 'Devi essere loggato per aggiungere prodotti al tuo carrello');
        }
        elseif(Product::findOrFail($id)->quantity<1){
            $this->dispatchBrowserEvent('item_not_avaible');
        }
        elseif(isset($cart[$id])){
            if((Product::findOrFail($id)->quantity)>=$cart[$id]["t_quantity"]){
                $this->dispatchBrowserEvent('item_max');
            }
        }
        else{
            $product=Product::findOrFail($id);
            if(isset($cart[$id])){
                $cart[$id]['quantity']++;
            }
            else{
                $cart[$id]=[
                    'id'=>$product->id,
                    'product_title'=>$product->title,
                    'img'=>$product->images[0]->url,
                    'price'=>$product->price,
                    'quantity'=>1,
                    't_quantity'=>$product->quantity
                ];
            }

            session()->put('cart', $cart);
            $this->emit('refresh_cart');
            $this->dispatchBrowserEvent('item_add');
        }
    }

    public function render()
    {
        $this->products = Product::whereHasFavorite(
            auth()->user()
        )->get();

        return view('livewire.wishlist-page');
    }
}
