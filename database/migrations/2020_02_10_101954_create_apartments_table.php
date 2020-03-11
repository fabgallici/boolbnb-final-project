<?php

use Carbon\Traits\Timestamp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('address');
            $table->decimal('lat', 10, 8)->nullable();  //temp nullable
            $table->decimal('lon', 11, 8)->nullable();
            $table->integer('rooms');
            $table->integer('beds');
            $table->integer('bath');
            $table->integer('square_mt');
            $table->timestamp('ads_expired')->nullable();
            $table->tinyInteger('show')->defaut('1')->nullable();
            $table->integer('views')->default('0')->nullable();
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
        Schema::dropIfExists('apartments');
    }
}
