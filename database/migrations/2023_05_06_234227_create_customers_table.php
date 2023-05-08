<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('date_of_birth');
            $table->string('gender');
            $table->string('regency');
            $table->string('subdistrict');
            $table->string('village');
            $table->string('address');
            $table->string('company');
            $table->string('notes');
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
        Schema::dropIfExists('customers');
    }
}
