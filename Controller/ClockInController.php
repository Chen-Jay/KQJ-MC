<?php

class ClockInController extends Controller
{
    public function handle()
    {
        $ClockIn=new ClockInModel(); //创建签到表的Model
        $ClockIn->clockIn(); //将打卡记录上传
    }
}