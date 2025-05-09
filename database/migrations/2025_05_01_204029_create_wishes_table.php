<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishesTable extends Migration
{
    public function up()
    {
        Schema::create('wishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users');  // Collega a 'users'
            $table->json('content'); // Colonna JSON per il contenuto (titolo, immagine, ecc.)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wishes');
    }
}
