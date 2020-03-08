<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    
    public $timestamps = false;
    
    public function post() {
        return $this->belongsTo('App\Post');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function isLike(Int $user_id, Int $post_id) {
        return (boolean) $this->where('user_id', $user_id)->where('post_id', $post_id)->first();
    }
    
    public function storeLike(Int $user_id, Int $post_id) {
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->save();
        return;
    }
    
    public function destroyLike(Int $like_id) {
        return $this->where('id', $like_id)->delete();
    }
}
