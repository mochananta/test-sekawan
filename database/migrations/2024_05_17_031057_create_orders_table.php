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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('vehicle_type'); // Jenis kendaraan: angkutan orang atau angkutan barang
            $table->string('bbm'); 
            $table->string('phone_number'); 
            $table->string('plate_number_type');
            $table->dateTime('service_schedule')->nullable();
            $table->foreignId('driver_id')->constrained();
            $table->string('status')->default('pending');
            $table->foreignId('approved_by_atasan1')->nullable()->constrained('users');
            $table->foreignId('approved_by_atasan2')->nullable()->constrained('users');
            $table->text('usage_history')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
