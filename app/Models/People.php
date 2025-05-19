<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    
    protected $table = 'peoples';

    protected $fillable = [
        'name', 
        'last_name', 
        'email', 
        'phone', 
        'birthdate', 
        'gender', 
        'photo', 
        'registration_date'
    ];

    public function rfidCards()
    {
        return $this->hasMany(RfidCard::class);
    }

    public function accesses()
    {
        return $this->hasMany(Access::class);
    }
}
