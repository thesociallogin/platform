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
        Schema::create('connections_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('connection_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUuid('provider_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('connections_providers');
    }
};
