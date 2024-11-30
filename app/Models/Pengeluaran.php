<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pengeluaran', 'admin_id', 'jumlah', 'anggaran_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class);
    }
}
