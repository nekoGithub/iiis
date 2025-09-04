<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'people_id',
        'semester',
        'status',
        'enrollment_number',
        'guardian_name',
        'guardian_phone',
    ];
    
    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
