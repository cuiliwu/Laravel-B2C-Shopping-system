<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/22-10:40
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $perPage = 15;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
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
    /**
     * 设置 request 值，统一书写规范。
     **/
    public function request_set($data = []){
        if (is_array($data)){
            foreach ($data as $key=>$value){
                $this->request->offsetSet($key,$value);
            }
        }
        return true;
    }
}
