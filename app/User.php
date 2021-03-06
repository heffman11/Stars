<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'banned',
    ]; 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'banned',
    ];

      //comments

    public function comments()
    {
      return $this->hasMany('App\Comment');
    }

    public function tasks()
    {
      return $this->hasMany('App\Task');
    }


    //images

    public function images()
    {
      return $this->hasMany('App\Image');
    }

    // roles

    public function roles()
    {
        return $this->belongsToMany('App\Role','role_user', 'user_id', 'role_id');
    }
    public function checkRoles($roles)
    {
        if($this->hasAnyRole($roles)){
            return true;
        }
        abort(401, 'no');
    }
    public function hasAnyRole($roles)
    {
      if (is_array($roles)) {
        foreach ($roles as $role) {
          if ($this->hasRole($role)) {
            return true;
          }
        }
      } else {
        if ($this->hasRole($roles)) {
          return true;
        }
      }
      return false;
    }
    public function hasRole($role)
    {
      if ($this->roles()->where("name", $role)->first()) {
        return true;
      }
      return false;
    }

   
}
