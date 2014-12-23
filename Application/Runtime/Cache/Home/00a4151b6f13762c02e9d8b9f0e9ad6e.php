<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>FlyTiny Q&amp;A</title>
        <script src="/Public/js/jquery.min.js"></script>
    <link href="/Public/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Public/css/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet"  href="/Public/css/question.css" type="text/css">
        <link rel="stylesheet"  href="/Public/css/right.css" type="text/css">

</head>
<body onload="set()">

<nav class="navbar navbar-default navbar-static-top" role="navigation" >
    <div class="container" >
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav" id="wojiushitop">
            	<a class="navbar-brand head-title"  href="http://localhost/index.php/home/index/index">FlyTiny QA</a>
                <li class="col-lg-6 search-text" >
                    <form role="form" action="/index.php/home/search/index" method="post">
    				    <div class="input-group">
      					 <input type="text" class="form-control" name="search_content"  id="search_content">
     						 <span class="input-group-btn">
       							 <button class="btn btn-default" type="submit">搜索</button>
      						</span>
    				    </div>
                    </form>
  				</li>

                <?php
 if(isset($_SESSION['username']) && $_SESSION['username']!=''){ $src="/Public".$_SESSION['picture']; echo '<li><img src="'.$src.'" alt="..." class="img-rounded" style="height:40px; margin-top: 5px; margin-left:10px; margin-right:10px;"></li>

                <li><a href="/index.php/home/user/index?id='; echo $_SESSION['id']; echo '" class="answer-author" ><strong >'.$_SESSION['username'].'</strong></a></li>
                <li><a href="#" class="answer-author" onclick="cancel()" >注销</a></li>'; } else{ echo '<li class="navbar-right"><a href="#Register_Modal"  data-toggle="modal" onclick="click_register()" id="click_register"  name="click_register">Register</a></li>
                <li class="navbar-right"><a href="#Login_Modal" data-toggle="modal" onclick="click_login()" id="click_login" name="click_login">Log In</a></li>'; } ?>
            </ul>
            <!-- <ul class="nav navbar-nav navbar-right">
 -->                
            <!-- </ul> -->
        </div>
    </div>
</nav>

<!--这个div是注册的div模态框-->
<div class="modal fade" id="Register_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="Register_Modal_Title">注册账号<small>(注册成功之后会直接登录)</small></h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="username">用户名</label>
                        <input type="text" class="form-control" id="register_user_name" placeholder="username" style="width:50%">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">账号</label>
                        <input type="email" class="form-control" id="register_user_id" placeholder="id"  data-placement="bottom" data-content="Vivamus" style="width:50%">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">密码</label>
                        <input type="password" class="form-control" id="register_password" placeholder="password" style="width:50%">
                    </div>
                    <p id="register_error1" name="register_error1" style="color: #F4115F;">用户民已存在~~~~~~~~ </p>
                    <p id="register_error2" name="register_error2" style="color: #F4115F;">账号已存在~~~~~~</p>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="register()">注册</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="Login_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">登陆</h4>
            </div>
            <div class="modal-body">
            	<form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">账号</label>
                        <input type="email" class="form-control" id="login_user_id" name="userid" placeholder="id" onfocus="popover" data-placement="bottom" data-content="Vivamus" style="width:50%">
                    </div>
                    <div class="form-group">
                        <label for="password">密码</label>
                        <input type="password" class="form-control" id="login_password" name="password" placeholder="password" style="width:50%;">
                       
                    </div>
                     <p id="login_error" name="login_error" style="color: #F4115F;">密码错误诶</p>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="login_button" onclick="login()">登陆</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="QA-main-content">
    <div class="QA-left">

        <?php
 $showtime = date("y-m-d h:i", $question['time']); $src="/Public".$question['picture']; echo '<div class="question-area">
            <div class="row">
                <div class="question-title">
                    <h3 class="question-title" id="questionTitle" ><strong>'.$question['title'].'</strong></a></h3>
                    <div class="author">




                        <a href="/index.php/home/user/index?id='; echo $question['userid']; echo '" class="question-author"><strong>'.$question['username'].'</strong></a>'.$showtime.' 提问
                        <ul class="question-taglist">'; if($question['C']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=1" class="tag-click">C</a></span> </li>'; } if($question['JAVA']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=2" class="tag-click">JAVA</a></span> </li>'; } if($question['PHP']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=3" class="tag-click">PHP</a></span> </li>'; } echo '</ul>
                    </div>
                </div>
                <div class="question-option">
                    <div class="button-section">
                        <button type="button"  class="btn btn-success btn-sm question-option-button1" data-id="" data-do="follow" data-type="question"  onclick="dianzan()">点赞</button>
                        <strong id="dianzannum" name="dianzannum">'.$question['prisenum'].'</strong> 点赞
                        <button type="button"  class="btn btn-default btn-sm question-option-button2" data-id="" data-do="bookmark" data-type="question" onclick="shoucang()">收藏</button><strong id="shoucangnum" name="shoucangnum">'.$question['sellectnum'].'</strong> 收藏
                        <span class="glyphicon glyphicon-tower coin" aria-hidden="true"></span>
                        赏金：'.$question['coin'].' 金币
                    </div>

                    <p id="dianzan_error" name="dianzan_error" style="color: #F4115F; display:none;">已取消 </p>
                    <p id="dianzan_error2" name="dianzan_error2" style="color: #F4115F;display:none;">请先登录~~~~ </p>
                    <p id="shoucang_error" name="shoucang_error" style="color: #F4115F; display:none;">已取消收藏~~~~</p>
                </div>
            </div>
        </div>  

        <div class="question-content" >
            <p class="lead question-content-text">'.$question['content'].'</p>'; if(!($question['picture']==null)){ echo '<img src="'.$src.'" class="img-responsive img-thumbnail question-img" alt="">'; } echo '<hr />
        </div>'; ?>

        <?php
 echo '<div class="answer">
            <div class="answer-summary">
                <h3 class="answer-num" id="zh-question-answer-num">'.$question['answernum'].' 个回答</h3>
                <hr />
            </div>
        </div>'; ?>

        <?php
 foreach ($answer as $key => $value) { $showtime = date("y-m-d h:i", $value['time']); $src="/Public".$value['picture']; echo '<div class="answer-content">
            <div class="answer-rank">
                <div class="votes">
                    <strong id="dianzannum2" name="dianzannum2">'.$value['prisenum'].'</strong>
                    <button class="glyphicon glyphicon-thumbs-up" dashuaibi="'.$value['id'].'" onclick="dianzan2(this)"></button>
                </div>
            </div>
            <div class="answer-main">
                <div class="author">
                    <a href="/index.php/home/user/index?id='; echo $value['userid']; echo '" class="answer-author"><strong>'.$value['username'].'</strong></a>
                        '.$showtime.'回答'; if($value['adopt']==1){ echo '<span class="glyphicon glyphicon-check answer-adopt" aria-hidden="true"></span>
                    被采纳'; } echo '</div>
                <div class="answer-text">
                    <p class="lead answer-text">'.$value['content'].'</p>'; if(!($value['picture']==null)){ echo '<img src="'.$src.'" class="img-responsive img-thumbnail answer-img" alt="">'; } echo '<hr />
                </div>
            </div>
        </div> '; } ?>
       
        <form class="publish-answer-form " role="form" action="/index.php/Home/Question/publishanswer" method="post" enctype="multipart/form-data">
            <div class="publish-answer">
                <strong class="publish-answer-label1">发布回复</strong><br/><br />
                <textarea class="form-control publish-answer-content" rows="10" id="publish_answer_content"  name="publish_answer_content"></textarea>
                <input type="file" id="file" name="file" class="publish-answer-img">
                <input type="hidden" name="hidden_name" id="hidden_name" value="<?php echo ($question['id']); ?>">
                <button type="submit" class="btn btn-default btn-lg publish-answer-button">发布回复</button>
            </div>

        </form>
    </div>
    
    <div class="QA-right">
        <div class="QA-right-section">
            <li class="QA-right-question">
            <?php
 echo '<a class="QA-right-question-text" href="/index.php/home/user/index/id/'.$_SESSION['id'].'">'; ?>
                    <span class="glyphicon glyphicon-question-sign QA-right-question-img"></span>
                    我的问题
                </a>
            </li>
            <li class="QA-right-fav">
                <?php
 echo '<a class="QA-right-question-text" href="/index.php/home/user/index/id/'.$_SESSION['id'].'">'; ?>
                    <span class="glyphicon glyphicon-ok-sign QA-right-fav-img"></span>
                    我的收藏
                </a>
            </li>
        </div>
    </div>


    <div id="toolBackTo" class="back-to" widthlog="" style="left: 1151.5px;">
<a href="#wojiushitop" style="display: block;"></a> 
</div>
</div>



<script src="/Public/js/dianzan.js"></script>
<script src="/Public/js/header.js"></script>
</body>
</html>