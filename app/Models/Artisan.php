<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;


class Artisan extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        "id",
        'art_fname',
        'art_lname',
        'art_user',
        'art_email',
        'art_phone',
        'art_gender',
        'art_age',
        'category',
        'art_address',
        'art_about',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
}
