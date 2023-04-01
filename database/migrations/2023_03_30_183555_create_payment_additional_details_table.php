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
        Schema::create('payment_additional_details', function (Blueprint $table) {
            $table->id();
            $table->string('details');
            $table->bigInteger('payment_id')->unsigned();
            $table->foreign('payment_id')->on('payments')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_additional_details');
    }
};
