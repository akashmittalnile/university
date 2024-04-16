<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageAboutUs extends Model
{
    use HasFactory;
    protected $key = 'id';
    protected $table = 'manage_about_us';
    protected $fillable = ['title', 'description', 'section_code', 'image1', 'image2', 'status'];
}
