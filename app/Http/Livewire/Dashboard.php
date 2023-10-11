<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    public $products;
    public $search;
    protected $paginationTheme = 'bootstrap';


  public function search(){
        if($this->search==''){
            $this->product=Product::all();
        }
        else{
            $this->products=Product::search($this->search)->get();
        }
     }




    public function render()
    {

        if($this->search!=null){
           $this->search();
        }
        else{
            $this->products=Product::all();
        }

        return view('livewire.dashboard');
    }
}
