<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tambah admin_id ke tabel reports
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->after('id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');
        });

        // Tambah admin_id ke tabel anggarans
        Schema::table('anggarans', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->after('id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');
        });
    }

    public function down()
    {
        // Hapus foreign key dan kolom dari tabel reports
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });

        // Hapus foreign key dan kolom dari tabel anggarans
        Schema::table('anggarans', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
};