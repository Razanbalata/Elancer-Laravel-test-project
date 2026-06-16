<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{username}', function ($user, $username) {
    return (string) $user->username === (int) $username;
});

Broadcast::channel('posts.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
