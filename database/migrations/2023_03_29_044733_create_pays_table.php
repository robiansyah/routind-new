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
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('deposit_id')->constrained('tax_deposits')->onUpdate('cascade')->onDelete('no action');
            $table->string('start_period')->nullable();
            $table->string('end_period')->nullable();
            $table->string('year');
            $table->string('assignment_number')->nullable();
            $table->string('amount');
            $table->text('description')->nullable();
            $table->string('billing_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
};
