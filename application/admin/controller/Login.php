<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
use think\Cookie;
class Login extends controller{
    public function index(){
        return $this->fetch();
    }
//    验证用户信息
    public function check(){
        $username=input("post.username","");
        $pwd = input("post.password","");
        if(empty($username) || empty($pwd)){
            $this->error("用户名或密码不能为空");
        }
        $info = Admin::where(array("username"=>$username,"password"=>$pwd))->find();
        if($info){
            Cookie::set("admin_id",$info->id,['expire'=>3600]);
            Cookie::set("admin_name",$info->username,['expire'=>3600]);
            $this->success("登陆成功","admin/admin/index");
        }else{
            $this->error("登录失败");
        }
    }
    //退出登录
    public function userout(){
        Cookie::delete("admin_id");
        Cookie::delete("admin_name");
        $this->redirect("admin/login/index");
    }
}
