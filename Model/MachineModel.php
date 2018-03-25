<?php

class MachineModel extends Model
{
    private $serial_number;

    public function setSerial_number($sn)
    {
        $this->serial_number=$sn;
    }

    /**
     * 用于验证信息来源是否为我方考勤机（POST）
     * #机器验证
     */
    public function P_verifyMachine()
    {
        global $db;
        $stmt=$db->prepare('SELECT count(*) FROM kqj_machine WHERE series_number=:sn;');
        $stmt->execute(array('sn'=>$this->serial_number));
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result[0]['count(*)']!=1)   //与数据库中考勤机序列号匹配
        {
            r_log("This post message comes from an unknown machine");
        }
    }


    public function updateMachine($space,$user,$fingerprint)
    {
        global $db;
        $sql='UPDATE kqj_machine SET space=:space,user=:user,fingerprint=:fingerprint WHERE series_number=:sn';
        $stmt=$db->prepare($sql);
        $stmt->execute(array('space'=>$space,'user'=>$user,'fingerprint'=>$fingerprint,'sn'=>$this->serial_number));
    }

    
}