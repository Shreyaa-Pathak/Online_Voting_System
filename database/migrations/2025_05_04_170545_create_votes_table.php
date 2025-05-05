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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // voter
            $table->foreignId('election_id')->constrained()->onDelete('cascade'); // election being voted in
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade'); // chosen candidate
           
    
            // User can only vote once per election
            $table->unique(['user_id', 'election_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
