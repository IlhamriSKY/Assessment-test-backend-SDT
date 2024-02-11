<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirthdateAndCityToEmailContacts extends Migration
{
    public function up()
    {
        Schema::table('email_contacts', function (Blueprint $table) {
            $table->date('birthdate')->nullable();
            $table->string('city')->nullable();
        });
    }

    public function down()
    {
        Schema::table('email_contacts', function (Blueprint $table) {
            $table->dropColumn(['birthdate', 'city']);
        });
    }
}
