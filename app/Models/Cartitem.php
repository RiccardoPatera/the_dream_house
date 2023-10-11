<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cartitem extends Model
{
    use HasFactory;

    protected $fillable=['product_id','quantity'];


    public function users(){
        return $this->belongsToMany(User::class,);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
