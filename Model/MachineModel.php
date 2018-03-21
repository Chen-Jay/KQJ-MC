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
        $stmt=$db->prepare('SELECT count(*) FROM machine WHERE series_number=:sn;');
        $stmt->execute(array('sn'=>$this->serial_number));
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result[0]['count(*)']!=1)   //与数据库中考勤机序列号匹配
        {
            exit;
        }
    }


    public function updateMachine($model,$space,$user,$fingerprint)
    {
        global $db;
        $sql='UPDATE machine SET model=:model,space=:space,user=:user,fingerprint=:fingerprint WHERE series_number=:sn';
        $stmt=$db->prepare($sql);
        var_dump($stmt->execute(array('model'=>$model,'space'=>$space,'user'=>$user,'fingerprint'=>$fingerprint,'sn'=>$this->serial_number)));
        var_dump ($this->serial_number);
    }

    
}