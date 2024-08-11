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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('po_so_number');
            $table->string('discount')->nullable();
            $table->string('disWith_total_amount')->nullable();
            // $table->date('transaction_date');
            $table->date('payment_due_date');
            $table->string('payment_type');
            $table->string('advance')->nullable();

            $table->string('dueAmount');
            $table->string('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
