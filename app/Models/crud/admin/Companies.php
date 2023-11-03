<?php

namespace App\Models\crud\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Companies extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'companies';

    protected $fillable = [
        'holding_id',
        'name',
        'business_name',
        'tradename',
        'director',
        'logo',
        'document',
        'document_type_id',
        'address',
        'email',
        'geo_latitud',
        'geo_longitud',
        'geo_country_id',
        'geo_state_id',
        'geo_region_id',
        'geo_district_id',
        'geo_suburb_id',
        'company_type_id',
        'customer_module_id',
        'apply_taxes',
        'apply_contracts',
        'active_id',
    ];
}
