<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\WishList;
use App\Models\Occurence;
use App\Support\Collection;
use Livewire\WithPagination;
use Maize\Markable\Models\Favorite;
use Illuminate\Database\Eloquent\Builder;



class IndexProduct extends Component
{
    use WithPagination;

    public $products;
    public $product_filtered;
    public $search;
    public $brand;
    public $category;
    public $occurence;
    public $brand_searched;
    public $category_searched;
    public $occurence_searched;
    public $searched;
    public $min_price;
    public $max_price;
    public $range_min_searched;
    public $range_max_searched;
    public $products_max_price;

    protected $paginationTheme = 'bootstrap';




    public function AddtoFav($id){
        $product=Product::FindOrFail($id);
        $user=Auth::user();

        if(!Auth::user()){
            return redirect(route('login'))->with('mustlog', 'Devi effettuare il login per aggiungere prodotti tra i tuoi preferiti');
        }
        else{
            if(count(Favorite::all()->where('markable_id' , $product->id)->where('user_id' ,Auth::id()))>=1){
                $this->dispatchBrowserEvent('item_already_fav');
            }
            else{
                Favorite::add($product, $user);
                $this->dispatchBrowserEvent('item_add_fav');
            }
        }
     }

    // public function AddToCart($id){

    //     $cart=session('cart');
    //     if (!Auth::user()){
    //         return redirect(route('login'))->with('mustlog', 'Devi effettuare il login per aggiungere prodotti al tuo carrello');
    //     }

    //     elseif(Product::findOrFail($id)->quantity<1){
    //         $this->dispatchBrowserEvent('item_not_avaible');
    //     }

    //     elseif(isset($cart[$id])){

    //         if($cart[$id]["quantity"]>=(Product::findOrFail($id)->quantity)){
    //             $this->dispatchBrowserEvent('item_max');
    //         }

    //         else{
    //             $product=Product::findOrFail($id);
    //                 $cart[$id]['quantity']++;
    //             }

    //     }
    //     elseif(!isset($cart[$id])){
    //         $product=Product::findOrFail($id);
    //         $cart[$id]=[
    //             'id'=>$product->id,
    //             'product_title'=>$product->title,
    //             'img'=>$product->images[0]->url,
    //             'price'=>$product->price,
    //             'quantity'=>1,
    //             't_quantity'=>$product->quantity
    //             ];


    //         }
    //         session()->put('cart', $cart);
    //         $this->emit('refresh_cart');
    //         $this->dispatchBrowserEvent('item_add');

    //     }


    public function AddToCart($id){

        $product=Product::findOrFail($id);


        if (!Auth::user()){
            return redirect(route('login'))->with('mustlog', 'Devi effettuare il login per aggiungere prodotti al tuo carrello');
        }elseif($product->quantity<1){
            $this->dispatchBrowserEvent('item_not_avaible');
        }
        elseif(count(Auth::user()->cartitems->where('product_id',$product->id))>0){
            $this->dispatchBrowserEvent('item_already_added');
        }
        else{

            $cart=Cartitem::create([
                'quantity'=>1,
                'product_id'=>$product->id,
            ]);

            $cart->users()->attach(Auth::id());
            $this->emit('refresh_cart');
            $this->dispatchBrowserEvent('item_add');
        }



        // $this->dispatchBrowserEvent('item_not_avaible');

        // elseif(isset($cart[$id])){

        //     if(>=(Product::findOrFail($id)->quantity)){
        //         $this->dispatchBrowserEvent('item_max');
        //     }

        //     else{
        //         $product=Product::findOrFail($id);
        //             $cart[$id]['quantity']++;
        //         }

        // }


        }


     public function search(){


            if($this->brand!=0 && $this->category!=0 && $this->occurence!=0){
                if($this->search!=null){
                    $this->products= Product::whereHas('brands', function (Builder $query) {
                        $query->where('brand_id', $this->brand);
                    })->whereHas('categories', function (Builder $query) {
                        $query->where('category_id', $this->category);
                    })->whereHas('occurences', function (Builder $query) {
                        $query->where('occurence_id', $this->occurence);
                    })->where('title', 'LIKE' ,'%'.$this->search.'%')->
                    whereBetween('price',[$this->min_price, $this->max_price])->get();
                }
                else{
                    $this->products= Product::whereHas('brands', function (Builder $query) {
                        $query->where('brand_id', $this->brand);
                    })->whereHas('categories', function (Builder $query) {
                        $query->where('category_id', $this->category);
                    })->whereHas('occurences', function (Builder $query) {
                            $query->where('occurence_id', $this->occurence);
                    })->whereBetween('price',[$this->min_price, $this->max_price])->get();
                }

            }

            elseif($this->brand!=0 && $this->category==0 && $this->occurence==0) {

                if($this->search!=null){
                    $this->products=Product::whereHas('brands', function (Builder $query) {
                    $query->where('brand_id', $this->brand);
                    })->where('title', 'LIKE' , '%'.$this->search.'%')->
                    whereBetween('price',[$this->min_price, $this->max_price])->get();
                }
                else{
                    $this->products=Product::whereHas('brands', function (Builder $query) {
                    $query->where('brand_id', $this->brand);
                    })->whereBetween('price',[$this->min_price, $this->max_price])->get();
                }
            }

            elseif($this->brand==0 && $this->category!=0 && $this->occurence==0) {

                if($this->search!=null){
                    $this->products=Product::whereHas('categories', function (Builder $query) {
                        $query->where('category_id', $this->category);
                    })->where('title', 'LIKE' ,'%'.$this->search.'%')->whereBetween('price',[$this->min_price, $this->max_price])->get();                }
                else{
                    $this->products=Product::whereHas('categories', function (Builder $query) {
                        $query->where('category_id', $this->category);
                    })->whereBetween('price',[$this->min_price, $this->max_price])->get();
                }

            }

            elseif($this->brand==0 && $this->category==0 && $this->occurence!=0){
                if($this->search!=null){
                    $this->products=Product::whereHas('occurences', function (Builder $query) {
                        $query->where('occurence_id', $this->occurence);
                    })->where('title', 'LIKE' ,'%'.$this->search.'%')->whereBetween('price',[$this->min_price, $this->max_price])->get();                }
                else{
                    $this->products=Product::whereHas('occurences', function (Builder $query) {
                        $query->where('occurence_id', $this->occurence);
                    })->whereBetween('price',[$this->min_price, $this->max_price])->get();
                }

            }

            elseif($this->brand!=0 && $this->category==0 && $this->occurence!=0){

                if($this->search!=null){
                    $this->products=Product::whereHas('occurences', function (Builder $query) {
                        $query->where('occurence_id', $this->occurence);
                    })->whereHas('brands', function (Builder $query) {
                            $query->where('brand_id', $this->brand);})
                            ->where('title', 'LIKE' ,'%'.$this->search.'%')
                            ->whereBetween('price',[$this->min_price, $this->max_price])->get();
                        }
                else{
                    $this->products=Product::whereHas('occurences', function (Builder $query) {
                            $query->where('occurence_id', $this->occurence);})
                            ->whereHas('brands', function (Builder $query) {
                            $query->where('brand_id', $this->brand);})
                            ->whereBetween('price',[$this->min_price, $this->max_price])->get();
                        }
                }

                elseif($this->brand!=0 && $this->category!=0 && $this->occurence==0){

                    if($this->search!=null){
                        $this->products=Product::whereHas('categories', function (Builder $query) {
                                $query->where('category_id', $this->category);
                        })->whereHas('brands', function (Builder $query) {
                                $query->where('brand_id', $this->brand);})
                                ->where('title', 'LIKE' ,'%'.$this->search.'%')
                                ->whereBetween('price',[$this->min_price, $this->max_price])->get();
                            }
                    else{
                        $this->products=Product::whereHas('categories', function (Builder $query) {
                                $query->where('category_id', $this->category);})
                                ->whereHas('brands', function (Builder $query) {
                                $query->where('brand_id', $this->brand);})
                                ->whereBetween('price',[$this->min_price, $this->max_price])->get();
                            }
                }



            elseif($this->brand==0 && $this->category==0) {

                if($this->search!=null){
                    $this->products=Product::where('title', 'LIKE' ,'%'.$this->search.'%')->whereBetween('price',[$this->min_price, $this->max_price])->get();
                }
                else{
                    $this->products=Product::whereBetween('price',[$this->min_price, $this->max_price])->get();
                }
            }



            if($this->brand!=0){
                $this->brand_searched=Brand::find($this->brand)->name;
            }
            else{
                $this->brand_searched='Tutti i brand';
            }


            if($this->category!=0){
                $this->category_searched=Category::find($this->category)->name;
            }
            else{
                $this->category_searched='Tutte le categorie';
            }



            if($this->occurence!=0){
                $this->occurence_searched=Occurence::find($this->occurence)->name;
            }
            else{
                $this->occurence_searched='Tutte le occasioni';
            }



            if($this->search!=''){
                $this->searched= 'Ricerca attuale:'. $this->search;
            }
            else{
                $this->searched='Nessuna ricerca testuale';
            }

                $this->dispatchBrowserEvent('searched');

                $this->range_max_searched= $this->max_price;
                $this->range_min_searched= $this->min_price;

        }




     public function mount(){
        $this->brand=0;
        $this->category=0;
        $this->occurence=0;
        $this->min_price=0;
        $this->max_price=Product::max('price');
        $this->category_searched='Tutte le Categorie';
        $this->brand_searched='Tutti i Brand';
        $this->occurence_searched='Tutte le occasioni';
        $this->searched='Nessuna ricerca testuale';
        $this->range_min_searched=0;
        $this->range_max_searched=Product::max('price');
        $this->products_max_price=Product::max('price');


    }

    public function render()
    {
            // $cart=Auth::user()->cart;
            // dd($cart->products()->get());
            // Ricerca Tramite Navbar tramite sessioni
        if(session('session_b')){
            $this->brand=session('session_b');
            $this->products= Product::whereHas('brands', function (Builder $query) {
                $query->where('brand_id', $this->brand);
            })->get();
            $this->brand_searched=Brand::find($this->brand)->name;

        }


        if(session('session_c')){
            $this->category=session('session_c');
            $this->products=Product::whereHas('categories', function (Builder $query) {
                $query->where('category_id', $this->category);
            })->get();
            $this->category_searched=Category::find($this->category)->name;
        }



        return view('livewire.index-product',[
            'brands'=>Brand::all(),
            'categories'=>Category::all(),
            'occurences'=>Occurence::all(),
            'brand_searched'=>$this->brand_searched,
            'category_searched'=>$this->category_searched,
            ]
        );
    }

}

