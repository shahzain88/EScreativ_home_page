<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->text('title')->unique();
            $table->text('slug')->unique();
            $table->longText('description');
            $table->bigInteger('category_id')->nullable();
            $table->text('client_feedback')->nullable();
            $table->string('client_name');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('budget');
            $table->longText('image');
            $table->boolean('status')->default(true)->comment("1=>Publish, 0=>Unpublish")->nullable();
            $table->bigInteger('created_by')->default(1);
            $table->bigInteger('updated_by')->nullable();
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
};
