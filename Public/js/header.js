function login(){

	var user_email=document.getElementById("login_user_id").value;
	var password=document.getElementById("login_password").value;
    $.post("http://localhost/index.php/home/login/login",
    {
     'user_email': user_email,
     'password': password,
    },
    function(data,status){
    	index=data;
       if(index==1){
    	location.reload(true);
    }
    else{
    $("#login_error").show(500);
    $("#login_error").hide(2000);
    }

    });
  }

 function cancel(){

    $.post("http://localhost/index.php/home/login/cancel",
    {
     'user_email': '23',
    },
    function(data,status){
    	location.reload(true);
    });
  }

  function register(){

	var user_email=document.getElementById("register_user_id").value;
	var password=document.getElementById("register_password").value;
	var username=document.getElementById("register_user_name").value;
    $.post("http://localhost/index.php/home/login/register",
    {
     'register_user_id': user_email,
     'register_password': password,
     'register_user_name': username,
    },
    function(data,status){
    	index=data;
       if(index==1){
    	location.reload(true);
    }
    else if(index=2){
    $("#register_error1").show(500);
    $("#register_error1").hide(2000);
    }else{
    	 $("#register_error1").show(500);
    $("#register_error1").hide(2000);
    }

    });
  }


  function click_login(){

    $("#login_error").hide();
  }

    function click_register(){

    $("#register_error1").hide();
    $("#register_error2").hide();
  }

function question(){
     $.post("http://localhost/index.php/home/index/set",
    {

    },
    function(data,status){
      index=data;
       if(index==1){
      window.location.href="/index.php/home/publish/index";
    }
    else if(index==2){
     $("#login_error2").show(500);
    $("#login_error2").hide(2000);
    }else if(index==3){
      $("#coin_error").show(500);
    $("#coin_error").hide(2000);

    }

    });
}