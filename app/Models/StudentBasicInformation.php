<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentBasicInformation extends Model
{
    use SoftDeletes;

    protected $table = 'student_basic_informations';

    protected $fillable = ['last_name', 'first_name', 'middle_name', 'users_id', 'school_years_id'];

}
