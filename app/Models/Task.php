<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // تحديد الحقول المسموح بتعبئتها
    protected $fillable = ['title', 'description', 'status'];
}
