<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Price extends Model {
    protected $fillable = ['price', 'date'];

    public function product() {
        $this->belongsToOne(Product::class);
    }
}