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
        Schema::create('shareds', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('domain');
            $table->string('panel_type');
            $table->string('ipv4');
            $table->string('ipv6')->nullable();
            $table->string('location');
            $table->date('owned_at');
            $table->date('due_at');
            $table->float('price');
            $table->string('price_currency');
            $table->string('cycle_type');
            $table->float('price_per_month');
            $table->float('price_per_year');

            // spec
            $table->integer('domains');
            $table->integer('subdomains');
            $table->integer('disk_in_gb');
            $table->integer('emails');
            $table->integer('bandwith_in_gb');
            $table->integer('ftp');
            $table->integer('databases');

            // if reseller
            $table->boolean('is_reseller')->default(false);
            $table->integer('accounts')->nullable();

            $table->timestamps();
        });
    }
};
