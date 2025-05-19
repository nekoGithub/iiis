<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfidCard extends Model
{
    use HasFactory;

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function accesses()
    {
        return $this->hasMany(Access::class);
    }
}
