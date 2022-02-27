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
        // 发送短信
        if (app()->environment('production')) {
            $easySms = app('easysms');
            try {
                $easySms->send($user->telephone, [
                    'template' => 'SMS_144942084',
                    'data' => [
                        'password' => $user->password,
                    ],
                ]);
            } catch (NoGatewayAvailableException $exception){
                //dd($exception->getExceptions());
                return false;
            }
        }
    }

    public function updating(User $user)
    {
        //
    }

    public function saving(User $user)
    {
        //
    }

    /**
     * 处理 User「created」事件
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * 处理 User「updated」事件
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * 处理 User「deleted」事件
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * 处理 User「forceDeleted」事件
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
