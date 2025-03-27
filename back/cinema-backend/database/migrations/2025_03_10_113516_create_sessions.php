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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id('id_session');
            $table->date('day');
            $table->time('hour');
            $table->unsignedBigInteger('movie_id');
            $table->boolean('audienceDay')->default(false);
            $table->decimal('priceBase', 10, 2)->default(6.00);
            $table->boolean('vip')->default(false);
            $table->integer('total_tickets')->default(120);
            $table->integer('tickets_sold')->default(0);
            $table->timestamps();

            $table->foreign('movie_id')->references('id_movie')->on('movies')->onDelete('cascade');
        });
        DB::table('sessions')->insert([
            [
                'day' => '2025-04-15',
                'hour' => '18:00:00',
                'movie_id' => '1',
                'audienceDay' => true,
                'priceBase' => 4.00,
                'vip' => true,
                'total_tickets' => 120,
                'tickets_sold' => 6,
            ],
            [
                'day' => '2025-04-15',
                'hour' => '18:00:00',
                'movie_id' => '1',
                'audienceDay' => true,
                'priceBase' => 4.00,
                'vip' => true,
                'total_tickets' => 120,
                'tickets_sold' => 6,
            ],
            [
                'day' => '2025-04-16',
                'hour' => '20:30:00',
                'movie_id' => '2',
                'audienceDay' => false,
                'priceBase' => 6.50,
                'vip' => false,
                'total_tickets' => 100,
                'tickets_sold' => 15,
            ],
            [
                'day' => '2025-04-17',
                'hour' => '22:00:00',
                'movie_id' => '3',
                'audienceDay' => false,
                'priceBase' => 5.00,
                'vip' => true,
                'total_tickets' => 80,
                'tickets_sold' => 25,
            ],
            [
                'day' => '2025-04-18',
                'hour' => '16:00:00',
                'movie_id' => '4',
                'audienceDay' => true,
                'priceBase' => 4.50,
                'vip' => false,
                'total_tickets' => 150,
                'tickets_sold' => 30,
            ],
            [
                'day' => '2025-04-19',
                'hour' => '19:00:00',
                'movie_id' => '5',
                'audienceDay' => false,
                'priceBase' => 7.00,
                'vip' => true,
                'total_tickets' => 90,
                'tickets_sold' => 10,
            ],
            [
                'day' => '2025-04-20',
                'hour' => '21:30:00',
                'movie_id' => '6',
                'audienceDay' => true,
                'priceBase' => 4.00,
                'vip' => false,
                'total_tickets' => 110,
                'tickets_sold' => 40,
            ],
            [
                'day' => '2025-04-21',
                'hour' => '17:45:00',
                'movie_id' => '7',
                'audienceDay' => false,
                'priceBase' => 5.50,
                'vip' => true,
                'total_tickets' => 85,
                'tickets_sold' => 20,
            ],
            [
                'day' => '2025-04-22',
                'hour' => '20:00:00',
                'movie_id' => '8',
                'audienceDay' => true,
                'priceBase' => 4.00,
                'vip' => false,
                'total_tickets' => 120,
                'tickets_sold' => 50,
            ],
            [
                'day' => '2025-04-23',
                'hour' => '22:15:00',
                'movie_id' => '9',
                'audienceDay' => false,
                'priceBase' => 6.00,
                'vip' => true,
                'total_tickets' => 95,
                'tickets_sold' => 35,
            ],
            [
                'day' => '2025-04-24',
                'hour' => '18:30:00',
                'movie_id' => '10',
                'audienceDay' => true,
                'priceBase' => 4.50,
                'vip' => false,
                'total_tickets' => 130,
                'tickets_sold' => 60,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
