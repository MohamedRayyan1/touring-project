<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'travel_touring_id',
    ];

    public function user(){
        return $this->hasMany(User::class);
    }

     public function travel(){
        return $this->hasMany(Travel::class);
    }
}
