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
        Schema::create('tbl_petty_cash_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('staff_id')->on('tbl_staff');
            $table->date('transaction_date');
            $table->string('purpose');
            $table->string('description');
            $table->decimal('amount', 10, 2);
            $table->enum('transaction_type', ['allocation', 'top-up', 'withdrawal']);
            // Add any other relevant fields here

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
        Schema::dropIfExists('tbl_petty_cash_transactions');
    }
};
