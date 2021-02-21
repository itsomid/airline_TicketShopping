<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['flight','train']);
            $table->string('origin');
            $table->string('destination');
            $table->float('price');

            $table->dateTime('departure_date');
            $table->integer('capacity')->default(0);
            $table->enum('status',['available','sold','canceled','refund'])->default('available');

            $table->unsignedBigInteger('allocated_to_admin_id')->nullable();
            $table->foreign('allocated_to_admin_id')->references('id')->on('users');

            $table->text('ticket_info')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
