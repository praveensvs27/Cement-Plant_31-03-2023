<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plant',250);
            $table->integer('plant_type_id');
            $table->integer('company_id');
            $table->string('latitude',50);
            $table->string('longitude',50);
            $table->string('contact_person_name',100);
            $table->string('contact_phone_no',100);
            $table->string('contact_email',100);
            $table->string('city',50);
            $table->integer('state_id');
            $table->string('address',250);
            $table->timestamps();
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
