<?php
    namespace App\Http\Controllers;
    use App\Http\Controllers;
    class ViewController extends BaseController{
        public function index($id){
            return $id;
        }
    }