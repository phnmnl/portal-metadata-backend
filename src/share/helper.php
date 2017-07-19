<?php
class helper {
    public static function getError($code, $message) {
        $data = array();
        $data['error']['code'] = $code;
        $data['error']['message'] = $message;
        return $data;
    }
}