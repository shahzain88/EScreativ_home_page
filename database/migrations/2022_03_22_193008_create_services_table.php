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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('info')->nullable();
            $table->string('feature_image')->nullable();
            $table->text('description')->nullable();
            $table->longText('details_content')->nullable();
            $table->double('unit_price', 8, 2)->default(0.00);

            // Tab
            $table->longText('sales_point')->nullable();
            $table->longText('price_list')->nullable();
            $table->longText('work_content')->nullable();
            $table->longText('flow_to_work')->nullable();
            $table->longText('before_booking')->nullable();
            $table->longText('cancellation_policy')->nullable();
            $table->longText('about_the_store')->nullable();

            // Common Fields
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
        Schema::dropIfExists('services');
    }
};
