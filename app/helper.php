<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/17-14:10
 */

if (!function_exists('http_web')) {
    function http_web($_url, array $_format = [])
    {
        $api_host = config('url.api_web');
        list($method, $url) = $_url;
        if($_format){
            $url = vsprintf($url, $_format);
        }
        $url = $api_host . $url;

        return \App\Services\Http\GuzzleHttp::getInstance($method, $url,'web');
    }
}


if (!function_exists('http_old_web')) {
    function http_old_web($_url, array $_format = [])
    {
        $api_host = config('url.old_api_member');
        list($method, $url) = $_url;
        if($_format){
            $url = vsprintf($url, $_format);
        }
        $url = $api_host . $url;

        return \App\Services\Http\GuzzleHttp::getInstance($method, $url,'old_web');
    }
}



if (!function_exists('czbank_request')) {
    function czbank_request($_url, array $_format = [])
    {
        $api_host = config('url.czbank');
        list($method, $url) = $_url;
        if($_format){
            $url = vsprintf($url, $_format);
        }
        $url = $api_host . $url;

        return \App\Services\Http\GuzzleHttp::getInstance($method, $url);
    }
}

if (!function_exists('http_admin')) {
    function http_admin($_url, array $_format = [])
    {
        $api_host = config('url.api_backend');
        list($method, $url) = $_url;
        if($_format){
            $url = vsprintf($url, $_format);
        }
        $url = $api_host . $url;

        return \App\Services\Http\GuzzleHttp::getInstance($method, $url,'admin');
    }
}

if (!function_exists('search_params')) {
    function search_params($data = [])
    {
        $str = '';
        //@todo 改用array_filter();
        array_walk($data, function (&$value, $key, $p) {
            if(is_array($value)){
                if(key_exists('start', $value) || key_exists('end', $value)){
                    //如果包含start、end则为between
                    $start = array_get($value, 'start');
                    $end = array_get($value, 'end');
                    if($start || $end){
                        $between = [
                            'start' => $start ? : null,
                            'end' => $end ? : null
                        ];
                        $ret = implode(',', $between);
                    }else{
                        $ret = null;
                    }
                }else{
                    //普通数组
                    $ret = implode(',', $value);
                }
            }else{
                $ret = $value;
            }
            $value = $ret || $ret === 0 || $ret === "0"  ? $key . $p . $ret : null;
        }, ':');
        //剔除空值
        $data = array_filter($data);

        return $str . implode(';', $data);
    }
}

if (!function_exists('paginate')) {
    function paginate(\Illuminate\Http\Request $request, $data)
    {
        if (!isset($data['page'])) {
            $data['page'] = [];
        }
        $page = $data['page'];

        $url_template = $request->fullUrlWithQuery(['page' => 'page_num']);

        if ($page['total_pages'] > 1) {
            //首页、末页URL
            $first_page = $request->fullUrlWithQuery(['page' => 1]);
            $last_page = $request->fullUrlWithQuery(['page' => $page['total_pages']]);
        } else {
            list($first_page, $last_page) = [null, null];
        }

        if ($page['current_page'] > 1) {
            $prev_page = $request->fullUrlWithQuery(['page' => $page['current_page'] - 1]);
        } else {
            $prev_page = null;
        }

        if ($page['current_page'] < $page['total_pages']) {
            $next_page = $request->fullUrlWithQuery(['page' => $page['current_page'] + 1]);
        } else {
            $next_page = null;
        }

        $list_page = [];
        if ($page['total_pages'] <= 7 || ($page['total_pages'] > 7 && $page['current_page'] < 5)) {
            $limit = $page['total_pages'] <= 7 ? $page['total_pages'] : 7;
            for ($i = 1; $i <= $limit; $i++) {
                $list_page[] = [
                    'current_page' => $page['current_page'] == $i ? true : false,
                    'path' => $request->fullUrlWithQuery(['page' => $i]),
                    'num' => $i
                ];
            }
        } else {
            $limit = ($page['current_page'] + 3 < $page['total_pages']) ? $page['current_page'] + 3 : $page['total_pages'];
            for ($i = $page['current_page'] - 3; $i <= $limit; $i++) {
                $list_page[] = [
                    'current_page' => $page['current_page'] == $i ? true : false,
                    'path' => $request->fullUrlWithQuery(['page' => $i]),
                    'num' => $i
                ];
            }
        }

        $data['page']['links'] = [
            'first_page' => $first_page,
            'last_page' => $last_page,
            'prev_page' => $prev_page,
            'next_page' => $next_page,
            'list_page' => $list_page,
            'url_template' => $url_template
        ];

        return $data;
    }
}

if (!function_exists('generate_paginate_url')) {
    function generate_paginate_url($url, $params, $replace_params)
    {
        $str = $url;
        array_walk($data, function (&$value, $key, $p) {
            $value = $key . $p . (is_array($value) ? implode(',', $value) : $value);
        }, ':');

        return $str . implode(';', $data);

        return $data;
    }
}

if( ! function_exists('list_to_tree')){
    /**
     * 把返回的数据集转换成Tree
     *
     * @param array  $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int    $root
     *
     * @return array
     */
    function list_to_tree(array $list, $pk = 'id', $pid = 'parent_id', $child = 'child', $root = 0)
    {
        // 创建Tree
        $tree = [];
        if(is_array($list)){
            // 创建基于主键的数组引用
            $refer = [];
            foreach ($list as $key => $data) {
                $refer[ $data[ $pk ] ] =& $list[ $key ];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[ $pid ];
                if($root == $parentId){
                    $tree[] =& $list[ $key ];
                } else {
                    if(isset($refer[ $parentId ])){
                        $parent =& $refer[ $parentId ];
                        $parent[ $child ][] =& $list[ $key ];
                    }
                }
            }
        }

        return $tree;
    }
}

if (!function_exists('arr_get')) {
    function arr_get(array $array, $key, $default = '-')
    {
        return array_get($array, $key, $default) ? : $default;
    }
}

/**
 * 生成一维数组 HTML 层级树
 *
 * @param        $data
 * @param int    $parent_id
 * @param int    $level
 * @param string $html
 *
 * @return array
 */
function create_level_tree($data, $parent_id = 0,$pk = 'id',$fk = 'parent_id', $level = 0, $html = '-')
{
    $tree = [];
    foreach ($data as $item) {
        $item['html'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
        $item['html'] .= $level === 0 ? "" : '|';
        $item['html'] .= str_repeat($html, $level);
        if($item[$fk] == $parent_id){
            $tree[] = $item;
            $tree = array_merge($tree, create_level_tree($data, $item[$pk],$pk,$fk, $level + 1));
        }
    }

    return $tree;
}

if (! function_exists('old_set')) {
    /**
     * Retrieve an olds input item.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function old_set(array $items)
    {
        app('request')->session()->flashInput($items);
    }
}

if (! function_exists('change_url_params')){
    function change_url_params(array $params){
        $pathInfo = parse_url(url()->current());

        if(!empty($pathInfo['query'])){
            parse_str($pathInfo['query'], $query_array);
            foreach ($params as $key => $value) {
                $query_array[$key] = $value;
            }
        }else{
            $query_array = $params;
        }

        return $pathInfo['scheme'].'://'.$pathInfo['host'] . '/' . ltrim($pathInfo['path'], '/').'?'.http_build_query($query_array);
    }
}

/**
 * 中英文混合字符串截取
 * @param $sourcestr
 * @param $cutlength
 * @return string
 */
function cut_str($sourcestr, $cutlength) {
    $returnstr = '';
    $i = 0;
    $n = 0;
    $str_length = strlen ( $sourcestr ); //字符串的字节数
    while ( ($n < $cutlength) and ($i <= $str_length) ) {
        $temp_str = substr ( $sourcestr, $i, 1 );
        $ascnum = Ord ( $temp_str ); //得到字符串中第$i位字符的ascii码
        if ($ascnum >= 224) //如果ASCII位高与224，
        {
            $returnstr = $returnstr . substr ( $sourcestr, $i, 3 ); //根据UTF-8编码规范，将3个连续的字符计为单个字符
            $i = $i + 3; //实际Byte计为3
            $n ++; //字串长度计1
        } elseif ($ascnum >= 192) //如果ASCII位高与192，
        {
            $returnstr = $returnstr . substr ( $sourcestr, $i, 2 ); //根据UTF-8编码规范，将2个连续的字符计为单个字符
            $i = $i + 2; //实际Byte计为2
            $n ++; //字串长度计1
        } elseif ($ascnum >= 65 && $ascnum <= 90) //如果是大写字母，
        {
            $returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
            $i = $i + 1; //实际的Byte数仍计1个
            $n ++; //但考虑整体美观，大写字母计成一个高位字符
        } else //其他情况下，包括小写字母和半角标点符号，
        {
            $returnstr = $returnstr . substr ( $sourcestr, $i, 1 );
            $i = $i + 1; //实际的Byte数计1个
            $n = $n + 0.5; //小写字母和半角标点等与半个高位字符宽...
        }
    }
    if ($str_length > $cutlength) {
        $returnstr = $returnstr . ""; //超过长度时在尾处加上省略号
    }
    return $returnstr;
}



/**
 * session所有值集中处理
 * @param $data
 * @return string
 */
if (!function_exists('web_session')) {
    function web_session($data)
    {
        $session_value = '';
        if(!empty(session('user_id'))){

            switch ($data){
                case 'user_id' :
                    $session_value = session('user_id');
                    break;
                case 'user_shop_id' :
                    $session_value = session('user_shop_id');
                    break;
                default :
                    $session_value = '';
                    break;

            }
        }
        return $session_value;
    }
}