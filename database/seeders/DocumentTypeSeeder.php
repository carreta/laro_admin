<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\crud\admin\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentType::create([
            'hacienda_id' => '01',
            'name' => 'Cédula Física',
        ]);

        DocumentType::create([
            'hacienda_id' => '02',
            'name' => 'Cédula Jurídica',
        ]);

        DocumentType::create([
            'hacienda_id' => '03',
            'name' => 'DIMEX',
        ]);

        DocumentType::create([
            'hacienda_id' => '04',
            'name' => 'NITE',
        ]);

        DocumentType::create([
            'hacienda_id' => '05',
            'name' => 'Extrangera',
        ]);
    }
}
