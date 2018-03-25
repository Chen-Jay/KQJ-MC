<?php

class HeadpicController extends Controller
{
    public function handle()
    {
        global $json;
        $student=new StudentModel();
        if($student->checkId($json['ccid']))
        {
            $student->updateHeadpic($json['ccid'],$json['headpic']);            
        }
        else
        {
            r_log("Try to update a headpic to a nonexistent student: the id of the non_student is ".$json['ccid']);
        }
    }
}
