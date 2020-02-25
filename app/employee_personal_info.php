
 <div id="viewProfileTabs">
                <table>
                    <tr><?php if ($_GET['type'] != 'salary') {
                                
                            } ?>
                        <td id="personal" onclick="personal()" <?php if (isset($_GET['t']) == false) { ?> style="color:orchid" <?php } ?> >PERSONAL INFORMATION</td>
                        <td id="salary" onclick="salary()">SALARY</td>
                        <td id="ttable" onclick="tt()"><!--TIME TABLE --></td> 
                        <td id="record" onclick="record()"><!--RECORD --></td>
                    </tr>
                </table>
            </div> 
 
            <!--Personal Information-->
            <div class="viewProfileInfo">
                <?php if (isset($_GET['t']) == false) { ?>
                    <div id="pi" style="padding-top:20px;">
                        <?php
                    } else {
                        echo '<div id="pi" style="padding-top:20px;display: none">';
                    }
                    ?>
				
                    <div id="editModePI" >
                        <table class="titleBart">
                            <tr>
                                <td style="font-size:large;font-weight: bold;">
                                    &nbsp;&nbsp;&nbsp;Personal Information
                                </td>
								<!--<td onclick="editProfile()" id="editBut" style="width: 80px;">Edit</td>-->
                            </tr>
                        </table>
						
                         <table>
							 
                               <p class="personal-information"> Personal Detail</p>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Username</td>
                                    <td style="padding-top:5px;"><?php print $row['username']; ?></td>
                                </tr>
                                <tr style="display: none;">
                                    <td style="padding-top:5px;width:200px;">Profile</td>
                                    <td style="padding-top:5px"><?php print $row['profile']; ?></td>
                                </tr>
                               
								
				<?php  
	
				
				if($row['country']=="Malaysia"){
				?>
                 <tr>
                                    <td style="padding-top:5px;width:200px;">IC</td>
                                    <td style="padding-top:5px"><?php print $row['ic']; ?></td>
                  </tr>
				
				<?php
				}else{
				?>
				<tr>
                    <td style="padding-top:5px;width:200px;">Passport Number</td>
                    <td style="padding-top:5px;color:<?php print $fontColorIc ?>;"><?php print $row['passport']; ?></td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Passport Expiry</td>
                    <td style="padding-top:5px;color:<?php print $fontColorpe ?>;"><?php print date("d-m-Y", strtotime($row['passport_expiry'])); ?></td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Work Permit</td>
                    <td style="padding-top:5px;color:<?php print $fontColorwp ?>;"><?php print $row['work_permit']; ?></td>
                </tr>
			
				<?php
				
				}
				?>
				
				    <tr>
                                    <td style="padding-top:5px;width:200px;">Date of Birth</td>
                                    <td style="padding-top:5px">
                                        <?php
                                        $dateOfDay = date("Y-m-d");
                                        $dateOfBirth = $row['dob'];

                                        $yearOfDay = substr($dateOfDay, 0, 4);
                                        $yearOfBirth = substr($dateOfBirth, 0, 4);
                                        $age = $yearOfDay - $yearOfBirth;
                                        $realAge = abs($age);

                                       // if ($realAge >= 55) {
                                            echo date("d-m-Y",strtotime($row['dob'])) . ' ('.$realAge.')';
                                       // } else {
                                       //     echo date("d-m-Y",strtotime($row['dob'])) . ' (under 55)';
                                       // }
                                        ?>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Contact Number (Home)</td>
                                    <td style="padding-top:5px">
                                        <?php
                                        if ($row['phone'] != "") {
                                            print $row['phone'];
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Contact Number (Mobile)</td>
                                    <td style="padding-top:5px"><?php print $row['mobile']; ?></td>
                                </tr>
								
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Email</td>
                                    <td style="padding-top:5px"><?php print $row['email']; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Address</td>
                                    <td style="padding-top:5px">
                                        <?php
                                        if ($row['address'] != "") {
                                            print $row['address'];
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Gender</td>
                                    <td style="padding-top:5px">
                                        <?php
                                        if ($row['gender'] == 'F') {
                                            echo 'Female';
                                        } else if ($row['gender'] == 'M') {
                                            echo 'Male';
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px">Race</td>
                                    <td style="padding-top:5px;"><?php echo $row['race'] ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px">Religion</td>
                                    <td style="padding-top:5px;"><?php echo $row['religion'] ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px">Marital Status</td>
                                    <td style="padding-top:5px;">
                                        <?php
                                        if ($row['marital'] == 'M') {
                                            echo 'Married';
                                        } else if ($row['marital'] == 'D') {
                                            echo 'Divorced';
                                        } else if ($row['marital'] == 'S') {
                                            echo 'Single';
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
								<tr>
								    <td style="padding-top:5px;width:200px">Spouse Name</td>
                                    <td style="padding-top:5px;">
								    <?php
                                        if ($row['spouse_name'] !="") {
                                            echo $row['spouse_name'];
                                      
                                        }else{
											echo"-";
										}
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Spouse Working</td>
                                    <td style="padding-top:5px;">
                                        <?php
                                        if ($row['spouse_work'] == 'N') {
                                            echo 'No';
                                        } else if ($row['spouse_work'] == 'Y') {
                                            echo 'Yes';
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
								 <tr>
                                    <td style="padding-top:5px;width:200px;">Spouse Company</td>
                                    <td style="padding-top:5px;">
                                        <?php
                                        if ($row['spouse_work'] == 'Y') {
                                            echo $row['spouse_company'];
                                        }else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Number of Children</td>
                                    <td style="padding-top:5px">
                                        <?php
                                        if ($row['num_of_kids'] == 0) {
                                            echo "-";
                                        } else {
                                            print $row['num_of_kids'];
                                        }
                                        ?>
                                    </td>
                                </tr>
                               
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Join Date</td>
                                    <td style="padding-top:5px"><?php print date("d-m-Y",strtotime($row['join_date'])); ?></td>
                                </tr>
								 <tr>
									<td style="padding-top:5px;width:200px">Confirm Date</td>
									<td style="padding-top:5px;color:<?php// print $fontColorResign ?>;"><?php
										if ($row['confirm_date']  != "0000-00-00" && $row['confirm_date'] != "") {
											print date("d-m-Y", strtotime($row['confirm_date']));
										} else {
											print "-";
										}
										?>
									</td>
								</tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px">Resign Date</td>
                                    <td style="padding-top:5px;"><?php
                                    if ($row['resign_date'] != "0000-00-00" && $row['resign_date'] != "") {
                                        print date("d-m-Y",strtotime($row['resign_date']));
                                    } else {
                                        print "-";
                                    }
                                        ?></td> 
                                </tr>
								
								</table>  	
                            <table>
							 
                              <p class="personal-information">Next of kin</p>
								<tr>
                                    <td style="padding-top:5px;width:200px;">Emergency Contact Person</td>
                                    <td style="padding-top:5px"><?php print $row['contact_person']; ?></td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:200px;">Emergency Contact Number</td>
                                    <td style="padding-top:5px"><?php print $row['emergency']; ?></td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:200px;">Relationship</td>
                                    <td style="padding-top:5px"><?php print $row['emergency_relationship']; ?></td>
                                </tr>
                                <tr style="display: none;">
                                    <td style="padding-top:6px;width:200px">Extra Information/Note</td>
                                    <td style="padding-top:6px;"><?php print $row['notes']; ?></td>
                                </tr>
                                <tr style="display: none;">
                                    <td style="padding-top:6px;width:200px">Extra Information/Note</td>
                                    <td style="padding-top:6px;"><?php print $row['notes']; ?></td>
                                </tr>
                                <?php
                                $sql1 = 'SELECT field_name, field_value FROM employee_info WHERE emp_id=' . $getID;
                                $query1 = mysql_query($sql1);
                                while ($row1 = mysql_fetch_array($query1)) {
                                    echo '<tr><td style="padding-top:5px;width:200px;">' . $row1["field_name"] . '</td><td style="padding-top:5px;">' . $row1["field_value"] . '</td></tr>';
                                }
                                ?>
                            </table>
						 <table> 
							  <p class="personal-information">Resign Details</p>
							  
								<tr>
									<td style="padding-top:5px;width:200px">Resign Date</td>
									<td style="padding-top:5px;color:<?php //print $fontColorResign ?>;"><?php
										if ($resign != "0000-00-00" && $resign != "") {
										 
											print date("d-m-Y", strtotime($resign));
										} else {
										 
											print "-";
										}
										?></td>
								</tr>
								
							   
								
											<tr>
									<td style="padding-top:5px;width:200px">Last Working Day</td>
									<td style="padding-top:5px;color:<?php print $fontColorlastn ?>;"><?php
										if ($rowGetOld['last_working_day']!= "0000-00-00" && $rowGetOld['last_working_day'] != "") {
											print date("d-m-Y", strtotime($rowGetOld['last_working_day']));
										} else {
											print "-";
										}
										?></td>
								</tr>
									<tr>
									<td style="padding-top:5px;width:200px">Last Official Day</td>
									<td style="padding-top:5px;color:<?php print $fontColoroff ?>;"><?php
										if ($rowGetOld['officail_working_day'] != "0000-00-00" && $rowGetOld['officail_working_day']!= "") {
											print date("d-m-Y", strtotime($rowGetOld['officail_working_day']));
										} else {
											print "-";
										}
										?></td>
								</tr>
								<tr>
									<td style="padding-top:5px;width:200px">Reason For Resign</td>
									<td style="padding-top:5px;color:<?php print $fontColorReason ?>;"><?php
										if ($rowGetOld['reasign_reason'] != " " && $rowGetOld['reasign_reason'] != "") {
											print $rowGetOld['reasign_reason'];
										} else {
											print "-";
										}
										?></td>
								</tr>
				</table>
                    
                    </div>
					
					<div id="inc_e1" style="display:none">
					
					<table class="titleBart">
                            <tr>
                                <td style="font-size:large;font-weight: bold;">
                                    &nbsp;&nbsp;&nbsp;Personal Information
                                </td>
								<td onclick="save(<?php echo $getID ?>)" id="editBut" style="width: 80px;">Save</td>
								<td onclick="cancelPersonalInfo()" id="editBut" style="width: 80px;">Cancel</td>
                            </tr>
                        </table>
                      
					<?php
					 if($numRow>0){
						include("e_edit_emp_profile_inc1.php");
					 }
					?>
					
					
					</div>
					<div id="inc_e" style="display:none">
					<table class="titleBart">
                            <tr>
                                <td style="font-size:large;font-weight: bold;">
                                    &nbsp;&nbsp;&nbsp;Personal Information
                                </td>
								<td onclick="save(<?php echo $getID ?>)" id="editBut" style="width: 80px;">Save</td>
								<td onclick="cancelPersonalInfo()" id="editBut" style="width: 80px;">Cancel</td>
                            </tr>
                        </table>
					<?php
					if($numRow<1){
						include("e_edit_emp_profile_inc.php");
					}
					?>
					
					</div>
					
					
                </div>
				
			
                <?php if ($_GET['t'] != 's') { ?>
				 
                    <div id="sal" style="display:none; padding-top:20px;">
					   <div style="margin-bottom:4%">
                        <?php
                    } else {
                        echo '<div id="sal" style="padding-top:20px;">';
                    }
                    ?>
					
                    <div id="editModeSAL">
					
                        <table id="titleBar" class="titleBarTo">
                            <tr>
                                <td style="font-size:large;font-weight: bold;">
                                    &nbsp;&nbsp;&nbsp;Salary
                                </td>
                            </tr>
                        </table>
                        <div style="overflow:auto;width:94%;padding-top:20px;padding-left:20px;">
                            <table>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Under Contract</td>
                                    <td style="padding-top:5px;">
                                        <?php
                                        if ($row['is_contract'] == 'N') {
                                            echo 'No';
                                        } else if ($row['is_contract'] == 'Y') {
                                            echo 'Yes';
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Salary Type</td>
                                    <td style="padding-top:5px">  
                                        <?php
                                        if ($row['salary_type'] == "bs") {
                                            echo "Basic Salary";
                                        } elseif ($row['salary_type'] == "mn") {
                                            echo "Monthly";
                                        } elseif ($row['salary_type'] == "wk") {
                                            echo "Weekly";
                                        } elseif ($row['salary_type'] == "dy") {
                                            echo "Daily";
                                        } elseif ($row['salary_type'] == "hr") {
                                            echo "Hourly";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Salary Amount</td>
                                    <td style="padding-top:5px"><input type="hidden" id="textsalary" /><?php print $row['salary']; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Bank Type</td>
                                    <td style="padding-top:5px;">
                                        <?php
                                        if ($rowJoin['bank_acc_id'] != 0) {
                                            echo $rowJoin['name'];
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:6px;width:200px">Bank Account Number</td>
                                    <td style="padding-top:6px;">
                                        <?php
                                        if ($row['bank_acc_num'] != "") {
                                            print $row['bank_acc_num'];
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">EPF Number</td>
                                    <td style="padding-top:5px">
                                        <?php
                                        if ($row['epf_num'] != "") {
                                            print $row['epf_num'];
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Socso Number</td>
                                    <td style="padding-top:5px">
                                        <?php
                                        if ($row['socso_num'] != "") {
                                            print $row['socso_num'];
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Income Tax Number</td>
                                    <td style="padding-top:5px">
                                        <?php
                                        if ($row['income_tax_num'] != "") {
                                            print $row['income_tax_num'];
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">Zakat</td>
                                    <td style="padding-top:5px;color:<?php echo $fontColorZakat ?>">
                                        <?php
                                        if ($row["zakat"] == "" || $row["zakat"] == 0) {
                                            echo "-";
                                        } else {
                                            print $row['zakat'];
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:6px;">Salary History</td>
                                    <td style="padding-top:6px;"><a class="blue" onclick="salaryhistory()">View</a></td>
                                </tr>
                                <tr>
                                    <td style="padding-top:6px;">Payslip History</td>
                                    <td style="padding-top:6px;"><a class="blue" onclick="paysliphistory()">View</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
					</div>
                </div>
				</div>
				</span>
				<input type="hidden" id="em_id" value="<?php echo $getID   ?>">
	<script>
		    function editProfile(){
					
						var id =$("#em_id").val();
						$.ajax({
                type:'GET',
                url:"?widget=e_edit_emp_profile",
                data:{
				  id:id
                   
                },
                success:function(data){
				
				
				if(data==1){
				 $("#editModePI").hide();
				 $("#inc_e1").fadeIn(3000);
				 $("#inc_e").hide();
				 $(".viewProfileInfo #pi").addClass("profile-edit");
				 
				   }else if(data==2){
				    $("#editModePI").hide();
				 $("#inc_e1").hide()
				 $("#inc_e").fadeIn(3000);;
				   
				   }
				  
                }
            });
			}
		function cancelPersonalInfo(){
			window.location.reload();
		}				
    function save(id){
	    var mailAdd="";
        var name = $('#fullNameText').val();
        var ic1 = $('#ICText1').val();
        var ic2 = $('#ICText2').val();
        var ic3 = $('#ICText3').val();
        var ic = ic1 + "-" + ic2 + "-" +ic3;
        var phone = $('#phoneText').val();
        var mobile = $('#mobileText').val();
        var emailAdd = $('#emailAddText').val();
		if($('#mailAddText').val()==""){
        mailAdd= $('#me').val();
		}else{
		 mailAdd= $('#mailAddText').val();
		
		}
		
        var note = $('#noteText').val();

        var z = document.getElementById("dropGender");
        var gender = z.options[z.selectedIndex].value;
        var z = document.getElementById("dropRace");
        var race = z.options[z.selectedIndex].value;
        var z = document.getElementById("dropReligion");
        var religion = z.options[z.selectedIndex].value;
		
        var z = document.getElementById("dropMarital");
        var marital = z.options[z.selectedIndex].value;
        var z = document.getElementById("dropSpouse");
        var spouse = z.options[z.selectedIndex].value;
        var dob = $('#dobText').val();
        var child = $('#numChildText').val();
        
        var joinDate = $('#joinDateText').val();
        var resignDate = $('#resignDateText').val();
		resignDate="0000-00-00";
		
        var profile= $('#profileText').val(); 
        var username=$('#usernameText').val();
       var ecp =$("#ecp").val();
	   var ecn =$("#ecn").val();
	   var ecr =$("#emr").val();
	   
        var zakat = $('#zakatText').val();
        var epf = $('#epfText').val();
        var socso = $('#socsoText').val();
        var iTax = $('#iTaxText').val();
        var z = document.getElementById("dropBank");
        var bank = z.options[z.selectedIndex].value;
        var bankAccNum = $('.bankAccNumText').val();
        var contract = $('#contractText').val();
        var salaryAmt = $('#salaryAmtText').val();
        var salaryType = $('#salaryTypeText').val();
		var country=$("#country").val();
		
		if(country!="Malaysia"){
		
		ic="";
		}
		var pn, pe, wp;
		
		if(ic==""){ 
		 pn=$("#pass").val();
		pe=$("#pe").val();
		wp=$("#wp").val();
		
		}else{
		pn="";
		pe="";
		wp="";
		
		}
      
        var error1 = [];
        var error2 = [];
        var error3 = [];
        
        if(name == '' || name == ' '){
            error1.push("Full Name");
        }
		   if(ic!=""){
        if(ic1 == '' || ic1 == ' ' || ic2 == '' || ic2 == ' ' || ic3 == '' || ic3 == ' ' || ic1.length < 6 || ic2.length < 2 || ic3.length < 4){
            error1.push("I.C Number");
        }else{
            if(ic1.match(/^\d+$/) && ic2.match(/^\d+$/) && ic3.match(/^\d+$/)){
            }else{
                error2.push("I.C Number");
            }
        }
		}
        if(mobile == '' || mobile == ' '){
            error1.push("Mobile Number");
        }
        if(emailAdd == '' || emailAdd == ' '){
            error1.push("Email Address");
        }
        if(gender == '0'){
            error3.push("Gender");
        }
        if(race == '0'){
            error3.push("Race");
        }
        if(religion == '0'){
		
            error3.push("Religion");
        }
        if(marital == '0'){
            error3.push("Marital Status");
        }
        if(spouse == '0' && marital == "M"){
            error3.push("Spouse Working");
        }
        if((child == "" || child == " ") && (marital == "M" || marital == "D")){
            error1.push("Number of Children");
        }else{
            if(child == "" || child == " "){
                child = 0;
            }else{
                if(child.match(/^\d+$/)){
                }else{
                    error2.push("Number of Children");
                }
            }
        }
        if(dob == '' || dob == ' '){
            error1.push("Date of Birth");
        }
        if(joinDate == '' || joinDate == ' '){
            error1.push("Join Date");
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error2.length > 0 || error3.length > 0){
            alert(data1 + data2 + data3);
        }else{
	
            $.ajax({
                type:'POST',
                url:'?ewidget=employeeedit',
                data:{
                    id:id,
                    name:name,
                    ic:ic,
                    phone:phone,
                    mobile:mobile,
                    emailAdd:emailAdd,
                    mailAdd:mailAdd,
                    gender:gender,
                    race:race,
                    religion:religion,
                    marital:marital,
                    spouse:spouse,
                    dob:dob,
                    child:child,
					username:username,
                    joinDate:joinDate,
                    resignDate:resignDate,
                    profile:profile,
                    zakat:zakat,
                    iTax:iTax,
                    socso:socso,
                    epf:epf,
                    bankAccNum:bankAccNum,
                    bank:bank,
                    contract:contract,
                    salaryAmt:salaryAmt,
                    salaryType:salaryType,
					pn:pn,
					wp:wp,
					pe:pe,
					ecp:ecp,
					ecn:ecn,
					ecr:ecr,
					country:country
                },

                success:function(data){	
                    if(data!=false){
                        alert("Profile Updated");
						
                        window.location='?eloc=emp_view_profile&viewId='+id;
                    }
                    else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
    
					
					</script>
					
					
	