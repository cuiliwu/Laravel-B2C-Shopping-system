<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/22-10:40
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //状态码不放在http()函数中处理，http()只做请求功能，交由业务自身判断
    public function httpCodeJudge($ret){
        if ($ret['http_code'] == 200) {
            return true;
        } elseif ($ret['http_code'] >= 500) {
            //@todo 服务器错误页面
            $redirect = redirect('http://www.baidu.com');
        } elseif ($ret['http_code'] >= 400) {
            //@todo
            $redirect = redirect('http://www.baidu.com');
        }else{
            //@todo
            $redirect = redirect('http://www.baidu.com');
        }
        $redirect->send();
        exit();
    }
}
