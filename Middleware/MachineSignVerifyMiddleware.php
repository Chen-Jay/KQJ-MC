<?php
class MachineSignVerifyMiddleware implements Middleware
{
    public function invoke()
    {
        $serial_number=$_GET['sn']; //获取机器序列号
        $request_time=$_GET['requesttime']; //获取时间戳
        $sign=$_GET['sign'];    //获取签名
        global $key;    //获取密钥

        $plain_text=$serial_number.$request_time.$key; //拼接成字符串

        if(sha1($plain_text)==$sign)    //sha1加密后得到的字符串与签名匹配
        {
            ;
        }
        else    //不匹配则直接退出
        {
            exit;
        }
    }
}