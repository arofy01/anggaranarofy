<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengeluaran',
        'admin_id',
        'jumlah',
        'anggarans_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'anggarans_id');
    }
}
