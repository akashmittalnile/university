<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;
    protected $key = 'id';
    protected $table = 'badges';
    protected $fillable = ['path', 'type', 'status'];
}
