<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Student;

class LopHoc extends Model
{
    use HasFactory;
    protected $table = 'class';
    protected $fillable = [
        'name', 'MAGV', 'khoi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'MAGV', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'MaLH', 'id');
    }
}
