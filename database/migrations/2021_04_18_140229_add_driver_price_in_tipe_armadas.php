<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDriverPriceInTipeArmadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipe_armadas', function (Blueprint $table) {
            $table->tinyInteger('is_driver_allowed')->default(0)->after('price12');
            $table->double("price_driver")->after('is_driver_allowed')->nullable();
            $table->double("price_driver12")->after('price_driver')->nullable();
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
            $table->dropColumn('is_driver_allowed');
            $table->dropColumn('price_driver');
            $table->dropColumn('price_driver12');
        });
    }
}
