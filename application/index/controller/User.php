<?php
    namespace app\index\controller;
    use think\Request;
    use app\index\model\User as UserModel;
    class User extends Base
    {
        public function login(){
            return $this-> fetch();
        }

        public function checkLogin(Request $request){
            $status = 0;
            $resault = '';
            $data = $request -> param();

            //验证规则
            $rule = [
                'name|用户名'=>'require',
                'password|密码'=>'require',
                'verify|验证码'=>'require|captcha',
            ];
            // 自定义错误信息
            $msg=[
                'name'=>['require'=>'用户名不能为空，请检查！'],
                'password'=>['require'=>'密码不能为空，请检查！'],
                'verify'=>[
                    'require'=>'验证码不能为空，请检查！',
                    'captcha'=>'验证码不正确！！'
                ],
            ];
            
            $resault = $this->validate($data,$rule,$msg);
            if($resault==true){
                $map = [
                    'name'=>$data['name'],
                    'password'=>md5($data['password'])
                ];
                
                $rel = UserModel::get($map);
                // dump($rel);
                if($rel==null){
                    // $status = 0;
                    $resault = '没有此用户';
                }else{
                    $status = 1;
                    $resault='验证成功';
                }
        }
            return['status'=>$status,'message'=>$resault,'data'=>$data];
            
        }
    }

?>