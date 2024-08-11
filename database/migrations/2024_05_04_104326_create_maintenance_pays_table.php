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
        Schema::create('maintenance_pays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_id');
            $table->foreign('maintenance_id')->references('id')->on('maintenances')->onDelete('cascade');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('payment_type');
            $table->string('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_pays');
    }
};
