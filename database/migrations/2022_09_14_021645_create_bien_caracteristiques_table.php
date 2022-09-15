<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bien_caracteristiques', function (Blueprint $table) {
            $table->id();
            $table->string('valeur');
            $table->foreignId('bien_id')->constrained('biens')->onDelete('cascade');
            $table->foreignId('caracteristique_id')->constrained('caracteristiques')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bien_caracteristiques');
    }
};
