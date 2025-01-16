<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJumlahToAnggaransAndPengeluarans extends Migration
{
    public function up()
    {
        // Tambahkan kolom 'jumlah' ke tabel anggarans
        Schema::table('anggarans', function (Blueprint $table) {
            $table->decimal('jumlah', 15, 2)->default(0)->after('nama_anggaran');
        });

        // Tambahkan kolom 'jumlah' ke tabel pengeluarans
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->decimal('jumlah', 15, 2)->default(0)->after('nama_pengeluaran');
        });
    }

    public function down()
    {
        // Hapus kolom 'jumlah' dari tabel anggarans
        Schema::table('anggarans', function (Blueprint $table) {
            $table->dropColumn('jumlah');
        });

        // Hapus kolom 'jumlah' dari tabel pengeluarans
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->dropColumn('jumlah');
        });
    }
}
