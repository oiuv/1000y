<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        $password = str_random(6);
        if (app()->environment('production')) {

            $easySms = app('easysms');

            $easySms->send($user->telephone, [
                'template' => 'a02e64017c54430e89e32521fa99b805',
                'data' => [
                    $password,
                ],
            ]);

        }
        $user->password = $password;
    }

    public function updating(User $user)
    {
        //
    }

    public function saving(User $user)
    {
        //
    }
}