<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php print '<?xml version="1.0" encoding="UTF-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Upload Profile Picture</title>
        <!--upload function start-->
      <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	  <script type="text/javascript" src="js/jquery-ui.js"></script>

        <?php
       
		if(isset($_GET["employeeID"])){
		 $id = $_GET["employeeID"];
		 
        $url = '?loc=view_profile_new&viewId=' . $id;
		$action="admin";
		
		}
		
		if(isset($_GET["employee"])){
		 $id = $_GET["employee"];
        $url = '?eloc=emp_view_profile';
		$action="emp";
		}
        ?>

        <script type="text/javascript">

            $(function() {
					$("#upload").click(function(){
							var empid="<?php echo $id ?>";
							var action ="<?php echo $action?>";
							var files = $('#fileInput')[0].files[0];
							var uploaded_img = $('#fileInput').val();
							 var found = uploaded_img.lastIndexOf('.') + 1;
							//alert(files + ":"+found +": "+uploaded_img);
							var formData = new FormData();
							formData.append("empid",empid);
							formData.append("action",action);
							formData.append("fileInput",files);
							var ext_arr = ['png','jpg','gif','PNG','JPG','GIV'];
							var ext =$('#fileInput').val().replace(/^.*\./, '');
							if(jQuery.inArray(ext, ext_arr)==-1 && uploaded_img!=""){
								alert("Please upload image only");
								exit;
							}
							$.ajax({
								type:'POST',
								url:'?widget=addimage',
							    data: formData,
								processData: false,
								contentType: false,
								success:function(data){
									 
									if(data==true){
										alert('Profile Picture Uploaded');
										window.location.reload();
									}else{
										alert('Error While Processing');

									}
							}
					  })
				})
            });
			
	
        </script>

        <style type="text/css">

            #custom-demo .uploadifyQueueItem {
                background-color: #FFFFFF;
                border: none;
                border-bottom: 1px solid #E5E5E5;
                font: 11px Verdana, Geneva, sans-serif;
                height: 50px;
                margin-top: 0;
                padding: 10px;
                width: 350px;
            }
            #custom-demo .uploadifyError {
                background-color: #FDE5DD !important;
                border: none !important;
                border-bottom: 1px solid #FBCBBC !important;
            }
            #custom-demo .uploadifyQueueItem .cancel {
                float: right;
            }
            #custom-demo .uploadifyQueue .completed {
                color: #C5C5C5;
            }
            #custom-demo .uploadifyProgress {
                background-color: #E5E5E5;
                margin-top: 10px;
                width: 100%;
            }
            #custom-demo .uploadifyProgressBar {
                background-color: #0099FF;
                height: 3px;
                width: 1px;
            }
            #custom-demo #custom-queue {
                border: 1px solid #E5E5E5;
                height: 213px;
                margin-bottom: 10px;
                width: 370px;
            }
            #uploadDoc a:hover{
                cursor: pointer;
            }
            #uploadDoc a{
                text-decoration: none;
            } 
        </style>
    </head>
    <body onunload="opener.location=('<?php echo $url ?>'),close()">
        <div align="center">
            <table id="popup_table" cellspacing="5" cellpadding="5" style="padding-bottom: 10px; ">
                <tr>
                    <td style="text-align: left;">
                        <div class="demo-box">
                            <div id="status-message" style="font-family:arial;font-weight: bold ">Select image file to upload:</div>
                            <div id="custom-queue" class="uploadifyQueue"></div>
                            <input type="file" name="file" id="fileInput" accept="image/*">
                            <p id="uploadDoc"><a href="#" id="upload">Upload Image</a></p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
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