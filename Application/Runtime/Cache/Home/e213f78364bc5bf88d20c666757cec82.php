<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>FlyTiny Q&A</title>
        <script src="/Public/js/jquery.min.js"></script>
    <link href="/Public/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Public/css/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet"  href="/Public/css/publish-qa.css" type="text/css">
    <link rel="stylesheet"  href="/Public/css/modify.css" type="text/css">

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
    <h1 class="publish-qa-head"> 修改信息</h1>
    <form class="publish-qa-form navbar-left" role="form" action="/index.php/Home/User/xiugai" method="post" enctype="multipart/form-data">
        <div class="publish-qa-img ">
            <strong class="publish-qa-label5">修改头像</strong>
            <?php
 $src="/Public".$_SESSION['picture']; echo '<img alt="陈倾酒" src="'.$src.'" class="img_old">'; ?>
            <input type="file" id="file" name="file" class="publish-qa-img-submit">
        </div>

        <div class="publish-qa-title "> 
            <strong class="publish-qa-label1">用户昵称</strong>
            <input type="text" class="publish-qa-name-input form-control  " name="name" id="name"  required="" autofocus="" value="<?php echo ($user_info['user_name']); ?>">
        </div>
         <div class="publish-qa-title "> 
            <strong class="publish-qa-label1">用户密码</strong>
            <input type="text" class="publish-qa-password-input form-control  " name="password" id="password"  required="" autofocus="" value="<?php echo ($user_info['password']); ?>">
        </div>
         <div class="publish-qa-title "> 
            <strong class="publish-qa-label1">用户性别</strong>
            <label class="radio-inline sex_select1">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 男
            </label>
            <label class="radio-inline sex_select2">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 女
            </label>
        </div>
         <div class="publish-qa-title "> 
            <strong class="publish-qa-label1">用户地点</strong>
            <input type="text" class="publish-qa-location-input form-control  " name="location" id="location"  required="" autofocus="" value="<?php echo ($user_info['location']); ?>">
        </div>
        <div class="publish-qa-title "> 
            <strong class="publish-qa-label1">用户学历</strong>
            <input type="text" class="publish-qa-study-input form-control  " name="study" id="study"  required="" autofocus=""
            value="<?php echo ($user_info['study']); ?>">
        </div>
        <div class="publish-qa-title "> 
            <strong class="publish-qa-label1">用户邮箱</strong>
            <input type="email" class="publish-qa-email-input form-control  " name="email" id="email"  required="" autofocus=""
            value="<?php echo ($user_info['email']); ?>">
        </div>
        

        
        <div class="publish-qa-submit ">
            <button type="submit" class="btn btn-default btn-lg publish-qa-submit-button">提交修改</button>
        </div>
    </form>
</div>



<script src="/Public/js/header.js"></script>
</body>
</html>