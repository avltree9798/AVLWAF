<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillableActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billable_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rule_id')->nullable();
            $table->unsignedInteger('hacking_attempt_id')->nullable();
            $table->unsignedInteger('blacklist_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->integer('amount');
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
        Schema::dropIfExists('billable_actions');
    }
}
