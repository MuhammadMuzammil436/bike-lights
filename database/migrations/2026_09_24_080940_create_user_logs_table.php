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
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('action'); // login, logout, create, update, delete, etc.
            $table->string('module')->nullable(); // product, order, inventory, customer
            $table->string('message', 250);

            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();

            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'action']);
            $table->index(['module', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logs');
    }
};
