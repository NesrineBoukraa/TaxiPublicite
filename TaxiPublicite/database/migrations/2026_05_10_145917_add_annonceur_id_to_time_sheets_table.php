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
        Schema::table('time_sheets', function (Blueprint $table) {
            $table->foreignId('annonceur_id')
                ->after('id')
                ->constrained('annonceurs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('time_sheets', function (Blueprint $table) {
            $table->dropForeign(['annonceur_id']);
            $table->dropColumn('annonceur_id');
        });
    }
};
