<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemuDokter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'no_urut',
        'waktu_daftar',
        'status',
        'idpet',
        'idrole_user',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->rekamMedis()->delete();

            $userId = session('user_id');
            if ($userId) {
                $model->deleted_by = $userId;
                $model->save();
            }
        });
    }

    protected $casts = [
        // Removed casts for non-existent columns
    ];

    // Relationship with Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relationship with RoleUser (assuming dokter is linked via role_user)
    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }

    // Relationship with DataUser for dokter via roleUser
    public function dokter()
    {
        return $this->belongsTo(DataUser::class, 'id_dokter');
    }
}
