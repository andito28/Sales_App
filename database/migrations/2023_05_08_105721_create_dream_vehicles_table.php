<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDreamVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dream_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('condition');
            $table->string('vehicle_brand');
            $table->string('vehicle_name');
            $table->string('vehicle_type');
            $table->string('transmission');
            $table->string('picture');
            $table->string('sold_status');
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
        Schema::dropIfExists('dream_vehicles');
    }
}
