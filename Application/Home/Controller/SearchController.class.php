<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {

    public function index(){
    	$user=M('User');
    	$question=M('Question');
    	$content=$_POST['search_content'];
    	$content='%'.$content.'%';
    	$data1['user_name']=array('like',$content);
    	$data2['title']=array('like',$content);
    	$user_data=$user->where($data1)->select();
    	$question_data=$question->where($data2)->select();

        $this->assign('question_data',$question_data);
        $this->assign('user_data',$user_data);
        $this->display('search');
    }

    public function searchtag($id){

        if($id==1){
            $data['C']=1;
        }
        if($id==2){
            $data['JAVA']=1;
        }
        if($id==3){
            $data['PHP']=1;
        }

        $question=M('Question');
        $question_data=$question->where($data)->select();

        $this->assign('question_data',$question_data);
        $this->display('search_tag');
    }

}