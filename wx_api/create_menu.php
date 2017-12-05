<?php

//引入自动加载文件，不同位置引入路径不同
require '../vendor/autoload.php';

//填写自己的appid和secret
$appid = '';
$secret = '';

//获取token值
$token = weixin\wxToken::getToken();

$create_menu_api = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$token;

$post_data=[
    "button"=>[
        [
        "type"=>"view",
        "name"=>"guge",
        "url"=>"https://www.baidu.com"
        ],
        [
        "name"=>"Dev-Test",
        "sub_button"=>[
            [
                "type"=>"view",
                "name"=>"WeUi-Test",
                "url"=>"http://wzyu.wywwwxm.com/"
            ],
            [
                "type"=>"view",
                "name"=>"JSSDK-Test",
                "url"=>"http://wzyu.wywwwxm.com/unknow/jssdk_test.php"
            ],
            [
                "type"=>"view",
                "name"=>"oauth",
                "url"=>"http://wzyu.wywwwxm.com/unknow/oauth/oauth_code.php"
            ]
        ]
    ]
  ]
];

$json_menu = json_encode($post_data,JSON_UNESCAPED_UNICODE);
$c = curl_init();

$curl_options=[
    CURLOPT_RETURNTRANSFER  => true,
    CURLOPT_SSL_VERIFYPEER  => false,
    CURLOPT_URL => $create_menu_api,
    CURLOPT_POST =>true,
    CURLOPT_POSTFIELDS =>$json_menu

];

//设置url选项
curl_setopt_array($c, $curl_options);

$ret = curl_exec($c);

curl_close($c);

echo $ret;
