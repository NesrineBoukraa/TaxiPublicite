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
        Schema::table('annonceurs', function (Blueprint $table) {
             $table->string('matricule_fiscale')->nullable();

            $table->foreignId('admin_user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annonceurs', function (Blueprint $table) {
             $table->dropForeign(['admin_user_id']);

            $table->dropColumn([
                'matricule_fiscale',
                'admin_user_id'
            ]);

        });
    }
};