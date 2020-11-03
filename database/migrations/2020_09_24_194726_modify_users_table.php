<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname', 150)->unique()->after('name'); //REQUIRED
            $table->string('title')->nullable()->default(null)->after('nickname');
            $table->string('last_login_ip', 100)->nullable()->default(null)->after('title');
            $table->datetime('last_login_time')->nullable()->default(null)->after('last_login_ip');
            $table->date('date_of_birth')->default(null)->nullable()->after('last_login_time'); // REQUIRED
            $table->string('city', 100)->nullable()->default(null)->after('date_of_birth');
            $table->string('state', 50)->nullable()->default(null)->after('city');
            $table->string('postal_or_zip_code', 50)->nullable()->default(null)->after('state');
            $table->string('country', 50)->nullable()->default(null)->after('postal_or_zip_code');
            $table->string('timezone', 50)->nullable()->default(null)->after('country');
            $table->enum('role',['admin','moderator', 'partner', 'user'])->after('timezone')->default('user');
            $table->boolean('tos_accepted')->default(false)->after('role'); //REQUIRED
            $table->boolean('receive_email_updates')->default(false)->after('tos_accepted');
            $table->softDeletes();

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
            $table->dropColumn('nickname');
            $table->dropColumn('title');
            $table->dropColumn('last_login_ip');
            $table->dropColumn('last_login_time');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('postal_or_zip_code');
            $table->dropColumn('country');
            $table->dropColumn('timezone');
            $table->dropColumn('role');
            $table->dropColumn('tos_accepted');
            $table->dropColumn('receive_email_updates');
            $table->dropSoftDeletes();
        });
    }
}
