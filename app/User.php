<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image'
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
    
    public function posts() {
        return $this->hasMany('App\Post');
    }
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    
    public function likes() {
        return $this->hasMany('App\Like');
    }
    
    public function followers() {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }
    
    public function follows() {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }
    
    public function getAllUsers(Int $user_id) {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }
    
    public function follow(Int $user_id) {
        return $this->follows()->attach($user_id);
    }
    
    public function unfollow(Int $user_id) {
        return $this->follows()->detach($user_id);
    }
    
    public function isFollowing(Int $user_id) {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }
    
    public function isFollowed(Int $user_id) {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }
    
    public function updateProfile(Array $params) {
        if(isset($params['image'])) {
            $file_name = $params['image']->store('public/image/');
            $this::where('id', $this->id)
                ->update([
                    'name' => $params['name'],
                    'email' => $params['email'],
                    'image' => basename($file_name)
                ]);
        } else {
            $this::where('id', $this->id)
                ->update([
                    'name' => $params['name'],
                    'email' => $params['email']
                ]);
        }
        
        return;
    }
    
    
}
