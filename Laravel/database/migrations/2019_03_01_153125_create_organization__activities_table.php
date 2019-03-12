<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization__activities', function (Blueprint $table) {
            $table->increments('organization_activity_id');
            $table->unsignedInteger('organization_id');
            $table->foreign('organization_id')->references('organization_id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('activity_id');
            $table->foreign('activity_id')->references('activity_id')->on('activities')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization__activities');
    }
}
