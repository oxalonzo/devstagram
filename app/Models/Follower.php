<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //este es el modelo de follower para hacer los registro de cuando sigues y dejas de seguir

     /** @use HasFactory<\Database\Factories\PostFactory> */
     use HasFactory;


     protected $fillable = [
        'user_id',
        'follower_id',

    ];




}
