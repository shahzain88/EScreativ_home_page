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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->nullable();
            $table->double("cost", 8, 2)->default(0.00);
            $table->double('expenses', 8, 2)->default(0.00);
            $table->double('discount', 8, 2)->default(0.00);
            $table->text('construction_details')->nullable();
            $table->string('validity')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
