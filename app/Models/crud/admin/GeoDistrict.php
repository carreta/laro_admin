<?php

namespace App\Models\crud\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoDistrict extends Model
{
    use HasFactory;

    protected $table = 'geo_districts';

    protected $fillable = ['name', 'code', 'geo_region_id'];
}
