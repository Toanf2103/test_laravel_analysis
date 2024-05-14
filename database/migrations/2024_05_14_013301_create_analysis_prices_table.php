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
        Schema::create('analysis_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('status_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->double('amount');
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analysis_prices');
    }
};
