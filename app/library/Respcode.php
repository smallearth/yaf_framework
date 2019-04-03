<?php
/**
 * 接口常用返回码.
 * User: Jack
 * Date: 2018/3/21
 * Time: 下午4:23
 */
class Respcode {
    const RESP_SUCCESS           = 0; //成功
    const RESP_NOT_LOGIN         = 1000; //未登录
    const RESP_PARAMS_ERROR      = 400; //参数错误
    const RESP_NOT_FOUND         = 404; //找不到相关信息
    const RESP_SERVER_ERROR      = 500; //服务端错误
    const RESP_NOT_AJAX_REQUEST  = 501; //非Ajax请求
    const RESP_PERMISSION_DENIED = 502; //没有权限操作

    private static $respMsg= [
        self::RESP_SUCCESS => "Success",
        self::RESP_NOT_LOGIN => "用户未登录",
        self::RESP_PARAMS_ERROR => "参数错误",
        self::RESP_NOT_FOUND => "找不到相关信息",
        self::RESP_SERVER_ERROR => "服务端错误",
        self::RESP_NOT_AJAX_REQUEST => "请通过AJAX请求，不能通过API直接访问",
        self::RESP_PERMISSION_DENIED => "没有权限操作",
    ];

    public static function getCodeMsg($code) {
        return isset(self::$respMsg[$code]) ? self::$respMsg[$code] : "";
    }
}