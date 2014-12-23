<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        $question=M('Question');
        $new=$question->order('time desc')->select();
        $data['time'] =array('egt',time()-7*24*60*60);
        $hot=$question->where($data)->order('answernum desc')->select();
        $temp['answernum']=0;
        $noans=$question->where($temp)->order('time desc')->select();
        $this->assign('new',$new);
        $this->assign('hot',$hot);
        $this->assign('noans',$noans);

        $this->display("index");
    }

    public function set(){

        if(isset($_SESSION['username']) && $_SESSION['username']!=''){
            if($_SESSION['coin']<=100){
                $temp=3;
            }else
           $temp=1;
        }
        else{
            $temp=2;
        }  

        $this->ajaxReturn($temp);
    }
    

}