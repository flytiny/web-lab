<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {

  public function index($id){

    $user=M('User');
    $data['id']=$id;
    $user_info=$user->where($data)->find();
    

    $question=M('Question');
    $data2['userid']=$id;
    $question_data=$question->where($data2)->order('time desc')->select();

    $fav=M('Fav');
    $data3['userid']=$id;
    $fav_info=$fav->where($data3)->order('id desc')->select();
    $fav_question=array();
    foreach ($fav_info as $key => $value) {
        $data4['id']=$value['questionid'];
        $temp=$question->where($data4)->find();
        array_push($fav_question, $temp);
    }

    $guanzhu=M('Guanzhu');
    $data5['user_id']=$id;
    $guanzhu_info=$guanzhu->where($data5)->order('id desc')->select();
    $user=M('User');
    $user_data=array();
    foreach ($guanzhu_info as $key => $value) {
        $data6['id']=$value['user_id2'];
        $temp=$user->where($data6)->find();
        array_push($user_data, $temp);
    }
    


    $this->assign('user_info',$user_info);
    $this->assign('question_info',$question_data);
    $this->assign('fav_question',$fav_question);
    $this->assign('user_data',$user_data);

    // var_dump($_SESSION['guanzhu']);
        $this->display('user');
	}


    public function modify(){
        $user=M('User');
        $data['id']=$_SESSION['id'];
        $user_info=$user->where($data)->find();
        $this->assign('user_info',$user_info);
        $this->display('modify');
    }


    public function xiugai(){
        $upload = new \Think\Upload();
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public';
        $upload->savePath  =      '/picture/touxiang/'; // 设置附件上传目录// 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息    
          $picture_path="/picture/touxiang/index.png";}
        else{// 上传成功 获取上传文件信息    
            foreach($info as $file){        
                 $picture_path=$file['savepath'].$file['savename'];    
             }}
        $user=M('User');
        $temp['id']=$_SESSION['id'];
        $data=$user->where($temp)->find();

        $data['user_image']=$picture_path;
        $data['user_name']=$_POST['name'];
        $data['password']=$_POST['password'];
        $data['study']=$_POST['study'];
        $data['location']=$_POST['location'];
        $data['email']=$_POST['email'];

        $_SESSION['picture']=$picture_path;
        $user->where($temp)->save($data); 

        $this->index($_SESSION['id']);

    }
}


  // public function guanzhu(){


       
  //        $dianzan=M('Dianzan');
  //        $question=M('Question');
  //       $temp['questionid']=$_POST['questionid'];
  //       $temp['userid']=$_SESSION['id'];

  //        $dianzan_info=$dianzan->where($temp)->find();
  //        if(!($dianzan_info)){
  //           $data['questionid']=$_POST['questionid'];
  //           $data['userid']=$_SESSION['id'];
  //           $dianzan->create($data);
  //           $dianzan->add();

  //           $data2['id']=$_POST['questionid'];
  //           $question_info=$question->where($data2)->find();
  //           $wahaha=$question_info['prisenum'];
  //           $question_info['prisenum']=$wahaha+1;
  //           $question->where($data2)->save($question_info); 

  //           $temp=1;
  //        }else{
  //           $data3['id']=$dianzan_info['id'];
  //           $dianzan->where($data3)->delete();

  //           $data2['id']=$_POST['questionid'];
  //           $question_info=$question->where($data2)->find();
  //           $wahaha=$question_info['prisenum'];
  //           $question_info['prisenum']=$wahaha-1;
  //           $question->where($data2)->save($question_info); 

  //           $temp=2;
            
  //        }
  //        $this->ajaxReturn($temp);


  // }