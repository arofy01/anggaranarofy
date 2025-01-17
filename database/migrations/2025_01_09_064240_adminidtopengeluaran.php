<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->after('id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');
        });
    }

    public function down()
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
};