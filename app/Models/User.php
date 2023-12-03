<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const IS_VERIFIED = false;
    const IS_ADMIN = false;

    public $transformer = UserTransformer::class;

    protected $table = 'users';

    protected $dates = ['delete_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    public function setNameAttribute($valor)
    {
        $this->attributes['name'] = strtolower($valor);
    }

    public function setEmailAttribute($valor)
    {
        $this->attributes['email'] = strtolower($valor);
    }

    public function getNameAttribute($valor)
    {
        return ucwords($valor);
    }

    public function isVerified()
   {
    return $this->verified = !User::IS_VERIFIED;
   }

   public function isAdministrator()
   {
    return $this->admin = !User::IS_ADMIN;
   }

   public static function generateVerificationToken()
   {
    return Str::random(40);
   }
}
