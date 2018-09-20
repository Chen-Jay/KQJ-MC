<?php

/**
 * 设置全局的数据库对象
 * 此处需要改进，通过读入配置文件来进行参数的设置
 */
try
{
    $db=new PDO("mysql:dbname=kqj;port=3306;host=127.0.0.1;charset=utf8mb4","kqj_root","btm");
} 
catch(PDOException $exception)
{
    echo 'Connection failed: '.$exception->getMessage();
}

$raw;   //用于缓存未经处理的http体

$json;  //用于缓存已经解析完毕的报文


/**
 * 设置考勤机验证密钥
 * 此处需要改进，通过读入配置文件来进行参数的设置
 */
$key='123456';

/**
 *  已有类的共同父类
 */
class Root
{
    private $middleware_list=array();


    /**
     * 中间件执行器
     */
    public function middlewareInvoke()
    {
        foreach($this->middleware_list as $item)
        {
            $item->invoke();
        }
    }

    /**
     * 中间件注册器
     */
    public function middlewareRegister($middleware)
    {
        $mw=new $middleware();
        $this->middleware_list[]=$mw;
    }
}

/**
* 自动类载入器的实现
*/
function autoloader($class)
{   
    // global $curl;
    $class_name=[
        'Router',
        'Controller',
        'Model',
        'Middleware'
        ];
    foreach($class_name as $i)
    {
        if(strpos($class,$i)===FALSE)
            continue;
        $end=strpos($class,$i);
        $name=substr($class,0,$end);
        // echo ROOTPATH.$i.'/'.$name.$i.'.php'."\n";
        require_once ROOTPATH.$i.'/'.$name.$i.'.php';

    }   
    
}

/**
 * 日志管理（添加日志）
 */
function r_log($message)
{
    // $Log=date('Y/m/d H:i:s')."\n".$message."\n";
    $Log=date('Y/m/d H:i:s')."\n";
    file_put_contents(ROOTPATH.'RunningLog.log',$Log,FILE_APPEND);
    echo($message);
    exit;
}