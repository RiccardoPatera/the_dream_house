<?php

namespace App\Models;

use App\Models\User;

use App\Models\OrderedProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;



    public function orderedproducts(){
        return $this->hasMany(OrderedProduct::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shipping(){
        return $this->hasOne(Shipping::class);
    }
}

