<?php

namespace App\Models;

use App\Traits\TieneAuditoria;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends SpatieRole
{
    use HasFactory;
    use SoftDeletes, TieneAuditoria;
}
