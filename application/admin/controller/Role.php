<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Role as adminRole;
use app\admin\model\Admin;
use think\Loader;
class Role extends Controller{
    //管理员列表
    public function index(){
        $list = new adminRole();
        $list = $list->paginate(2);
        $this->assign("list",$list);
        return $this->fetch();
    }
    //打开新增页面
    public function add(){
        return $this->fetch();
    }
    
    //插入数据
    public function insert(){
        $data= input("post.");
        //加载验证规则
        $validate = Loader::validate('Role');
        if(!$validate->check($data)){
           $this->error($validate->getError());
        }else{
            $adminRole = new adminRole;
            //添加数据并排除password1;
            if($adminRole->save($data)){
                $this->success("添加成功！","admin/role/index");
            }else{
                $this->error("添加失败！");
            }
        }
    }
    //删除
    public function delete($id){
        $adminRole = new adminRole;
        $ret = $adminRole->where("id",$id)->delete();
        if($ret){
            $this->success("删除成功！","admin/Role/index");
        }else{
            $this->error("删除失败！请重试。");
        }
    }
    
    //修改
    public function update($id){
        $data = adminRole::get($id);
        $this->assign("list",$data);
//        var_dump($data);
        return $this->fetch("role/update");
    }
    
    //保存修改的信息 
    public function saveUp(){
        $data = input("post.");
        $validate = Loader::validate('Role');
        if(!$validate->check($data)){
           $this->error($validate->getError());
        }else{
            $adminRole = new adminRole;
            //添加数据并排除password1;
            if($adminRole->save($data,["id"=>$data["id"]])){
                $this->success("修改成功！","admin/Role/index");
            }else{
                $this->error("修改失败！");
            }
        }
    }
}