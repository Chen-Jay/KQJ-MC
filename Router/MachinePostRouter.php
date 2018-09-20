<?php

class MachinePostRouter extends Router
{

    private $raw_message;    //消息主体部分


    public function handle()
    {
        /**
         * 进行任务分配以及消息确认回复
         */
        $ids = array(); //用于存储收到的信息的ID
        $js=json_decode($this->raw_message,true); //将未经处理的消息主体转换成数据数组

        if($this->isOneJson($js))	//只有一条数据的情况，为其分配controller
        {
           
            $ids[]=$js['id'];
            $this->route($js);
        }
        else //有多条数据的情况下，每条数据都进行一次分配
        {
            foreach($js as $json)
            {
                // var_dump($js);
                $ids[] = $json['id'];
                $this->route($json);
            }
        }
 
        echo json_encode(array(
            'status' => 1,
            'info' => 'ok',
            'data' => $ids
        ));
        // echo json_encode(array(
        //     'status' => 1,
        //     'info' => 'ok',
        //     'data' => ["567631"]
        // ));
    }

    /**
     * 根据消息中不同的命令类型分配不同的controller来进行处理,其中$json指代传入的json数组
     * #任务分配
     */
    protected function route($js)
    {
        $controller;
        global $json;
        // var_dump($js);
        $json=$js;
        switch($json['data'])
                {
                case 'user':
                    $controller=new UserController();
                    break;
                case 'fingerprint':
                    $controller=new FingerprintController();
                    break;
                case 'headpic':
                    $controller=new HeadpicController();
                    break;
                case 'clockin':
                    $controller=new ClockInController();
                    break;
                case 'info':
                    $controller=new MachineController();
                    break;
                case 'return':
                    $controller=new ReturnController();
                    break;
                default:
                    r_log("Unknown post order:".$json['data']);
                };
        $controller->handle();
        
    }

    /**
     * 用来判定消息中包含多少条命令
     * #常用函数
     */
    private function isOneJson($js)
    {
        if(isset($js['id'])&&isset($js['data'])&&is_numeric($js['id']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    /**
     * 设置传入的消息主体
     * #常用函数
     */
    public function setMessage($raw)
    {
        $this->raw_message=$raw;
    }
}