<?php

class DataVerifyMiddleware implements Middleware
{
    public function invoke()
    {
        global$raw,$js;
        $this->verifyData($raw);
    }

    /**
    **用来验证POST中数据的合法性
    **如果数据不合法，直接终止程序（不回复）
    * #数据验证
    **/
    private function verifyData($data)
    {
        $js=json_decode($data,true);
        if($js==NULL)	//数据不符合json格式
        {
            die('invalid json');
        }
        else if($this->isOneJson($js))	//只有一条json格式的数据
        {
            $this->checkData($js);
        }
        else	//有多条json数据
        {
            foreach($js as $json)
            {
                if(isset($json['id'])&&isset($json['data'])&&is_numeric($json['id'])) //检查每种数据都必要的三个key
                {
                    $this->checkData($json);
                    continue;
                }
                else
                {
                    if(!isset($json['id']))
                    {
                        die('no id');
                    }
                    else if(!isset($json['data']))
                    {
                        die('no data');
                    }
                    else if(!is_numeric($json['id']))
                    {
                        die('id not numetric');
                    }
                }
            }
        }
    }

    /**
    * 用来具体实现验证不同指令的数据
    * 如果数据不合法，直接终止程序（不回复）
    * #数据验证
    */
    private function checkData($json)
    {
        switch($json['data']) //对于不同的指令，需要包括一些对应的key
                    {
                    case 'user':
                        /*if(isset($json['ccid'])&&is_numeric($json['ccid'])&&
                        isset($json['name'])&&is_string($json['name'])&&
                        isset($json['passwd'])&&is_string($json['passwd'])&&
                        isset($json['auth'])&&($json['auth']==0||$json['auth']==14)&&
                        isset($json['deptid'])&&is_numeric($json['deptid'])
                        )*/
                        {
                        break;
                        }
                        //else
                        {
                            die('user data error');
                        }
                    case 'fingerprint':
                        if(isset($json['ccid'])&&is_numeric($json['ccid'])&&
                        isset($json['fingerprint'])&&is_array($json['fingerprint'])
                        )
                        {
                            foreach($json['fingerprint'] as $fp)
                            {
                                if(!is_string($fp))
                                {
                                    die('invalid fingerprint data');
                                }
                            }			
                            break;
                        }
                        else
                        {
                            die('fingerprint data error');
                        }
                    case 'headpic':
                        if(isset($json['ccid'])&&is_numeric($json['ccid'])&&
                        isset($json['headpic'])&&is_string($json['headpic'])
                        )
                        {
                            break;
                        }
                        else
                        {
                            die('headpic data error');
                        }
                    case 'clockin':
                        if(isset($json['ccid'])&&is_numeric($json['ccid'])&&
                        isset($json['time'])&&(strtotime($json['time'])!=false)&&
                        isset($json['verify'])&&is_numeric($json['verify'])
                        )
                        {
                            if(isset($json['pic']))
                            {
                                if(!is_string($json['pic']))
                                {
                                    die('invalid "pic"');
                                }
                            }
                            if($json['verify']!=0&&$json['verify']!=1)
                            {
                                die('invalid "verify"');
                            }
                            break;
                        }
                        else
                        {
                            die('clockin data error');
                        }
                    case 'info':
                        if(isset($json['model'])&&($json['model']=='Q1')&&
                            isset($json['rom'])&&
                            isset($json['app'])&&
                            isset($json['space'])&&is_numeric($json['space'])&&
                            isset($json['memory'])&&is_numeric($json['memory'])&&
                            isset($json['user'])&&is_numeric($json['user'])&&
                            isset($json['fingerprint'])&&is_numeric($json['fingerprint'])&&
                            isset($json['headpic'])&&is_numeric($json['headpic'])&&
                            isset($json['clockin'])&&is_numeric($json['clockin'])&&
                            isset($json['pic'])&&is_numeric($json['pic'])
                        )
                        {
                            break;
                        }
                        else
                        {
                            die('info data error');
                        }
                    case 'return':
                        if(isset($json['return'])==true)
                        {
                            break;
                        }
                        else
                        {
                            die('return data error');
                        }
                    case 'unbound':
                        break;
                    default:
                        die('invalid "data"');
                    }
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
}