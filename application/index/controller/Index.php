<?php
namespace app\index\controller;
class Index extends Base
{
    public function index()
    {
        $this->isLogin();
        $this->assign('title','tp5学习项目');
        $this->assign('keywords','tp5学习项目');
        $this->assign('des','tp5学习项目');
        return $this-> fetch();
    }
}

?>

