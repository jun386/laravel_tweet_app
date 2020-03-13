<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['content'];
    
    public function post() {
        return $this->belongsTo('App\Post');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function getComments(Int $post_id) {
        return $this->with('user')->where('post_id', $post_id)->get();
    }
    
    public function commentStore(Int $user_id, Array $data) {
        $this->user_id = $user_id;
        $this->post_id = $data['post_id'];
        $this->content = $data['content'];
        $this->save();
        return;
    }
    
    public function commentDestroy(Int $user_id, Int $comment_id) {
        return $this->where('user_id', $user_id)->where('id', $comment_id)->delete();
    }
}
