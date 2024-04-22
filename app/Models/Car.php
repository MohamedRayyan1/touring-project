<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $fillable=[ 'name', 'model' , 'type' , 'price'];


    public function car__rental__c (): BelongsTo
    {
        return $this->belongsTo(Car_Rental_C::class);
    }
}
