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
                'email' => 'admin@gmail.com',
                'vardas_pavarde' => 'Admin',
                'role' => 'admin',
                'password' => Hash::make('1234'),
            )
        );

        DB::table('vartotojai')->insert(
            array(
                'email' => 'org1@gmail.com',
                'vardas_pavarde' => 'Tomas Kruizas',
                'role' => 'renginio_organizatorius',
                'password' => Hash::make('1234'),
            )
        );

        DB::table('vartotojai')->insert(
            array(
                'email' => 'org2@gmail.com',
                'vardas_pavarde' => 'Lomas Pocius',
                'role' => 'renginio_organizatorius',
                'password' => Hash::make('1234'),
            )
        );

        DB::table('vartotojai')->insert(
            array(
                'email' => 'org3@gmail.com',
                'vardas_pavarde' => 'Reigardas Liusas',
                'role' => 'renginio_organizatorius',
                'password' => Hash::make('1234'),
            )
        );

        DB::table('vartotojai')->insert(
            array(
                'email' => 'var1@gmail.com',
                'vardas_pavarde' => 'Somas Kruizas',
                'role' => 'vartotojas',
                'password' => Hash::make('1234'),
            )
        );

        DB::table('vartotojai')->insert(
            array(
                'email' => 'var2@gmail.com',
                'vardas_pavarde' => 'Pomas Pocius',
                'role' => 'vartotojas',
                'password' => Hash::make('1234'),
            )
        );

        DB::table('vartotojai')->insert(
            array(
                'email' => 'var3@gmail.com',
                'vardas_pavarde' => 'Meigardas Liusas',
                'role' => 'vartotojas',
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
