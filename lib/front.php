<?php
/**
 * 前端控制器 解析url 使用反射api 调用Icontroller实现类的方法
 */
class FrontController{

    protected $_controller,$_action,$_params,$_body;
    static  $_instance;

    /**
     * 构造器，获取url参数
     */
    private function __construct(){
        $request = $_SERVER['REQUEST_URI'];
        $splits = explode('/',trim($request,'/'));
        var_dump($splits);
        $this->_controller = !empty($splits[1])?$splits[1]:'index';
        $this->_action = !empty($splits[2])?$splits[2]:'index';
        print_r($this);
        if(!empty($splits[2])){
            $keys = $values = array();
            for($idx = 3,$cnt = count($splits);$idx<$cnt;$idx++){
                if($idx%2 ==0){
                    //偶数索引号指的是数值
                    $values[] = $splits[$idx];
                }else{
                    //奇数索引号指的是键值
                    $keys[] = $splits[$idx];
                }
            }
           var_dump($keys);
           var_dump($values);$this->_params = array_combine($keys,$values);
        }
    }

    /**
     * Created by chenjian.
     * 单例模式
     */
    public static function getInstance(){
        if(!self::$_instance instanceof self){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Created by chenjian.
     * 利用反射,通过url参数调用相关controller以及action
     */
    public function route(){
        if(class_exists($this->getController())){
            $rc = new ReflectionClass($this->getController());
            var_dump($rc);
            var_dump($rc->implementsInterface('IController'));
            var_dump($rc->hasMethod($this->getAction()));
            if($rc->implementsInterface('IController')){
             if($rc->hasMethod($this->getAction())){
                 $controller = $rc->newInstance();
                 var_dump($controller);
                 $action = $this->getAction();
                 var_dump($action);
                 $method = $rc->getMethod($action);
                 var_dump($method);
                 $method->invoke($controller);
                 }else{
                 throw new Exception('action');
             }
            }else{
                throw new Exception('interface');
            }
        }else{
            throw new Exception('Controller');
        }
    }

    public function getParams(){
        return $this->_params;
    }
    public function getController(){
        return $this->_controller;
    }
    public function getAction(){
        return $this->_action;
    }
    public function getBody(){
        return $this->_body;
    }
    public function setBody($body){
        $this->_body = $body;
    }

}