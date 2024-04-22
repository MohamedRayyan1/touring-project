<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;


    protected $table='travels';
    protected $fillable=[
        'tourism_name_site','period','country_name',
        'hotels_name','departing_place','degree_valeting',
        'activities', 'food_service_schedule','price','status',
        'seating_stoppages','departing_appointment',
    ];

    public function comment(){
        return $this->belongsToMany(Comment::class);
    }

}
