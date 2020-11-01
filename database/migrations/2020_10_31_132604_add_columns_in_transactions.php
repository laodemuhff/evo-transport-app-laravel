<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->text('cancelled_reason')->nullable()->after('status_transaksi');
            $table->dateTime('customer_return_date')->nullable()->after('pickup_date');
            $table->dateTime('return_date')->nullable()->after('pickup_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('cancelled_reason');
            $table->dropColumn('customer_return_date');
            $table->dropColumn('return_date');
        });
    }
}
