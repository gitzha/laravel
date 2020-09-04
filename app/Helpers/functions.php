<?php
/**
 * 邀请码生成
 * user_id:用户id
 * num 位数
 */

function createCode($user_id, $dig)
{
    static $source_string = 'E5FCDG3HQA4B1NOPIJ2RSTUV67MWX89KLYZ';
    $num = $user_id;
    $code = '';
    while ($num > 0) {
        $mod = $num % 35;
        $num = ($num - $mod) / 35;
        $code = $source_string[$mod] . $code;
    }
    if (empty($code[3]))
        $code = str_pad($code, $dig, '0', STR_PAD_LEFT);
    return $code;
}

/**
 * 解密邀请码
 */
 function jdecode($code)
{
    static $source_string = 'E5FCDG3HQA4B1NOPIJ2RSTUV67MWX89KLYZ';
    if (strrpos($code, '0') !== false)
        $code = substr($code, strrpos($code, '0') + 1);
    $len = strlen($code);
    $code = strrev($code);
    $num = 0;
    for ($i = 0; $i < $len; $i++) {
        $num += strpos($source_string, $code[$i]) * pow(35, $i);
    }
    return $num;
}

function objectToArray($object) {
    //先编码成json字符串，再解码成数组
    return json_decode(json_encode($object), true);
}
