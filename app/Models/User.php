<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property int $role
 * @property $created_at
 * @property $updated_at
 * @property
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * All roles
     *
     * @var array<string, int>
     */
    const ROLES = [
        'ADMIN' => 0,
        'LIBRARIAN' => 1,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
}
