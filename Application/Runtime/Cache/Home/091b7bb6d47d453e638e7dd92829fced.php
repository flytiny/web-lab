<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>FlyTiny Q&amp;A</title>
        <script src="/Public/js/jquery.min.js"></script>
    <link href="/Public/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Public/css/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet"  href="/Public/css/user.css" type="text/css">
        <link rel="stylesheet"  href="/Public/css/right.css" type="text/css">

</head>
<body>

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
 if(!(isset($_SESSION['username']) && $_SESSION['username']!='')){ $src="/Public".$user_info['user_image']; echo '<div class="user_info">
            <div class="user_info_main">
                <div class="top">

                    <div class="title-section ellipsis">

                            <span class="name">'.$user_info['user_name'].'</span>
                            <span class="coin">用户积分 : '.$user_info['user_coin'].'</span>
                    </div>
                </div>
                <div class="body clearfix">
                    <div class="zm-profile-header-avatar-container self">
                    <img alt="陈倾酒" src="'.$src.'" class="zm-profile-header-img zg-avatar-big zm-avatar-editor-preview">
                    </div>
                    
                    <div class="info_content">
                        <div class="sex">
                            <strong class="sex_name">性别:</strong>
                            <strong class="sex_info">'.$user_info['sex'].'</strong>
                        </div>
                        <div class="location">
                            <strong class="location_name">地点:</strong>
                            <strong class="location_info">'.$user_info['location'].'</strong>
                        </div>
                         <div class="study">
                            <strong class="study_name">学历:</strong>
                            <strong class="study_info">'.$user_info['study'].'</strong>
                        </div>
                        <div class="email">
                            <strong class="study_name">邮箱:</strong>
                            <strong class="study_info">'.$user_info['email'].'</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="question">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">他的问题</a></li>
                            <li role="presentation"><a href="#profile" role="tab" data-toggle="tab">他的收藏</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">'; foreach ($question_info as $key => $value) { $showtime = time() - $value['time']; if ($showtime < 60) { $showtime = ($showtime)."秒前"; } elseif ($showtime / 3600 < 1) { $showtime = (floor($showtime / 60))."分钟前"; } elseif ($showtime / 3600 < 8) { $showtime = (floor($showtime / 3600))."小时前"; } else { $showtime = date("y-m-d h:i", $value['time']); } echo '
                            <section class="question-list-section">
                                <div class="qa-rank">
                                    <div class="votes">
                                        '.$value['prisenum'] .'<small><span class="glyphicon glyphicon-thumbs-up"></span></small>
                                    </div>
                                    <div class="answers">
                                        '.$value['answernum'].'<small><span class="glyphicon glyphicon-comment"></span></small>
                                    </div>
                                </div>
                                <div class="qa-info">
                                    <ul class="author">
                                        <li>
                                            <a href="/index.php/home/user/index?id='; echo $value['userid']; echo '">'.$value['username'].'</a>
                                            <span class="split"></span>
                                            <li>在'; echo $showtime; echo '提问</li>
                                        </li>
                                    </ul>
                    <h2 class="title"><a href="/index.php/home/question/index?id='; echo $value['id']; echo '">'.$value['title'].'</a></h2>
                    <ul class="question-taglist">'; if($value['C']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=1" class="tag-click">C</a></span> </li>'; } if($value['JAVA']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=2" class="tag-click">JAVA</a></span> </li>'; } if($value['PHP']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=3" class="tag-click">PHP</a></span> </li>'; } echo '</ul>
                </div>
            </section>
                            '; } echo '</div>
                            <div role="tabpanel" class="tab-pane" id="profile">'; foreach ($fav_question as $key => $value) { $showtime = time() - $value['time']; if ($showtime < 60) { $showtime = ($showtime)."秒前"; } elseif ($showtime / 3600 < 1) { $showtime = (floor($showtime / 60))."分钟前"; } elseif ($showtime / 3600 < 8) { $showtime = (floor($showtime / 3600))."小时前"; } else { $showtime = date("y-m-d h:i", $value['time']); } echo '
                            <section class="question-list-section">
                                <div class="qa-rank">
                                    <div class="votes">
                                        '.$value['prisenum'] .'<small><span class="glyphicon glyphicon-thumbs-up"></span></small>
                                    </div>
                                    <div class="answers">
                                        '.$value['answernum'].'<small><span class="glyphicon glyphicon-comment"></span></small>
                                    </div>
                                </div>
                                <div class="qa-info">
                                    <ul class="author">
                                        <li>
                                            <a href="/index.php/home/user/index?id='; echo $value['userid']; echo '">'.$value['username'].'</a>
                                            <span class="split"></span>
                                            <li>在'; echo $showtime; echo '提问</li>
                                        </li>
                                    </ul>
                    <h2 class="title"><a href="/index.php/home/question/index?id='; echo $value['id']; echo '">'.$value['title'].'</a></h2>
                    <ul class="question-taglist">'; if($value['C']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=1" class="tag-click">C</a></span> </li>'; } if($value['JAVA']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=2" class="tag-click">JAVA</a></span> </li>'; } if($value['PHP']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=3" class="tag-click">PHP</a></span> </li>'; } echo '</ul>
                </div>
            </section>
                            '; } echo '</div>
                        </div>
        </div>'; }else if($_SESSION['id']!=$user_info['id']){ $src="/Public".$user_info['user_image']; echo '<div class="user_info">
            <div class="user_info_main">
                <div class="top">

                    <div class="title-section ellipsis">

                            <span class="name">'.$user_info['user_name'].'</span>
                            <span class="coin">用户积分 : '.$user_info['user_coin'].'</span>
                    </div>
                </div>
                <div class="body clearfix">
                    <div class="zm-profile-header-avatar-container self">
                    <img alt="陈倾酒" src="'.$src.'" class="zm-profile-header-img zg-avatar-big zm-avatar-editor-preview">
                    </div>
                    
                    <div class="info_content">
                        <div class="sex">
                            <strong class="sex_name">性别:</strong>
                            <strong class="sex_info">'.$user_info['sex'].'</strong>
                        </div>
                        <div class="location">
                            <strong class="location_name">地点:</strong>
                            <strong class="location_info">'.$user_info['location'].'</strong>
                        </div>
                         <div class="study">
                            <strong class="study_name">学历:</strong>
                            <strong class="study_info">'.$user_info['study'].'</strong>
                        </div>
                        <div class="email">
                            <strong class="study_name">邮箱:</strong>
                            <strong class="study_info">'.$user_info['email'].'</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="question">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">他的问题</a></li>
                            <li role="presentation"><a href="#profile" role="tab" data-toggle="tab">他的收藏</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">'; foreach ($question_info as $key => $value) { $showtime = time() - $value['time']; if ($showtime < 60) { $showtime = ($showtime)."秒前"; } elseif ($showtime / 3600 < 1) { $showtime = (floor($showtime / 60))."分钟前"; } elseif ($showtime / 3600 < 8) { $showtime = (floor($showtime / 3600))."小时前"; } else { $showtime = date("y-m-d h:i", $value['time']); } echo '
                            <section class="question-list-section">
                                <div class="qa-rank">
                                    <div class="votes">
                                        '.$value['prisenum'] .'<small><span class="glyphicon glyphicon-thumbs-up"></span></small>
                                    </div>
                                    <div class="answers">
                                        '.$value['answernum'].'<small><span class="glyphicon glyphicon-comment"></span></small>
                                    </div>
                                </div>
                                <div class="qa-info">
                                    <ul class="author">
                                        <li>
                                            <a href="/index.php/home/user/index?id='; echo $value['userid']; echo '">'.$value['username'].'</a>
                                            <span class="split"></span>
                                            <li>在'; echo $showtime; echo '提问</li>
                                        </li>
                                    </ul>
                    <h2 class="title"><a href="/index.php/home/question/index?id='; echo $value['id']; echo '">'.$value['title'].'</a></h2>
                    <ul class="question-taglist">'; if($value['C']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=1" class="tag-click">C</a></span> </li>'; } if($value['JAVA']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=2" class="tag-click">JAVA</a></span> </li>'; } if($value['PHP']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=3" class="tag-click">PHP</a></span> </li>'; } echo '</ul>
                </div>
            </section>
                            '; } echo '</div>
                            <div role="tabpanel" class="tab-pane" id="profile">'; foreach ($fav_question as $key => $value) { $showtime = time() - $value['time']; if ($showtime < 60) { $showtime = ($showtime)."秒前"; } elseif ($showtime / 3600 < 1) { $showtime = (floor($showtime / 60))."分钟前"; } elseif ($showtime / 3600 < 8) { $showtime = (floor($showtime / 3600))."小时前"; } else { $showtime = date("y-m-d h:i", $value['time']); } echo '
                            <section class="question-list-section">
                                <div class="qa-rank">
                                    <div class="votes">
                                        '.$value['prisenum'] .'<small><span class="glyphicon glyphicon-thumbs-up"></span></small>
                                    </div>
                                    <div class="answers">
                                        '.$value['answernum'].'<small><span class="glyphicon glyphicon-comment"></span></small>
                                    </div>
                                </div>
                                <div class="qa-info">
                                    <ul class="author">
                                        <li>
                                            <a href="/index.php/home/user/index?id='; echo $value['userid']; echo '">'.$value['username'].'</a>
                                            <span class="split"></span>
                                            <li>在'; echo $showtime; echo '提问</li>
                                        </li>
                                    </ul>
                    <h2 class="title"><a href="/index.php/home/question/index?id='; echo $value['id']; echo '">'.$value['title'].'</a></h2>
                    <ul class="question-taglist">'; if($value['C']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=1" class="tag-click">C</a></span> </li>'; } if($value['JAVA']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=2" class="tag-click">JAVA</a></span> </li>'; } if($value['PHP']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=3" class="tag-click">PHP</a></span> </li>'; } echo '</ul>
                </div>
            </section>
                            '; } echo '</div>
                        </div>
        </div>'; }else{ $src="/Public".$user_info['user_image']; echo '<div class="user_info">
            <div class="user_info_main">
                <div class="top">

                    <div class="title-section ellipsis">

                            <span class="name">'.$user_info['user_name'].'</span>
                            <span class="coin">用户积分 : '.$user_info['user_coin'].'</span>
                    </div>
                </div>
                <div class="body clearfix">
                    <div class="zm-profile-header-avatar-container self">
                    <img alt="" src="'.$src.'" class="zm-profile-header-img zg-avatar-big zm-avatar-editor-preview">
                    </div>
                    
                    <div class="info_content">
                    <a href="/index.php/home/user/modify" class="btn btn-success modify_info ">修改信息</a>
                        <div class="sex">
                            <strong class="sex_name">性别:</strong>
                            <strong class="sex_info">'.$user_info['sex'].'</strong>
                        </div>
                        <div class="location">
                            <strong class="location_name">地点:</strong>
                            <strong class="location_info">'.$user_info['location'].'</strong>
                        </div>
                         <div class="study">
                            <strong class="study_name">学历:</strong>
                            <strong class="study_info">'.$user_info['study'].'</strong>
                        </div>
                        <div class="email">
                            <strong class="study_name">邮箱:</strong>
                            <strong class="study_info">'.$user_info['email'].'</strong>
                        </div>
                    </div>


                </div>
            </div>
        </div>

         <div class="question">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">我的问题</a></li>
                            <li role="presentation"><a href="#profile" role="tab" data-toggle="tab">我的收藏</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">'; foreach ($question_info as $key => $value) { $showtime = time() - $value['time']; if ($showtime < 60) { $showtime = ($showtime)."秒前"; } elseif ($showtime / 3600 < 1) { $showtime = (floor($showtime / 60))."分钟前"; } elseif ($showtime / 3600 < 8) { $showtime = (floor($showtime / 3600))."小时前"; } else { $showtime = date("y-m-d h:i", $value['time']); } echo '
                            <section class="question-list-section">
                                <div class="qa-rank">
                                    <div class="votes">
                                        '.$value['prisenum'] .'<small><span class="glyphicon glyphicon-thumbs-up"></span></small>
                                    </div>
                                    <div class="answers">
                                        '.$value['answernum'].'<small><span class="glyphicon glyphicon-comment"></span></small>
                                    </div>
                                </div>
                                <div class="qa-info">
                                    <ul class="author">
                                        <li>
                                            <a href="/index.php/home/user/index?id='; echo $value['userid']; echo '">'.$value['username'].'</a>
                                            <span class="split"></span>
                                            <li>在'; echo $showtime; echo '提问</li>
                                        </li>
                                    </ul>
                    <h2 class="title"><a href="/index.php/home/question/index?id='; echo $value['id']; echo '">'.$value['title'].'</a></h2>
                    <ul class="question-taglist">'; if($value['C']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=1" class="tag-click">C</a></span> </li>'; } if($value['JAVA']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=2" class="tag-click">JAVA</a></span> </li>'; } if($value['PHP']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=3" class="tag-click">PHP</a></span> </li>'; } echo '</ul>
                </div>
            </section>
                            '; } echo '</div>
                            <div role="tabpanel" class="tab-pane" id="profile">'; foreach ($fav_question as $key => $value) { $showtime = time() - $value['time']; if ($showtime < 60) { $showtime = ($showtime)."秒前"; } elseif ($showtime / 3600 < 1) { $showtime = (floor($showtime / 60))."分钟前"; } elseif ($showtime / 3600 < 8) { $showtime = (floor($showtime / 3600))."小时前"; } else { $showtime = date("y-m-d h:i", $value['time']); } echo '
                            <section class="question-list-section">
                                <div class="qa-rank">
                                    <div class="votes">
                                        '.$value['prisenum'] .'<small><span class="glyphicon glyphicon-thumbs-up"></span></small>
                                    </div>
                                    <div class="answers">
                                        '.$value['answernum'].'<small><span class="glyphicon glyphicon-comment"></span></small>
                                    </div>
                                </div>
                                <div class="qa-info">
                                    <ul class="author">
                                        <li>
                                            <a href="/index.php/home/user/index?id='; echo $value['userid']; echo '">'.$value['username'].'</a>
                                            <span class="split"></span>
                                            <li>在'; echo $showtime; echo '提问</li>
                                        </li>
                                    </ul>
                    <h2 class="title"><a href="/index.php/home/question/index?id='; echo $value['id']; echo '">'.$value['title'].'</a></h2>
                    <ul class="question-taglist">'; if($value['C']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=1" class="tag-click">C</a></span> </li>'; } if($value['JAVA']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=2" class="tag-click">JAVA</a></span> </li>'; } if($value['PHP']==1){ echo '<li><span class="label label-primary tag-button"><a href="/index.php/home/search/searchtag?id=3" class="tag-click">PHP</a></span> </li>'; } echo '</ul>
                </div>
            </section>
                            '; } echo '</div>
                        </div>
        </div>'; } ?>
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
           <!--  <canvas id="c"></canvas>
            <div id="top">
                <a id="close" href=""></a>
            </div> -->
        </div>
    </div>


    <div id="toolBackTo" class="back-to" widthlog="" style="left: 1151.5px;">
<a href="#wojiushitop" style="display: block;"></a> 
</div>
</div>



<script src="/Public/js/dianzan.js"></script>
<script src="/Public/js/header.js"></script>
 <script src="/Public/js/game.js"></script>
</body>
</html>