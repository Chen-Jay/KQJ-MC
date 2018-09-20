<?php

require_once 'InitialConfiguration.php';

define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/curl.php';
require_once __ROOT__.'/curl_response.php';


class ClockInController extends Controller
{
    public function handle()
    {
        error_reporting(E_ALL);
        global $json;
        $ClockIn=new ClockInModel(); //创建签到表的Model
        $ClockIn->clockIn(); //将打卡记录上传
        // var_dump($json);
        
        
        /**
         * 向node服务器发送签到信息
         */
        // $curl=new Curl;
        // var_dump($curl);
        // global $json;
        // var_dump($json);

        $curl=new Curl();
        $response = $curl->post("https://app.biketomotor.cn/api/ClockIn", $json);

        // var_dump($response);
        // curl_setopt($ch, CURLOPT_URL, "https://app.biketomotor.cn/api/ClockIn");
        // curl_setopt($ch, CURLOPT_POST, 1); // 发送一个常规的Post请求
        // curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        // curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        // curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        // curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        // curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        
        // $output = curl_exec($ch);
        // if (curl_errno($ch)) {
        //     echo 'Errno'.curl_error($ch);//捕抓异常
        //  }
        //  curl_close($ch); // 关闭CURL会话
        //  var_dump（$output）; // 返回数据
    }
}