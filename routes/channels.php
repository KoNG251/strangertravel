<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\userProfile;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});



Broadcast::channel('chat.{receiver}',function ($user, $groupId) {
    // Check if the user is a member of the group.
    // You might need to implement the `isMemberOfGroup` method based on your application's logic.
    return $user->isMemberOfGroup($groupId);
});