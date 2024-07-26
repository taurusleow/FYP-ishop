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
        Schema::create('pay_methods', function (Blueprint $table) {
            $table->id();
            $table->string('customerEmail');
            $table->string('paymentName');
            $table->string('paymentType');
            $table->string('paymentCompany');
            $table->string('phoneNo')->nullable();
            $table->string('cardNo')->nullable();
            $table->string('cardMExpiry')->nullable();
            $table->string('cardYExpiry')->nullable();
            $table->string('cardCVV')->nullable();
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
        Schema::dropIfExists('pay_methods');
    }
};
