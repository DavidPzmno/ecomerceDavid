<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    public $fillable = [
        'sku',
        'name',
        'price',
        'cart_id'
    ];


    public function cart(){

        return $this->belongsTo(Cart::class);

    }

}
