<?php

declare(strict_types=1);

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
        Schema::create('servers', function (Blueprint $table): void {
            $table->id();
            $table->string('hostname')->unique();
            $table->foreignId('provider_id')->constrained();
            $table->json('ip_addresses_v4');
            $table->json('ip_addresses_v6');
            $table->string('server_type');
            $table->string('os');
            $table->integer('cpu');
            $table->string('cpu_model');
            $table->integer('ram');
            $table->string('ram_type');
            $table->integer('disk');
            $table->string('disk_type');
            $table->string('location');
            $table->date('owned_at');
            $table->date('due_at');
            $table->float('price');
            $table->string('price_currency');
            $table->string('cycle_type');
            $table->float('price_per_month');
            $table->float('price_per_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
