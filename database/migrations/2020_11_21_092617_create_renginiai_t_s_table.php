<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenginiaiTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renginiai_t_s', function (Blueprint $table) {
            $table->string('pavadinimas');
            $table->text('turinys', 60000);
            $table->string('nuotrauka');
            $table->string('pradzia');
            $table->string('pabaiga');
            $table->string('vieta');
            $table->string('zyma');
            $table->string('kartosis');
            $table->BigInteger('savininko_id');
            $table->id();
            $table->timestamps();
        });

        DB::table('renginiai_t_s')->insert(
            array(
                'pavadinimas' => 'Gedimino prospekto šventė',
                'turinys' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.',
                'nuotrauka' => 'location',
                'savininko_id' => 2,
                'pradzia' => '2020-11-21',
                'pabaiga' => '2020-11-22',
                'vieta' => 'Marijampolė Dainavos g. 26',
                'zyma' => 'Pokalbių šou',
                'kartosis' => 'nesikartos',
            )
        );

        DB::table('renginiai_t_s')->insert(
            array(
                'pavadinimas' => 'Turko prospekto šventė',
                'turinys' => 'Turinys...',
                'nuotrauka' => 'location',
                'savininko_id' => 2,
                'pradzia' => '2020-11-21',
                'pabaiga' => '2020-11-22',
                'vieta' => 'Marijampolė Dainavos g. 26',
                'zyma' => 'Muzikinis festivalis',
                'kartosis' => 'nesikartos',
            )
        );

        DB::table('renginiai_t_s')->insert(
            array(
                'pavadinimas' => 'Mariaus prospekto šventė',
                'turinys' => 'Turinys...',
                'nuotrauka' => 'location',
                'savininko_id' => 3,
                'pradzia' => '2020-11-21',
                'pabaiga' => '2020-11-22',
                'vieta' => 'Marijampolė Dainavos g. 26',
                'zyma' => 'Muzikinis festivalis',
                'kartosis' => 'nesikartos',
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
        Schema::dropIfExists('renginiai_t_s');
    }
}
