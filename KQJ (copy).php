<?php
require_once 'InitialConfiguration.php';


class KQJ extends Root
{

    public function shit()
    {
        echo'shit';
    }
    public function start()
    {
        /**
         * 使用自动加载器，自动将需要的php文件require进来
         */
        spl_autoload_register('autoloader'); //注册autoloader
        $ROOTPATH=$_SERVER['DOCUMENT_ROOT'].'/';  //将当前的初始路径储存为$WkPath，用于寻找其他php文件


        /**
         * 将请求中的接入口部分剥离出来，储存在$entrance中
         */
        $entrance=explode('?',$_SERVER['REQUEST_URI']);
        $entrance=$entrance[0];
        $entrance=explode('/',substr($entrance, 1));

        /**
         * 判断请求中接入口的地址，分配路由
         */
        switch (count($entrance)) 
        {
            case 3:
                $router; //路由器
                require_once 'InitialConfiguration.php'; //无法被自动识别的文件手动require进来
                if($entrance[0]=='api'&&$entrance[1]='data'&&$entrance[2]=='post')   //判断为POST指令
                { 
                    if(isset($_GET['sn']))  //考勤机发过来的POST消息一定会要带有sn（序列码）
                    {
                        global $raw;
                        $raw=file_get_contents('php://input'); //获取消息主体
                        $this->middlewareRegister('MachineSerialVerifyMiddleware'); //注册用于机器验证的中间件
                        $this->middlewareRegister('DataVerifyMiddleware');  //注册用于数据验证的中间件
                        $router=new MachinePostRouter();   //创建管理POST指令的路由器
                        $router->setMessage($raw); 
                    }
                    else
                    {
                        exit;
                    }
                }
                elseif($entrance[0]=='api'&&$entrance[1]='data'&&$entrance[2]=='get') //判断为GET指令
                {
                    $router=new MachineGetRouter();
                    $this->middlewareRegister('MachineSignVerifyMiddleware');
                }
                $this->middlewareInvoke(); //开始执行
                $router->handle();   //开始分配任务

                break;
            default:
                var_dump($entrance);
                break;
        }
    }
    
}