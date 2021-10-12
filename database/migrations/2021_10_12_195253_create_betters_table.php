<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('betters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->decimal('bet');
            $table->unsignedBigInteger('horse_id');
            $table->foreign('horse_id')->references('id')->on('horses');
            $table->string('photo_name')->nullable();
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
        Schema::dropIfExists('betters');
    }
}
