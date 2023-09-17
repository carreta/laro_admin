<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ViewField;

class ViewFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ViewField::create([
            'route' => 'document_types',
            'field_names' => 'Id Hacienda,Nombre',
            'table_names' => 'hacienda_id,name',
            'view_name' => 'Mantenimiento de tipos de documentos',
        ]);

        ViewField::create([
            'route' => 'companies',
            'field_names' => 'Nombre,Director,Cédula,Tipo de cédula,Dirección,Correo,Latitud,Longitud,País,Provincia,Cantón,Distrito',
            'table_names' => 'name,director,document,nameDocumentType,address,email,geo_latitud,geo_longitud,nameGeoCountry,nameGeoState,nameGeoRegion,nameGeoDistrict',
            'view_name' => 'Mantenimiento de compañías',
        ]);
    }
}
