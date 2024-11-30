<?php

namespace App\Models;

use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggaran extends Model
{
    use HasFactory;

    protected $fillable = ['tahun', 'nama_anggaran', 'sumber', 'nominal'];

    public function pengeluarans()
    {
        return $this->hasMany(Pengeluaran::class);
    }
}
