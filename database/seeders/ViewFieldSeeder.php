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
    }
}
