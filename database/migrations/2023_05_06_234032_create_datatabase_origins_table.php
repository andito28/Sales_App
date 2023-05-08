<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatatabaseOriginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datatabase_origins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('origin');
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
        Schema::dropIfExists('datatabase_origins');
    }
}
