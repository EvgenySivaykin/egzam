<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    Const SORT = [
        'asc_title' => 'Title A-Z',
        'desc_title' => 'Title Z-A',
    ];

    const PER_PAGE = [
        'all', 4, 8, 12, 16
    ];


    public function dishRestaurant() 
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id', 'id');
    }

    public function deletePhoto()
    {
        $fileName = $this->photo;
        if (file_exists(public_path().$fileName)) {
            unlink(public_path().$fileName);
        }
        $this->photo = null;
        $this->save();
    }
}