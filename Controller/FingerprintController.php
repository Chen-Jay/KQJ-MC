<?php

class FingerprintController extends Controller
{
    public function handle()
    {
        global $json;
        $fingerprint=new FingerprintModel();
        if(!$fingerprint->checkId($json['ccid']))//如果表中没有该同学的指纹信息，添加学号，指纹信息
        {
            if(count($json['fingerprint']==2))  //上传两枚指纹
            {
                $fingerprint->addFinger($json['ccid'],$json['fingerprint'][0],$json['fingerprint'][1]);
            }
            elseif(count($json['fingerprint']==1))  //上传一枚指纹
            {
                $fingerprint->addFinger($json['ccid'],$json['fingerprint'][0],null);
            }
        }
        else   //如果已经有了，就更新信息好了
        {
            if(count($json['fingerprint']==2))  //上传两枚指纹
            {
                $fingerprint->updateFinger($json['ccid'],$json['fingerprint'][0],$json['fingerprint'][1]);
            }
            elseif(count($json['fingerprint']==1))  //上传一枚指纹
            {
                $fingerprint->updateFinger($json['ccid'],$json['fingerprint'][0],null);
            }
        }
    }
}