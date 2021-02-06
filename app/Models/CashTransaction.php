<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashTransaction extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
