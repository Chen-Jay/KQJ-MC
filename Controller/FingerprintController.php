<?php

class FingerprintController extends Controller
{
    public function handle()
    {
        global $json;
        $fingerprint=new FingerprintModel();
        if(!$fingerprint->checkId($json['ccid']))//如果表中没有该同学的指纹信息，添加学号，指纹信息
        {
            $Finger1=$json['fingerprint'][0];    //第一枚指纹一定是需要的，将其转换成二进制

            if(count($json['fingerprint']==2))  //上传两枚指纹
            {
                $Finger2=$json['fingerprint'][1]; //将第二枚指纹转化成二进制形式来储存
                $fingerprint->addFinger($json['ccid'],$Finger1,$Finger2);
            }
            elseif(count($json['fingerprint']==1))  //上传一枚指纹
            {
                $fingerprint->addFinger($json['ccid'],$Finger1,null);
            }
        }
        else   //如果已经有该同学了，就更新信息好了
        {
            $Finger1=$json['fingerprint'][0];

            if(count($json['fingerprint']==2))  //更新两枚指纹
            {
                $Finger2=$json['fingerprint'][1];    //将第二枚指纹转化成二进制形式来储存
                $fingerprint->updateFinger($json['ccid'],$Finger1,$Finger2);
            }
            elseif(count($json['fingerprint']==1))  //更新一枚指纹
            {
                $fingerprint->updateFinger($json['ccid'],$Finger1,null);
            }
        }
    }
}