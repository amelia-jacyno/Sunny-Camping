<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenNumberToClients extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->integer('token_number')->nullable();
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->removeColumn('token_number');
        });
    }
}
