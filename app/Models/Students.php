<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_name',
        'class',
        'email',
        'user_id',
        'dob',
        'gender',
        'religion',
        'community',
        'nationality',
        'orphan_student_status',
        'birth_id',
        'aadharno',
        'identification_mark',
        'previous_school',
        'total_siblings',
        'blood_grp',
        'disease_status',
        'doa',
        'discount_fee',
        'profile_picture',
        'permanent_address',
        'current_address',
        'father_name',
        'father_aadhaar_no',
        'father_occupation',
        'father_mobile_no',
        'father_mobile_status_wp',
        'father_income',
        'mother_name',
        'mother_aadhaar_no',
        'mother_occupation',
        'mother_mobile_no',
        'mother_mobile_status_wp',
        'mother_income',
        'active_status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
