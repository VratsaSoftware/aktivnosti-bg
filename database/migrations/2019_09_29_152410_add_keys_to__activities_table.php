<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysToActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `activities` CHANGE `price` `price` DOUBLE(6,2) NULL DEFAULT NULL;');

        Schema::table('activities', function (Blueprint $table) {
            $table->boolean('price_visible')->default('0')->nullable();
            $table->bigInteger('votes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `activities` CHANGE `price` `price` DOUBLE(5,2) NULL DEFAULT NULL;');

        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('price_visible');
            $table->dropColumn('votes');
        });
    }
}
