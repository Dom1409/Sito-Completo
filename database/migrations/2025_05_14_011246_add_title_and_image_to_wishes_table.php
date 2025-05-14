<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('wishes', function (Blueprint $table) {
        $table->string('title')->after('id_user');
        $table->text('image')->after('title');
        $table->dropColumn('content'); // se vuoi rimuoverla
    });
}

public function down()
{
    Schema::table('wishes', function (Blueprint $table) {
        $table->dropColumn('title');
        $table->dropColumn('image');
        $table->json('content')->nullable(); // se vuoi ripristinarla
    });
}

};
