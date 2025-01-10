<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_name', 'employee_role', 'dob', 'gender', 'email', 
        'blood_grp', 'marital_status', 'emp_relative_name', 'religion',
        'community', 'nationality', 'education', 'experience', 'doj', 
        'monthly_salary', 'aadharno', 'mobileno', 'alt_mobileno',
        'mobileno_wp_status', 'alt_mobileno_wp_status', 
        'permanent_address', 'current_address', 'user_id','profile_picture','active_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
