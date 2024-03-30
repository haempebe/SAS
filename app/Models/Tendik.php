<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tendik extends Model
{
    use HasFactory;
    protected $table = 'tendik';
    protected $fillable = ['nuptk', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'role', 'nomor_whatsapp', 'foto'];
}
