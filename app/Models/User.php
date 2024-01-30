<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    protected $fillable = [
        'number_id',
        'name',
        'last_name',
        'email',
        'password',
    ];

    protected $appends=['full_name'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
       'created_at'=> 'datetime:Y-m-d', //con esto hago que solo salga la fecha no hora
       'updated_at'=> 'datetime:Y-m-d',
       // 'is_enable'=>'boolean'//0 -1 cuando sea u booleano comvertirlo a true,flase
    ];

    /*Accesor(get)*/
    public function getFullNameAttribute()
    {
        return "{$this->name}{$this->last_name}";
    }


    /*
    //PARA CREAR UN USUARIO
       (new User($request->all()))->save();
    */
//Mutadores
    public function setPasswordAttribute($value)
    {
        $this-> attributes['password']=bcrypt($value);
    }
    public function setRememberTokenAttribute()
    {
        $this-> attributes['remember_token']=Str::random(30);
    }

    public function customerLends()
    {
        return $this->hasMany(Lend::class, 'customer_user_id', 'id');
    }
    public function ownerLends()
    {
        return $this->hasMany(Lend::class, 'owner_user_id', 'id');
    }
}
