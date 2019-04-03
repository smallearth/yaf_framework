<?php
/**
 * 验证工具类.
 * User: Jack
 * Date: 2018/3/21
 * Time: 下午6:34
 */
class Validate {

    /**
     * 匹配一个变量字符串
     * @param string $var
     *
     * @return boolean
     */
    public static function isString( $var="" ) {
        return is_string($var) && !empty($var);
    }

    /**
     * 匹配一个数字或数字类型字符串
     * @param string $var
     *
     * @return boolean
     */
    public static function isNumber( $var="" ) {
        return is_numeric($var);
    }

    /**
     * 匹配类似于"1,2,3,4"样式的字符串
     * @param $var
     *
     * @return boolean
     */
    public static function isNumberWithComma( $var="" ) {
        $res = false;
        if (is_string($var)) {
            $res = preg_match_all("/^(\d+,?)*\d$/", $var) > 0 ? true : false;
        }
        return $res;
    }

    /**
     * 匹配类似于"string:number"样式的字符串
     * @param $var
     *
     * @return boolean
     */
    public static function isStringColonNumber( $var="" ) {
        $res = false;
        if (is_string($var)) {
            $res = preg_match_all("/^[a-z]+:\d{1}$/", $var) > 0 ? true : false;
        }
        return $res;
    }

    /**
     * 验证是否是合法的电话号码
     */
    public static function isPhone( $var ) {
        $res = false;
        if ( is_string($var) ) {
            if ( self::isMobile($var) ) {
                $res = true;
            } else {
                $pattern = "/^(\d{3,4}-?)?\d{7,8}(-?\d{1,4})?$/";
                $res = preg_match_all($pattern, $var) > 0 ? true : false;
            }
        }
        return $res;
    }

    /**
     * 验证手机号
     * @param $var
     *
     * @return bool
     */
    public static function isMobile( $var ) {
        $res = false;
        if ( is_numeric($var) ) {
            $pattern = "/^1[3-9]{1}\d{9}$/";
            $res = preg_match_all($pattern, $var) > 0 ? true : false;
        }
        return $res;
    }

}