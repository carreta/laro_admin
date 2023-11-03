<?php

namespace App\Models\crud\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoState extends Model
{
    use HasFactory;

    protected $table = 'geo_states';

    protected $fillable = ['name', 'code', 'geo_country_id'];
}
