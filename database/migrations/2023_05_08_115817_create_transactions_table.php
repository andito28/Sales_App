<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dream_vehicle_id')->constrained('dream_vehicles')->onDelete('cascade')->onUpdate('cascade');
            $table->string('payment');
            $table->string('leasing');
            $table->string('dp');
            $table->string('installment');
            $table->string('number_of_month');
            $table->string('submission_foto');
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
        Schema::dropIfExists('transactions');
    }
}
