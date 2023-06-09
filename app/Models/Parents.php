<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $fillable = [
        'fathers_name',
        'fathers_occupation',
        'mothers_name',
        'mothers_occupation',
        'guardian_name',
        'guardian_contact_no',
        'address',
        'contact_no',
    ];
    public function child()
    {
        return $this->hasOne(Child::class, 'parent_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
