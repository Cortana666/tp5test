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
    public function menu() {
      $list = AdminModel::paginate(2);
      $this->assign('list', $list);
      return $this -> fetch('menu');
    }
  }
