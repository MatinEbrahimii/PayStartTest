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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_account');
            $table->unsignedBigInteger('to_account');
            $table->bigInteger('amount');
            $table->timestamps();
            $table->softDelete();

            $table->foreign('from_account')->references('id')->on('accounts')->cascadeOnDelete();
            $table->foreign('to_account')->references('id')->on('accounts')->cascadeOnDelete();
            // $table->index(['from_account', 'to_account'], 'accounts_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
