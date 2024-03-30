<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = ['nisn', 'nama', 'jenis_kelamin', 'kelas', 'tempat_lahir', 'tanggal_lahir', 'role', 'nomor_whatsapp', 'foto'];
}
