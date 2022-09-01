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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('about')->nullable();
            $table->string('about_img')->nullable();
            $table->text('message')->nullable();
            $table->string('message_img')->nullable();
            $table->text('mission')->nullable();
            $table->string('mission_img')->nullable();
            $table->text('vision')->nullable();
            $table->string('vision_img')->nullable();
            $table->text('history')->nullable();
            $table->string('history_img')->nullable();
            $table->text('why_choose')->nullable();
            $table->string('why_choose_img')->nullable();
            $table->text('why_best')->nullable();
            $table->string('why_best_img')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('status')->default(true)->comment('1=>active, 0=>inactive');
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
        Schema::dropIfExists('abouts');
    }
};
