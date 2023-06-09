<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentBasicInformation extends Model
{
    use SoftDeletes;

    protected $table = 'student_basic_informations';

    protected $fillable = [
        'last_name', 
        'first_name', 
        'middle_name', 
        'users_id', 
        'school_years_id',
        'old_student',
        'gender',
        'birth_date',
        'place_of_birth',
        'grade',
        'profile_picture'
    ];
    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class, 'school_years_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function child()
    {
        return $this->hasOne(Child::class, 'student_id');
    }
    public function parent()
    {
        return $this->hasOneThrough(Parents::class, Child::class, 'student_id', 'id', 'parent_id', 'id');
    }
}
