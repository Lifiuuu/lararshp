<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use SoftDeletes;

    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idpemilik', 'idras_hewan'];
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $userId = session('user_id');
            if ($userId) {
                $model->deleted_by = $userId;
                $model->save();
            }
        });
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    public function setJenisKelaminAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes['jenis_kelamin'] = null;
            return;
        }

        $val = trim((string) $value);
        $upper = mb_strtoupper($val);

        if ($upper === 'J' || $upper === 'JANTAN') {
            $this->attributes['jenis_kelamin'] = 'J';
            return;
        }

        if ($upper === 'B' || $upper === 'BETINA') {
            $this->attributes['jenis_kelamin'] = 'B';
            return;
        }

        // Fallback: if a full word contains 'J' as first letter treat as J, etc.
        $first = mb_substr($upper, 0, 1);
        if ($first === 'J' || $first === 'B') {
            $this->attributes['jenis_kelamin'] = $first;
            return;
        }

        // Otherwise store as-is (but it may exceed DB column length)
        $this->attributes['jenis_kelamin'] = $val;
    }

    public function getJenisKelaminAttribute($value)
    {
        return $value === 'J' ? 'Jantan' : ($value === 'B' ? 'Betina' : $value);
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idpet', 'idpet');
    }
}
