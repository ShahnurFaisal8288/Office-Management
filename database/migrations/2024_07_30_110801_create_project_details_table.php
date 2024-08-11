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
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('project_create_id');
            $table->foreign('project_create_id')->references('id')->on('projects')->onDelete('cascade');
            // $table->unsignedBigInteger('employee_id');
            // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedBigInteger('project_module_id');
            $table->foreign('project_module_id')->references('id')->on('project_modules')->onDelete('cascade');
            $table->string('hours')->nullable();
            $table->string('features')->nullable();
            $table->string('details')->nullable();
            $table->json('employee_id')->nullable();
            $table->enum('status',['incomplete','ongoing','complete'])->default('incomplete');
            $table->longText('remarks')->nullable();
            $table->date('startTime')->nullable();
            $table->date('endTime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_details');
    }
};
