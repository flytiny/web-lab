// 

function dianzan(){

	var dianzannum=$('#dianzannum').text();
  var questionid=$('#hidden_name').val();
    $.post("http://localhost/index.php/home/question/dianzan",
    {
     'questionid': Number(questionid),
    },
    function(data,status){
    	index=data;
       if(index==1){
        temp=Number(dianzannum)+1;
    	$('#dianzannum').text(temp);
    }
    else if(index==2){
      temp=Number(dianzannum)-1;
      $('#dianzannum').text(temp);
      $("#dianzan_error").show(500);
    $("#dianzan_error").hide(2000);
    }else{
       $("#dianzan_error2").show(500);
    $("#dianzan_error2").hide(2000);
    }

    });
  }

function dianzan2(which){

  var dianzannum2=$(which).prev().text();
  var answerid = $(which).attr('dashuaibi');
    $.post("http://localhost/index.php/home/question/dianzan2",
    {
     'answerid': Number(answerid),
    },
    function(data,status){
      index=data;
       if(index==1){
        temp=Number(dianzannum2)+1;
      $(which).prev().text(temp);
    }
    else if(index==2){
      temp=Number(dianzannum2)-1;
      $(which).prev().text(temp);
    }else{
        alert("请登录");
    }

    });
  }



  function shoucang(){
var shoucangnum=$('#shoucangnum').text();
  var questionid=$('#hidden_name').val();
    $.post("http://localhost/index.php/home/question/shoucang",
    {
     'questionid': Number(questionid),
    },
    function(data,status){
      index=data;
       if(index==1){
         temp=Number(shoucangnum)+1;
      $('#shoucangnum').text(temp);
    }
    else if(index==2){
      temp=Number(shoucangnum)-1;
      $('#shoucangnum').text(temp);
      $("#shoucang_error").show(500);
    $("#shoucang_error").hide(2000);
    }else{
       $("#dianzan_error2").show(500);
    $("#dianzan_error2").hide(2000);
    }

    });


  }
