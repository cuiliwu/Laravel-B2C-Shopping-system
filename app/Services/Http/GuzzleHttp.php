<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/22-11:00
 */

namespace App\Services\Http;

use App\Exceptions\NoTLoginException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class GuzzleHttp
{
    private static $conn;

    protected static $method;

    protected static $url;
    protected static $type = '';

    protected $client;

    protected $data;

    protected $params;

    protected $debug = false;

    protected $auto = true;

    private function __construct()
    {
        $this->client = new Client();
    }

    public static function getInstance($method = 'get', $url,$type = ''){
        self::$method = $method;
        self::$url = $url;
        self::$type = $type;

        if(!(self::$conn instanceof self)){
            self::$conn = new self;
        }
        return self::$conn;
    }

    public function __clone(){
        trigger_error('不能够复制');
    }

    public function debug()
    {
        $this->debug = true;
        return $this;
    }

    public function auto($auto = true)
    {
        $this->auto = $auto;
        return $this;
    }

    public function send(array $data = []){
        return $this->doRequest($data);
    }

    public function get(){
        $this->data['query'] = $this->params;
        $ret = $this->client->request('GET', self::$url, $this->data);
        return $ret;
    }

    public function post(){
        $this->data['form_params'] = $this->params;
        $ret = $this->client->request('POST', self::$url, $this->data);
        return $ret;
    }

    public function put(){
        $this->data['query'] = $this->params;
        $ret = $this->client->request('PUT', self::$url, $this->data);
        return $ret;
    }

    public function delete(){
        $this->data['query'] = $this->params;
        $ret = $this->client->request('DELETE', self::$url, $this->data);
        return $ret;
    }

    /**
     * 执行发送请求
     */
    public function doRequest(array $data = [])
    {
        $this->params = $data;
        if(self::$type == 'web'){
            if(session('user_b2b_token','')){
                $this->data['headers']['Authorization'] = 'Bearer  '.session('user_b2b_token');
            }
        }elseif(self::$type == 'admin'){
            //后台添加token
            if(session('Authorization','')){
                $this->data['headers']['Authorization'] = 'Bearer  '.session('Authorization');
            }
        }
        //发送请求方式
        switch (self::$method) {
            case 'get':
                $ret = $this->get();
                break;
            case 'post':
                $ret = $this->post();
                break;
            case 'put':
                $ret = $this->put();
                break;
            case 'delete':
                $ret = $this->delete();
                break;
            default:
                $ret = $this->get();
                break;
        }

        if($this->debug){
            $debug_data['http_code'] = $ret->getStatusCode();
            $debug_data['content'] = $ret->getBody()->getContents();
            print_r('<pre>');
            print_r($debug_data);
            print_r('</pre');
            exit;
        }

        $data = json_decode($ret->getBody(), 1);
        $data = array_merge(['http_code' => 200], $data);
        if (in_array($data['code'], [900, 10, 11])) {
            //将登陆信息ession清空
            session([
                'user_id' => '',
                'userid' => '',
                'user_phone' => '',
                'userphone' => '',
                'user_name' => '',
                'username' => '',
                'user_email' => '',
                'user_shop_id' => '',
                'user_is_test_user' => '',
                'user_identification_type' => '',
                'user_personal_enterprise' => '',
                'user_b2b_token' => '',
                'usertoken' => '',
                'user_info' => '',
                'userinfo' => ''
            ]);
            $redirect = redirect('/user/login');
            $redirect->send();
            die;
            //throw new NoTLoginException('未登录');
        }
        if($data['code'] == 0 && array_get($data,'data.token')){
            session(['Authorization' => array_get($data,'data.token')]);
        }
        //自动全局处理
        if($this->auto){
            if($data['code'] == 105){
                abort(404);
            }
        }

        return $data;
    }
}