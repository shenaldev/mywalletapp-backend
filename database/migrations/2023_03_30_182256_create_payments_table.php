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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->char('currency', 3)->default('LKR');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('payment_method_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('category_id')->on('categories')->references('id')->cascadeOnUpdate();
            $table->foreign('payment_method_id')->on('payment_methods')->references('id')->cascadeOnUpdate();
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
