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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->Integer('productID');
            $table->string('variantName1')->nullable();
            $table->string('variantName2')->nullable();
            $table->string('variantName3')->nullable();
            $table->string('variantName4')->nullable();
            $table->string('variantName5')->nullable();
            $table->string('variantImg1')->nullable();
            $table->string('variantImg2')->nullable();
            $table->string('variantImg3')->nullable();
            $table->string('variantImg4')->nullable();
            $table->string('variantImg5')->nullable();
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
        Schema::dropIfExists('product_variants');
    }
};
