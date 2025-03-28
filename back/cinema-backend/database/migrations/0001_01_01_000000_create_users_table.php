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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('birthday');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('password');
            $table->integer('type')->default(2);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name'=> 'clara',
            'surname'=> 'reyes',
            'birthday'=> '16/09/2005',
            'phone_number'=> '123456789',
            'email'=> 'clara@gmail.com',
            'password'=> bcrypt('clara'),
        ]);

        DB::table('users')->insert([
            'name'=> 'Admin',
            'surname'=> 'Admin',
            'birthday'=> '16/09/2005',
            'phone_number'=> '123456789',
            'email'=> 'admin@gmail.com',
            'password'=> bcrypt('admin.123'),
            'type' => 1,
        ]);

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('table_sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
