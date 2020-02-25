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
        <title>Upload Company Logo</title>
        <!--upload function start-->
       <!-- <script type="text/javascript" src="js/uploadify/jquery-1.4.2.min.js"></script>
		
        <script type="text/javascript" src="js/uploadify/swfobject.js"></script>
        
        <link href="js/uploadify/uploadify.css" rel="stylesheet" type="text/css" />-->

		<!--<script type="text/javascript" src="js/uploadify/jquery-1.4.2.min.js"></script>-->
		

        <?php
        $id = $_GET["company_id"];
        if (isset($_GET["action"]) == true && $_GET["action"] == "edit") {
            $loc = 'close()';
        } else {
            $loc = 'opener.location="?loc=company",close()';
        }
        ?>
      <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	  <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript">

            $(function() {
				$("#upload").click(function(){
							var company_id="<?php echo $id ?>";
							var action ="add";
							var files = $('#fileInput')[0].files[0];
							var uploaded_img = $('#fileInput').val();
							var found = uploaded_img.lastIndexOf('.') + 1;
							//alert(files + ":"+found +": "+uploaded_img);
							  var formData = new FormData();
							  formData.append("company_id",company_id);
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
								url:'?widget=addlogo',
								data: formData,
								processData: false,
								contentType: false,
								success:function(data){
									if(data==true){
										
										alert('Company Logo Uploaded');
										opener.location='?loc=company';
										close();
									}else{
										alert('Error While Processing');

									}
                            }
                        })
				})
				/*alert(1)
                $('#file_upload').uploadify({
                    'width'    : 350,
                    'uploader'  : 'js/uploadify/uploadify.swf',
                    'script'    : 'js/uploadify/uploadify.php',
                    'cancelImg' : 'js/uploadify/cancel.png',
                    'folder'    : 'images/logoPic',
                    'fileExt'     : '*.jpg;*.gif;*.png',
                    'fileDesc'    : 'Image Files',
                    'scriptData'  : {'pid': '<?php echo $id . "_"; ?>'},
                    'multi'          :false,
                    'onSelectOnce'   : function(event,data) {
                        $('#status-message').text(data.filesSelected + ' files have been added to the queue.');
                    },

                    'onAllComplete'  : function(event, data) {
                        $('#status-message').text(data.filesUploaded + ' files uploaded, ' + data.errors + ' errors.');
                    },

                    'onComplete': function(event, queueID, fileObj, reponse, data)
                    {
                      alert(2)
                        var company_id="<?php echo $id ?>";
                        var fileName = company_id + "_" + fileObj.name;
                        $.ajax({
                            type:'POST',
                            url:'?widget=addlogo',
                            data:{
                                action:"add",
                                fileName:fileName,   //get the uploaded file name and pass it to addfile.php
                                company_id:company_id
                            },

                            success:function(data){

                                if(data==true){
                                    alert('Company Logo Uploaded');
                                    opener.location='?loc=company';
                                    close();
                                }else{
                                    alert('Error While Processing');

                                }
                            }
                        })
                    }
                });*/
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
    <body onunload="<?php echo $loc; ?>">
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
                        <!--upload function end-->
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