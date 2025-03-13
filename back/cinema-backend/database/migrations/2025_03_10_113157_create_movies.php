<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id('id_movie')->autoIncrement();
            $table->string('image');
            $table->string('title');
            $table->string('director');
            $table->string('actors');
            $table->string('sinopsis');
            $table->string('duration');
            $table->date('premiere');
            $table->string('gendre');
            $table->string('classification');
            $table->timestamps();
        });

        DB::table('movies')->insert([
            'image' => 'https://m.media-amazon.com/images/M/MV5BMDU2ZWJlMjktMTRhMy00ZTA5LWEzNDgtYmNmZTEwZTViZWJkXkEyXkFqcGdeQXVyNDQ2OTk4MzI@._V1_SX300.jpg',
            'title' => 'Toy Story',
            'director' => 'John Lasseter',
            'actors' => json_encode(["Tom Hanks", "Tim Allen", "Don Rickles"]),
            'sinopsis' => 'Un juguete cowboy celoso intenta sabotear la relación entre un vaquero y un astronauta del espacio exterior.',
            'duration' => '81 minutos',
            'premiere' => '1995-11-22',
            'gendre' => 'Animación, Aventura, Comedia',
            'classification' => 'Apta para todos'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }

};
