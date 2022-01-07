<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint as BlueprintAlias;
use Illuminate\Support\Facades\Schema;


class Users extends Migration
{

    public function up()
    {
        Schema::create('users', function (BlueprintAlias $table) {
            $table->id();
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_code')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('phone_verification_code')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->foreignId('default_organisation_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(0)->comment('0:Inactive, 1:Active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }

}
