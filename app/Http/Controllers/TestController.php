<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/14-10:48
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use Illuminate\Redis\RedisManager;
use Illuminate\Support\Facades\Redis;
class TestController extends  Controller
{
    public function __construct()
    {
    }

    public  function  index()
    {
        // Redis::set('name','xyz');
        $mkv = array(
            'usr:0001' => 'First user',
            'usr:0002' => 'Second user',
            'usr:0003' => 'Third user'
        );
        //Redis::mset($mkv);  // 存储多个 key 对应的 value
        $retval = Redis::mget(['usr:0001','usr:0002','usr:0003']);  //获取多个key对应的value
        var_dump($retval);
        var_dump(Redis::get('name'));
    }
}