<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * attributes hidden for arrays
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * used to find the role of a user
     *
     * @param $role
     * @return bool
     */
    public function hasAnyRole($role): bool
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * removes user from users table and detaches role from role_user table
     *
     * @param int $id
     * @return bool
     */
    public function Remove(int $id): bool
    {
        $user = $this->find($id);
        if ($user) {
            $user->roles()->detach();
            $user->delete();
            return true;
        }
        return false;
    }
}
