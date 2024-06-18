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
        Schema::create('qrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id')->nullable(false);
            $table->double('quantity')->nullable(false)->default(0);
            $table->integer('status')->nullable(true);
            $table->integer('valide')->nullable(true);
            $table->unsignedBigInteger('transaction_id')->nullable(true);
            $table->timestamps();
            //
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qrs');
    }
};
