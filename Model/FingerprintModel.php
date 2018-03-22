<?php

class FingerprintModel extends Model
{
    public function checkId($Id)
    {
        global $db;
        $sql='SELECT * FROM kqj_fingerprint WHERE stu_id=:id;';
        $stmt=$db->prepare($sql);
        $stmt->execute(array('id'=>$Id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFinger($Id,$Finger1,$Finger2)
    {
        global $db;

        if($Finger2!=NULL)
        {
            $sql='INSERT INTO kqj_fingerprint(stu_id,fingerprint1,fingerprint2)VALUES(:stu_id,:fg1,:fg2)';
            $stmt=$db->prepare($sql);
            $stmt->execute(array('stu_id'=>$Id,'fg1'=>$Finger1,'fg2'=>$Finger2));
        }
        else
        {
            $sql='INSERT INTO kqj_fingerprint(stu_id,fingerprint1)VALUES(:stu_id,:fg1)';
            $stmt=$db->prepare($sql);
            $stmt->execute(array('stu_id'=>$Id,'fg1'=>$Finger1));
        }
    }

    public function updateFinger($Id,$Finger1,$Finger2)
    {
        global $db;
        if($Finger2!=NULL)
        {
            $sql='UPDATE kqj_fingerprint SET fingerprint1=:fg1,fingerprint2=:fg2 WHERE stu_id=:Id';
            $stmt=$db->prepare($sql);
            $stmt->execute(array('fg1'=>$Finger1,'fg2'=>$Finger2,'Id'=>$Id));
        }
        else 
        {
            $sql='UPDATE kqj_fingerprint SET fingerprint1=:fg1 WHERE stu_id=:Id';
            $stmt=$db->prepare($sql);
            $stmt->execute(array('fg1'=>$Finger1,'Id'=>$Id));
        }
    }
}
