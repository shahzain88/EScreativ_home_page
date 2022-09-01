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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('subject');
            $table->longText('message')->nullable();
            $table->boolean('quotation')->default(false)->comment('0=>Unchecked, 1=>Checked')->nullable();
            $table->boolean('visit')->default(false)->comment('0=>Unchecked, 1=>Checked')->nullable();
            $table->boolean('diagnosis')->default(false)->comment('0=>Unchecked, 1=>Checked')->nullable();
            $table->boolean('consultation')->default(false)->comment('0=>Unchecked, 1=>Checked')->nullable();
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
        Schema::dropIfExists('quotations');
    }
};
