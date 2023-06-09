<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'child_id',
        'parent_id',
        'student_id',
        'payment_option',
        'total_tuition_fee',
        'down_payment',
        'cash_receive',
        'payment_1st_month',
        'payment_2nd_month',
        'payment_3rd_month',
        'payment_4th_month',
        'payment_5th_month',
        'payment_6th_month',
        'payment_7th_month',
        'payment_8th_month',
        'payment_9th_month',
        'payment_10th_month',
    ];
    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id', 'child_id');
    }

    public function parent()
    {
        return $this->belongsTo(Parents::class);
    }

    public function studentBasicInformation()
    {
        return $this->belongsTo(StudentBasicInformation::class);
    }
}
