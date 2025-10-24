<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nama_kategori'];
    public $timestamps = false;

    public function kodeTindakanTerapis()
    {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori', 'idkategori');
    }
}
