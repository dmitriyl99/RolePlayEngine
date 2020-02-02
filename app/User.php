<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    const UPLOAD_DIRECTORY = 'storage/avatars/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'nickname', 'signature'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Authorize role for user
     *
     * @param string|array $roles
     *
     * @return bool
     */
    public function authorizeRole($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');
        }

        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     *
     * @param array $roles
     *
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn(‘name’, $roles)->first();
    }

    /**
     *
     * Check one role
     *
     * @param string $role
     *
     * @return boolean
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Add role for user
     *
     * @param string $role
     * @return void
    */
    public function addRole(string $role)
    {
        if ($this->hasRole($role))
            return;
        $role = Role::where('name', $role)->first();
        abort_if($role == null, 404);
        $this->roles()->attach($role);
    }

    /**
     * All heroes of user
     */
    public function heroes()
    {
        return $this->hasMany(Hero::class);
    }

    /**
     * All posts of user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function removeAvatar()
    {
        if ($this->avatar_url) {
            Storage::delete(self::UPLOAD_DIRECTORY . $this->avatar_url);

        }
    }

    public function saveAvatar($image) {
        if (!$image) return;
        $this->removeAvatar();
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs(self::UPLOAD_DIRECTORY, $filename);
        $this->avatar_url = $filename;
        $this->save();
    }

    public function getAvatar () {
        if ($this->avatar_url)
            return self::UPLOAD_DIRECTORY . $this->avatar_url;
        return asset('assets/img/avatars/avatar0.jpg');
    }
}
