<?php

class OrderModel extends Model
{
    private $table_name;

    function __construct()
    {
        $this->table_name='order';
    }

    /**
     * 获取当前表格中有多少条未执行的命令
     */
    function numOfOrder()
    {
        global $db;
        $stmt=$db->prepare('SELECT COUNT(*) FROM order WHERE status =0');
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['COUNT(*)'];
    }

    /**
     * 删除对应id的指令
     */
    public function deleteOrder($id)
    {
        global $db;
        $stmt=$db->prepare("DELETE FROM order WHERE id=:id;");
        $stmt->execute(array('id'=>$id));
    
    }

    /**
     * 将对应id的元组中的status属性改为value值
     */
    public function modifyStatus($id,$value)
    {
        global $db;
        $stmt=$db->prepare("UPDATE order SET `status`=:v WHERE id=:id;");
        $stmt->execute(array('v'=>$value,'id'=>$id));
    }

    /**
     * 返回对应命令的json格式字符串
     */
    public function getOrder($id)
    {
        global $db;
        $stmt=$db->prepare('SELECT command FROM order WHERE id=:id');
        $stmt->execute(array('id'=>$id));
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $command=json_decode($result[0]['command'],true);
        $command['id']=$id;
        $order=array(
            'status'=>1,
            'info'=>'ok',
            'data'=>$command
        );
        return json_encode($order); //返回json格式的命令字符串
    }

    /**
     * 返回命令集为空时候的命令的json格式字符串
     */
    public function getRenewMachine()
    {
        $order = array(
            'status' => 1,
            'info' => 'ok',
            'data' => array(
                'id'=>'0',
                'do'=>'update',
                'data'=>'config',				 
                'name'=>'5班实验机',			 //设备名称
                'company'=>'单车变摩托开发团队',	//公司名称
                'companyid'=>0,					 //公司id
                'max'=>3000,					 //设备最大容纳员工数量
                'function'=>65535,				 //功能，65535 表示全功能开放 1 -》密码功能 2-》拍照功能 16-》门禁
                'delay'=>10,						 //表示无新数据请求服务器间隔，单位秒	
                'errdelay'=>10,					 //当请求服务器发生错误时，再次发送请求的间隔，单位秒
                'timezone'=>'GMT+08:00',		 //设备时区设定
                'encrypt'=>0,                    //预留字段
                'expired'=>'2015-12-10 12:10:10' //预留字段	
                )
            );
        return json_encode($order);	       
    }

    /**
     * 获得头num条没有执行的命令的id
     */
    public function getTopId($num)
    {
        global $db;
        $stmt=$db->query("SELECT id FROM order WHERE status!=1 ORDER BY id ASC LIMIT {$num}");
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $ids=array();
        for($i=0;$i<count($result);$i++)
        {
            $ids[]=$result[$i]['id'];
        }
        return $ids;
    }


}