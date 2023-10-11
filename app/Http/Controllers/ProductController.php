<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }


    public function dashboard(){
        if(Auth::user()->is_admin){
        $products=Product::orderby('created_at','DESC' )->get();
        return view('admin.dashboard',compact('products'));
        }
        else{
            return redirect(route('welcome'))->with("message, Non sei autorizzato ad accedere a quest'area");
        }
    }

    public function index()
    {
        $products=Product::all();
        return view('product.index' ,compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->is_admin) {
            return view('product.create');
        }
        else{
            return redirect(route('product_index'));
        }

    }

    public function show(Product $product)
    {
        return view('product.detail',compact('product'));
    }


    public function wishlist()
    {
        if(!Auth::user()){
            return redirect(route('login'))->with('mustlog', 'Devi essere loggato per aggiungere prodotti tra i tuoi preferiti');
        }
        else{
            return view('product.wishlist');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if(Auth::user()->is_admin){
        return view('product.edit',compact('product'));
        }
        else {
            redirect(route('product_index'))->with("message, Non sei autorizzato ad accedere a quest'area!");
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
       {
        $product->brands()->detach();
        $product->categories()->detach();
        $product->occurences()->detach();
        if(Storage::exists("/public/product/". $product->id . "/")){
            Storage::delete("/public/product/". $product->id . "/");
        }
        $product->images()->delete();
        $product->delete();
        session()->flash('deleted', 'Prodotto eliminato correttamente');
        return redirect(route('dashboard'))->with("message, L'articolo è stato eliminato correttamente.");
    }
}

