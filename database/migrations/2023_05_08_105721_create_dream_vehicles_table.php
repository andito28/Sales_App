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
            $table->enum('status',['dream','bought']);
            $table->enum('item_condition',['baru','bekas','trade in']);
            $table->foreignId('vehicle_brand_id')->constrained('vehicle_brands')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('vehicle_name_id')->constrained('vehicle_names')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('vehicle_type_id')->constrained('vehicle_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('vehicle_color_id')->constrained('vehicle_colors')->onDelete('cascade')->onUpdate('cascade');
            $table->date('purchase_date')->nullable();
            $table->enum('transmission',['manual','automatic']);
            $table->enum('payment',['cash','kredit']);
            $table->string('leasing')->nullable();
            $table->integer('dp')->nullable();
            $table->string('repayment')->nullable();
            $table->string('installment')->nullable();
            $table->string('number_of_month')->nullable();
            $table->enum('ownership',['pribadi','perusahaan'])->nullable();
            $table->string('notes');
            $table->string('deals_photo');
            $table->enum('sold_status',['false','true']);
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
