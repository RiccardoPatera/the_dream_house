<?php

namespace App\Http\Livewire;

use view;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Navbar extends Component
{

    public $brand;
    public $category;
    public $user;

     protected $listeners=['refresh_nav'=> 'refresh_nav'];


    public function search_brand($id){
        return redirect(route('product_index'))->with('session_b',$id);
    }


    public function search_category($id){
        return redirect(route('product_index'))->with('session_c',$id);
    }

    public function refresh_nav(){
        $this->user=Auth::user()->name;
    }

    public function mount(){
        if(Auth::user()){
            $this->user=Auth::user()->name;
        }
    }
    public function render()
    {
        return view('livewire.navbar',[
            'brands'=>Brand::all(),
            'categories'=>Category::all(),
        ]);
    }
}
