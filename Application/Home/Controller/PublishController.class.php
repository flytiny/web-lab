<?php
namespace Home\Controller;
use Think\Controller;
class PublishController extends Controller {

    public function index(){

            $this->display('publish');



    }
    public function publishqa(){
        $upload = new \Think\Upload();
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public';
        $upload->savePath  =      '/picture/wenti/'; // 设置附件上传目录// 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息    
          $picture_path=null;}
        else{// 上传成功 获取上传文件信息    
            foreach($info as $file){        
                 $picture_path=$file['savepath'].$file['savename'];    
             }}
        $checkbox = $_POST['checkbox']; 
        $title=$_POST['title'];
        $coin=$_POST['coin'];
        $content=$_POST['content'];

        $question=M('Question');
        $data['userid']=$_SESSION['id'];
        $data['username']=$_SESSION['username'];
        $data['title']=$title;
        $data['content']=$content;
        $data['coin']=$coin;
        $data['picture']=$picture_path;
        $data['time']=time();
        
        $data['C']=0;
        $data['JAVA']=0;
        $data['PHP']=0;

        $arrlength=count($checkbox);

        for($x=0;$x<$arrlength;$x++) {
             if($checkbox[$x]=='option1'){
                $data['C']=1;
             }
             if($checkbox[$x]=='option2'){
                $data['JAVA']=1;
             }
            if($checkbox[$x]=='option3'){
                $data['PHP']=1;
             }

        }


        $question->create($data);
        $index=$question->add();

        $user=M('User');
        $temp['id']=$_SESSION['id'];
        $user_info=$user->where($temp)->find();
        $user_info['user_coin']=$_SESSION['coin']+10;
        $_SESSION['coin']+=10;
        $user->where($temp)->save($user_info);


        $this->redirect('/home/index/index');


    

}

}