<?php

namespace App\Models\crud\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoSuburb extends Model
{
    use HasFactory;

    protected $table = 'geo_suburbs';

    protected $fillable = ['name', 'code', 'atv', 'geo_district_id'];
}
