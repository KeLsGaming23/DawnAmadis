<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPortal extends Model
{
    use HasFactory;
    protected $fillable = [
        'role', 
        'first_name', 
        'middle_name', 
        'last_name'
    ];
}
