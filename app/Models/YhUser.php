<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YhUser extends Model
{
    //云端千年用户数据表配置
    protected $connection = 'sqlsrv_yh';
    protected $table = 'account1000y';
    const CREATED_AT = 'makedate';
    protected $guarded = ['char1', 'char2', 'char3', 'char4', 'char5'];

    public function setMakedateAttribute($value)
    {
        $this->attributes['makedate'] = substr($value, 0, 19);
    }

    public function getLastdateAttribute($value)
    {
        if (is_null($value))
            return '未登录';
        return $value;
    }

}
