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
        Schema::create('utilisateurs1', function (Blueprint $table) {
            $table->id('id');
            $table->string('Nom');
            $table->string('Prenom');
            $table->string('telephone')->nullable();
            $table->string('email');
            $table->string('Password');
            $table->string('role');
            $table->string('solde')->default(0);
            $table->timestamp('DateCreation')->nullable();
            $table->timestamp('DateModification')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs1');

    }
};
