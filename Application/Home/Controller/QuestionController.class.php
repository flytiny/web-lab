<?php
namespace Home\Controller;
use Think\Controller;
class QuestionController extends Controller {
	public function index($id){
		 $question=M('Question');
		 $answer=M('Answer');
		 $temp1['id']=$id;
		 $temp2['questionid']=$id;
         $question_info=$question->where($temp1)->find();
         $answer_info=$answer->where($temp2)->select();
         
         $this->assign('question',$question_info);
        $this->assign('answer',$answer_info);

        $this->display('question');
	}


	public function publishanswer(){

         if(!(isset($_SESSION['username']) && $_SESSION['username']!='')){
                 $this->error('请先登录','/index.php/home/index/index',1);
         }else{
		 $upload = new \Think\Upload();
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public';
        $upload->savePath  =      '/picture/huida/'; // 设置附件上传目录// 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息    
          $picture_path=null;}
        else{// 上传成功 获取上传文件信息    
            foreach($info as $file){        
                 $picture_path=$file['savepath'].$file['savename'];    
             }}
        $content=$_POST['publish_answer_content'];
        $answer=M('Answer');
        $data['userid']=$_SESSION['id'];
        $data['username']=$_SESSION['username'];
        $data['content']=$content;
        $data['questionid']=(int)$_POST['hidden_name'];
        $data['time']=time();
        $data['picture']=$picture_path;
         $answer->create($data);
        $index=$answer->add();


        $question=M('Question');
        $quedata['id']=(int)$_POST['hidden_name'];
        $arr=$question->where($quedata)->find();
        $answernum=$arr['answernum']+1;

        $question-> where($quedata)->setField('answernum',$answernum);

        $user=M('User');
        $temp['id']=$_SESSION['id'];
        $user_info=$user->where($temp)->find();
        $user_info['user_coin']=$_SESSION['coin']+10;
        $_SESSION['coin']+=10;
        $user->where($temp)->save($user_info);

        $this->index($quedata['id']);

    }
	}


  public function dianzan(){


         if(!(isset($_SESSION['username']) && $_SESSION['username']!='')){
                 $temp=3;
         }else{
         $dianzan=M('Dianzan');
         $question=M('Question');
        $temp['questionid']=$_POST['questionid'];
        $temp['userid']=$_SESSION['id'];

         $dianzan_info=$dianzan->where($temp)->find();
         if(!($dianzan_info)){
            $data['questionid']=$_POST['questionid'];
            $data['userid']=$_SESSION['id'];
            $dianzan->create($data);
            $dianzan->add();

            $data2['id']=$_POST['questionid'];
            $question_info=$question->where($data2)->find();
            $wahaha=$question_info['prisenum'];
            $question_info['prisenum']=$wahaha+1;
            $question->where($data2)->save($question_info); 

            $temp=1;
         }else{
            $data3['id']=$dianzan_info['id'];
            $dianzan->where($data3)->delete();

            $data2['id']=$_POST['questionid'];
            $question_info=$question->where($data2)->find();
            $wahaha=$question_info['prisenum'];
            $question_info['prisenum']=$wahaha-1;
            $question->where($data2)->save($question_info); 

            $temp=2;
            
         }
}
         $this->ajaxReturn($temp);


  }

    public function dianzan2(){
         $dianzan=M('Dianzanans');
         $answer=M('Answer');
        $temp['answerid']=$_POST['answerid'];
        $temp['userid']=$_SESSION['id'];

         $dianzan_info=$dianzan->where($temp)->find();
         if(!($dianzan_info)){
            $data['answerid']=$_POST['answerid'];
            $data['userid']=$_SESSION['id'];
            $dianzan->create($data);
            $dianzan->add();

            $data2['id']=$_POST['answerid'];
            $answer_info=$answer->where($data2)->find();
            $wahaha=$answer_info['prisenum'];
            $answer_info['prisenum']=$wahaha+1;
            $answer->where($data2)->save($answer_info); 

            $temp=1;
         }else{
            $data3['id']=$dianzan_info['id'];
            $dianzan->where($data3)->delete();

            $data2['id']=$_POST['answerid'];
            $answer_info=$answer->where($data2)->find();
            $wahaha=$answer_info['prisenum'];
            $answer_info['prisenum']=$wahaha-1;
            $answer->where($data2)->save($answer_info); 
            $temp=2;
         }

         $this->ajaxReturn($temp);


  }


    public function shoucang(){

        if(!(isset($_SESSION['username']) && $_SESSION['username']!='')){
                 $temp=3;
         }else{
         $shoucang=M('Fav');
         $question=M('Question');
        $temp['questionid']=$_POST['questionid'];
        $temp['userid']=$_SESSION['id'];

         $shoucang_info=$shoucang->where($temp)->find();
         if(!($shoucang_info)){
            $data['questionid']=$_POST['questionid'];
            $data['userid']=$_SESSION['id'];
            $shoucang->create($data);
            $shoucang->add();

            $data2['id']=$_POST['questionid'];
            $question_info=$question->where($data2)->find();
            $wahaha=$question_info['sellectnum'];
            $question_info['sellectnum']=$wahaha+1;
            $question->where($data2)->save($question_info); 

            $temp=1;
         }else{

             $data3['id']=$shoucang_info['id'];
            $shoucang->where($data3)->delete();

            $data2['id']=$_POST['questionid'];
            $question_info=$question->where($data2)->find();
            $wahaha=$question_info['sellectnum'];
            $question_info['sellectnum']=$wahaha-1;
            $question->where($data2)->save($question_info); 

            $temp=2;        
             }
}
         $this->ajaxReturn($temp);


  }
}