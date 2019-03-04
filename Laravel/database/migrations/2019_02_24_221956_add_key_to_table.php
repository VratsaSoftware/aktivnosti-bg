<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeyToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('family',50);
            $table->text('description')->nullable();
            $table->string('address');
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('city_id')->on('cities');
            $table->string('phone')->nullable();
            $table->string('updated_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->softDeletes();
            $table->string('deleted_by')->nullable();
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('updated_by');
            $table->dropColumn('approved_at');
            $table->dropColumn('approved_by');
            $table->dropSoftDeletes();
            $table->dropColumn('deleted_by');
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}
