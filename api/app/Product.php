<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['name', 'currentPrice', 'imageUrl', 'productPage'];

    public function category() {
        return $this->hasOne(Category::class);
    }

    public function prices() {
        return $this->hasMany(Price::class);
    }
}