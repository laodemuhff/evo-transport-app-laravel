<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSeveralColInArmadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('armadas', function (Blueprint $table) {
            $table->dropColumn('status_driver');
            $table->dropColumn('price');
            $table->dropColumn('photo');

        });

        Schema::table('tipe_armadas', function (Blueprint $table) {
            $table->enum('status_driver', ['tidak pakai supir', 'pakai supir'])->after('tipe_kemudi');
            $table->double('price')->after('status_driver');
            $table->string('photo')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipe_armadas', function (Blueprint $table) {
            $table->dropColumn('status_driver');
            $table->dropColumn('price');
            $table->dropColumn('photo');

        });

        Schema::table('armadas', function (Blueprint $table) {
            $table->enum('status_driver', ['tidak pakai supir', 'pakai supir'])->after('status_armada');
            $table->double('price')->after('status_driver');
            $table->string('photo')->after('price');
        });
    }
}
