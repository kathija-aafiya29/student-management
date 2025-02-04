<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CustomGrading extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['grade', 'from', 'to', 'status', 'created_by', 'updated_by'];
}