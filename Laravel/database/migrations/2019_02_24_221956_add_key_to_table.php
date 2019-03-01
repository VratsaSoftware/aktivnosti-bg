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
            $table->string('updated_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
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
            $table->dropColumn('deleted_at');
            $table->dropColumn('deleted_by');
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}
