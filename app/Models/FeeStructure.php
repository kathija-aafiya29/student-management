<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class FeeStructure extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_id', 'fee_type', 'caste_id', 'monthly_tution_fee', 'admission_fee', 
        'registration_fee', 'art_material', 'transport', 'books',
        'uniform', 'others', 'total_amount'
    ];
}
