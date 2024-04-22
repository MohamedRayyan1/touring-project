<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Car_Rental_C extends Model
{
    use HasFactory;

    protected $fillable=[ 'name', 'location' , 'rating' ];


        public function car(): HasMany
        {
            return $this->hasMany(Car::class);
        }
    }

