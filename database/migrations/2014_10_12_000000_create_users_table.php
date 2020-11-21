<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vartotojai', function (Blueprint $table) {
            $table->id();
            $table->string('vardas_pavarde');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('vartotojai')->insert(
            array(
                'email' => 'admin@local',
                'vardas_pavarde' => 'Admin',
                'role' => 'admin',
                'password' => Hash::make('1234'),
            )
        );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vartotojai');
    }
}
