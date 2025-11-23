<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // các trường có thể gán mass assignment
    protected $fillable = [
        'name',
        'image_url',
        'price',
        'description',
        'quantity',
        'type',
    ];
}
