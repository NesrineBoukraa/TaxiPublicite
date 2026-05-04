<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('statut_validations', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->date('datevalidation');
            $table->text('commentaire')->nullable();
            $table->foreignId('dossier_annonce_id')->constrained('dossier_annonces')->onDelete('cascade')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statut_validations');
    }
};
