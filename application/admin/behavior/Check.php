<?php
namespace app\admin\behavior;
use think\Request;
//use traits\controller\Jump;
use think\Cookie;
class Check{
//    use Jump;
    public function run(&$params){
        
        //加入控制器为admin,方法为index,跳转为login/index;
        $request = Request::instance();
        $controller = strtolower($request->controller());
        $action = strtolower($request->action());
        //排除的控制器和方法
        
        $paichu = array(
            "login"=>["index","check"],
        );
        //判断当前控制器是否在排除的控制器内
        if(isset($paichu[$controller])){
            //控制器对应的方法与当前的方法能否匹配
            $actions = $paichu[$controller];
            if(in_array($action, $actions)){
                return;//终止方法，和整体程序无关。
            }
        }
        //判断是否登陆
        if(!Cookie::has("admin_id")){
            redirect("admin/login/index")->send();
            die();
        }
        
        
        
        
//        if(strtolower($controller) =="admin" && strtolower($action) =="index"){
//            redirect("admin/login/index")->send();
//            die();
//        }
    }
}