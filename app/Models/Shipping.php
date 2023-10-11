<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;

    // protected $fillable=['user_id','address','street_number','city','country','zip_code','state'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
