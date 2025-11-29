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
        Schema::table('servers', function (Blueprint $table) {
            $table->boolean('is_owned')->default(true);
        });
        Schema::table('shareds', function (Blueprint $table) {
            $table->boolean('is_owned')->default(true);
        });
        Schema::table('domains', function (Blueprint $table) {
            $table->boolean('is_owned')->default(true);
        });
        Schema::table('miscs', function (Blueprint $table) {
            $table->boolean('is_owned')->default(true);
        });
    }
};
