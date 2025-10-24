<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password'];
    public $timestamps = false;

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
}
