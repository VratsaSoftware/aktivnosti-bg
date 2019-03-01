<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('activity_id');
            $table->string('name');
            $table->text('description');
            $table->tinyInteger('min_age')->nullable();
            $table->tinyInteger('max_age')->nullable();
            $table->float('price', 3, 1)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('duration')->nullable();
            $table->boolean('available');
            $table->string('requirements', 255)->nullable();
            $table->boolean('fixed_start');
            $table->string('address');
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->timestamps();
            $table->string('updated_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('city_id')->on('cities');
            $table->unsignedInteger('organization_id');
            $table->foreign('organization_id')->references('organization_id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
