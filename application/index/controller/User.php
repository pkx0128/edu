<?php
    namespace app\index\controller;
    class User extends Base
    {
        public function login(){
            return $this-> fetch();
        }
    }

?>