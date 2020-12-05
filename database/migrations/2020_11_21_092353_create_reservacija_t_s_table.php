<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservacijaTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservacija_t_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vartotojo_id');
            $table->unsignedBigInteger('renginio_id');
            $table->boolean('reminder_sent');
            $table->timestamps();
        });

        DB::table('reservacija_t_s')->insert(
            array(
                'vartotojo_id' => 5,
                'renginio_id' => 1,
                'reminder_sent' => false,
            )
        );

        DB::table('reservacija_t_s')->insert(
            array(
                'vartotojo_id' => 5,
                'renginio_id' => 2,
                'reminder_sent' => false,
            )
        );

        DB::table('reservacija_t_s')->insert(
            array(
                'vartotojo_id' => 6,
                'renginio_id' => 1,
                'reminder_sent' => false,
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
        Schema::dropIfExists('reservacija_t_s');
    }
}
