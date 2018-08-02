<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     // $category->product
     public function product()
     {
         return $this->hasMany(Product::class);
     }
}
