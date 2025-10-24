<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKlinis extends Model
{
    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nama_kategori_klinis'];
    public $timestamps = false;

    public function kodeTindakanTerapis()
    {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}
