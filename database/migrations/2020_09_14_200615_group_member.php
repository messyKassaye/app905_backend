<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('group_member');
        Schema::create('group_member', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->boolean('isleader')->default(false);
            $table->primary(['group_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
