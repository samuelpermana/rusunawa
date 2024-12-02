<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas');
            $table->foreignId('kamar_id')->constrained('kamars');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar');
            $table->enum('status', [
                'bookingpending',
                'bookingconfirmed',
                'bookingcanceled',
                'paymentpending',
                'paymentconfirmed',
                'paymentcanceled',
                'done',
            ])->default('bookingpending'); 
            $table->string('payment_proof')->nullable(); 
            $table->string('agreement_proof')->nullable(); 
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
