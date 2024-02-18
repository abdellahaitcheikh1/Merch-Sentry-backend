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
        Schema::create('article_x_substitut', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_Article')
                ->constrained('articles', 'IdArticle')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('LibelleSubstitut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_x_substitut');

    }
};
