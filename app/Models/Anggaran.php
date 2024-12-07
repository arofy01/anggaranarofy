<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;

    // Izinkan mass assignment
    protected $fillable = [
        'tahun',
        'nama_anggaran',
        'sumber',
        'nominal',
    ];
}
