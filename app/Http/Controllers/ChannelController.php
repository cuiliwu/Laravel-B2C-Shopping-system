<?php
    namespace App\Http\Controllers;
    use App\Cmscontents;
    class ChannelController extends BaseController{
        public function index(){
            return Cmscontents::getContent();
        }
    }