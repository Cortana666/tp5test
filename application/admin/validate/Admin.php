<?php
  namespace app\admin\validate;
  use think\Validate;
  class Admin extends Validate{
    protected $rule =   [
       'username'  => 'require|max:16',
       'password'  => 'require',
    ];
    protected $message  =   [
        'username.require' => '用户名不能为空',
        'username.between'     => '用户名长度不能大于16',
        'password.require'   => '密码不能为空',
    ];
    protected $scene = [
           'add'  =>  ['username','password'],
           'edit'  =>  ['username'],
    ];

  }
