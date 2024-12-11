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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('total_price', $precision = 8, $scale = 2);
            $table->foreignId('user_id')->constrained();
            $table->boolean('ordered')->default(false);
            $table->string('phone');
            $table->string('address');
            $table->string('cupon')->nullable();
            $table->longText('observations')->nullable();
            $table->integer('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
