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
        Schema::create('investors', function (Blueprint $table) {
            $table->id();

            $table->string('serial_number')->nullable();
            $table->string('project_name')->nullable();
            $table->string('project_details')->nullable();
            $table->string('project_owner_name')->nullable();
            $table->string('project_owner_cell_no')->nullable();
            $table->string('project_owner_email')->nullable();
            $table->string('project_value')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->enum('status',['lead','customer'])->default('lead');
            $table->string('lead')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};
