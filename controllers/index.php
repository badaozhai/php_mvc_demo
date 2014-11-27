<?php
//业务逻辑控制器，调用url控制器获取参数，调用view控制器render渲染页面
class index implements Icontroller{

    public function index(){
        //url控制器获取参数
        $fc = FrontController::getInstance();
        $paramas = $fc->getParams();
        $view = new View();
        $person = new Person();
        $view->name = $paramas['name'];
        $view->person = $person;
        //渲染views里面的index.php 文件
        $result = $view->render('index');
        $fc = FrontController::getInstance();
        //将result设置到$fc实例中
        $fc ->setBody($result);
    }

}