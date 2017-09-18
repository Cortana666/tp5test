<?php
  namespace app\admin\controller;
  use think\Controller;
  use app\admin\model\Admin as AdminModel;
  class Admin extends Controller{

    public function add() {
      if (request() -> isPost()) {
        $data = [
          'username' => input('username'),
          'password' => md5(input('password')),
        ];
        $validate = \think\Loader::validate('Admin');
        if(!$validate -> scene('add') -> check($data)){
            $this -> error($validate->getError());
            die;
        }
        if (db('admin') -> insert($data)) {
          return $this -> success("success!","menu");
        }else {
          return $this -> error("error!");
        }
        return;
      }
      return $this -> fetch('add');
    }

    public function edit() {
      $id = input('id');
      $admins = db('admin')->where('id', $id)->find();
      if (request() -> isPost()) {
        $data = [
          'id' => input('id'),
          'username' => input('username'),
        ];
        if (input('password')) {
          $data['password'] = md5(input('password'));
        }else {
          $data['password'] = $admins['password'];
        }
        $validate = \think\Loader::validate('Admin');
        if(!$validate -> scene('edit') -> check($data)){
            $this -> error($validate->getError());
            die;
        }
        if (db('admin')->where('id', $id)->update($data)) {
          $this -> success("修改成功！",'menu');
        }else {
          $this -> error("修改失败！");
        }
        return;
      }
      $this -> assign('admins', $admins);
      return $this -> fetch();
    }

    public function menu() {
      $list = AdminModel::paginate(8);
      $this->assign('list', $list);
      return $this -> fetch('menu');
    }

    public function del() {
      $id = input('id');
      if ($id != 1) {
        db('admin')->where('id', $id)->delete();
        $this -> success("删除成功！", "menu");
      }else {
        $this -> error("初始化管理员不可删除！");
      }
    }
  }
