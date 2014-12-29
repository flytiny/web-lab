<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        $userid=$_POST['user_email'];
        $password=$_POST['password'];
         $user=M('User');
         $guanzhu=M('Guanzhu');
         $where['user_id']=$userid;
         $where['password']=$password;
         $arr=$user->where($where)->find();
         if($arr){
            $_SESSION['username']=$arr['user_name'];
            $_SESSION['id']=$arr['id'];
            $_SESSION['picture']=$arr['user_image'];
            $_SESSION['coin']=$arr['user_coin'];
         //    $data5['user_id']=$arr['id'];
         // $guanzhu_info=$guanzhu->where($data5)->order('id desc')->select();
         //    $_SESSION['guanzhu']=$guanzhu_info;
            $data=1;
         }else{
            $data=0;
         }
         $this->ajaxReturn($data);
        }
         
    public function cancel(){
            session(null); 

        }

    public function register(){
        $username=$_POST['register_user_name'];
        $userid=$_POST['register_user_id'];
        $password=$_POST['register_password'];

         $user=M('User');
          $where1['user_id']=$userid;
         $arr1=$user->where($where1)->find();

         $where2['user_name']=$username;
         $arr2=$user->where($where2)->find();
         if(!($arr1)){
            if(!($arr2)){
                $data['user_id'] = $userid;
                $data['user_name'] = $username;
                $data['password'] = $password;
                $data['user_coin'] = 0;
                $user->create($data);
                $user->add();

                $where['user_id']=$userid;
                $arr=$user->field('id,user_name')->where($where)->find();
            $_SESSION['username']=$arr['user_name'];
            $_SESSION['id']=$arr['id'];
            $data=1;
            }else{
                $data=2;
            }
         }else{
            $data=3;
         }
         $this->ajaxReturn($data);
    }

    }
