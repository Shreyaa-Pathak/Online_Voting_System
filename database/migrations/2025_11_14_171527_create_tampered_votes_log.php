<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tampered_votes_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vote_id');
            $table->timestamp('detected_at');
            $table->text('details')->nullable();
            $table->foreign('vote_id')->references('id')->on('votes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tampered_votes_log');
    }
};
