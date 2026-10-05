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
        Schema::create('email_changes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('current_email');
            $table->string('new_email');

            $table->string('token_hash')->nullable()->unique();
            $table->string('deny_token_hash')->unique();
            $table->string('approve_token_hash')->unique();


            $table->timestamp('change_confirmed_at')->nullable();
            $table->timestamp('change_denied_at')->nullable();
            $table->timestamp('security_confirmed_at')->nullable();


            $table->dateTime('expires_at');

            $table->timestamps();

            $table->index(
                [
                    'user_id',
                    'change_confirmed_at',
                    'change_denied_at',
                    'expires_at',
                ],
                'email_changes_pending_index'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_changes');
    }
};
