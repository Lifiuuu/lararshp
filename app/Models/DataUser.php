<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataUser extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password'];
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->roleUsers()->delete();
            $model->perawat()->delete();
            $model->dokter()->delete();
            $model->pemilik()->delete();

            $userId = session('user_id');
            if ($userId) {
                $model->deleted_by = $userId;
                $model->save();
            }
        });
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole');
    }

    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'id_user', 'iduser');
    }

    public function perawat()
    {
        return $this->hasOne(Perawat::class, 'id_user', 'iduser');
    }
}
