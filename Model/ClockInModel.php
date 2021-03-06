<?php
require_once 'InitialConfiguration.php';
class ClockInModel extends Model
{
    private $table_name;

    function __construct()
    {
        $this->table_name='kqj_clock_in';
    }

    public function clockIn()
    {   
        global $db;
        global $json;
        $sql='INSERT INTO kqj_clock_in(stu_id,`time`,style,pic) VALUES (:stu_id,:_time,:style,:pic)';
        $stmt=$db->prepare($sql);



        // $date_time=explode(' ',$json['time']);
        // $date=explode('-',$date_time[0]);
        // $time=explode(':',$date_time[1]);
        // $year=$date[0]; $month=$date[1]; $day=$date[2];
        // $hour=$time[0]; $minute=$time[1]; $second=$time[2];

        $time=$json['time'];
        $pic=$json['pic'];
        $style;
        if($json['verify']==1)
        {
            $style='fingerprint';
        }
        elseif($json['verify']==0)
        {
            $style='password';
        }

        $if_success=$stmt->execute(array('stu_id'=>$json['ccid'],'_time'=>$time,'style'=>$style,'pic'=>$pic));
        if($if_success==false)
        {
            r_log("clock in failed when excute:\n".'INSERT INTO kqj_clock_in(stu_id,`time`,style,pic) VALUES ('.$json['ccid'].','.$time.','.$style.','.$pic.')');
        }
        // echo json_encode(array(
        //     'status' => 1,
        //     'info' => 'ok',
        //     'data' => $json['id']
        // ));
    }
    
}