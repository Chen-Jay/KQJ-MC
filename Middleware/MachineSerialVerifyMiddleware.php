<?php

class MachineSerialVerifyMiddleware implements Middleware
{
    /**
     * 用于验证机器的序列号(POST)
     * #机器验证
     */
    public function invoke()
    {
        $serial_number=$_GET['sn'];
        $machineModel=new MachineModel();   //创建执行机器验证的Model   
        $machineModel->setSerial_number($serial_number); //传递待验证机器序列号
        $machineModel->P_verifyMachine(); //进行POST接口的机器验证
    }

}