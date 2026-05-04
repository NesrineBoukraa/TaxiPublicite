<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_publicitaires', function (Blueprint $table) {
            $table->id();
            $table->string('nomservice');
            $table->text('description');
            $table->decimal('tarif', 10, 2);
            $table->integer('dureejour');
            $table->boolean('actif')->default(true);
            $table->foreignId('annonceur_id')->constrained('annonceurs')->onDelete('cascade');
            $table->unsignedBigInteger('produit_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_publicitaires');
    }
};
