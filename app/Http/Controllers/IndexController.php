<?php
    namespace App\Http\Controllers;
    use AjaxResponse;
    class IndexController extends BaseController{
        public function index(){
            return AjaxResponse::success();
        }
    }