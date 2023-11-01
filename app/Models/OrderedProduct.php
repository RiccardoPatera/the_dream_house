<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderedProduct extends Model
{
    use HasFactory;

    protected $fillable=['order_id', 'product_id','quantity'];

    public function order(){
        return $this->BelongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
