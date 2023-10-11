<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Occurence;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class EditProduct extends Component
{

    use WithFileUploads;
    public $product;
    public $title;
    public $brand;
    public $description;
    public $price;
    public $img;
    public $category;
    public $quantity;
    public $occurence;
    public $barcode;


    protected $rules = [
        'title' => 'required|min:5',
        'brand' => 'required',
        'price' => 'required|doesnt_start_with:-',
        'description' => 'required|min:15',
        'category' => 'required',
        'quantity'=>'required',
        'occurence'=>'required',
        'barcode'=>'required'
    ];

    protected $messages = [
        'title.required'=> 'Il titolo è obbligatorio',
        'brand.required'=> 'Il brand è obbligatorio',
        'price.required'=> 'Il prezzo è obbligatorio',
        'description.required'=> 'La descrizione è obbligatoria',
        'occurence.required'=> "L'occasione è obbligatoria",
        'category.required'=> 'La descrizione è obbligatoria',
        'description.min'=> 'La descrizione deve essere lunga almeno 15 caratteri',
        'quantity.required'=>"La quantità è obbligatoria",
        'barcode.required'=>"Il codice a barre è obbligatorio"

    ];

    public function edit(){
        $this->validate();
        Product::where('id', $this->product->id)->first()->update([
            'title'=>$this->title,
            'description'=>$this->description,
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'barcode'=>$this->barcode,

        ]
        );

        Product::where('id', $this->product->id)->first()->categories()->sync($this->category);
        Product::where('id', $this->product->id)->first()->brands()->sync($this->brand);
        Product::where('id', $this->product->id)->first()->occurences()->sync($this->occurence);


        if ($this->img) {
             $this->product->update([
                 'img' => $this->img->store('public/media'),
            ]);
             File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        return redirect(route('dashboard'))->with('message', 'Prodotto modificato correttamente');

    }


    public function delete(){
        $this->product->delete();
         return redirect(route('dashboard'))->with('message', 'Prodotto eliminato correttamente');
    }

    public function mount(){
        $this->title=$this->product->title;
        $this->brand = $this->product->brands->pluck('id');
        $this->description=$this->product->description;
        $this->price=$this->product->price;
        $this->quantity=$this->product->quantity;
        $this->barcode=$this->product->barcode;
        $this->category=$this->product->categories->pluck('id');
        $this->occurence=$this->product->occurences->pluck('id');
    }

    public function render()
    {
        return view('livewire.edit-product',[
            'categories'=>Category::all(),
            'brands'=>Brand::all(),
            'occurences'=>Occurence::all(),
        ]);
    }
}
