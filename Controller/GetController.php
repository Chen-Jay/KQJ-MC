<?php

class GetController extends Controller
{
    public function handle()
    {
        $orders=array();
        $orderModel=new OrderModel();

        if($orderModel->numOfOrder()!=0) //命令表中有未执行命令
        {
            $ids=$orderModel->getTopId(5); //要发送命令的id数组
            foreach($ids as $item)
            {
                echo $orderModel->getOrder($item);
                $orderModel->modifyStatus($item,1);
            }
        }
        else
        {
            echo $orderModel->getRenewMachine();
        }
    }
    
}