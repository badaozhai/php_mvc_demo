<?php

//echo $_SERVER['REQUEST_URI'];


//导入组件
require_once('..\application\lib\front.php');
require_once('..\application\lib\icontroller.php');
require_once('..\application\lib\view.php');

//导入业务控制器
require_once('..\application\controllers\index.php');

//导入数据层
require_once('..\application\models\person.php');


//初始化前端控制器
$front = FrontController::getInstance();
$front->route();

echo $front->getBody();
