
    
            <div style="padding-left:20px;padding-top:10px;">
                <table style="width:100%">
                    <tr>
                        <td style="padding-left:20px;width:15%;height:280px; vertical-align: top; padding-top: 20px;">
                            <!-- profile picture-->
                            <table>
                                <tr style="height:255px;">
                                    <td>
                                        <?php
                                         if (substr($row['image_src'], 0, 5) != 'image') { 
										
                                     echo '<img id="profileIMG" onmouseover="uploadImage()" onmouseout="noUploadImage()"  style="width:200px;height:236px;" src="images/profilePic/Gra_ProfilePhoto.png" />
                                            </td>
                                        </tr>
                                        <tr style="height:20px;">
                                            <td style="color: white;">
                                                <a id="uploadImage" onmouseover="uploadImage()" onmouseout="noUploadImage()" style="background-color:#007DC5; display:none;position: relative;top: -20px;cursor:pointer;z-index: 10;text-align: center;"  onclick="uploadPic(' . $row['id'] . ')" >Upload a new photo</a>
                                            </td>
                                        </tr>';
                            } else {
							 
                                echo '<img id="profileIMG" onmouseover="uploadImage()" onmouseout="noUploadImage()"  style="width:200px;height:236px" src="' . $row["image_src"] . '" />
                                            </td>
                                        </tr>
                                        <tr style="height:20px;">
                                            <td style="color: white;">
                                                <a id="uploadImage" onmouseover="uploadImage()" onmouseout="noUploadImage()" style="background-color:#007DC5; display:none;position: relative;top: -20px;cursor:pointer;z-index: 10;text-align: center;"  onclick="deletePic(\'' . $row['image_src'] . '\',' . $row['id'] . ')">Change photo</a>
                                            </td>';
											if($img!=null){
											echo '<td style="padding-top:-10px; background:red"><img title="you have changed your picture and is waiting for HR approval" src="images/pencil.png" style="width:15px;height:15px;"/></td>';
											}
                                       echo'</tr>';
                            }
                                        ?> 
										
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="padding-left: 20px;vertical-align: top;width:85%; ">
                            <div id="topDetails">
                                <div style="padding-top:20px">
                                    <table class="titleBarTo" style="width:98%; padding-right: 5px;">
                                        <tr>
                                            <td style="font-size:large;font-weight: bold;">
                                                &nbsp;&nbsp;&nbsp;Employee Details
                                            </td>
                                            <!--<td onclick="editProfile()" id="editBut" style="width: 80px;">Edit</td>-->
                                            <td onclick="chgPW()" id="editBut" style="width: 140px;"><i class="fas fa-lock"></i> Change Password</td>
                                        </tr>
                                    </table>
                                </div>
                                <?php
                                $idGet = $_COOKIE['igen_user_id'];
                                $new_id = 'EMP' . str_pad($idGet, 6, "0", STR_PAD_LEFT);
                                ?>
                                <table style="padding-top:20px;padding-left:20px;">
                                    <tr>
                                        <td style="padding-top:5px;width:200px;">Employee ID</td>
                                        <td style="padding-top:5px"><?php print $new_id; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top:5px;width:200px;">Full Name</td>
                                        <td style="padding-top:5px"><?php print $row['full_name']; ?></td>
                                    </tr>
									<tr>
                                      <td style="padding-top:5px;width:200px;">Nationality</td>
                                     <td style="padding-top:5px;color:<?php print $fontColorc ?>;"><?php print $row['country']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top:5px;width:200px;">Company</td>
                                        <td style="padding-top:5px"><?php print $rowCompany['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top:5px;width:200px;">Division</td>
                                        <td style="padding-top:5px"><?php print $rowBranch['branch_code']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top:5px;width:200px;">Department</td>
                                        <td style="padding-top:5px"><?php print $rowDept['dep_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top:5px;width:200px;">Section/Unit</td>
                                        <td style="padding-top:5px"><?php print $rowGroup['group_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top:5px;width:200px;">Position</td>
                                        <td style="padding-top:5px"><?php print $rowPos['position_name']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
			
		
			
<div id="passwordPop" style="display:none;">
    <table style="width:400px;padding-top:20px;">
        <tr>
            <td colspan="2" style="padding-bottom: 10px;">
                <input type="button" class="button" style="width: 70px;" value="Save" onclick="checkPW(<?php echo $getID ?>)"/>
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
<?php
$sqlGetPassword = mysql_query('SELECT pwd FROM employee WHERE id = ' . $getID);
$rowGetPassword = mysql_fetch_array($sqlGetPassword);

echo '<input type="hidden" id="hiddenField" value="' . $rowGetPassword['pwd'] . '"/>';
?>
<script type="text/javascript">
function uploadImage(){
        $('#uploadImage').css({"display":"block"});
        $("#profileIMG").css({ // this is just for style
            "opacity": "3"
        });
    }
	
	  function deletePic(loc,id){
	 
        var result = confirm('Are you sure you want to change your profile picture?');
        if(result){
           // mywindow = window.open('?widget=editprofileupload&employee='+id,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
        }
        uploadPic(id);
    }
    
    function noUploadImage(){
        $('#uploadImage').css({"display":"none"});
        $("#profileIMG").css({ // this is just for style
            "opacity": "3"
        });
    }
	 function uploadPic(id) {

        mywindow = window.open('?widget=editprofileupload&employee='+id,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
    }
	function chgPW(){
        var o = document.getElementById("passwordPop");
        o.style.display="block";
    }
    function checkPW(id){

        var pw0 = $('#pw0').val();
        var pw1 = $('#pw1').val();
        var pw2 = $('#pw2').val();
		pw0 = CryptoJS.MD5(pw0).toString();
		
        var pw9 = $('#hiddenField').val();
		
        if((pw0 == "" || pw0 == " ") || (pw0 != pw9)){
            alert("Wrong Current Password");
        }else{
            if((pw1 == "" || pw1 == " " || pw2 == "" || pw2 == " ") || (pw1 != pw2)){
                alert("New Password Does Not Match");
            }else{
                $.ajax({
                    type:'POST',
                    url:'?ewidget=changePassword',
                    data:{
                        id:id,
                        pw1:pw1
                    },
                    success:function(data){
					
                        if(data==true){
                            alert('Password Changed');
                            window.location = '?eloc=emp_view_profile';
                        }
                        else{
                            alert('Error While Processing');
                        }
                    }
                })
            }
        }
    }
    
    function cancelPW(){
        var o = document.getElementById("passwordPop");
        o.style.display="none";
    }
    
	</script>