<?php

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
        $stmt->execute(array('id'=>$Id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 更新该学号的学生的姓名，班级，学号，年级，班级，登录密码,头像（待实现）
     */
    public function updateUser($stu_id,$name,$class,$grade,$password/*headpic*/)
    {
        global $db;
        $sql='UPDATE kqj_student SET stu_id=:stu_id,name=:name,class=:class,grade=:grade,password=:passwd WHERE stu_id=:u_id';
        $stmt=$db->prepare($sql);
        $stmt->execute(array('stu_id'=>$stu_id,'name'=>$name,'class'=>$class,'grade'=>$grade,'passwd'=>$password,'u_id'=>$stu_id));
    }

    /**
     * 在表中添加学生（学号，姓名，班级，年级，密码，头像（待实现））
     */
    public function addUser($stu_id,$name,$class,$grade,$password/*headpic*/)
    {
        global $db;
        $sql='INSERT INTO kqj_student(stu_id,name,class,grade,password) VALUES(:stu_id,:name,:class,:grade,:passwd)';
        $stmt=$db->prepare($sql);
        $stmt->execute(array('stu_id'=>$stu_id,'name'=>$name,'class'=>$class,'grade'=>$grade,'passwd'=>$password));
    }
}