<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['created_at', 'anamnesa', 'temuan_klinis', 'diagnosa', 'idpet', 'dokter_pemeriksa'];
    public $timestamps = false;

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }
}
