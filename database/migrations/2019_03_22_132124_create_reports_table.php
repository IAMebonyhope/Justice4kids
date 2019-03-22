<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->string('address');
            $table->string('state');
            $table->string('country');
            $table->string('tags');
            $table->string('personInvolvedIDs');
            $table->string('status')->nullable();
            $table->string('advocateID')->nullable();
            $table->string('watcherIDs')->nullable();
            $table->string('activityIDs')->nullable();
            $table->string('imageID')->nullable();
            $table->string('fileIDs')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
