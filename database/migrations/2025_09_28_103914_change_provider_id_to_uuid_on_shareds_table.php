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
        Schema::table('shareds', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('provider_id');
            $table->foreignUuid('provider_id')->constrained()->change();
        });
        Schema::table('shareds', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('provider_id');
            $table->foreignUuid('provider_id')->constrained()->change();
        });
    }
};
