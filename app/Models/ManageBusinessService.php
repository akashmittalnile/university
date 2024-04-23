<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageBusinessService extends Model
{
    use HasFactory;
    protected $key = 'id';
    protected $table = 'manage_business_services';
}
