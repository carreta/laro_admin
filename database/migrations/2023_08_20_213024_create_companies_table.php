<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('holding_id');
            $table->string('name', 200);
            $table->string('business_name', 200);
            $table->string('tradename', 200);
            $table->string('director', 200);
            $table->string('logo', 200);
            $table->string('document', 50);
            $table->integer('document_type_id');
            $table->text('address');
            $table->string('email', 255);
            $table->string('geo_latitud', 20);
            $table->string('geo_longitud', 20);
            $table->integer('geo_country_id');
            $table->integer('geo_state_id');
            $table->integer('geo_region_id');
            $table->integer('geo_district_id');
            $table->integer('geo_suburb_id');
            $table->integer('company_type_id');
            $table->integer('customer_module_id');
            $table->integer('apply_taxes');
            $table->integer('apply_contracts')->default(2);
            $table->integer('active_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
