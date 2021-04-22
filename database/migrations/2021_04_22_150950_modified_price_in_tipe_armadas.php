<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifiedPriceInTipeArmadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE tipe_armadas MODIFY price DOUBLE');
        DB::statement('ALTER TABLE tipe_armadas MODIFY price12 DOUBLE NOT NULL ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE tipe_armadas MODIFY price DOUBLE NOT NULL ');
        DB::statement('ALTER TABLE tipe_armadas MODIFY price12 DOUBLE');
    }
}
