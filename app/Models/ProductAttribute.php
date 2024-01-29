<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $key = 'id';
    protected $table = 'product_attributes';
    protected $fillable = ['product_id', 'image', 'type', 'status'];
}
