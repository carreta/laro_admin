<?php

namespace App\Models\crud\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoCountry extends Model
{
    use HasFactory;

    protected $table = 'geo_countries';

    protected $fillable = ['name', 'code', 'zone'];
}
