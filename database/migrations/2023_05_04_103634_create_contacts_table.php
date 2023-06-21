<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('data_origin_id')->constrained('data_origins')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('name');
            $table->enum('gender',['laki-laki','perempuan']);
            $table->enum('status',['netral','hot','medium','low','follow_up','next_follow_up','customer']);
            $table->string('photo')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('village')->nullable();
            $table->string('job')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('hobby')->nullable();
            $table->enum('relationship_status',['belum menikah','menikah'])->nullable();
            $table->string('partner_name')->nullable();
            $table->string('partner_job')->nullable();
            $table->string('number_of_children')->nullable();
            $table->string('contact_record')->nullable();
            $table->string('supporting_notes')->nullable();
            $table->date('save_date');
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
        Schema::dropIfExists('contacts');
    }
}
