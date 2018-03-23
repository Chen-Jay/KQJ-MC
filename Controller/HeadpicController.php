<?php

class HeadpicController extends Controller
{
    public function handle()
    {
        global $json;
        $student=new StudentModel();
        if($student->checkId($json['ccid']))
        {
            $student->updateHeadpic($json['headpic']);            
        }
        else
        {
            exit;
        }
    }
}
