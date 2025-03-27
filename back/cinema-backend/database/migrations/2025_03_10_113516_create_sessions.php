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
            'day' => '2025-04-15',
            'hour' => '18:00:00',
            'movie_id' => '1',
            'audienceDay' => true,
            'priceBase' => 4.00,
            'vip' => true,
            'total_tickets' => 120,
            'tickets_sold' => 6,
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
