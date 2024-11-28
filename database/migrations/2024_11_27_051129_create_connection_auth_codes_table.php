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
        Schema::create('connections_auth_codes', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->foreignUuid('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUuid('team_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUuid('connection_id')->nullable()->constrained()->cascadeOnDelete();
            $table->json('scopes')->nullable();
            $table->boolean('revoked');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connection_auth_codes');
    }
};
