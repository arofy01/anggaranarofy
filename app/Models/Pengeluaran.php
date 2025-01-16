<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun',
        'nama_pengeluaran',
        'keterangan',
        'nominal',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'nominal' => 'string',
    ];

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'tahun', 'tahun');
    }
}
