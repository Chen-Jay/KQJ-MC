<?php
require_once 'InitialConfiguration.php';
class StudentModel extends Model
{
    private $table_name;

    function __construct()
    {
        $this->table_name='kqj_student';
    }

    /**
     * 检查一下学生表中的这个学号的学生是否存在
     */
    public function checkId($Id)
    {
        global $db;
        $sql='SELECT * FROM kqj_student WHERE stu_id=:id;';
        $stmt=$db->prepare($sql);
        $if_success=$stmt->execute(array('id'=>$Id));
        if($if_success==false)
        {
            r_log("Check id in Student failed");
        }
        // var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 更新该学号的学生的姓名，班级，学号，年级，班级，登录密码,头像（待实现）
     */
    public function updateUser($stu_id,$name,$class,$grade,$password/*headpic*/)
    {
        global $db;
        $sql='UPDATE kqj_student SET stu_id=:stu_id,stu_name=:name_,class=:class,grade=:grade,password=:passwd WHERE stu_id=:u_id';
        $stmt=$db->prepare($sql);
        $if_success=$stmt->execute(array('stu_id'=>$stu_id,'name_'=>$name,'class'=>$class,'grade'=>$grade,'passwd'=>$password,'u_id'=>$stu_id));
        // var_dump(array('stu_id'=>$stu_id,'name_'=>$name,'class'=>$class,'grade'=>$grade,'passwd'=>$password,'u_id'=>$stu_id));
        if($if_success==false)
        {
            r_log("Update user in Student failed.");
        }
    }

    /**
     * 在表中添加学生（学号，姓名，班级，年级，密码）
     */
    public function addUser($stu_id,$name,$class,$grade,$password)
    {
        global $db;
        $sql='INSERT INTO kqj_student(stu_id,stu_name,class,grade,`password`) VALUES(:stu_id,:name,:class,:grade,:passwd)';
        $stmt=$db->prepare($sql);
        $if_success=$stmt->execute(array('stu_id'=>$stu_id,'name'=>$name,'class'=>$class,'grade'=>$grade,'passwd'=>$password));
        if($if_success==false)
        {
            r_log("Add user in Student failed when execute:\n".'INSERT INTO kqj_student(stu_id,stu_name,class,grade,`password`) VALUES('.$stu_id.','.$name.','.$class.','.$grade.','.$password.')');
        }
    }

    /**
     * 更新该学号的学生的头像
     */
    public function updateHeadpic($Id,$Headpic)
    {
        global $db;
        $sql='UPDATE kqj_student SET headpic=:hp WHERE stu_id=:id';
        $stmt=$db->prepare($sql);
        $if_success=$stmt->execute(array('hp'=>$Headpic,'id'=>$Id));
        if($if_success==false)
        {
        $sql='UPDATE kqj_student SET headpic=:hp WHERE stu_id=:id';
        r_log("Update headpic in Student failed when execute:\n".'UPDATE kqj_student SET headpic='.$Headpic.' WHERE stu_id='.$Id);
        }
    }
}