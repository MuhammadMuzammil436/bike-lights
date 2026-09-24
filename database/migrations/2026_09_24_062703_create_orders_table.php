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
            $table->string('order_number')->unique();
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('location_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('sales_channel')->default('online');
            $table->string('status')->default('pending');

            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('shipping_amount', 12, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);

            $table->string('currency', 3)->default('PKR');

            // Snapshot of delivery address.
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone', 30)->nullable();
            $table->string('shipping_address_line_1')->nullable();
            $table->string('shipping_address_line_2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_postal_code', 20)->nullable();
            $table->string('shipping_country', 100)->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['sales_channel', 'status']);
            $table->index('customer_id');
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
