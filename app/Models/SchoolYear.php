<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_year',
    ];
    public function studentBasicInformations()
    {
        return $this->hasMany(StudentBasicInformation::class, 'school_years_id');
    }

}
