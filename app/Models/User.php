<?php

namespace App\Models;

use App\Models\Traits\ActiveUserHelper;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use ActiveUserHelper;
    use HasRoles;
    use Notifiable {
        notify as protected laravelNotify;
    }

    //云端千年用户数据表配置
    protected $connection = 'sqlsrv';
    protected $table = 'account1000y';
    const CREATED_AT = 'makedate';
    protected $guarded = ['char1', 'char2', 'char3', 'char4', 'char5'];

    //public $timestamps = false;
    protected $dateFormat = 'Y-m-d H:i:s';

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['name', 'phone', 'email', 'password', 'introduction', 'avatar', 'weixin_openid', 'weixin_unionid'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    /* 云端千年老服务器，明文密码，不能加密～囧
    public function setPasswordAttribute($value)
    {
        // 如果值的长度等于 60，即认为是已经做过加密的情况
        if (strlen($value) != 60) {

            // 不等于 60，做密码加密处理
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }
    */

    public function setAvatarAttribute($path)
    {
        // 如果不是 `http` 子串开头，那就是从后台上传的，需要补全 URL
        if (!starts_with($path, 'http')) {

            // 拼接完整的 URL
            $path = config('app.url')."/uploads/images/avatars/$path";
        }

        $this->attributes['avatar'] = $path;
    }


    public function getAvatarAttribute($path)
    {
        // 如果不是 `http` 子串开头，那就是从后台上传的，需要补全 URL
        if (is_null($path)) {

            // 拼接完整的 URL
            $path = "https://www.gravatar.com/avatar/20823c79de757831969a8d7105e12977?s=200";
        }

        return $path;
    }

    public function setMakedateAttribute($value)
    {
        $this->attributes['makedate'] = substr($value, 0, 19);
    }

    public function getMakedateAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getLastdateAttribute($value)
    {
        if (is_null($value))
            return '未登录';
        return $value;
    }

    public function getChar1Attribute($value)
    {
        if (ends_with($value, ':云端'))
            return substr($value, 0, strpos($value, ':云端'));
        return $value;
    }

    public function getChar2Attribute($value)
    {
        if (ends_with($value, ':云端'))
            return substr($value, 0, strpos($value, ':云端'));
        return $value;
    }

    public function getChar3Attribute($value)
    {
        if (ends_with($value, ':云端'))
            return substr($value, 0, strpos($value, ':云端'));
        return $value;
    }

    public function getChar4Attribute($value)
    {
        if (ends_with($value, ':云端'))
            return substr($value, 0, strpos($value, ':云端'));
        return $value;
    }

    public function getChar5Attribute($value)
    {
        if (ends_with($value, ':云端'))
            return substr($value, 0, strpos($value, ':云端'));
        return $value;
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
}
