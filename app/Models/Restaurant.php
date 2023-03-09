<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function restaurantDishes()
    {
        return $this->hasMany(Dish::class, 'restaurant_id', 'id');
    }
}