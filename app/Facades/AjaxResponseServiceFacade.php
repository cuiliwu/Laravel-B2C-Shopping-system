<?php
    namespace App\Facades;
    use Illuminate\Support\Facades\Facade;
    class AjaxResponseServiceFacade extends Facade {
        protected static function getFacadeAccessor() {
            return 'AjaxResponseService';
        }
    }