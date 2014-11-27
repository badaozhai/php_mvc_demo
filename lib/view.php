<?php
//视图控制器 渲染页面方法
class View extends ArrayObject{
     public  function __construct(){
         parent::__construct(array(),ArrayObject::ARRAY_AS_PROPS);
     }
    //渲染的方法
    public function render($file){
        ob_start();
        $dir = dirname(__FILE__);
        echo $file;
        include($dir.'/../views/'.$file.'.php');
        return ob_get_clean();
    }
}