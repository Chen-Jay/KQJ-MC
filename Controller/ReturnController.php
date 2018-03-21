<?php
class ReturnController
{
    public function handle()
    {
        global $json;
        $OrderModel=new OrderModel();   //创建一个管理orders表格的model
        foreach($json['return'] as $item)
        {
            if($item['result']===0||$item['result']==='0')  //如果命令被成功执行，则将命令表中该命令删去
            {
                $OrderModel->deleteOrder($item['id']);
            }
            else    //否则则将执行状态改为0，即尚未被成功执行状态
            {
                $OrderModel->modifyStatus($item['id'],0);
            }
            
        }

        
    }
}