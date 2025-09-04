<?php

namespace App\Models;

use App\Traits\TieneAuditoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use HasFactory;
    use SoftDeletes, TieneAuditoria;

    protected $table = 'peoples';

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'ci',
        'type',
        'address',
        'phone',
        'birthdate',
        'gender',
        'photo',
        'registration_date',
    ];

    public function rfidCard() // Singular
    {
        return $this->hasOne(RfidCard::class);
    }

    public function accesses()
    {
        return $this->hasMany(Access::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
