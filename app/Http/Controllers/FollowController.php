<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;

class FollowController extends Controller
{
    /**
     * Follow the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function follow(User $user)
{
    $follower = auth()->user();

    // Check if the user is not trying to follow themselves
    if (!$follower || $user->id === $follower->id) {
        return response()->json(['error' => 'Cannot follow yourself.'], 422);
    }

    // Check if the user is not already being followed
    if ($follower->following && $follower->following->contains($user)) {
        return response()->json(['error' => 'You are already following this user.'], 422);
    }

    // Create a follow relationship
    $follow = new Follow([
        'follower_id' => $follower->id,
        'following_id' => $user->id,
    ]);
    $follow->save();

    return response()->json(['message' => 'Successfully followed user.']);
}

/**
 * Unfollow the specified user.
 *
 * @param  \App\User  $user
 * @return \Illuminate\Http\Response
 */
public function unfollow(User $user)
{
    $follower = auth()->user();

    // Check if the user is currently being followed
    $follow = Follow::where('follower_id', optional($follower)->id)
        ->where('following_id', optional($user)->id)
        ->first();

    // Check if the follow relationship exists
    if (!$follow) {
        return response()->json(['error' => 'You are not following this user.'], 422);
    }

    // Remove the follow relationship
    $follow->delete();

    return response()->json(['message' => 'Successfully unfollowed user.']);
}


}

