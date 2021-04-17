<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeVariablesInTipeArmadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipe_armadas', function (Blueprint $table) {
            $table->integer('kapasitas_penumpang')->default(5)->after('tipe');
            $table->enum('tipe_kemudi', ['Automatic', 'Manual', 'Automatic/Manual'])->after('kapasitas_penumpang');
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
            $table->dropColumn('kapasitas_penumpang');
            $table->dropColumn('tipe_kemudi');
        });
    }
}
