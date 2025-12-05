<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perawat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'perawat';
    protected $primaryKey = 'id_perawat';
    public $timestamps = false;
    protected $fillable = ['alamat', 'no_hp', 'jenis_kelamin', 'pendidikan', 'id_user'];

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

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'iduser');
    }
}