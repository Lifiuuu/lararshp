<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    use SoftDeletes;

    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['iduser', 'idrole', 'status'];
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

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_pemeriksa', 'idrole_user');
    }
}
