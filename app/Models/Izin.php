<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;
    protected $table = 'izin';
    protected $fillable = ['nama', 'role', 'jenis_izin', 'keterangan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function tendik()
    {
        return $this->belongsTo(Tendik::class);
    }
}
