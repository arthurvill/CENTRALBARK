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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('schedule_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('payment_method_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('reference_no')->nullable();
            $table->mediumText('note')->nullable();
            $table->boolean('is_online')->default(true);
            $table->integer('status')->default(0);
            $table->mediumText('remark')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};