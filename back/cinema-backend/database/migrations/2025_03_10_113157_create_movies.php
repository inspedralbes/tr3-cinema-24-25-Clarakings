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
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BMDU2ZWJlMjktMTRhMy00ZTA5LWEzNDgtYmNmZTEwZTViZWJkXkEyXkFqcGdeQXVyNDQ2OTk4MzI@._V1_SX300.jpg',
                'title' => 'Toy Story',
                'director' => 'John Lasseter',
                'actors' => json_encode(["Tom Hanks", "Tim Allen", "Don Rickles"]),
                'sinopsis' => 'Un juguete cowboy celoso intenta sabotear la relación entre un vaquero y un astronauta del espacio exterior.',
                'duration' => '81 minutos',
                'premiere' => '1995-11-22',
                'gendre' => 'Animación, Aventura, Comedia',
                'classification' => 'Apta para todos'
            ],
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BN2VjY2E2NDMtZGMwMC00ODk0LWIyMWUtMjM4YTIyYzE0Y2M3XkEyXkFqcGdeQXVyMTUyNjc3NDQ4._V1_SX300.jpg',
                'title' => 'Dune: Part Two',
                'director' => 'Denis Villeneuve',
                'actors' => json_encode(["Timothée Chalamet", "Zendaya", "Rebecca Ferguson"]),
                'sinopsis' => 'Paul Atreides se une a los Fremen y emprende un viaje espiritual y de venganza contra los conspiradores que destruyeron su familia.',
                'duration' => '166 minutos',
                'premiere' => '2024-03-01',
                'gendre' => 'Ciencia ficción, Aventura, Acción',
                'classification' => 'PG-13'
            ],
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BZmI3NzI0YmUtNzUwYS00MmFkLTg0NjAtMWNmM2I4Y2FiYjMwXkEyXkFqcGdeQXVyMTUzOTcyODA5._V1_SX300.jpg',
                'title' => 'Oppenheimer',
                'director' => 'Christopher Nolan',
                'actors' => json_encode(["Cillian Murphy", "Emily Blunt", "Robert Downey Jr."]),
                'sinopsis' => 'La historia de J. Robert Oppenheimer y su papel en el desarrollo de la bomba atómica durante la Segunda Guerra Mundial.',
                'duration' => '180 minutos',
                'premiere' => '2023-07-21',
                'gendre' => 'Drama, Historia, Biografía',
                'classification' => 'R'
            ],
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BYzEyY2I2YmItMmE4ZS00MDM5LWJjZmMtYjI4NjRmNzM1YzFkXkEyXkFqcGdeQXVyMTE1MzI2NzIz._V1_SX300.jpg',
                'title' => 'Spider-Man: Across the Spider-Verse',
                'director' => 'Joaquim Dos Santos, Kemp Powers, Justin K. Thompson',
                'actors' => json_encode(["Shameik Moore", "Hailee Steinfeld", "Oscar Isaac"]),
                'sinopsis' => 'Miles Morales viaja a través del multiverso y se encuentra con un equipo de Spider-People que intentan proteger su existencia.',
                'duration' => '140 minutos',
                'premiere' => '2023-06-02',
                'gendre' => 'Animación, Acción, Aventura',
                'classification' => 'PG'
            ],
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BZjYxNjA4ZDYtMmZlNi00NGNmLWIxM2MtNjRjOTFlMmY3NjgzXkEyXkFqcGdeQXVyMTEyMjM2NDc2._V1_SX300.jpg',
                'title' => 'The Batman',
                'director' => 'Matt Reeves',
                'actors' => json_encode(["Robert Pattinson", "Zoë Kravitz", "Paul Dano"]),
                'sinopsis' => 'Batman investiga la corrupción en Gotham City y la conexión de su familia con un asesino en serie conocido como el Acertijo.',
                'duration' => '176 minutos',
                'premiere' => '2022-03-04',
                'gendre' => 'Acción, Crimen, Drama',
                'classification' => 'PG-13'
            ],
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BMjQ4NzQxYjktNzg2Mi00MTUzLTgxZDgtYjA4YjI0M2JjMjgxXkEyXkFqcGdeQXVyMTUzOTcyODA5._V1_SX300.jpg',
                'title' => 'Avatar: The Way of Water',
                'director' => 'James Cameron',
                'actors' => json_encode(["Sam Worthington", "Zoe Saldana", "Sigourney Weaver"]),
                'sinopsis' => 'Jake Sully y Neytiri luchan por proteger a su familia en Pandora mientras enfrentan nuevas amenazas.',
                'duration' => '192 minutos',
                'premiere' => '2022-12-16',
                'gendre' => 'Ciencia ficción, Aventura, Acción',
                'classification' => 'PG-13'
            ],
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BNTdhZjA4MDgtNjFjNi00MzRkLWFmNzAtNjE5ZjNiNDQ2NmM3XkEyXkFqcGdeQXVyMTUzOTcyODA5._V1_SX300.jpg',
                'title' => 'Campeonex',
                'director' => 'Javier Fesser',
                'actors' => json_encode(["Jesús Vidal", "Gloria Ramos", "El Langui"]),
                'sinopsis' => 'Los "campeones" vuelven a las canchas, esta vez para enfrentarse a un nuevo reto en el mundo del atletismo.',
                'duration' => '124 minutos',
                'premiere' => '2023-08-18',
                'gendre' => 'Comedia, Drama, Deporte',
                'classification' => 'Apta para todos'
            ],
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BYmE4ODUzNzYtMzc1Ni00MjEyLThjZTktNTgyMWRiODI1ZjY2XkEyXkFqcGdeQXVyMTMzODk3NDU0._V1_SX300.jpg',
                'title' => 'Modelo 77',
                'director' => 'Alberto Rodríguez',
                'actors' => json_encode(["Miguel Herrán", "Javier Gutiérrez", "Jesús Carroza"]),
                'sinopsis' => 'Un joven contable es encarcelado en la prisión Modelo de Barcelona en 1977 y lucha por la justicia en plena transición española.',
                'duration' => '125 minutos',
                'premiere' => '2022-09-23',
                'gendre' => 'Drama, Thriller',
                'classification' => '16+'
            ],
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BM2MwMmM4NDAtMGFkNS00NDZmLWExYWItMjljZjE1YTYyYzEyXkEyXkFqcGdeQXVyMTY3ODkyNDk4._V1_SX300.jpg',
                'title' => 'As Bestas',
                'director' => 'Rodrigo Sorogoyen',
                'actors' => json_encode(["Denis Ménochet", "Marina Foïs", "Luis Zahera"]),
                'sinopsis' => 'Una pareja francesa se muda a un pueblo gallego, pero su relación con los vecinos se vuelve cada vez más tensa y peligrosa.',
                'duration' => '137 minutos',
                'premiere' => '2022-11-11',
                'gendre' => 'Thriller, Drama',
                'classification' => '18+'
            ],
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BNzMyNjZjZjgtOTczMi00MGJjLTg5ZWEtZjkzZGE2ZmE5NjI3XkEyXkFqcGdeQXVyMTY3ODkyNDk4._V1_SX300.jpg',
                'title' => 'La sociedad de la nieve',
                'director' => 'J.A. Bayona',
                'actors' => json_encode(["Enzo Vogrincic", "Matías Recalt", "Agustín Pardella"]),
                'sinopsis' => 'Basada en hechos reales, narra la historia de los supervivientes del accidente aéreo de los Andes en 1972.',
                'duration' => '144 minutos',
                'premiere' => '2023-12-15',
                'gendre' => 'Drama, Supervivencia',
                'classification' => '16+'
            ],
            [
                'image' => 'https://m.media-amazon.com/images/M/MV5BMTFiYzE4MjItYjNiNC00ZjQ3LWIwYmQtNTNkZmE2NTQzYmFkXkEyXkFqcGdeQXVyMTMzODk3NDU0._V1_SX300.jpg',
                'title' => 'Tin & Tina',
                'director' => 'Rubin Stein',
                'actors' => json_encode(["Milena Smit", "Jaime Lorente", "Carlos González Morollón"]),
                'sinopsis' => 'Una pareja adopta a dos niños huérfanos con creencias religiosas extremas, lo que desata eventos inquietantes en su hogar.',
                'duration' => '119 minutos',
                'premiere' => '2023-03-24',
                'gendre' => 'Terror, Thriller',
                'classification' => '18+'
            ]
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
