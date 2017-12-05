<?php

namespace weixin;

class wxBasic
{
    //填写自己的appi、secret和token
    static private $appid = '';
    static private $secret = '';
    static private $self_token = '';

    static public function getAppid()
    {
        return self::$appid;
    }

    static public function getSecret()
    {
        return self::$secret;
    }

    static public function getSelfToken()
    {
        return self::$self_token;
    }

    static public function getConfig()
    {
        return [
            'appid'=>self::$appid,
            'secret'=>self::$secret,
            'self_token'=>self::$self_token
        ];
    }

}
