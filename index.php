<?php

//（测试用）将考勤机post的内容打印到日志中
define('POST_LOG', '/tmp/post.log', FILE_APPEND);
file_put_contents(POST_LOG, date('Y/m/d H:i:s')."\n");
file_put_contents(POST_LOG, file_get_contents('php://input')."\n");

require_once 'KQJ.php';


$Kqj=new KQJ();
$Kqj->start();
