<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryAttribute extends Model
{
    use HasFactory;
    protected $key = 'id';
    protected $table = 'gallery_attributes';
    protected $fillable = ['path', 'type', 'status'];
}
