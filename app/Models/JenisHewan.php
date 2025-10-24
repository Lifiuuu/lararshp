<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nama_jenis_hewan'];
    public $timestamps = false;

    public function rasHewans()
    {
        return $this->hasMany(RasHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }
}
