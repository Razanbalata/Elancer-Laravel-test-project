<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\FollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class FollowController extends Controller
{
    //
    public function store(Request $request, string $id)
    {

        $follower = $request->user(); // المستخدم الحالي
        $user = User::query()->findOrFail($id);
        $exists = $follower->followings()->where('user_id', $user->id)->exists();
        if (!$exists && $follower->id !== $user->id) {
            $follower->followings()->attach($user->id, [
                'id' => Str::uuid(),
                'created_at' => now(),
            ]);

            // send notifcation 
            $user->notify(new FollowNotification($user, $follower));
        }
        
        return Redirect::back();
    }
    public function destroy(Request $request, string $id)
    {
        $user = User::query()->findOrFail($id);
        $follower = $request->user();
        $follower->followings()->detach($user->id);
        return Redirect::back();
    }
}
