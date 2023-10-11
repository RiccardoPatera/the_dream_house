<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Occurence;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class CreateProduct extends Component
{
    use WithFileUploads;
    public $title;
    public $brand=[];
    public $description;
    public $price;
    public $img;
    public $quantity;
    public $occurence;
    public $barcode;
    public $category=[];




    protected $rules = [
        'title' => 'required|min:5',
        'brand' => 'required',
        'price' => 'required|numeric|doesnt_start_with:-|regex:/^\d+(\.\d{1,2})?$/',
        'description' => 'required|min:15',
        'category' => 'required',
        'occurence'=>'required',
        'img'=> 'required',
        'quantity'=>'required',
        'barcode'=>'required|max:13|string',
    ];

    protected $messages = [
        'title.required'=> 'Il titolo è obbligatorio',
        'brand.required'=> 'Il brand è obbligatorio',
        'price.required'=> 'Il prezzo è obbligatorio',
        'price.regex'=> 'Il prezzo è un valore numerico con due valori decimali.',
        'description.required'=> 'La descrizione è obbligatoria',
        'occurence.required'=> "L'occasione è obbligatoria",
        'category.required'=> 'La categoria è obbligatoria',
        'description.min'=> 'La descrizione deve essere lunga almeno 15 caratteri',
        'img.required'=> "L'immagine è obbligatoria",
        'quantity.required'=>"La quantità è obbligatoria",
        'barcode.required'=>"Il codice a barre è obbligatorio"

    ];

    public function create(){
        $this->validate();
        // $product=Product::create([
        //     'title'=>$this->title,
        //     'description'=>$this->description,
        //     'price'=>$this->price,
        //     'img'=>$this->img->store('public/product'),
        //     'quantity'=>$this->quantity,
        // ]
        // );

        $product = new Product;
        $product->title = $this->title;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->quantity=$this->quantity;
        $product->barcode=$this->barcode;
        $product->save();
            foreach ($this->img as $imagefile) {
        $image = new Image;
        $path = $imagefile->store("/public/product/". $product->id . "/");
        $image->url = $path;
        $image->product_id = $product->id;
        $image->save();
        }



        $product->categories()->attach($this->category);
        $product->brands()->attach($this->brand);
        $product->occurences()->attach($this->occurence);


        File::deleteDirectory(storage_path('/app/livewire-tmp'));
        session()->flash('message','Articolo creato con successo');
        $this->reset();
    }


    function delete_temp($i){
        array_splice($this->img, $i ,1);;
    }


    public function render()
    {
        return view('livewire.create-product',[
            'categories'=>Category::all(),
            'brands'=>Brand::all(),
            'occurences'=>Occurence::all(),
        ]);
    }
}
