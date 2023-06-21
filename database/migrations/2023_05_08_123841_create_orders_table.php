<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('subscription_package_id')->constrained('subscription_packages')->onDelete('cascade')->onUpdate('cascade');
            $table->string('evidence_of_transfer');
            $table->string('bank_name');
            $table->string('name');
            $table->integer('total_price');
            $table->integer('uniq_number');
            $table->enum('status',['unpaid','paid']);
            $table->foreignId('affiliate_id')->constrained('affiliates')->onDelete('cascade')->onUpdate('cascade')->nullable();
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
}
