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
        Schema::create('tblemploye', function (Blueprint $table){
            //$table->id();
            $table->string('nik', 15)->primary();
            $table->string('empname', 150);
            $table->mediumInteger('kodecab');
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
        Schema::dropIfExists('tblemploye');
    }
};
