<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avater');
            $table->string('confirmation_token')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('confirmation_sent_at')->nullable();
            $table->string('todofu');
            $table->string('new_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avater',
                'confirmation_token',
                'confirmed_at',
                'confirmation_sent_at',
                'todofu',
                'new_email',
            ]);
        });
    }
}
