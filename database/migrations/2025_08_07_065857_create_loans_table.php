<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->string('app_id')->nullable();
            $table->string('name')->nullable();
            $table->string('bank')->nullable();
            $table->string('pl_bl')->nullable();
            $table->string('location')->nullable();
            $table->string('company_name')->nullable();
            $table->string('sanction_amount')->nullable();
            $table->string('date')->nullable();
            $table->string('partner')->nullable();
            $table->string('remarks')->nullable();
            $table->string('payout_percent')->nullable();
            $table->string('sub')->nullable();
            $table->string('bank_amount')->nullable();
            $table->string('ex_amount')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
