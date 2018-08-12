<?php
require_once 'InitialConfiguration.php';

class UserController extends Controller
{
    public function handle()
    {
        global $json;
        $student=new StudentModel();
        if($student->checkId($json['ccid'])) //如过学生表中已经有了该学生，则更新数据
        {
            $student=new StudentModel();
            // var_dump($json);
            $stu_id=$json['ccid'];
            $name=$json['name'];
            $class=$json['deptid']%10;
            $grade=($json['deptid']-($json['deptid']%10))/10;
            $password=$json['passwd'];

            $student->updateUser($stu_id,$name,$class,$grade,$password);
        }
        else //如果没有，则添加该学生的信息
        {
            $student=new StudentModel();

            $stu_id=$json['ccid'];
            $name=$json['name'];
            $class=$json['deptid']%10;
            $grade=($json['deptid']-($json['deptid']%10))/10;
            $password=$json['passwd'];

            $student->addUser($stu_id,$name,$class,$grade,$password);
        }
    }
}