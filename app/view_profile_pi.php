<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>

<?php
$userID = $_GET['viewId'];
include 'view_old_new.php';
$getID = $_GET['viewId'];
if (isset($_GET['t']) == true) { 
    ?>
    <div id="pi" style="display:none; padding-top:15px;"> 
        <?php
    } else {
        echo '<div id="pi" style="padding-top:15px;">'; 
    }
    ?>
    <div id="editModePI" >
	   <div id="editm">
        <table id="titlebar"  class="titleBarTo" style="width:98.5%;padding-right: 5px;">
            <tr>
                <td style="font-size:large;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;Personal Information
                </td>
                <?php if ($igen_a_hr == "a_hr_edit" || $user_id==$getID) { ?>
                    <td onclick="editPI(<?php echo $getID ?>)" id="editBut">Edit</td>  
                <?php } ?>
            </tr>
        </table>
        <div style="overflow:auto;width:94%;min-height: 500px;padding-top:20px;padding-left:20px;">
		<p class="personal-information"> Personal Detail</p>
            <table>
                <tr>
                    <td style="padding-top:5px;width:200px;">Username</td>
                    <td style="padding-top:5px;"><?php print $row['username']; ?></td>
                </tr>
                <tr style="display: none;">
                    <td style="padding-top:5px;width:200px;">Profile</td>
                    <td style="padding-top:5px;color:<?php print $fontColorProfile ?>;"><?php print $row['profile']; ?></td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">IC</td>
                    <td style="padding-top:5px;color:<?php print $fontColorIc ?>;">
					<?php 
						if($country =="Malaysia"){
							print $ic;
						}else{
							print "-";
						}
					?>
					</td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Passport Number</td>
                    <td style="padding-top:5px;color:<?php print $fontColorp ?>;">
					<?php 
						if ($passport=="" || $passport==" "){
							print "-";
						}else{
							print $passport; 
						}
					?>
					</td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Passport Expiry</td>
                    <td style="padding-top:5px;color:<?php print $fontColorpe ?>;">
						<?php 
						if ($passport_expiry=="0000-00-00" || $passport_expiry==""){
							print "-";
						}else{
							print 	date("d-m-Y", strtotime($passport_expiry)); 
						}
						?>
					</td> 
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Work Permit</td>
                    <td style="padding-top:5px;color:<?php print $fontColorwp ?>;">
					<?php 
						if($work_permit=="" || $work_permit==" "){
								print "-";
							}else{
								print $work_permit;
							} 
					?>
					</td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Work Permit Expiry</td>
                    <td style="padding-top:5px;color:<?php print $fontColorwp ?>;">
					<?php 
						if($work_permit_expiry=="0000-00-00" || $work_permit_expiry==""){
							echo"-";
						}else{
							echo date("d-m-Y", strtotime($work_permit_expiry));
						} 

					?>
					</td>
                </tr>
				 <tr>
                    <td style="padding-top:5px;width:200px;">Date of Birth</td>
                    <td style="padding-top:5px;color:<?php print $fontColorDob ?>;">
                        <?php
                        $dateOfDay = date("Y-m-d");
                        $dateOfBirth = $row['dob'];

                        $yearOfDay = substr($dateOfDay, 0, 4);
                        $yearOfBirth = substr($dateOfBirth, 0, 4);
                        $age = $yearOfDay - $yearOfBirth;
                        $realAge = abs($age);

                       // if ($realAge >= 55) {
                            echo date("d-m-Y", strtotime($dob)).' ('.$realAge.')' ;
                       // } else {
                        //    echo date("d-m-Y", strtotime($dob)) ;
                        //}
                        ?>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Contact Number (Home)</td>
                    <td style="padding-top:5px;color:<?php print $fontColorPhone ?>;">
                        <?php
                        if ($phone != "") {
                            print $phone;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr> 
                <tr>
                    <td style="padding-top:5px;width:200px;">Contact Number (Mobile)</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMobile ?>;"><?php print $mobile; ?></td>
                </tr>
				
                <tr>
                    <td style="padding-top:5px;width:200px;">Email</td>
                    <td style="padding-top:5px;color:<?php print $fontColorEmail ?>;"><?php print $email; ?></td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Address 1</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMail ?>;">
                        <?php
                        if ($address != "") {
                            print $address;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Address 2</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMail ?>;">
                        <?php
                        if ($address1 != "") {
                            print $address1;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Postal Code</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMail ?>;">
                        <?php
                        if ($postal_code != "") {
                            print $postal_code;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">City</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMail ?>;">
                        <?php
                        if ($city != "") {
                            print $city;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">State</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMail ?>;">
                        <?php
                        if ($state != "") {
                            print $state;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Country</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMail ?>;">
                        <?php
                        if ($country != "") {
                            print $country;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Gender</td>
                    <td style="padding-top:5px;color:<?php print $fontColorGender ?>;">
                        <?php
                        if ($gender == 'F') {
                            echo 'Female';
                        } elseif ($gender == 'M') {
                            echo 'Male';
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Race</td>
                    <td style="padding-top:5px;color:<?php print $fontColorRace ?>;"><?php echo $race ?></td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Religion</td>
                    <td style="padding-top:5px;color:<?php print $fontColorReligion ?>;"><?php echo $religion ?></td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Marital Status</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMarital ?>;">
                        <?php
                        if ($marital == 'M') {
                            echo 'Married';
                        } else if ($marital == 'D') {
                            echo 'Divorced';
                        } else if ($marital == 'S') {
                            echo 'Single';
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
	 
				<tr>
								    <?php
                                        if ($row['spouse_name'] !="") {
										?>
                                    <td style="padding-top:5px;width:200px">Spouse Name</td>
                                    <td style="padding-top:5px;">
                                       <?php
                                            echo $row['spouse_name'];
                                      
                                        }else{
										?>
										<td style="padding-top:5px;width:200px">Spouse Name</td>
                                    <td style="padding-top:5px;">
                                       <?php
                                            echo "-";
										
										}
                                        ?>
                                    </td>
                                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Spouse Working</td>
                    <td style="padding-top:5px;color:<?php print $fontColorSpouse ?>;">
                        <?php
                        if ($spouseWork == 'N') {
                            echo 'No';
                        } else if ($spouseWork == 'Y') {
                            echo 'Yes';
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Spouse Company</td>
                    <td style="padding-top:5px;color:<?php print $fontColorSpouse ?>;">
                        <?php
						echo $spouseCompany;
                        if ($spouseWork == 'Y' AND $spouseCompany !="") {
                             echo $spouseCompany;
                        }else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Number of Children</td>
                    <td style="padding-top:5px;color:<?php print $fontColorChild ?>;">
                        <?php
                        if ($child == "" || $child == 0) {
                            print "-";
                        } else {
                            print $child;
                        }
                        ?>
                    </td> 
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Join Date</td>
                    <td style="padding-top:5px;color:<?php print $fontColorJoin ?>;"><?php print date("d-m-Y", strtotime($join)); ?></td>
                </tr>
				 <tr>
                    <td style="padding-top:5px;width:200px">Confirm Date</td>
                    <td style="padding-top:5px;color:<?php// print $fontColorResign ?>;"><?php
                        if ($row['confirm_date']  != "0000-00-00" && $row['confirm_date'] != "") {
                            print date("d-m-Y", strtotime($row['confirm_date']));
                        } else {
                            print "-";
                        }
                        ?></td>
                </tr>
				  <?php
                $sqlGetLeave = mysql_query('SELECT e.group_for_leave_id, g.group_name FROM group_for_leave AS g INNER JOIN employee AS e ON g.id=e.group_for_leave_id WHERE e.id=' . $getID);
                $rowGetLeave = mysql_fetch_array($sqlGetLeave);
                ?>
                <tr>
                    <td style="padding-top:6px;width:200px">Leave Group</td>
                    <td style="padding-top:6px;">
                        <?php
                        if ($rowGetLeave['group_for_leave_id'] != 0) {
                            print $rowGetLeave['group_name'];
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
	 </table>
	 <table style="">
	 
	 <p class="personal-information">Emergency Contact Detail</p>
	             <tr>
                    <td style="padding-top:5px;width:200px;">Emergency Contact Name</td>
                    <td style="padding-top:5px color:<?php print $fontColorcontactPerson ?>;">
					<?php 
					 if($contact_person==""){
						 print "-";
					 }else{
						print $contact_person; 
					 }
					?>
					</td>
                 </tr>
				<tr>
                    <td style="padding-top:5px;width:200px">Emergency Contact Number</td>
                    <td style="padding-top:5px;color:<?php print $fontColorEmergency ?>;">
					<?php 
						if($emergency==""){
							print "-";
						}else{
							print $emergency;
						}
					?>
					</td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Emergency Contact Relationship</td>
                     <td style="padding-top:5px;color:<?php print $fontColorErelationship ?>;">
					 <?php 
						if($emergency_relationship==""){
							print "-";
						}else{
							print $emergency_relationship; 
						}
					 ?>
					 </td>
                </tr>
        
              </table>

        <table style="">
     
             <p class="personal-information">Next Of Kin</p>
                         <tr>
                            <td style="padding-top:5px;width:200px;">Next Of Kin Name</td>
                            <td style="padding-top:5px color:<?php print $fontColorcontactPerson ?>;">
                            <?php 
                             if($kin_contact_person==""){
                                 print "-";
                             }else{
                                print $kin_contact_person; 
                             }
                            ?>
                            </td>
                         </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px">Next Of Kin Contact Number</td>
                            <td style="padding-top:5px;color:<?php print $fontColorEmergency ?>;">
                            <?php 
                                if($kin_emergency==""){
                                    print "-";
                                }else{
                                    print $kin_emergency;
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Next Of Kin Relationship</td>
                             <td style="padding-top:5px;color:<?php print $fontColorErelationship ?>;">
                             <?php 
                                if($kin_emergency_relationship==""){
                                    echo "-";
                                }else{
                                    echo $kin_emergency_relationship; 
                                }
                             ?>
                             </td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Next Of Kin IC</td>
                             <td style="padding-top:5px;color:<?php print $fontColorErelationship ?>;">
                             <?php 
                                if($kin_ic==""){
                                    print "-";
                                }else{
                                    print $kin_ic; 
                                }
                             ?>
                             </td>
                        </tr>
                
                      </table>
		<table style="">	   
			<p class="personal-information">Pass Expiry</p>
	                            <tr>
                                    <td style="padding-top:5px;width:200px;">PKFZ Expiry Date (Pass)</td>
                                    <td style="padding-top:5px color:<?php print $fontColorpk ?>;">
									<?php 
    									if ($e_date_pk_fz != "0000-00-00" && $e_date_pk_fz != "") {
                                            if(strtotime($e_date_pk_fz) < time() && $e_date_pk_fz !=""){
                                                $pkfz_expiry_class="class='expired'";
                                                echo date("d-m-Y", strtotime($e_date_pk_fz)).'<span '.$pkfz_expiry_class.'>Expired</span>';
                                            } else {
                                                print date("d-m-Y", strtotime($e_date_pk_fz));
                                            }
    									} else {
    										print "-";
    									}
									?>
									</td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:200px;">Westport Expiry date (Pass)</td>
                                    <td style="padding-top:5px color:<?php print $fontColorwesp ?>;">
									<?php 
    									if ($e_date_westport != "0000-00-00" && $e_date_westport != "") {
                                            //$nextDay = date('d-m-Y',time() + (1 * 24 * 60 * 60));
                                            if(strtotime($e_date_westport) < date('d-m-Y',time()) && $e_date_westport !="" ){
                                                $westport_expiry_class="class='expired'";
                                                //echo '<br>test='.$nextDay.'<br>';
                                                //echo '<br>testDate='.date('d-m-Y',strtotime($e_date_westport)).'<br>';
                                                echo date("d-m-Y", strtotime($e_date_westport)).'<span '.$westport_expiry_class.'>Expired</span>';
                                            } else {
                                                print date("d-m-Y", strtotime($e_date_westport));
                                            }
    									} else {
    										print "-";
    									}
									?>
									</td>
                                </tr>
								 <tr>
                                    <td style="padding-top:5px;width:200px;">Johor Port Expiry Date (Pass)</td>
                                    <td style="padding-top:5px color:<?php print $fontColorjohp ?>;">
									<?php 
    									if ($e_date_johor_port != "0000-00-00" && $e_date_johor_port != "") {
                                            if(strtotime($e_date_johor_port) < time() && $e_date_johor_port !=""){
                                                $johor_port_expiry_class="class='expired'";
                                                echo date("d-m-Y", strtotime($e_date_johor_port)).'<span '.$johor_port_expiry_class.'>Expired</span>';
                                            } else {
                                                echo date("d-m-Y", strtotime($e_date_johor_port));
                                            }
    									} else {
    										print "-";
    									}
									?>
									</td>
                                </tr>
								 <tr>
                                    <td style="padding-top:5px;width:200px;">PTP Expiry Date (Pass)</td>
                                    <td style="padding-top:5px color:<?php print $fontColorptp ?>;">
									<?php 
									if ($e_date_ptp != "0000-00-00" && $e_date_ptp != "") {
                                        if(strtotime($e_date_ptp) < time() && $e_date_ptp !=""){
                                            $ptp_expiry_class="class='expired'";
                                            echo date("d-m-Y", strtotime($e_date_ptp)).'<span '.$ptp_expiry_class.'>Expired</span>';
                                        } else {
                                            echo date("d-m-Y", strtotime($e_date_ptp));
                                        }
									} else {
										echo "-";
									}
						
									?>
									</td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:200px;">TLP Expiry Date (Pass)</td>
                                    <td style="padding-top:5px color:<?php print $fontColortlp ?>;">
									<?php 
    									if ($e_date_tlp != "0000-00-00" && $e_date_tlp != "") {
    						                  //<span '.$ptp_expiry_class.'>Expired</span>.' ('.$realAge.')'
                                            if(strtotime($e_date_tlp) < time() && $e_date_tlp !=""){
                                                //$showptpRenewal="";
                                                $tlp_expiry_class="class='expired'";
                                                //echo 'ptp='.$ptp_expiry_class.'<br>';
                                                //echo 'time='.time().'<br>';date('Y-m-d', time())
                                                //$nextWeek = time() + (1 * 24 * 60 * 60);
                                                //echo '<br>TestTime='.date('d-m-Y', time() + (1 * 24 * 60 * 60)).'<br>';
                                                //echo '<br>time1='.date('d-m-Y', time()+(1)).'<br>';
                                                //echo '<br>time='.date('d-m-Y', time()).'<br>';
                                                //echo 'e_date'.strtotime($e_date_ptp);
                                                //echo 'e_date='.date('d-m-Y', strtotime($e_date_tlp)).'<br>';
                                                //echo 'e_date1='.$e_date_tlp.'<br>';
                                                //echo '<br><br><br><br>';
                                                echo date("d-m-Y", strtotime($e_date_tlp)).'<span '.$tlp_expiry_class.'>Expired</span>';
                                            } else {
    									        echo date("d-m-Y", strtotime($e_date_tlp));
                                            }
    									} else {
    										echo "-";
    									}
									?>
									</td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;width:200px;">North Port Expiry Date (Pass)</td>
                                    <td style="padding-top:5px color:<?php print $fontColornorp ?>;">
                                    <?php 
                                        if ($e_date_north_port != "0000-00-00" && $e_date_north_port != "") {
                                            if(strtotime($e_date_north_port) < time() && $e_date_north_port !=""){
                                                $north_port_expiry_class="class='expired'";
                                                echo date("d-m-Y", strtotime($e_date_north_port)).'<span '.$north_port_expiry_class.'>Expired</span>';
                                            } else {
                                                echo date("d-m-Y", strtotime($e_date_north_port));
                                            }
                                        } else {         
                                            echo "-";
                                        }
                                    ?>
                                    </td>
                                </tr>
        
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
					<!--<tr>
                    <td style="padding-top:5px;width:200px">Last Official Day</td>
                    <td style="padding-top:5px;color:<?php// print $fontColoroff ?>;"><?php
                     /*   if ($rowGetOld['officail_working_day'] != "0000-00-00" && $rowGetOld['officail_working_day']!= "") {
                            print date("d-m-Y", strtotime($rowGetOld['officail_working_day']));
                        } else {
                            print "-";
                        }*/
                        ?></td>
                </tr>-->
				<tr>
                    <td style="padding-top:5px;width:200px">Reason For Resign</td>
                    <td style="padding-top:5px;color:<?php print $fontColorReason ?>;"><?php
                        if ($rowGetOld['reasign_reason'] != " " && $rowGetOld['reasign_reason'] != "") {
                            print $rowGetOld['reasign_reason'];
                        } else {
                            print "-";
                        }
                        ?></td>
                </tr></table>
              
                <table><tr style="display: none;">
                    <td style="padding-top:6px;width:200px">Extra Information/Note</td> 
                    <td style="padding-top:6px;"><?php print $row['notes']; ?></td>
                </tr>
                <?php
                $sql1 = 'SELECT field_name, field_value FROM employee_info WHERE emp_id=' . $getID;
                $query1 = mysql_query($sql1);
				if($query1>0){
					echo'<p class="personal-information">Extra Information</p>';
					while ($row1 = mysql_fetch_array($query1)) {
						echo '<tr><td style="padding-top:5px;width:200px;">' . $row1["field_name"] . '</td><td style="padding-top:5px;">' . $row1["field_value"] . '</td></tr>';
					}
				}
                ?>
            </table>
        </div>
    </div>
</div>

<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>