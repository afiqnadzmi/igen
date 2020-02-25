<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$id = $_POST['id'];
$query = mysql_query('SELECT * FROM employee WHERE id=' . $id . ';');
$row = mysql_fetch_array($query);
$sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $id);
$rowGetNew = mysql_fetch_array($sqlGetNew);
$rowCount = mysql_num_rows($sqlGetNew);

if ($rowCount > 0) {
    if ($rowGetNew['profile'] != $row['profile'] && $rowGetNew['profile'] !=null) { 
        $fontColorProfile = 'red';
        $profile = $rowGetNew['profile']; 
    } else {
        $fontColorProfile = null;
        $profile = $row['profile'];
    }
if ($rowGetNew['username'] != $row['username'] && $rowGetNew['username']!=null) {


    $fontColoruname = 'red';
    $imguname = 'block';
    $username = $rowGetNew['username'];
} else {
     $fontColoruname = null;
   
     $username = $row['username'];
}
    if ($rowGetNew['ic'] != $row['ic'] && $rowGetNew['ic']!=null) {
        $fontColorIc = 'red';
        $imgIc = 'display';
        $ic = $rowGetNew['ic'];
    } else {
        $fontColorIc = null;
        $imgIc = 'none';
        $ic = $row['ic'];
    }
	if ($rowGetNew['passport'] != $row['passport'] && $rowGetNew['passport'] !=null) {
        $fontColorp = 'red';
        $imgp = 'display';
        $passport = $rowGetNew['passport'];
        
    } else {
        $fontColorp = null;
        $imgp = 'none';
        $passport = $row['passport'];
       
    }
	 
	 if ($rowGetNew['work_permit'] != $row['work_permit'] && $rowGetNew['work_permit'] !=null) {
        $fontColorwp = 'red';
        $imgwp = 'display';
        $work_permit= $rowGetNew['work_permit'];
		
      
    } else {
        $fontColorwp= null;
        $imgwp= 'none';
        $work_permit = $row['work_permit']; 
       
    }
	
	 if ($rowGetNew['work_permit_expirty'] != $row['work_permit_expirty'] && $rowGetNew['work_permit_expirty'] !=null) {
        $fontColorwpe = 'red';
        $imgwpe = 'display';
        $work_permit_expirty= $rowGetNew['work_permit_expirty'];
		
      
    } else {
        $fontColorwpe= null;
        $imgwpe= 'none';
        $work_permit_expirty = $row['work_permit_expirty']; 
       
    }
	

	
		 if ($rowGetNew['passport_expiry'] != $row['passport_expiry'] && $rowGetNew['passport_expiry'] !="0000-00-00") {
        $fontColorpe = 'red';
        $imgpe = 'display';
        $passport_expiry= $rowGetNew['passport_expiry'];
       
    } else {
        $fontColorpe= null;
        $imgpe= 'none';
        $passport_expiry = $row['passport_expiry'];
       
    }
	 if ($rowGetNew['country'] != $row['country'] && $rowGetNew['country'] !=null) {
        $fontColorc = 'red';
        $imgc = 'display';
        $country= $rowGetNew['country'];
       
    } else {
        $fontColorc= null;
        $imgc= 'none';
        $country = $row['country'];
     
    }


    if ($rowGetNew['phone'] != $row['phone'] && $rowGetNew['phone'] !=null) {
        $fontColorPhone = 'red';
        $imgPhone = 'display';
        $phone = $rowGetNew['phone'];
    } else {
        $fontColorPhone = null;
        $imgPhone = 'none';
        $phone = $row['phone'];
    }

    if ($rowGetNew['mobile'] != $row['mobile'] && $rowGetNew['mobile'] !=null) {
        $fontColorMobile = 'red';
        $imgMobile = 'display';
        $mobile = $rowGetNew['mobile'];
    } else {
        $fontColorMobile = null;
        $imgMobile = 'none';
        $mobile = $row['mobile'];
    }

    if ($rowGetNew['email'] != $row['email'] && $rowGetNew['email'] != null) {
        $fontColorEmail = 'red';
        $imgEmail = 'display';
        $email = $rowGetNew['email'];
    } else {
        $fontColorEmail = null;
        $imgEmail = 'none';
        $email = $row['email'];
    }
	
	if ($rowGetNew['contact_person'] != $row['contact_person'] && $rowGetNew['contact_person']!=null) {
		$fontColorcontactPerson = 'red';
		$imgcontactPerson = 'display';
		$contact_person = $rowGetNew['contact_person'];
	} else {
		$fontColorcontactPerson = null;
		$imgcontactPerson = 'none';
		$contact_person = $rowGetNew['contact_person'];
	}
	if ($rowGetNew['emergency'] != $row['emergency'] && $rowGetNew['emergency']!=null) {
		$fontColorEmergency = 'red';
		$imgEmergency = 'display';
		$emergency = $rowGetNew['emergency'];
	} else {
		$fontColorEmergency = null;
		$imgEmergency = 'none';
		$emergency = $rowGetNew['emergency'];
	}
	if ($rowGetNew['emergency_relationship'] != $row['emergency_relationship'] && $rowGetNew['emergency_relationship']!=null) {
		$fontColorErelationship = 'red';
		$imgErelationship= 'display';
		$emergency_relationship = $rowGetNew['emergency_relationship'];
	} else {
		$fontColorErelationship = null;
		$imgErelationship = 'none';
		$emergency_relationship = $rowGetNew['emergency_relationship'];
	}

    if ($rowGetNew['kin_contact_person'] != $row['kin_contact_person'] && $rowGetNew['kin_contact_person']!=null) {
        $fontColorKinContactPerson = 'red';
        $imgKinContactPerson = 'display';
        $kin_contact_person = $rowGetNew['kin_contact_person'];
    } else {
        $fontColorKinContactPerson = null;
        $imgKinContactPerson = 'none';
        $kin_contact_person = $rowGetNew['kin_contact_person'];
    }
    if ($rowGetNew['kin_emergency'] != $row['kin_emergency'] && $rowGetNew['kin_emergency']!=null) {
        $fontColorKinEmergency = 'red';
        $imgKinEmergency = 'display';
        $kin_emergency = $rowGetNew['kin_emergency'];
    } else {
        $fontColorKinEmergency = null;
        $imgKinEmergency = 'none';
        $kin_emergency = $rowGetNew['kin_emergency'];
    }
    if ($rowGetNew['kin_emergency_relationship'] != $row['kin_emergency_relationship'] && $rowGetNew['kin_emergency_relationship']!=null) {
        $fontColorKinErelationship = 'red';
        $imgKinErelationship= 'display';
        $kin_emergency_relationship = $rowGetNew['kin_emergency_relationship'];
    } else {
        $fontColorKinErelationship = null;
        $imgKinErelationship = 'none';
        $kin_emergency_relationship = $rowGetNew['kin_emergency_relationship'];
    }
    if ($rowGetNew['kin_ic'] != $row['kin_ic'] && $rowGetNew['kin_ic']!=null) {
        $fontColorKinIC = 'red';
        $imgKinIC= 'display';
        $kin_ic = $rowGetNew['kin_ic'];
    } else {
        $fontColorKinIC = null;
        $imgKinIC = 'none';
        $kin_ic = $rowGetNew['kin_ic'];
    }

    if ($rowGetNew['address'] != $row['address'] && $rowGetNew['address'] !=null) {
        $fontColorMail = 'red';
        $imgAddress = 'display';
        $address = $rowGetNew['address'];
    } else {
        $fontColorMail = null;
        $imgAddress = 'none';
        $address = $row['address'];
    }
    if ($rowGetNew['address1'] != $row['address1'] && $rowGetNew['address1'] !=null) {
        $fontColorMail1 = 'red';
        $imgAddress1 = 'display';
        $address1 = $rowGetNew['address1'];
    } else {
        $fontColorMail1 = null;
        $imgAddress1 = 'none';
        $address1 = $row['address1'];
    }
    if ($rowGetNew['postal_code'] != $row['postal_code'] && $rowGetNew['postal_code'] !=null) {
        $fontPostalCode = 'red';
        $imgPostalCode = 'display';
        $postal_code = $rowGetNew['postal_code'];
    } else {
        $fontPostalCode = null;
        $imgPostalCode = 'none';
        $postal_code = $row['postal_code'];
    }
    if ($rowGetNew['city'] != $row['city'] && $rowGetNew['city'] !=null) {
        $fontCity = 'red';
        $imgCity = 'display';
        $city = $rowGetNew['city'];
    } else {
        $fontCity = null;
        $imgCity = 'none';
        $city = $row['city'];
    }
    if ($rowGetNew['state'] != $row['state'] && $rowGetNew['state'] !=null) {
        $fontState = 'red';
        $imgState = 'display';
        $state = $rowGetNew['state'];
    } else {
        $fontState = null;
        $imgState = 'none';
        $state = $row['state'];
    }
    if ($rowGetNew['adrsCountry'] != $row['adrsCountry'] && $rowGetNew['adrsCountry'] !=null) {
        $fontAdrsCountry = 'red';
        $imgAdrsCountry = 'display';
        $adrsCountry = $rowGetNew['adrsCountry'];
    } else {
        $fontAdrsCountry = null;
        $imgAdrsCountry = 'none';
        $adrsCountry = $row['adrsCountry'];
    }

    if ($rowGetNew['gender'] != $row['gender'] && $rowGetNew['gender'] !=null) {
        $fontColorGender = 'red';
        $imgGender = 'display';
        $gender = $rowGetNew['gender'];
    } else {
        $fontColorGender = null;
        $imgGender = 'none';
        $gender = $row['gender'];
    }

    if ($rowGetNew['race'] != $row['race'] && $rowGetNew['race'] != null) {
        $fontColorRace = 'red';
        $imgRace = 'display';
        $race = $rowGetNew['race'];
    } else {
        $fontColorRace = null;
        $imgRace = 'none';
        $race = $row['race'];
    }

    if ($rowGetNew['religion'] != $row['religion'] && $rowGetNew['religion'] !=null) {
        $fontColorReligion = 'red';
        $imgReligion = 'display';
        $religion = $rowGetNew['religion'];
    } else {
        $fontColorReligion = null;
        $imgReligion = 'none';
        $religion = $row['religion'];
    }

    if ($rowGetNew['marital'] != $row['marital'] && $rowGetNew['marital'] !=null) {
        $fontColorMarital = 'red';
        $imgMarital = 'display';
        $marital = $rowGetNew['marital'];
    } else {
        $fontColorMarital = null;
        $imgMarital = 'none';
        $marital = $row['marital'];
    }

    if ($rowGetNew['spouse_work'] != $row['spouse_work'] && $rowGetNew['spouse_work'] != null) {
        $fontColorSpouse = 'red';
        $imgSpouse = 'display';
        $spouseWork = $rowGetNew['spouse_work'];
    } else {
        $fontColorSpouse = null;
        $imgSpouse = 'none';
        $spouseWork = $row['spouse_work'];
    }
	if ($rowGetNew['spouse_company'] != $row['spouse_company'] && $rowGetNew['spouse_company'] != null) {
        $fontColorSpouse_company = 'red';
        $imgSpouse_company = 'display';
        $spouseCompany = $rowGetNew['spouse_company'];
    } else {
        $fontColorSpouse_company = null;
        $imgSpouse_company = 'none';
        $spouseCompany = $row['spouse_company'];
    }
	
    if ($rowGetNew['dob'] != $row['dob'] && $rowGetNew['dob'] !=null) {
        $fontColorDob = 'red';
        $imgDob = 'display';
        $dob = $rowGetNew['dob'];
    } else {
        $fontColorDob = null;
        $imgDob = 'none';
        $dob = $row['dob'];
    }

    if ($rowGetNew['num_of_kids'] != $row['num_of_kids'] && $rowGetNew['num_of_kids'] !=0) {
        $fontColorChild = 'red';
        $imgChild = 'display';
        $child = $rowGetNew['num_of_kids'];
    } else {
        $fontColorChild = null;
        $imgChild = 'none';
        $child = $row['num_of_kids'];
    }

    if ($rowGetNew['join_date'] != $row['join_date'] && $rowGetNew['join_date'] !=null) {
        $fontColorJoin = 'red';
        $imgJoin = 'display';
        $join = $rowGetNew['join_date'];
    } else {
        $fontColorJoin = null;
        $imgJoin = 'none';
        $join = $row['join_date'];
    }

    if ($rowGetNew['resign_date'] != $row['resign_date'] && $rowGetNew['resign_date'] !=0) {
        $fontColorResign = 'red';
        $imgResign = 'display';
        $resign = $rowGetNew['resign_date'];
    } else {
        $fontColorResign = null;
        $imgResign = 'none';
        $resign = $row['resign_date'];
    }
	if ($rowGetNew['last_working_day'] != $row['last_working_day'] && $rowGetNew['last_working_day'] !=0) {
        $fontColorlast = 'red';
        $imgResign = 'display';
        $last_working_day= $rowGetNew['last_working_day'];
    } else {
        $fontColorlast= null;
        $imgResign = 'none';
        $last_working_day = $row['last_working_day'];
    }
	if ($rowGetNew['officail_working_day'] != $row['officail_working_day']) {
        $fontColoroff = 'red';
        $imgResign = 'display';
        $officail_working_day= $rowGetNew['officail_working_day'];
    } else {
        $fontColoroff= null;
        $imgResign = 'none';
        $officail_working_day = $row['officail_working_day'];
    }
	if ($rowGetNew['e_date_pk_fz'] != $row['e_date_pk_fz'] && $rowGetNew['e_date_pk_fz'] !="0000-00-00") {
        $fontColorpk = 'red';
        $imgpk = 'display';
        $e_date_pk_fz= $rowGetNew['e_date_pk_fz'];
        $countpk = 1;
    } else {
        $fontColorpk= null;
        $imgpk= 'none';
        $e_date_pk_fz = $row['e_date_pk_fz'];
        $countpk = 0;
    }
	if ($rowGetNew['e_date_westport'] != $row['e_date_westport'] && $rowGetNew['e_date_westport'] !="0000-00-00") {
        $fontColorwesp = 'red';
        $imgwesp = 'display';
        $e_date_westport= $rowGetNew['e_date_westport'];
        $countwesp = 1;
    } else {
        $fontColorwesp= null;
        $imgwesp= 'none';
        $e_date_westport = $row['e_date_westport'];
        $countwesp = 0;
    }
	if ($rowGetNew['e_date_johor_port'] != $row['e_date_johor_port'] && $rowGetNew['e_date_johor_port'] !="0000-00-00") {
        $fontColorjohp = 'red';
        $imgjohp = 'display';
        $e_date_johor_port= $rowGetNew['e_date_johor_port'];
        $countjohp = 1;
    }else {
        $fontColorjohp= null;
        $imgjohp= 'none';
        $e_date_johor_port = $row['e_date_johor_port'];
        $countjohp = 0;
    }
	if ($rowGetNew['e_date_ptp'] != $row['e_date_ptp'] && $rowGetNew['e_date_ptp'] !="0000-00-00") {
        $fontColorptp = 'red';
        $imgptp = 'display';
        $e_date_ptp= $rowGetNew['e_date_ptp'];
        $countptp = 1;
    }else {
        $fontColorptp= null;
        $imgptp= 'none';
        $e_date_ptp = $row['e_date_ptp'];
        $countptp = 0;
    }
	if ($rowGetNew['e_date_tlp'] != $row['e_date_tlp'] && $rowGetNew['e_date_tlp'] !="0000-00-00") {
        $fontColortlp = 'red';
        $imgtlp = 'display';
        $e_date_tlp= $rowGetNew['e_date_tlp'];
        $counttlp = 1;
    }else {
        $fontColortlp= null;
        $imgtlp= 'none';
        $e_date_tlp = $row['e_date_tlp'];
        $counttlp = 0;
    }
    if ($rowGetNew['e_date_north_port'] != $row['e_date_north_port'] && $rowGetNew['e_date_north_port'] !="0000-00-00") {
        $fontColornorp = 'red';
        $imgnorp = 'display';
        $e_date_north_port= $rowGetNew['e_date_north_port'];
        $countnorp = 1;
    }else {
        $fontColornorp= null;
        $imgnorp= 'none';
        $e_date_north_port = $row['e_date_north_port'];
        $countnorp= 0;
    }
} else {
    $fontColorBankNum = null;
    $fontColorBank = null;
    $fontColorChild = null;
    $fontColorDob = null;
    $fontColorEmail = null;
    $fontColorEpf = null;
    $fontColorGender = null;
    $fontColorIc = null;
    $fontColorItax = null;
    $fontColorJoin = null;
    $fontColorMail = null;
    $fontColorMail1 = null;
    $fontPostalCode = null;
    $fontCity = null;
    $fontState = null;
    $fontAdrsCountry = null;
    $fontColorMarital = null;
    $fontColorMobile = null;
    $fontColorPhone = null;
    $fontColorProfile = null;
    $fontColorRace = null;
    $fontColorReligion = null;
    $fontColorResign = null;
    $fontColorSocso = null;
    $fontColorSpouse = null;
    $fontColorZakat = null;
	$fontColoruname = null;
	$fontColorcontactPerson = null;
	$fontColorErelationship==null;
	$fontColorEmergency=null;
    $fontColorKinContactPerson = null;
    $fontColorKinErelationship==null;
    $fontColorKinEmergency=null;
    $fontColorKinIC=null;
	$fontColorpk= null;
	$fontColorwesp= null;
	$fontColorjohp= null;
	$fontColorptp= null;
	$fontColortlp= null;
    $fontColornorp= null;

	$imgpk= 'none';
	$imgwesp= 'none';
	$imgjohp= 'none';
	$imgptp= 'none';
	$imgtlp= 'none';
    $imgnorp= 'none';
    $imgAddress = 'none';
    $imgAddress1 = 'none';
    $imgPostalCode = 'none';
    $imgCity = 'none';
    $imgState = 'none';
    $imgAdrsCountry = 'none';
    $imgBankNum = 'none';
    $imgBank = 'none';
    $imgChild = 'none';
    $imgDob = 'none';
    $imgEmail = 'none';
    $imgEpf = 'none';
    $imgGender = 'none';
    $imgIc = 'none';
	$imgp = 'none';
	$imgpe = 'none';
	$imgwp = 'none';
	$imgc = 'none';
    $imgItax = 'none';
    $imgJoin = 'none';
    $imgMarital = 'none';
    $imgMobile = 'none';
    $imgPhone = 'none';
    $imgProfile = 'none';
    $imgRace = 'none';
    $imgReligion = 'none';
    $imgResign = 'none';
    $imgSocso = 'none';
    $imgSpouse = 'none';
    $imgZakat = 'none';

   
    $username = $row['username'];
    $passport = $row['passport'];
	$passport_expiry = $row['passport_expiry'];
	 $work_permit= $row['work_permit'];
	 $work_permit_expirty = $row['work_permit_expirty'];
	 $country = $row['country'];
    $ic = $row['ic'];
    $phone = $row['phone'];
    $mobile = $row['mobile'];
    $email = $row['email'];
    $address = $row['address'];
    $address1 = $row['address1'];
    $postal_code = $row['postal_code'];
    $city = $row['city'];
    $state = $row['state'];
    $adrsCountry = $row['adrsCountry'];
    $gender = $row['gender'];
    $race = $row['race'];
    $religion = $row['religion'];
    $marital = $row['marital'];
    $spouseWork = $row['spouse_work'];
	$spouseCompany = $row['spouse_company'];
    $dob = $row['dob'];
    $child = $row['num_of_kids'];
    $join = $row['join_date'];
    $profile = $row['profile'];
    $zakat = $row['zakat'];
    $epf = $row['epf_num'];
    $socso = $row['socso_num'];
    $iTax = $row['income_tax_num'];
    $bank = $row['bank_acc_id'];
    $bankNum = $row['bank_acc_num'];
    $resign = $row['resign_date'];
	$reason_resign = $row['reasign_reason'];
	$contact_person = $row['contact_person'];
	$emergency = $row['emergency'];
	$emergency_relationship = $row['emergency_relationship'];
    $kin_contact_person = $row['kin_contact_person'];
    $kin_emergency = $row['kin_emergency'];
    $kin_emergency_relationship = $row['kin_emergency_relationship'];
    $kin_ic = $row['kin_ic'];
	$e_date_pk_fz = $row['e_date_pk_fz'];
	$e_date_westport = $row['e_date_westport'];
	$e_date_johor_port = $row['e_date_johor_port'];
	$e_date_ptp = $row['e_date_ptp'];
	$e_date_tlp = $row['e_date_tlp'];
    $e_date_north_port = $row['e_date_north_port'];
	if($spouseWork!="Y"){
		$spouse_company_display="none";
	}else{
		$spouse_company_display="inherit";
	}
}
// $e_date_north_port = date("d-m-Y", strtotime($e_date_north_port));
// echo "test";
// echo "<br><br><br><br><br>";
// echo $e_date_north_port;
// echo "<br><br><br><br><br>";
if ($row) {
   
    echo '
	
	<table id="titlebar" class="titleBarTo"  style="width:98%; padding-right: 5px;">
            <tr>
                <td style="font-size:large;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;Personal Information
                </td>
                <td style="padding-right: 10px; width: 250px;"><span id="popupdiv" style="font-weight: normal;background-color: lightpink;display:none;text-align:center;color:blue; font-size: 12px;border:1px solid red; height:20px; padding-right: 15px; padding-left: 10px;"><span class="i_warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="error_msg"></span></span></td>
                <td onclick="savePI(' . $id . ')" id="editBut">Save</td>  
                <td onclick="cancelPI()" id="editBut">Cancel</td>
            </tr> 
        </table>
        <div style="overflow:auto;width:94%;padding-top:20px;padding-left:20px;"> 
         <table>
            <tr>
                <td style="padding-top:5px;width:200px;">Username<span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" id="textusername" style="width:250px;" value="' . $username . '"  /></td>';
							 if ($fontColoruname == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['username'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'ic\')" />
                          </td>';
    }
           echo'</tr>
			<input type="hidden" id="country" value="'.$country.'" >
            <tr style="display: none;">
                <td style="padding-top:5px;width:200px;">Profile</td>
                <td style="padding-top:5px;"><input type="text" id="textprofile" style="width:250px;" value="' . $profile . '" /></td>';

    if ($fontColorProfile == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['profile'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'profile\')" />
                          </td>';
    }
    echo '  </tr>';
	if($country=="Malaysia"){ 
    $ic_full = explode("-", $ic);
    echo '<tr>
                <td style="padding-top:5px;width:200px;">IC<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="ICText1" style="width:99px" type="Text" value="' . $ic_full[0] . '" maxlength="6" />&nbsp;-&nbsp;<input id="ICText2" style="width:30px" type="Text" value="' . $ic_full[1] . '" maxlength="2" />&nbsp;-&nbsp;<input id="ICText3" style="width:99px" type="Text" value="' . $ic_full[2] . '" maxlength="4" />
                </td>';
    if ($fontColorIc == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['ic'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'ic\')" />
                          </td>';
    }
    echo '</tr>';
	
	}else{  
    echo '<tr>
                <td style="padding-top:5px;width:200px;">Passport Number<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="pass" style="width:99px" type="Text" value="' . $passport . '"/>
                </td>';
    if ($fontColorp == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['passport'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'passport\')" />
                          </td>';
    }
    echo '</tr>';
	if($passport_expiry=="0000-00-00" || $passport_expiry==""){
		$passport_expiry="";
	}else{
		$passport_expiry =  date("d-m-Y", strtotime($passport_expiry));
	}
	$showPassportRenewal="display:none";
	$passport_expiry_class="";
	if(strtotime($passport_expiry) < time() && $passport_expiry !=""){
		$showPassportRenewal="";
		$passport_expiry_class="class='expired'";
	}
	  echo '<tr>
                <td style="padding-top:5px;width:200px;">Passport Expiry<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="pe" style="width:99px" type="Text" value="' .$passport_expiry.'"  />&nbsp;<span style="'.$showPassportRenewal.'"><span '.$passport_expiry_class.'>Expired</span>&nbsp;<input type="checkbox" name="renewPassport" id="renewPassport" onclick="passExpiry()"> Renew</span>
                </td> ';
    if ($fontColorpe == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $passport_expiry  . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'passport_expiry\')" />
                          </td>';
    }
    echo '</tr>';
	  echo '<tr id="passisuuedate" style="display:none;">
                <td style="padding-top:5px;width:200px;">Passport Issue Date<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="p_issuedate" style="width:99px" type="Text" value=""  />
                </td></tr> ';
		  echo '<tr>
                <td style="padding-top:5px;width:200px;">Work Permit<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="wp" style="width:99px" type="Text" value="' . $work_permit. '"  />
                </td>';
    if ($fontColorwp== 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['work_permit'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'work_permit\')" />
                          </td>';
    }
    echo '</tr>';
	if($work_permit_expirty=="0000-00-00" || $work_permit_expirty==""){
		$work_permit_expirty="";
	}else{
		$work_permit_expirty =  date("d-m-Y", strtotime($work_permit_expirty));
	}
	$showWorkPermitRenewal="display:none";
	$workPermit_expiry_class="";

	if(strtotime($work_permit_expirty."+1 days") < time() && $work_permit_expirty !=""){
		$showWorkPermitRenewal="";
		$workPermit_expiry_class="class='expired'";
	}
	echo '<tr>
                <td style="padding-top:5px;width:200px;">Work Permit Expiry<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="wpep" style="width:99px" type="Text" value="' . $work_permit_expirty. '"  />&nbsp;<span style="'.$showWorkPermitRenewal.'"><span '.$workPermit_expiry_class.'>Expired</span>&nbsp;<input type="checkbox" name="renewWorkPermit" id="renewWorkPermit" onclick="wpExpiry()"> Renew</span>
                </td>';
    if ($fontColorwpe== 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $work_permit_expirty . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'work_permit_expirty\')" />
                          </td>';
    }
    echo '</tr>';
	}
	 echo '<tr id="wpisuuedate" style="display:none;">
                <td style="padding-top:5px;width:200px;">Work Permit Issue Date<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="wp_issuedate" style="width:99px" type="Text" value=""  />
                </td></tr> ';
	 echo '<tr>
                <td style="padding-top:5px;width:200px;">Date of Birth<span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" id="textdob" value="' . date("d-m-Y", strtotime($dob)) . '" style="width:250px;" />';
    if ($fontColorDob == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . date("d-m-Y", strtotime($row['dob'])) . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'dob\')" />
                          </td>';
    }
    echo '</tr>';
            echo'<tr>
                <td style="padding-top:5px;width:200px;">Contact Number (Home)</td>
                <td style="padding-top:5px"><input type="text" id="textphone" style="width:250px;" value="' . $phone . '" /></td>';
    if ($fontColorPhone == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['phone'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'phone\')" />
                          </td>';
    }
    echo '</tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Contact Number (Mobile)<span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" id="textmobile" style="width:250px;" value="' . $mobile . '" /></td>';
    if ($fontColorMobile == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['mobile'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'mobile\')" />
                          </td>';
    }
    echo '</tr>

            <tr>
                <td style="padding-top:5px;width:200px;">Email<span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" id="textemail" style="width:250px;" value="' . $email . '"/></td>';
    if ($fontColorEmail == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['email'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'email\')" />
                          </td>';
    }
    echo '</tr> 
            <tr>
                <td style="padding-top:5px;width:200px;vertical-align:top;">Address 1</td>
                <td style="padding-top:5px"><input type="text" id="textaddress" style="width:250px;" value="' . $address . '"></td>';
    if ($fontColorMail == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['address'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'address\')" />
                          </td>';
    }
    echo '</tr>
            <tr>
                <td style="padding-top:5px;width:200px;vertical-align:top;">Address 2</td>
                <td style="padding-top:5px"><input type="text" id="textaddress1" style="width:250px;" value="' . $address1 . '"></td>';
    if ($fontColorMail1 == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['address1'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'address1\')" />
                          </td>';
    }
    echo '</tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Postal Code</td>
                <td style="padding-top:5px"><input type="text" id="textpostalcode" style="width:250px;" value="' . $postal_code . '"</td>';
    if ($fontPostalCode == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['postal_code'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'postal_code\')" />
                          </td>';
    }
    echo '</tr>
            <tr>
                <td style="padding-top:5px;width:200px;">City</td>
                <td style="padding-top:5px"><input type="text" id="textcity" style="width:250px;" value="' . $city . '"</td>';
    if ($fontCity == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['city'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'city\')" />
                          </td>';
    }
    echo '</tr>
            <tr>
                <td style="padding-top:5px;width:200px;">State</td>
                <td style="padding-top:5px"><input type="text" id="textstate" style="width:250px;" value="' . $state . '"</td>';
    if ($fontState == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['state'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'state\')" />
                          </td>';
    }
    echo '</tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Country</td>
                <td style="padding-top:5px"><input type="text" id="textadrsCountry" style="width:250px;" value="' . $adrsCountry . '"</td>';
    if ($fontAdrsCountry == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['adrsCountry'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'adrsCountry\')" />
                          </td>';
    }
    echo '</tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Gender<span class="red"> *</span></td>
                <td style="padding-top:5px">
                            <select id="dropgender" style="width:250px">
                        <option value="0">--Please Select--</option>';

    if ($gender == 'F') {
        echo '<option value="M">Male</option>
                                          <option value="F" selected="selected">Female</option>';
    } else if ($gender == 'M') {
        echo '<option value="M" selected="selected">Male</option>
                                          <option value="F">Female</option>';
    } else {
        echo '<option value="M">Male</option>
                                           <option value="F">Female</option>';
    }

    echo '</select>
                    </td>';
    if ($fontColorGender == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">';
        if ($row['gender'] == 'F') {
            print 'Female';
        } else {
            print 'Male';
        }
        echo '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'gender\')" />
                          </td>';
    }
    echo '</tr>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px">Race<span class="red"> *</span></td>
                <td style="padding-top:5px;">
                    <select class="input_text" id="dropRace" style="width:250px;">
                        <option value="0">--Please Select--</option>
                        <option value="Chinese"';
    if ($race == "Chinese") {
        echo 'selected="selected"';
    }
    echo'>Chinese</option>
                         <option value="Indian"';
    if ($race == "Indian") {
        echo 'selected="selected"';
    }
    echo'>Indian</option>
     <option value="Malay" ';
    if ($race == "Malay") {
        echo 'selected="selected"';
    }
    echo'>Malay</option>
	 <option value="Prebumi" ';
    if ($race == "Prebumi") {
        echo 'selected="selected"';
    }
    echo'>Prebumi</option>
	<option value="Iban" ';
    if ($race == "Iban") {
        echo 'selected="selected"';
    }
    echo'>Iban</option>
	<option value="Bidayuh" ';
    if ($race == "Bidayuh") {
        echo 'selected="selected"';
    }
    echo'>Bidayuh</option>
	<option value="Melanau" ';
    if ($race == "Melanau") {
        echo 'selected="selected"';
    }
    echo'>Melanau</option>
	<option value="Kadazan" ';
    if ($race == "Kadazan") {
        echo 'selected="selected"';
    }
    echo'>Kadazan</option>
	<option value="Dusun" ';
    if ($race == "Dusun") {
        echo 'selected="selected"';
    }
    echo'>Dusun</option>
	<option value="Minokok" ';
    if ($race == "Minokok") {
        echo 'selected="selected"';
    }
    echo'>Minokok</option>
	<option value="Dumpas" ';
    if ($race == "Dumpas") {
        echo 'selected="selected"';
    }
    echo'>Dumpas</option>
	<option value="Senoi" ';
    if ($race == "Senoi") {
        echo 'selected="selected"';
    }
    echo'>Senoi</option>
	<option value="Semang" ';
    if ($race == "Semang") {
        echo 'selected="selected"';
    }
    echo'>Semang</option>
    <option value="Foreigner"';
    if ($race == "Foreigner") {
        echo 'selected="selected"';
    }
    echo'>Foreigner</option>
                    </select>
                </td>';
    if ($fontColorRace == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['race'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'race\')" />
                          </td>';
    }
	
    echo '</tr>
            <tr>
                <td style="padding-top:5px;width:200px">Religion<span class="red"> *</span></td>
                <td style="padding-top:5px;">
                    <select class="input_text" id="dropReligion" style="width:250px;">
                        <option value="0">--Please Select--</option>
                        <option value="Buddhist"';
    if (ucfirst(strtolower($religion))== "Buddhist") {
        echo 'selected="selected"';
    }
    echo '>Buddhist</option>
                        <option value="Catholic"';
    if (ucfirst(strtolower($religion))== "Catholic") {
        echo 'selected="selected"';
    }
    echo '>Catholic</option>
                        <option value="Christian"';
    if (ucfirst(strtolower($religion)) == "Christian") {
        echo 'selected="selected"';
    }
    echo '>Christian</option>
                        <option value="Hindu"';
    if (ucfirst(strtolower($religion))== "Hindu") {
        echo 'selected="selected"';
    }
    echo '>Hindu</option>
                        <option value="Islam"';
    if (ucfirst(strtolower($religion))== "Islam") {
        echo 'selected="selected"';
    }
    echo '>Islam</option>
                        <option value="Others"';
    if (ucfirst(strtolower($religion)) == "Others") {
        echo 'selected="selected"';
    }
    echo '>Others</option>
                    </select>
                </td>';
    if ($fontColorReligion == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['religion'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'religion\')" />
                          </td>';
    }
    echo '</tr>
            <tr>
                <td style="padding-top:5px;width:200px">Marital Status<span class="red"> *</span></td>
                <td style="padding-top:5px;">
                   <select id="dropmarital" style="width:250px" onchange="checkMarital(this.value)">
                        <option value="0">--Please Select--</option>'; 
    if ($marital == 'M') {
        echo '<option value="S">Single</option>
              <option value="M" selected="selected">Married</option>
              <option value="D">Divorced</option>';
    } elseif ($marital == 'D') {
        echo '<option value="S">Single</option>
              <option value="M">Married</option>
              <option value="D" selected="selected">Divorced</option>';
    } elseif ($marital == 'S') {
        echo '<option value="S" selected="selected">Single</option>
            <option value="M">Married</option>
              <option value="D">Divorced</option>';
    } else {
        echo '<option value="S">Single</option>
            <option value="M">Married</option>
              <option value="D">Divorced</option>';
    }
    echo'</select>
                </td>';
    if ($fontColorMarital == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">';
        if ($row['marital'] == 'M') {
            print 'Married';
        } elseif ($row['marital'] == 'D') {
            print 'Divorced';
        } elseif ($row['marital'] == 'S') {
            print 'Single';
        } else {
            print '-';
        }
        echo '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'marital\')" />
                           </td>';
    }
    echo '</tr>';
	   echo '<tr>
        <td style="padding-top:5px;width:200px;" id="marital_spouse">Spouse Name';
    if ($marital == 'M') {
        echo '<span class="red"> *</span>';
    }
    echo '</td>';
    if ($marital == 'S' || $marital == 'D') {
        $dis_spouse = 'disabled="disabled"';
    }
	echo'<td style="padding-top:5px"><input type="text" id="spousename" ' . $dis_spouse . ' style="width:250px;" value="' . $row['spouse_name'] . '" /></td></tr>';
	
    echo '<tr>
        <td style="padding-top:5px;width:200px;" id="marital_spouse">Spouse Working'; 
    if ($marital == 'M') {
        echo '<span class="red"> *</span>';
    }
    echo '</td>';
    if ($marital == 'S' || $marital == 'D') {
        $dis_spouse = 'disabled="disabled"';
    }
    echo '<td style="padding-top:5px;">
        <select id="dropspouse" style="width:250px" ' . $dis_spouse . ' onchange="dropSpouse(this.value)">
        <option value="0">--Please Select--</option>';
    if ($spouseWork == 'N') {
		$dis_spouseCompany = 'disabled="disabled"';
        echo '<option value="Y">Yes</option>
                                              <option value="N" selected="selected">No</option>';
    } else if ($spouseWork == 'Y') {
        echo '<option value="Y" selected="selected">Yes</option>
                                              <option value="N">No</option>';
    } else {
        echo '<option value="Y">Yes</option>
                                              <option value="N">No</option>';
    }
    echo '</select>
                </td>';
    if ($fontColorSpouse == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">';
        if ($row['spouse_work'] == 'Y') {
            print 'Yes';
        } elseif ($row['spouse_work'] == "N") {
            print 'No';
        } else {
            print '-';
        }

        echo '</a>
            </td>
            <td style="padding-top:6px;">
            <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'spouse_work\')" />
            </td>';
    }
    echo '</tr>
	         <tr class="company_name" '.$dis_spouseCompany.'>
                <td style="padding-top:5px;width:200px;">Company Name<span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" id="company_name" style="width:250px;" value="' . $spouseCompany . '"</td>';
    if ($fontColorSpouse_company == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['spouse_company'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'spouse_company\')" />
                          </td>';
    }
    echo '</tr>'; 

    echo '<tr>
                <td style="padding-top:5px;width:200px;" id="marital_child">Number of Children';
    if ($marital == 'M' || $marital == 'D') {
        echo '<span class="red"> *</span>';
    }
    echo '</td>';
    if ($marital == 'S') {
        $dis_child = 'disabled="disabled"';
    }
    echo '<td style="padding-top:5px"><input type="text" ' . $dis_child . ' style="width: 250px;" id="textchild" value="' . $child . '" /></td>';
    if ($fontColorChild == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['num_of_kids'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'num_of_kids\')" />
                          </td>';
    }
    echo '</tr>';
	if($join=="0000-00-00" || $join==""){
		$join="";
	}else{
		$join=date("d-m-Y", strtotime($join));
	}
	  echo '<tr>
                <td style="padding-top:5px;width:200px;">Join Date<span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" style="width: 250px;"  id="textjoin" value="' .$join. '" /></td>';
    if ($fontColorJoin == 'red') {
        echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . date("d-m-Y", strtotime($row['join_date'])) . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'join_date\')" />
                          </td>';
    }
    echo '</tr>';
	if($confirm_date=="0000-00-00" || $confirm_date==""){
		$confirm_date="";
	}else{
		$confirm_date=date("d-m-Y", strtotime($confirm_date));
	}
	 echo '<tr>
                <td style="padding-top:5px;width:200px;">Confirm Date<span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" id="confirm" value="' .$confirm_date . '" style="width:250px;" />';
 
    echo '</tr>';
	   echo '<tr>
                <td style="padding-top:5px;width:200px;">Leave Group<span class="red"> *</span></td>
                <td style="padding-top:5px;">
                <select id="dropleave" style="width:250px">
                <option value="0">--Please Select--</option>';
    $sqlGetAllLeave = mysql_query('SELECT * FROM group_for_leave ORDER BY group_name');
    while ($rowGetLeave = mysql_fetch_array($sqlGetAllLeave)) {
        echo '<option value="' . $rowGetLeave['id'] . '"';
        if ($rowGetLeave['id'] == $row['group_for_leave_id']) { 
            echo 'selected="selected"';
        } else {
            echo '';
        }
        echo '>' . $rowGetLeave['group_name'] . '</option>';
    }

    echo '</select></td>';
    echo '</tr>';
	
	echo'</table>';
	
	echo' <table ><tr>
                <td style="padding-top:5px;width:200px;">Emergency Contact Person <span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" id="emergency" style="width:250px;" value="' .$contact_person. '" /></td>';
		if ($fontColorcontactPerson == 'red') {
					echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' .$row['contact_person']. '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'contact_person\')" />
                          </td>';
		}
   
    echo '</tr>
	<tr>
                <td style="padding-top:5px;width:200px;">Emergency Contact Number <span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" id="emergency_num" style="width:250px;" value="' . $emergency . '" /></td>';
			if ($fontColorEmergency == 'red') {
					echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' .$row['emergency']. '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'contact_person\')" />
                          </td>';
			}
   
    echo '</tr>';
	echo'<tr>
               <td style="padding-top:5px;width:200px;">Emergency Contact Relationship</td>
               <td style="padding-top:5px">';
			    if($row['emergency_relationship']=="Spouse"){
					   $spouse="selected";
				   }else if($row['emergency_relationship']=="Son"){
					   $son="selected";
				   }else if($row['emergency_relationship']=="Daughter"){
					   $daughter="selected";
				   }else if($row['emergency_relationship']=="Friend"){
					   $friend="selected";
				   }else if($row['emergency_relationship']=="Parents"){
					   $parents="selected";
				   }else if($row['emergency_relationship']=="Siblings"){
					   $siblings="selected";
				   }
			       echo'   	<select id="emergencyrelationship" style="width:250px;">
                                        <option value="0">--Please Select--</option>
                                        <option value="Spouse" '.$spouse.'>Spouse</option>
                                        <option value="Son" '.$son.'>Son</option>
										<option value="Daughter" '.$daughter.'>Daughter</option>
										<option value="Friend" '.$friend.'>Friend</option>
										<option value="Parents" '.$parents.'>Parents</option>
										<option value="Siblings" '.$siblings.'>Siblings</option>
                                  </select></td>';
			   if ($fontColorErelationship == 'red') {
			
				  
					echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['emergency_relationship'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'contact_person\')" />
                          </td>';
			}

        echo'<tr>
                <td style="padding-top:5px;width:200px;">Next Of Kin Name <span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" id="kin_emergency" style="width:250px;" value="' .$kin_contact_person. '" /></td>';
        if ($fontColorKinContactPerson == 'red') {
                    echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' .$row['kin_contact_person']. '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'kin_contact_person\')" />
                          </td>';
        }
   
        echo '</tr>
        <tr>
                <td style="padding-top:5px;width:200px;">Next Of Kin Contact Number <span class="red"> *</span></td>
                <td style="padding-top:5px"><input type="text" id="kin_emergency_num" style="width:250px;" value="' . $kin_emergency . '" /></td>';
            if ($fontColorKinEmergency == 'red') {
                    echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' .$row['kin_emergency']. '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'kin_contact_person\')" />
                          </td>';
            }
   
        echo '</tr>';

        echo'<tr>
               <td style="padding-top:5px;width:200px;">Next Of Kin Contact Relationship</td>
               <td style="padding-top:5px">';
                if($row['kin_emergency_relationship']=="Spouse"){
                       $kin_spouse="selected";
                   }else if($row['kin_emergency_relationship']=="Son"){
                       $kin_son="selected";
                   }else if($row['kin_emergency_relationship']=="Daughter"){
                       $kin_daughter="selected";
                   }else if($row['kin_emergency_relationship']=="Friend"){
                       $kin_friend="selected";
                   }else if($row['kin_emergency_relationship']=="Parents"){
                       $kin_parents="selected";
                   }else if($row['kin_emergency_relationship']=="Siblings"){
                       $kin_siblings="selected";
                   }
                   echo'    <select id="kin_emergencyrelationship" style="width:250px;">
                                        <option value="">--Please Select--</option>
                                        <option value="Spouse" '.$kin_spouse.'>Spouse</option>
                                        <option value="Son" '.$kin_son.'>Son</option>
                                        <option value="Daughter" '.$kin_daughter.'>Daughter</option>
                                        <option value="Friend" '.$kin_friend.'>Friend</option>
                                        <option value="Parents" '.$kin_parents.'>Parents</option>
                                        <option value="Siblings" '.$kin_siblings.'>Siblings</option>
                                  </select></td>';
               if ($fontColorKinErelationship == 'red') {
            
                  
                    echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' . $row['kin_emergency_relationship'] . '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'kin_contact_person\')" />
                          </td>';
            }

        echo '</tr>';

        $kin_ic_full = explode("-", $kin_ic);
        echo '<tr>
                <td style="padding-top:5px;width:200px;">Next Of Kin IC <span class="red"> *</span></td>
                <td style="padding-top:5px"><input id="KinICText1" style="width:99px" type="Text" value="' . $kin_ic_full[0] . '" maxlength="6" />&nbsp;-&nbsp;<input id="KinICText2" style="width:30px" type="Text" value="' . $kin_ic_full[1] . '" maxlength="2" />&nbsp;-&nbsp;<input id="KinICText3" style="width:99px" type="Text" value="' . $kin_ic_full[2] . '" maxlength="4" /></td>';
            if ($fontColorKinIC == 'red') {
                    echo '<td style="padding-top:5px;">
                              <a href="javscript:void()" style="width:200px;color:red;">' .$row['kin_ic']. '</a>
                          </td>
                          <td style="padding-top:6px;">
                              <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapprovePi(' . $id . ',\'kin_contact_person\')" />
                          </td>';
            }
   
        echo '</tr>';
            
		if ($resign != "0000-00-00" && $resign != "") {
				$resign = date("d-m-Y", strtotime($resign));
			} else {
				$resign = "";
			}
    echo '</tr>
            <tr style="display:none">
                <td style="padding-top:5px;width:200px">Resign Date</td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="textresign" value="'.$resign.'"';
    
    echo '" />
                </td>';
    echo '</tr>';
	 if ($last_working_day != "0000-00-00" && $last_working_day != "") {
			$last_working_day = date("d-m-Y", strtotime($last_working_day));
		} else {
			$last_working_day = "";
		}
	 echo'<tr style="display:none">
                <td style="padding-top:5px;width:200px">Last Working Day</td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="lastDateText" value="'.$last_working_day.'"';
   
    echo '" />
                </td>';

    echo '</tr>';
	 if ($officail_working_day  != "0000-00-00" && $officail_working_day  != "") {
		$officail_working_day = date("d-m-Y", strtotime($officail_working_day));
    } else {
        $officail_working_day = "";
    }
	echo'<tr style="display:none">
                <td style="padding-top:5px;width:200px">Officail Working Day </td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="offDateText" value="'.$officail_working_day.'"';
   
    echo '" />
                </td>';
    echo '</tr>';
	 echo '<tr style="display:none">
                <td style="padding-top:5px;width:200px">Reason For Resign</td>
                <td style="padding-top:5px;"><textarea rows="3" cols="37" id="reasnresign">'; 
   if ($reason_resign!= "" && $reason_resign != null) {
    print $reason_resign;
    } else {
        print "";
    }
    echo '</textarea>';
  
   echo' </td> </tr>';

  if ($officail_working_day  != "0000-00-00" && $officail_working_day  != "") {
		$officail_working_day = date("d-m-Y", strtotime($officail_working_day));
    } else {
        $officail_working_day = "";
    }
	echo'<tr style="display:none">
                <td style="padding-top:5px;width:200px">Officail Working Day </td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="offDateText" value="'.$officail_working_day.'"';
   
    echo '" />
                </td>';
    echo '</tr>';
	 if ($e_date_pk_fz  != "0000-00-00" && $e_date_pk_fz  != "") {
		$e_date_pk_fz = date("d-m-Y", strtotime($e_date_pk_fz));
    } else {
        $e_date_pk_fz = "";
    }
	$showpkfzRenewal="display:none";
	$pkfz_expiry_class="";

	if(strtotime($e_date_pk_fz) < time() && $e_date_pk_fz !=""){
		$showpkfzRenewal="";
		$pkfz_expiry_class="class='expired'";
	}
	echo'<tr>
                <td style="padding-top:5px;width:200px">PKFZ Expiry Date (Pass) </td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="e_date_pk_fz" value="'.$e_date_pk_fz.'"> &nbsp;<span style="'.$showpkfzRenewal.'"><span '.$pkfz_expiry_class.'>Expired</span>&nbsp;<input type="checkbox" name="renewpkfz" id="renewpkfz" onclick="pkfzExpiry()"> Renew</span>';
    echo '</td></tr>';
	echo '<tr id="pkfzisuuedate" style="display:none;">
                <td style="padding-top:5px;width:200px;">Issue Date (K FZ Pass)<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="pkfz_issuedate" style="width:250px" type="Text" value=""  />
                </td></tr> ';
	 if ($e_date_westport  != "0000-00-00" && $e_date_westport  != "") {
		$e_date_westport = date("d-m-Y", strtotime($e_date_westport));
    } else {
        $e_date_westport = "";
    }
	$showwestportRenewal="display:none";
	$westport_expiry_class="";

	if(strtotime($e_date_westport) < time() && $e_date_westport !=""){
		$showwestportRenewal="";
		$westport_expiry_class="class='expired'";
	}
	echo'<tr>
                <td style="padding-top:5px;width:200px">Westport Expiry Date (Pass) </td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="e_date_westport" value="'.$e_date_westport.'">&nbsp;<span style="'.$showwestportRenewal.'"><span '.$westport_expiry_class.'>Expired</span>&nbsp;<input type="checkbox" name="renewwestport" id="renewwestport" onclick="westportExpiry()"> Renew</span>';
    echo '</td></tr>';
	echo '<tr id="westportisuuedate" style="display:none;">
                <td style="padding-top:5px;width:200px;">Issue Date (Wesport Pass)<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="westport_issuedate" style="width:250px" type="Text" value=""  />
                </td></tr> ';
	 if ($e_date_johor_port  != "0000-00-00" && $e_date_johor_port  != "") {
		$e_date_johor_port = date("d-m-Y", strtotime($e_date_johor_port));
    } else {
        $e_date_johor_port = "";
    }
	$showjohorportRenewal="display:none";
	$johorport_expiry_class="";

	if(strtotime($e_date_johor_port) < time() && $e_date_johor_port !=""){
		$showjohorportRenewal="";
		$johorport_expiry_class="class='expired'";
	}
	echo'<tr>
                <td style="padding-top:5px;width:200px">Johor Port Expiry Date (Pass) </td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="e_date_johor_port" value="'.$e_date_johor_port.'">&nbsp;<span style="'.$showjohorportRenewal.'"><span '.$johorport_expiry_class.'>Expired</span>&nbsp;<input type="checkbox" name="renewpkfz" id="renewjohor" onclick="johorExpiry()"> Renew</span>';
    echo '</td></tr>';
	echo '<tr id="johorisuuedate" style="display:none;">
                <td style="padding-top:5px;width:200px;">Issue Date (Johor Port Pass)<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="johor_issuedate" style="width:250px" type="Text" value=""  />
                </td></tr> ';
	if ($e_date_ptp  != "0000-00-00" && $e_date_ptp  != "") {
		$e_date_ptp = date("d-m-Y", strtotime($e_date_ptp."+1 days"));
    } else {
        $e_date_ptp = "";
    }
	$showptpRenewal="display:none";
	$ptp_expiry_class="";

	if(strtotime($e_date_ptp) < time() && $e_date_ptp !=""){
		$showptpRenewal="";
		$ptp_expiry_class="class='expired'";
	}
	echo'<tr>
                <td style="padding-top:5px;width:200px">PTP Expiry Date (Pass) </td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="e_date_ptp" value="'.$e_date_ptp.'">&nbsp;<span style="'.$showptpRenewal.'"><span '.$ptp_expiry_class.'>Expired</span>&nbsp;<input type="checkbox" name="renewptp" id="renewptp" onclick="ptpExpiry()"> Renew</span>';
    echo '</td></tr>';
	echo '<tr id="ptpisuuedate" style="display:none;">
                <td style="padding-top:5px;width:200px;">Issue Date (PTP Pass)<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="ptp_issuedate" style="width:250px" type="Text" value=""  />
                </td></tr> ';
	if ($e_date_tlp  != "0000-00-00" && $e_date_tlp  != "") {
		$e_date_tlp = date("d-m-Y", strtotime($e_date_tlp));
    } else {
        $e_date_tlp = "";
    }
	$showtlpRenewal="display:none";
	$tlp_expiry_class="";

	if(strtotime($e_date_tlp) < time() && $e_date_tlp !=""){
		$showtlpRenewal="";
		$tlp_expiry_class="class='expired'";
	}
	echo'<tr>
                <td style="padding-top:5px;width:200px">TLP Expiry Date (Pass)</td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="e_date_tlp" value="'.$e_date_tlp.'">&nbsp;<span style="'.$showtlpRenewal.'"><span '.$tlp_expiry_class.'>Expired</span>&nbsp;<input type="checkbox" name="renewtlp" id="renewtlp" onclick="tlpExpiry()"> Renew</span>';
    echo '</td></tr>';
	   echo '<tr id="tplisuuedate" style="display:none;">
                <td style="padding-top:5px;width:200px;">Issue Date (TPL Pass)<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="tpl_issuedate" style="width:250px" type="Text" value=""  />
                </td></tr> ';
    if ($e_date_north_port  != "0000-00-00" && $e_date_north_port  != "") {
        $e_date_north_port = date("d-m-Y", strtotime($e_date_north_port));
    } else {
        $e_date_north_port = "";
    }
    $showNorthPortRenewal="display:none";
    $north_port_expiry_class="";

    if(strtotime($e_date_north_port) < time() && $e_date_north_port !=""){
        $showNorthPortRenewal="";
        $north_port_expiry_class="class='expired'";
    }
    echo'<tr>
                <td style="padding-top:5px;width:200px">North Port Expiry Date (Pass) </td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="e_date_north_port" value="'.$e_date_north_port.'">&nbsp;<span style="'.$showNorthPortRenewal.'"><span '.$north_port_expiry_class.'>Expired</span>&nbsp;<input type="checkbox" name="renewNorthPort" id="renewNorthPort" onclick="northportExpiry()"> Renew</span>';
    echo '</td></tr>';
    echo '<tr id="NorthPortisuuedate" style="display:none;">
                <td style="padding-top:5px;width:200px;">Issue Date (North Port Pass)<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <input id="NorthPort_issuedate" style="width:250px" type="Text" value=""  />
                </td></tr> ';
    echo '<tr style="display: none;">
          <td style="padding-top:6px;width:200px">Extra Information/Note</td>
          <td style="padding-top:6px;"><textarea class="input_textarea" id="noteText" style="height:50px;width:250px">' . $row['notes'] . '</textarea></td>
          </tr>';

 
    $sql1 = 'SELECT id, field_name, field_value FROM employee_info WHERE emp_id=' . $id;
    $query1 = mysql_query($sql1);
    $num_rows = mysql_num_rows($query1);
    echo '<tr>
          <td colspan="2" style="padding-top: 10px;"><span class="cursor_pointer" onclick="add_field_edit()"><img src="css/images/select.gif" alt="add" style="width: 20px; height: 20px; vertical-align: bottom;" />&nbsp;&nbsp;&nbsp;Add Information Field<span id="field_no" style="display: none;">' . $num_rows . '</span></span></td>
          </tr>
          <tr>
          <td colspan="2">
          <table id="add_field_table">';

    while ($row1 = mysql_fetch_array($query1)) {
        $i = $i + 1;
        echo '<tr id="extrainfo_' . $i . '"><td style="width: 200px;"><input type="text" id="title_' . $i . '" value="' . $row1["field_name"] . '" /></td><td><input type="text" id="value_' . $i . '" style="width: 250px;" value="' . $row1["field_value"] . '" /></td><td><img class="cursor_pointer" onclick="deleteextrainfo(' . $i . ')" src="images/button_cancel_icon.png" alt="add" style="width: 20px; height: 20px; vertical-align: bottom;" /></td></tr>';
    }
    echo '</table>
          <span id="deleteextrainfo" style="display: none;"></span>
          </td>
          </tr></table>
		  </div>
		  ';
} else {
    print false;
}
?>
<script type="text/javascript">
    function deleteextrainfo(info_id){
        $("#extrainfo_"+info_id).empty();
        $("#extrainfo_"+info_id).hide();
        $("#extrainfo_"+info_id).append("<td><input type='text' id='title_"+info_id+"' /></td><td><input type='text' id='value_"+info_id+"' /></td>");
    }
    
    function add_field_edit(){
        var field_no =  parseInt($("#field_no").html())+1;
        $("#field_no").html(field_no);
        $('#add_field_table').append("<tr><td style='width: 200px;'><input type='text' id='title_"+field_no+"' /></td><td><input type='text' id='value_"+field_no+"' style='width: 250px;' /></td></tr>");
    }
    
    $(function() {
        $("#textdob").datepicker({
            yearRange: "-100:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
	 $(function() {
        $("#confirm").datepicker({
            yearRange: "-100:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
	$(function() {
        $("#pe, #wpep, #wp_issuedate, #p_issuedate, #pkfz_issuedate, #westport_issuedate, #johor_issuedate, #ptp_issuedate, #tpl_issuedate, #NorthPort_issuedate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
    $(function() {
        $("#textjoin").datepicker({
            yearRange: "-100:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
    $(function() {
        $("#textresign").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
	$(function() {
        $("#offDateText").datepicker({
            yearRange: "-100:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
	$(function() {
        $("#lastDateText").datepicker({
            yearRange: "-100:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
		
		$("#e_date_pk_fz, #e_date_westport, #e_date_johor_port, #e_date_ptp, #e_date_tlp, #e_date_north_port").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
			minDate: '0'
        });
		
		
    });
	
	function dropSpouse(val){
			if(val=="Y"){
				$(".company_name").show();
				$("#company_name").val("<?php echo $spouseCompany; ?>");
			}else{
				$(".company_name").hide();
				$("#company_name").val("");
			}
		};
	function passExpiry(){
		if($("#renewPassport").is(":checked")){
			var pe = $("#pe").val();
			$("#passisuuedate").show();
			$("#pe").val("");
			$("#pass").val("");
		}else{
			$("#passisuuedate").hide();
			$("#pe").val();
		}
	}
	function wpExpiry(){
		var wpep =$("#wpep").val();
		if($("#renewWorkPermit").is(":checked")){
			$("#wpisuuedate").show();
			$("#wpep").val("");
			$("#wp").val("");
		}else{
			$("#wpisuuedate").hide();
			$("#wpep").val(wpep);
		}
	}
	
	function pkfzExpiry(){
		if($("#renewpkfz").is(":checked")){
			$("#pkfzisuuedate").show();
			$("#e_date_pk_fz").val("");
		}else{
			$("#pkfzisuuedate").hide();
		}
	}
	function westportExpiry(){
		if($("#renewwestport").is(":checked")){
			$("#westportisuuedate").show();
			$("#e_date_westport").val("");
		}else{
			$("#westportisuuedate").hide();
		}
	}
	function johorExpiry(){
		if($("#renewjohor").is(":checked")){
			$("#johorisuuedate").show();
			$("#e_date_johor_port").val("");
		}else{
			$("#johorisuuedate").hide();
		}
	}
	function tlpExpiry(){
		if($("#renewtlp").is(":checked")){
			$("#tplisuuedate").show();
			$("#e_date_tlp").val("");
		}else{
			$("#tplisuuedate").hide();
		}
	}
	function ptpExpiry(){
		if($("#renewptp").is(":checked")){
			$("#ptpisuuedate").show();
			$("#e_date_ptp").val("");
		}else{
			$("#ptpisuuedate").hide();
		}
	}
    function northportExpiry(){
        if($("#renewNorthPort").is(":checked")){
            $("#NorthPortisuuedate").show();
            $("#e_date_north_port").val("");
        }else{
            $("#NorthPortisuuedate").hide();
        }
    }
	
	
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>