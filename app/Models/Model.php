<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    //protected $connection = 'sqlsrv';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (env('APP_URL') === 'https://1000y.test')
            $this->dateFormat = 'Y-m-d H:i:s';
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }

    public function visits()
    {
        return visits($this);
    }
}
