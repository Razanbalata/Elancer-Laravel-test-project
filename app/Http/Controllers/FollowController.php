<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotification;
use App\Mail\GreetingMessage;
use App\Models\User;
use App\Notifications\FollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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

            // send notifcation for specific user 
            $user->notify(new FollowNotification($user, $follower));

            // dispatch(new SendNotification(
            //     new FollowNotification($user,$follower),$user
            // ));

            // $users = User::all() for all users
            // Notification::send($users,new FollowNotification($user, $follower));

            // to send mail for not signed in user in my project 
            //  Notification::route('mail','info@test.co')->notify(new FollowNotification($user, $follower));

            //  Mail::to([$user->email])->send(new GreetingMessage($user->name)); // to send mail outside notification zone
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
