<?php

namespace api\application\dao;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    const CREATED_AT = 'ctime';
    const UPDATED_AT = 'mtime';

    protected $guarded = ['ctime', 'mtime'];
    public static function test() {
        echo 'Welcome dao.';
    }
}