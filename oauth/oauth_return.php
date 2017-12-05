<?php

require('../vendor/autoload.php');

$wxcfg = weixin\wxBasic::getConfig();
//获取第一步的授权码
$code = isset($_GET['code'])?$_GET['code']:'';
if (empty($code)) {
    exit('Error: code is empty!');
}
//获取网页授权access_token 接口
$oauth_token_api = 'https://api.weixin.qq.com/sns/oauth2/access_token'.
            '?appid=' . $wxcfg['appid'] . 
            '&secret=' . $wxcfg['secret'] . 
            '&code=' . $code . 
            '&grant_type=authorization_code';
//初始化curl对象并调用access_token接口
$wxcurl = new weixin\wxCURL;
$response = $wxcurl->get($oauth_token_api);
//对返回值进行解码
$oauth_token = json_decode($response,true);
//如果access_token获取失败则退出
if (!isset($oauth_token['access_token'])) {
    exit($ret);
}

//获取用户信息接口
$oauth_info_api = 'https://api.weixin.qq.com/sns/userinfo' .
            '?access_token=' . $oauth_token['access_token'] .
            '&openid='.$oauth_token['openid'] .
            '&lang=zh_CN';

$response = $wxcurl->get($oauth_info_api);
//解码json到php相关数组
$info = json_decode($response,true);

$view=[];
//判断是否成功获取用户信息，失败则退出，返回错误信息
if (isset($info['errcode'])) {
    $view['errorinfo']='获取用户信息失败.<br>' . $info['errmsg'];
    include('oauth_userinfo_error.html');
    exit();
}

$view['nickname'] = $info['nickname'];
$view['where'] = $info['country'].$info['province'].$info['city'];
$view['openid'] = $info['openid'];

if ($info['headimgurl']) {
    $view['headimgurl']='<img src="' . $info['headimgurl'] . '" style="width:30%;height:auto;">';
}

include('oauth_userinfo.html');
