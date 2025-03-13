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
        Schema::create('tickets', function (Blueprint $table) {
            #$table->id();
            $table->unsignedBigInteger('session_id');
            $table->string('seat');
            $table->decimal('price', 10, 2);
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->timestamps();

            $table->foreign('session_id')->references('id_session')->on('sessions')->onDelete('cascade');
            $table->primary(['session_id', 'seat']);
        });
        DB::table('tickets')->insert([
            'session_id' => '1',
            'seat' => 'A-1',
            'price' => 4.00,
            'email' => 'client1@gmail.com',
            'first_name' => 'Client',
            'last_name' => 'One',
            'phone_number' => '123456789',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
