<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['content'];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    
    public function likes() {
        return $this->hasMany('App\Like');
    }
    
    public function getUserTimeLine(Int $user_id) {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
    }
    
    public function getPostCount(Int $user_id) {
        return $this->where('user_id', $user_id)->count();
    }
    
    public function getTimeLines(Int $user_id, Array $follow_ids) {
        $follow_ids[] = $user_id;
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }
    
    public function getTweet(Int $post_id) {
        return $this->with('user')->where('id', $post_id)->first();
    }
    
    public function postStore(Int $user_id, Array $data) {
        $this->user_id = $user_id;
        $this->content = $data['content'];
        $this->save();
        
        return;
    }
    
    public function getEditPost(Int $user_id, Int $post_id) {
        return $this->where('user_id',$user_id)->where('id', $post_id)->first();
    }
    
    public function postUpdate(Int $post_id, Array $data) {
        $this->id = $post_id;
        $this->content = $data['content'];
        $this->update();
        return;
    }
    
    public function postDestroy(Int $user_id, Int $post_id) {
        return $this->where('user_id', $user_id)->where('id', $post_id)->delete();
    }
}
