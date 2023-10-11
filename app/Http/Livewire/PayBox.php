<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\Product;
use Livewire\Component;
use App\Models\Cartitem;
use Maize\Markable\Models\Favorite;

class PayBox extends Component
{


    public $product;
    public $quantity=0;
    public $email;

    protected $rules = [
        'quantity' => 'numeric|integer',
    ];

    protected $messages=[
        'quantity.numeric'=>'Si accettano solo valori numerici',
        'quantity.integer'=>'Si accettano solo valori interi',
    ];



    public function addtocart(){
        $this->validate();
        if(!Auth::user()){
            return redirect(route('login'))->with('mustlog', 'Devi effettuare il login per aggiungere prodotti al tuo carrello');
        }
        elseif($this->quantity==0){
            $this->dispatchBrowserEvent('item_q_0');
        }
        elseif(gettype((int)$this->quantity)!='integer'){
            $this->quantity=0;
            $this->dispatchBrowserEvent('value_error');
        }
        elseif($this->quantity>$this->product->quantity){
            $this->dispatchBrowserEvent('item_exceed');
        }
        else{
            $cartitems=Auth::user()->cartitems;
            // dd($cartitems->where('product_id',$this->product->id)->first()->get());

            if(count($cartitems->where('product_id',$this->product->id))>0) {
                $cartitem=$cartitems->where('product_id',$this->product->id)->first();
                $cartitem->quantity=$this->quantity ;
                $cartitem->save();
                $this->dispatchBrowserEvent('item_update');
                $this->emit('refresh_cart');
            }
            else{
                    $cart=Cartitem::create([
                        'product_id'=>$this->product->id,
                        'quantity'=>$this->quantity,
                    ]);

                    $cart->users()->attach(Auth::id());
                    $this->emit('refresh_cart');
                    $this->dispatchBrowserEvent('item_add');
            }
        }
    }

    public function add(){
        if($this->quantity<$this->product->quantity){
            $this->quantity+=1;
        }
        else {
            $this->dispatchBrowserEvent('item_max');
        }

    }
    public function remove(){
        if($this->quantity>0){
            $this->quantity-=1;
        }
    }

    public function AddtoFav($id){
        $product=Product::FindOrFail($id);
        $user=Auth::user();

        if(!Auth::user()){
            return redirect(route('login'))->with('mustlog', 'Devi effettuare il login per aggiungere prodotti tra i tuoi preferiti');
        }
        else{
            if(count(Favorite::all()->where('markable_id' , $product->id))>=1){
                $this->dispatchBrowserEvent('item_already_fav');
            }
            else{
                Favorite::add($product, $user);
                $this->dispatchBrowserEvent('item_add_fav');
            }
        }



    }


    public function render()
    {

        return view('livewire.pay-box');
    }
}
