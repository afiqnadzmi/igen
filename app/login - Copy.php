<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>HR & Payroll System</title>
        <link type="text/css" rel="stylesheet" href="css/main.css" />
        <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="js/function.js"></script>
        <script type="text/javascript">
            function login(){
                $("#loginBtn").attr("disabled", "disabled");
                $("#clearBtn").attr("disabled", "disabled");
                var username=$('#username').val(),password=$('#password').val();
				
                $.ajax({
                    url:'?widget=loginAction',
                    data:{
                        username:username,
                        password:password
                    },
                    success:function(data){
				  
                        if(data=="admin_true"){
                           window.location='?loc=dashboard';
                        }else if(data=="dash_show"){
                            window.location='?loc=dashboard';
                        }else if(data=="dash_hide"){
						   window.location='?eloc=emp_view_profile';
                        }else if(data==""){ 
                            $("#loginBtn").removeAttr("disabled");
                            $("#clearBtn").removeAttr("disabled");
                            $("#login_error").stop(true,true);
                            $("#login_error").fadeIn(300);
                            $("#login_error").html('<span class="i_warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="vertical-align:middle;">Wrong Username And Password. Please Try Again.</span>');
                            $("#login_error").fadeOut(10000);
                        }else{
						$("#user").val(data);
						chgPW();
						}
                    }
                })
            }
            
            function forgotPwd(){
                var username =$("#username").val();
                if(username==""||username=="username"){
                    alert("Please Insert Username")
                }else{
                    var selection = prompt("Selection:(1/2)\n1.Reset your password to I.C. number.\n2.Password will be send to your Email");
                    if(selection==1){
                        $.ajax({
                            url:'?widget=forget_password',
                            type:"POST",
                            data:{
                                username:username
                            },
                            success:function(data){		
                                if(data==1){
                                    alert("Password Reset");
                                }else{
                                    alert("Incorrected Username");
                                }
                            }
						
                        });			
                    }else if(selection==2){
                        alert("Requesting, Please wait...");
                        $.ajax({
                            url:'?widget=forget_password1',
                            type:"POST",
                            data:{
                                username:username
                            },
                            success:function(data){
                                if(data==1){
                                    alert("Password was send to your email.");
                                }else{
                                    alert("Username is incorrect");
                                }
                            }	
                        }); 
					
                    }else{
                        alert("Invalid Input");
                    }
                }
            }
	function chgPW(){
	
        var o = document.getElementById("passwordPop");
        o.style.display="block";
    }
	 function cancelPW(){
        var o = document.getElementById("passwordPop");
        o.style.display="none";
    }
	function checkPW(){
	
       var user=$("#user").val();
        var pw0 = $('#pw0').val();
        var pw1 = $('#pw1').val();
        var pw2 = $('#pw2').val();
     
        if((pw0 == "" || pw0 == " " || pw0!="123456")){
            alert("Wrong Current Password");
        }else{
            if((pw1 == "" || pw1 == " " || pw2 == "" || pw2 == " ") || (pw1 != pw2)){
                alert("New Password Does Not Match");
            }else{
                $.ajax({
                    type:'POST',
                    url:'?ewidget=changePassword1',
                    data:{
                        id:user,
                        pw1:pw1
                    },
                    success:function(data){
					      var mn=$.trim(data);
						 
                        if(mn=="admin_true"){
                           window.location='?loc=dashboard';
                        }else if(mn=="dash_show"){
                            window.location='?loc=dashboard';
                        }else if(mn=="dash_hide"){
						
                           window.location='?eloc=emp_view_profile';
                        }
						
						
                    }
                })
            }
        }
    }
        </script>
		<style type="text/css">
    
	
</style>
<style>
.unorganised{
 list-style:none;
 background:#333;
 margin-right:350px;
 width:300px;
 height:auto;
 margin-top:0px;
 padding:0px;
 color:#fff;
 

}
.hover{
background:#ccc;

cursor:pointer;

}
#suggest{
margin-left:30.5%;

}

</style>
<script type="text/javascript">
$("document").ready(function(){
$("#username").keyup(function(){

 $("#suggest").html("");
var input=$(this).val();

input=$.trim(input);

if(input){

$.ajax({

  url: 'autosuggest/suggest.php',
  data:"input=" +  input,
  success: function(data) {


    $("#suggest").html(data);
	$("#suggest ul li").mouseover(function(){
		$("#suggest ul li").removeClass("hover");
	  $(this).addClass("hover");
	
	})
	$("#suggest ul li").click(function(){
	 var value= $(this).html();
	$("#username").val( value);
	$("#suggest ul").remove();
	})
  }
});
}

})

})
</script>
    </head>
    <body>
	<input type="hidden" id="user" value="">
	<div id="passwordPop" style="display:none;">
    <table style="width:400px;padding-top:20px;">
        <tr>
            <td colspan="2" style="padding-bottom: 10px;">
                <input type="button" class="button" style="width: 70px;" value="Save" onclick="checkPW()"/>
                <input type="button" class="button" style="width: 70px;" value="Cancel" onclick="cancelPW()"/>
            </td>
        </tr>
        <tr>
            <td>Current Password</td>
            <td><input type="password" id="pw0" /></td>
        </tr>
        <tr>
            <td>New Password</td>
            <td><input type="password" id="pw1" /></td>
        </tr>
        <tr>
            <td>Re-type New Password</td>
            <td><input type="password" id="pw2" /></td>
        </tr>
    </table>
</div>

        <form autocomplete="off">
            <div id="login_div">
                <div class="form_content_login" style="margin-left: auto; margin-right: auto;">
				<h1><br></h2>
                    <table style="width: 100%;">
					<tr><td style="padding-top: 170px; padding-bottom: 15px;text-align: center; font-size: 36px; color: #fff">
					<i> Baiduri@Work</i></td>
					</tr>
                        <tr><td style="padding-top: 0px; text-align: center; font-size: 16px; color: #FFF;"><i>Please enter your email and password below to sign in.</i></td></tr>
                        <tr>
                            <td style="padding-top: 30px;   text-align: center;"><input type="text" class="input_text" id="username" class="textfield" style="width: 300px; height: 27px; background-color: #fff; color: #000;" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="Email"/></td>
                        </tr>
						<tr>
						
						<td >
					
						</td>
						</tr>
                        <tr>
                            <td style="padding-top: 20px;   text-align: center;"><input type="password" class="input_text" id="password" class="textfield" style="width: 300px; height: 27px; background-color: #FFF; color: #000;" onkeypress="detect_enter(event,login)" value="password" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;"/></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px; text-align: center; color: #fff; margin-left: 300px; "><a class="cursor_pointer"   onclick="login()" style="font-weight: bold; color: #fff;">LOGIN</a>&nbsp&nbsp;|&nbsp&nbsp<a class="cursor_pointer" style="color: #fff;" onclick="window.location='?loc=forget_password'">Forgot Password?</a></td>
                        </tr>
                        <tr>
                            <td id="login_error" style="padding-top: 0px; text-align: center; color: white;"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </body>
</html>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
