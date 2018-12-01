<?php
    namespace app\index\model;
    use think\Model;
    

    class User extends Model
    {
      protected function getStatusAttr($value){
            $status=[
                0=>'已停用',
                1=>'已启用'
            ];
            return $status[$value];
      }

      protected function getRoleAttr($value){
            $role=[
                0=>'管理员',
                1=>'超级管理员'
            ];
            return $role[$value];
      }
    }
?>