<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
