<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //1tom
        Schema::table('apartments', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'apartment_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

        });

        //collega per ogni appartamento più messaggi
        Schema::table('messages', function (Blueprint $table) {

            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id', 'messages_apartment')
                ->references('id')
                ->on('apartments')
                ->onDelete('cascade');
        });
        //collega per ogni appartamento più stats
        Schema::table('stats', function (Blueprint $table) {

            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id', 'stats_apartment')
                ->references('id')
                ->on('apartments')
                ->onDelete('cascade');
        });

        // apartments N <> N configs
        Schema::table('apartment_config', function (Blueprint $table) {

            $table->unsignedBigInteger('config_id');
            $table->foreign('config_id', 'apartment_config_configs')
                  ->references('id')
                  ->on('configs');

            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id', 'apartment_config_apartments')
                  ->references('id')
                  ->on('apartments');

        });

        // ads N <> N apartments
        Schema::table('ad_apartment', function (Blueprint $table) {

            $table->unsignedBigInteger('ad_id');
            $table->foreign('ad_id', 'ad_apartment_ads')
                  ->references('id')
                  ->on('ads')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id', 'ad_apartment_apartments')
                ->references('id')
                ->on('apartments')
                ->onDelete('cascade');

        });



    }


    public function down()
    {
        //1toM user -> apartment
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropForeign('apartment_user');
            $table->dropColumn('user_id');
        });


        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_apartment');
            $table->dropColumn('apartment_id');
        });
        Schema::table('stats', function (Blueprint $table) {
            $table->dropForeign('stats_apartment');
            $table->dropColumn('apartment_id');
        });

        //mtom appartments -> configs
        Schema::table('apartment_config', function (Blueprint $table) {
            $table->dropForeign('apartment_config_configs');
            $table->dropColumn('config_id');

            $table->dropForeign('apartment_config_apartments');
            $table->dropColumn('apartment_id');
        });

        //mtom appartments -> configs
        Schema::table('ad_apartment', function (Blueprint $table) {
            $table->dropForeign('ad_apartment_ads');
            $table->dropColumn('ad_id');

            $table->dropForeign('ad_apartment_apartments');
            $table->dropColumn('apartment_id');
        });

    }
}
