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
        Schema::create('rfcabang', function (Blueprint $table){
            $table->mediumInteger('kodecab')->primary();
            $table->string('namacab', 80);
            $table->tinyInteger('isactive')->default('1');
            $table->smallInteger('sortorder')->default('9');
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
        Schema::dropIfExists('rfcabang');
    }
};
