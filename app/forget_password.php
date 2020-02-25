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
        <title>iGEN HR & Payroll System</title>
        <link type="text/css" rel="stylesheet" href="css/main.css" />
        <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="js/function.js"></script>
        <script type="text/javascript">
         
            function forgotPwd(){
                var username =$("#username").val();
                var selection = $("input[name='opt']:checked").val();
                if(username==""||username=="username"){
                    alert("Please insert your username")
                }else{		
                    if(selection==1){
                        $.ajax({
                            url:'?widget=forget_password',
                            type:"POST",
                            data:{
                                username:username
                            },
                            success:function(data){	
 						 
                                if(data==1){
                                    alert("Password was reset.");
                                    window.location="?loc=login";
                                }else{
                                    alert("Username is incorrected");
                                }
                            }	
                        });				
                    }else if(selection==2){
                        alert("requesting, Please wait...");
                        $.ajax({
                            url:'?widget=forget_password1',
                            type:"POST",
                            data:{
                                username:username
                            },
                            success:function(data){
                                alert(data)
                            }	
                        });	
                    }else{
                        alert("Invalid Input");
                    }
                }
            }
        </script>
    </head>
    <body>
        <form autocomplete="off">
            <div id="login_div">
                <div class="form_content_login" style="margin-left: auto; margin-right: auto;">
                    <table style="width: 100%;">
                        <tr><td style="padding-top: 250px; text-align: center; font-size: 14px; color: #e6e4e4;">Please enter your Email to retrieve password.</td></tr>
                        <tr>
                            <td style="padding-top: 30px; text-align: center;"><input type="text" class="input_text" id="username" class="textfield" style="width: 180px; height: 27px; background-color: #fff; color: lightgray;" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" value="Email"/></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 30px; text-align: center; color:#fff">
                                &nbsp &nbsp &nbsp <input type="radio" value="1" name="opt" />Reset your Password according to I.C.<br/>
                                <input type="radio" value="2" name="opt" />Password will be sent to your Email.<br/>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px; text-align: center; color: white;"><a class="cursor_pointer" onclick="forgotPwd()">Get Password</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="cursor_pointer" onclick="window.location='?loc=login'">Back</a></td>
                        </tr>
                        <tr>
                            <td id="login_error" style="padding-top: 20px; text-align: center; color: white;"></td>
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