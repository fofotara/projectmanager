<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('address')->nullable();
            $table->string('image')->default('default-home.jpg');
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->text('description')->nullable();
            $table->decimal('budget')->default(0);
            $table->decimal('area')->default(0);
            $table->integer('floor')->default(0);
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
        Schema::dropIfExists('projects');
    }
}
