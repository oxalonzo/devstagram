<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    
     /** @use HasFactory<\Database\Factories\PostFactory> */
     use HasFactory;

     //ya aqui no se requiere el post_id porque lo decteta automaticamente
     protected $fillable = [
        'user_id',
     ];

}
