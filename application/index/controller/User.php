<?php
    namespace app\index\controller;
    use think\Request;
    use app\index\model\User as UserModel;
    use think\Session;
    class User extends Base
    {
        public function login(){
            $this->alreadyLogin();
            return $this-> fetch();
        }
        //登录验证
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
                    Session::set('user_id',$rel->id);
                    Session::set('user_info',$rel->getData());
                }
        }
            return['status'=>$status,'message'=>$resault,'data'=>$data];
            
        }
        //注销登录
        public function loginout(){
            Session::delete('user_id');
            Session::delete('user_info');
            $this->success('注销成功,正在返回','index/user/login');
        }
        // 管理员列表
        public function adminList(){
            $this->assign('title','管理员列表');
            $this->assign('keywords','管理员列表');
            $this->assign('des','管理员列表');
            // 获取数据库中所有数据的数量
            $this->view->count = UserModel::count();
            // 获取当前登录的用户名
            $loginName = Session::get('user_info.name');
            // 如果当前用户为admin返回所有管理员信息,否则只返回当前用户信息
            if($loginName=='admin'){
                $list = UserModel::all();
            }else{
                $list = UserModel::all(['name'=>$loginName]); 
                dump($list);
            }
            $this->assign('list',$list);
            return $this->fetch('admin_list');
        }
    }

?>