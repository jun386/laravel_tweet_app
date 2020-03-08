<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follower;

class FollowersController extends Controller
{
    //
    
    public function following(User $user, Follower $follower) {
      $user = User::find($user->id);
      $user_following = $follower->followingIds($user->id);
      $user_following_ids = $user_following->pluck('followed_id')->toArray();
      $user_following_info = User::whereIn('id', $user_following_ids)->paginate(5);
      return view('users.following', [
        'user_following' => $user_following_info
      ]);
    }
    
    public function followers(User $user, Follower $follower) {
      $user = User::find($user->id);
      $user_followers = $follower->followersIds($user->id);
      $user_followers_ids = $user_followers->pluck('following_id')->toArray();
      $user_followers_info = User::whereIn('id', $user_followers_ids)->paginate(5);
      return view('users.followers', [
        'user_followers' => $user_followers_info
      ]);
    }
    
}
