<?php

namespace App\Models\crud\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Companies extends Model
{
    use HasFactory, HasRoles;
}
