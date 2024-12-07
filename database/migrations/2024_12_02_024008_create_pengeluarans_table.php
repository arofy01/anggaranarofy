<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaransTable extends Migration
{
    public function up()
    {
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengeluaran');
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->decimal('jumlah', 15, 2);
            $table->foreignId('anggarans_id')->constrained('anggarans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluarans');
    }
}
