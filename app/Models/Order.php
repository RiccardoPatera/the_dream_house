<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;



    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function shipping(){
        return $this->hasOne(Shipping::class);
    }
}

