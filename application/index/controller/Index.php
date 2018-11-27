<?php
namespace app\index\controller;
class Index extends Base
{
    public function index()
    {
        $this->isLogin();
        $this->assign('title','tp5学习项目');
        return $this-> fetch();
    }
}

?>

