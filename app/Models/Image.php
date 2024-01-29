<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $key = 'id';
    protected $table = 'images';
    protected $fillable = ['path', 'type', 'status'];
}
