<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function pengeluarans()
{
    return $this->hasMany(Pengeluaran::class);
}

public function reports()
{
    return $this->hasMany(Report::class);
}

public function anggarans()
{
    return $this->hasMany(Anggaran::class);
}
}
