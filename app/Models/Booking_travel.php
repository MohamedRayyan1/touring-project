<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_travel extends Model
{
    use HasFactory;
    protected $table ='travel_bookings';
    protected $fillable = ['payment_method' , 'travel_touring_id' , 'user_id'];
}
