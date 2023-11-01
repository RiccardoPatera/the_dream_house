<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Order;
use App\Models\Category;
use Maize\Markable\Markable;
use Laravel\Scout\Searchable;
use App\Models\OrderedProduct;
use Maize\Markable\Models\Favorite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;
    use Searchable;
    use Markable;

    protected $fillable = ['title','description','price','img','quantity','barcode','color_id'];

    protected static $marks = [
        Favorite::class,
    ];

    public function categories(){
        return $this->BelongstoMany(Category::class);
    }

    public function brands(){
        return $this->BelongsToMany(Brand::class);
    }

    public function occurences(){
        return $this->BelongsToMany(Occurence::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function color(){
        return $this->hasOne(Color::class);
    }

    public function orderedproduct(){
        return $this->hasOne(OrderedProduct::class);
    }

    public function cartitems(){
        return $this->hasOne(Cartitem::class);
    }

    public function delete()
    {
        $this->cartitems()->delete();
        return parent::delete();
    }
    }



