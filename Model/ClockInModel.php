<?php

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
        $sql='INSERT INTO kqj_clock_in(stu_id,year,month,day,hour,minute,second,style) VALUES (:stu_id,:year,:month,:day,:hour,:minute,:second,:style)';
        $stmt=$db->prepare($sql);

        $date_time=explode(' ',$json['time']);
        $date=explode('-',$date_time[0]);
        $time=explode(':',$date_time[1]);
        $year=$date[0]; $month=$date[1]; $day=$date[2];
        $hour=$time[0]; $minute=$time[1]; $second=$time[2];

        $style;
        if($json['verify']==1)
        {
            $style='fingerprint';
        }
        elseif($json['verify']==0)
        {
            $style='password';
        }

        $stmt->execute(array('stu_id'=>$json['ccid'],'year'=>$year,'month'=>$month,'day'=>$day,'hour'=>$hour,'minute'=>$minute,'second'=>$second,'style'=>$style));
    }
    
}