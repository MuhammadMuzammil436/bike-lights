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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payment_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('provider');
            $table->string('provider_transaction_id')->nullable();

            $table->string('type'); // payment, refund
            $table->string('status');

            $table->decimal('amount', 12, 2);

            $table->json('response')->nullable();

            $table->timestamps();

            $table->index([
                'provider',
                'provider_transaction_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
