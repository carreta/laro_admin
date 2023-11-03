<?php

namespace App\Models\crud\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoRegion extends Model
{
    use HasFactory;

    protected $table = 'geo_regions';

    protected $fillable = ['name', 'code', 'geo_state_id'];
}
