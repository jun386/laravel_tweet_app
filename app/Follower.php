<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //
    public function getFollowCount($user_id) {
        return $this->where('following_id', $user_id)->count();
    }
    
    public function getFollowerCount($user_id) {
        return $this->where('followed_id', $user_id)->count();
    }
    
    public function followingIds(Int $user_id) {
        return $this->where('following_id', $user_id)->get('followed_id');
    }
    
    public function followersIds(Int $user_id) {
        return $this->where('followed_id', $user_id)->get('following_id');
    }
    
}
