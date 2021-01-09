<?php

namespace App\Observers;

use App\Models\User;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        $password = str_random(6);
        if (app()->environment('production')) {

            $easySms = app('easysms');
            try {
                $easySms->send($user->telephone, [
                    'template' => 'SMS_144942084',
                    'data' => [
                        'password' => $password,
                    ],
                ]);
            } catch (NoGatewayAvailableException $exception){
                //dd($exception->getExceptions());
                return false;
            }
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
