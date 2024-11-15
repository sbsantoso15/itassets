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
        Schema::create('tblassets', function (Blueprint $table){
            $table->string('serialnr', 150)->primary();
            $table->string('jenis', 25);
            $table->mediumInteger('kodecab');
            $table->string('nik', 15)->nullable();
            $table->tinyInteger('isactive')->default('1');
            $table->timestamps();
            $table->string('created_by', 15)->nullable();
            $table->string('updated_by', 15)->nullable();
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblassets');
    }
};
