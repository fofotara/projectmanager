<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('duration')->default(0);
            $table->float('progress')->default(0);
            $table->integer('sortorder')->default(0);
            $table->integer('parent')->nullable();
            $table->DateTime('start_date')->nullable();
            $table->string('text');
            $table->decimal('cost_amount')->default(0);
            $table->decimal('total_cost_amount')->default(0);
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
        Schema::dropIfExists('projectdetails');
    }
}
