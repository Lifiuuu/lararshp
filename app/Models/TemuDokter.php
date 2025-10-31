<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    use HasFactory;

    protected $table = 'temu_dokter';

    protected $fillable = [
        'idreservasi_dokter',
        'no_urut',
        'waktu_daftar',
        'status',
        'idpet',
        'idrole_user',
    ];

    protected $casts = [
        'tanggal_temu' => 'date',
        'waktu_temu' => 'datetime',
    ];

    // Relationship with Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relationship with RoleUser (assuming dokter is linked via role_user)
    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'id_dokter');
    }

    // Relationship with DataUser for dokter
    public function dokter()
    {
        return $this->belongsTo(DataUser::class, 'id_dokter');
    }
}
