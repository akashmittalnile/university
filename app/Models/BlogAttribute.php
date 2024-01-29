<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogAttribute extends Model
{
    use HasFactory;
    protected $key = 'id';
    protected $table = 'blog_attributes';
    protected $fillable = ['blog_id', 'image', 'type', 'status'];
}
