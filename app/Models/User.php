<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const IS_VERIFIED = true;
    const IS_ADMIN = false;

    protected $table = 'users';

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

    public function isVerified()
   {
    return $this->verified = User::IS_VERIFIED;
   }

   public function isAdministrator()
   {
    return $this->admin = User::IS_ADMIN;
   }

   public static function generateVerificationToken()
   {
    return Str::random(40);
   }
}
