<?php
//98be0c47717b94c6e7194ecd809f63f9 开放平台   appid wx64d79e3910e84b42
# 引入文件
require 'include.php';

# 配置参数    include文件中 默认是公众平台ID PC端登录需要下面配置
$config = array(
    /*'token'          => '',*/
    'appid'          => '',
    'appsecret'      => '',
    'encodingaeskey' => '',   
);


//获取用户公众号openid  如用户已经绑定wx表中，用表中openid即可
$wechat = & \Wechat\Loader::get_instance('Oauth');
$go_obj = $wechat->getOauthRedirect('http://www.ectee.com/wx/test2.php');
if (!isset($_GET['code'])) {
	header("Location:".$go_obj);
}
$go_obj_atoken = $wechat->getOauthAccessToken();	//获取access_token

$go_obj_userinfo = $wechat->getOauthUserinfo($go_obj_atoken['access_token'],$go_obj_atoken['openid']);	//获取用户信息


#模板数组 
$send_data = [
	'touser' => $go_obj_atoken['openid'],  //用户公众号openid 需要手机登录公众号上获取
	'template_id' => 'IOQiXZlQcyHkZM2YY392g43_A-JZqxJfso4RbgvNl8Q',  //模板ID 看微信平台
	"url" => "http://weixin.qq.com/download",    //模板可点击的地址（可空）
    "topcolor" => "#FF0000",					//通知模板颜色
    //模板数组、不同模板不一样
	'data' =>[
		'first' => [
			'value' => '测试',
		],
		'accountType' => [
			'value' => '手机号',
		],
		'account' => [
			'value' => '186xxxxxx',
		],
		'amout' => [
			'value' => '100000元',
		],
		'result' => [
			'value' => '测试成功',
		],
		'remark' => [
			'vaule' => '备注信息',
		],
 	],

];


#发送模板信息
$wechat = & \Wechat\Loader::get_instance('Receive');
$go_obj = $wechat->sendTemplateMessage($send_data);
var_dump($go_obj);
exit();

