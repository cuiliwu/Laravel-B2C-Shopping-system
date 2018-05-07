<?php
    namespace App\Http\Controllers;
    use App\Cmscontents;
    class IndexController extends BaseController{
        public function index(){
            return Cmscontents::getContent();
        }
    }