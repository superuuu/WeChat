<?php

//引入自动加载文件，路径不确定
require '../vendor/autoload.php';

$wxcfg = weixin\wxBasic::getConfig();

$return_uri = 'http://wzyu.wywwwxm.com/oauth/oauth_return.php';
//获取code授权码接口
$get_code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize';
//构造参数
$get_code_url .= '?appid='.$wxcfg['appid'] . 
                '&redirect_uri='. urlencode($return_uri) . 
                '&response_type=code' . 
                '&scope=snsapi_userinfo' . 
                '&state=test#wechat_redirect';

header('location:'.$get_code_url);
