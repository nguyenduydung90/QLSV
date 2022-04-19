<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LopHoc;

class Student extends Model
{
    use HasFactory;

    protected $table = 'sudent';
    protected $fillable = [
        'name', 'gender', 'phone', 'address', 'image', 'birthday', 'MaLH'

    ];

    public function lops()
    {
        return $this->belongsTo(LopHoc::class, 'MaLH', 'id');
    }
}
