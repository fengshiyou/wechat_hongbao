<?php
/**
 * Created by PhpStorm.
 * User: kexiangzhang
 * Date: 17/1/10
 * Time: 下午4:17
 */

namespace App\Bussiness;


trait TraitBussiness
{
    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
        return call_user_func_array([new static(), $name],$arguments);
    }
}