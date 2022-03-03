<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'price',
        'code',
        'quantity',
        'image',
        'status',
        'des_en',
        'des_ar',
        'brand_id',
        'sub_category_id'
    ];
}
