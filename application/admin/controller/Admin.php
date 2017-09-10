<?php
  namespace app\admin\controller;
  use think\Controller;
  class Admin extends Controller{
    public function add() {
      if (request() -> isPost()) {
        $validate = new \think\Validate([
            'username'  => 'require|max:25',
            'password' => 'require|max:32'
        ]);
        $data = [
          'username' => input('username'),
          'password' => md5(input('password'))
        ];
        if (!$validate->check($data)) {
            return $this -> error(($validate->getError()));
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
      return $this -> fetch('menu');
    }
  }
