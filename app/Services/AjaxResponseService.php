<?php
    namespace App\Services;
    class AjaxResponseService{
        protected function ajaxResponse($code, $message, $data = null){
            $out = [
                'code' => $code,
                'message' => $message,
            ];

            if ($data !== null) {
                $out['result'] = $data;
            }
            return response()->json($out);
        }

        public function success($data = null){
            return $this->ajaxResponse(0, 'dddddddddddd', $data);
        }

        public function fail($message, $extra = []){
            return $this->ajaxResponse(1, $message, $extra);
        }
    }