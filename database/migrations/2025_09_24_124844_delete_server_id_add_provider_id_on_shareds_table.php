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
            $table->dropConstrainedForeignId('server_id');
            $table->foreignId('provider_id')->constrained();
        });
    }
};
