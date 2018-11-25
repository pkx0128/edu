<?php
    namespace app\index\controller;
    use think\Controller;
    use think\Session;
    class Base extends Controller
    {
        protected function _initialize()
        {
            parent::_initialize();
            define("USER_ID",Session::get('user_id'));
        }
        // 处理未登录直接访问管理员中心
        protected function isLogin(){
            if(empty(USER_ID)){
                $this -> error('未登录,禁止访问。。。','user/login');
            }
        }

        //处理重复登录
        protected function alreadyLogin(){
            if(!empty(USER_ID)){
                $this->error('已经登录,请勿重复登录','index/index');
            }
        }
    }

?>