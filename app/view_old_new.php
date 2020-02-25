<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php 

$sqlGetOld = mysql_query('SELECT * FROM employee WHERE id =' . $userID);
$rowGetOld = mysql_fetch_array($sqlGetOld);
 $epf1 =$rowGetOld['epf'];
 $socso1 =$rowGetOld['socso'];
 $pcp1 =$rowGetOld['pcp'];
 $eis =$rowGetOld['eis'];
 $cap =$rowGetOld['cap'];
$sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $userID);
$rowGetNew = mysql_fetch_array($sqlGetNew);
$rowCount = mysql_num_rows($sqlGetNew);

 
if ($rowCount > 0) {

    if ($rowGetNew['full_name'] != $rowGetOld['full_name'] && $rowGetNew['full_name'] !=null) {
        $fontColorName = 'red';
        $imgName = 'block';
        $countname = 1;
        $name = $rowGetNew['full_name'];
    } else {
        $fontColorName = null;
        $imgName = 'none';
        $countname = 0;
        $name = $rowGetOld['full_name'];
    }

	if ($rowGetNew['username'] != $rowGetOld['username'] && $rowGetNew['username']!=null) {


    $fontColoruname = 'red';
    $imguname = 'block';
    $username = $rowGetNew['username'];
} else {

     $fontColoruname = null;
    $imguname = 'none';
     $username = $rowGetOld['username'];
}
	
   
    if ($rowGetNew['ic'] != $rowGetOld['ic'] && $rowGetNew['ic'] != null) {
        $fontColorIc = 'red';
        $imgIc = 'display';
        $ic = $rowGetNew['ic'];
        $countic = 1;
    } else {
        $fontColorIc = null;
        $imgIc = 'none';
        $ic = $rowGetOld['ic'];
        $countic = 0;
    }
   
 if ($rowGetNew['passport'] != $rowGetOld['passport'] && $rowGetNew['passport'] !=null) {
        $fontColorp = 'red';
		
        $imgp = 'display';
        $passport = $rowGetNew['passport'];
        $countic = 1;
    } else {
        $fontColorp = null;
        $imgp = 'none';
        $passport = $rowGetOld['passport'];
        $countic = 0;
    }
	 
	 if ($rowGetNew['work_permit'] != $rowGetOld['work_permit'] && $rowGetNew['work_permit'] !=null) {
        $fontColorwp = 'red';
        $imgwp = 'display';
        $work_permit= $rowGetNew['work_permit'];
		
        $countwp = 1;
    } else {
        $fontColorwp= null;
        $imgwp= 'none';
        $work_permit = $rowGetOld['work_permit']; 
        $countwp = 0;
    }
	
	if ($rowGetNew['passport_expiry'] != $rowGetOld['passport_expiry'] && $rowGetNew['passport_expiry'] !="0000-00-00") {
        $fontColorpe = 'red';
        $imgpe = 'display';
        $passport_expiry= $rowGetNew['passport_expiry'];
        $countpe = 1;
    } else {
        $fontColorpe= null;
        $imgpe= 'none';
        $passport_expiry = $rowGetOld['passport_expiry'];
        $countpe = 0;
    }
	if ($rowGetNew['e_date_pk_fz'] != $rowGetOld['e_date_pk_fz'] && $rowGetNew['e_date_pk_fz'] !="0000-00-00") {
        $fontColorpk = 'red';
        $imgpk = 'display';
        $e_date_pk_fz= $rowGetNew['e_date_pk_fz'];
        $countpk = 1;
    } else {
        $fontColorpk= null;
        $imgpk= 'none';
        $e_date_pk_fz = $rowGetOld['e_date_pk_fz'];
        $countpk = 0;
    }
	if ($rowGetNew['e_date_westport'] != $rowGetOld['e_date_westport'] && $rowGetNew['e_date_westport'] !="0000-00-00") {
        $fontColorwesp = 'red';
        $imgwesp = 'display';
        $e_date_westport= $rowGetNew['e_date_westport'];
        $countwesp = 1;
    } else {
        $fontColorwesp= null;
        $imgwesp= 'none';
        $e_date_westport = $rowGetOld['e_date_westport'];
        $countwesp = 0;
    }
	if ($rowGetNew['e_date_johor_port'] != $rowGetOld['e_date_johor_port'] && $rowGetNew['e_date_johor_port'] !="0000-00-00") {
        $fontColorjohp = 'red';
        $imgjohp = 'display';
        $e_date_johor_port= $rowGetNew['e_date_johor_port'];
        $countjohp = 1;
    }else {
        $fontColorjohp= null;
        $imgjohp= 'none';
        $e_date_johor_port = $rowGetOld['e_date_johor_port'];
        $countjohp = 0;
    }
	if ($rowGetNew['e_date_ptp'] != $rowGetOld['e_date_ptp'] && $rowGetNew['e_date_ptp'] !="0000-00-00") {
        $fontColorptp = 'red';
        $imgptp = 'display';
        $e_date_ptp= $rowGetNew['e_date_ptp'];
        $countptp = 1;
    }else {
        $fontColorptp= null;
        $imgptp= 'none';
        $e_date_ptp = $rowGetOld['e_date_ptp'];
        $countptp = 0;
    }
	if ($rowGetNew['e_date_tlp'] != $rowGetOld['e_date_tlp'] && $rowGetNew['e_date_tlp'] !="0000-00-00") {
        $fontColortlp = 'red';
        $imgtlp = 'display';
        $e_date_tlp= $rowGetNew['e_date_tlp'];
        $counttlp = 1;
    }else {
        $fontColortlp= null;
        $imgtlp= 'none';
        $e_date_tlp = $rowGetOld['e_date_tlp'];
        $counttlp = 0;
    }
    if ($rowGetNew['e_date_north_port'] != $rowGetOld['e_date_north_port'] && $rowGetNew['e_date_north_port'] !="0000-00-00") {
        $fontColornorp = 'red';
        $imgnorp = 'display';
        $e_date_north_port= $rowGetNew['e_date_north_port'];
        $countnorp = 1;
    }else {
        $fontColornorp= null;
        $imgnorp= 'none';
        $e_date_north_port = $rowGetOld['e_date_north_port'];
        $countnorp = 0;
    }
	 if ($rowGetNew['country'] != $rowGetOld['country'] && $rowGetNew['country'] !=null) {
        $fontColorc = 'red';
        $imgc = 'display';
        $country= $rowGetNew['country'];
        $countc = 1;
    } else {
        $fontColorc= null;
        $imgc= 'none';
        $country = $rowGetOld['country'];
        $countc = 0;
    }

    if ($rowGetNew['phone'] != $rowGetOld['phone'] && $rowGetNew['phone'] !=null) {
        $fontColorPhone = 'red';
        $imgPhone = 'display';
        $phone = $rowGetNew['phone'];
        $countphone = 1;
    } else {
        $fontColorPhone = null;
        $imgPhone = 'none';
        $phone = $rowGetOld['phone'];
        $countphone = 0;
    }

    if ($rowGetNew['mobile'] != $rowGetOld['mobile'] && $rowGetNew['mobile'] !=null) {
        $fontColorMobile = 'red';
        $imgMobile = 'display';
        $mobile = $rowGetNew['mobile'];
        $countmobile = 1;
    } else {
        $fontColorMobile = null;
        $imgMobile = 'none';
        $mobile = $rowGetOld['mobile'];
        $countmobile = 0;
    }

    if ($rowGetNew['email'] != $rowGetOld['email'] && $rowGetNew['email'] !=null) {
        $fontColorEmail = 'red';
        $imgEmail = 'display';
        $email = $rowGetNew['email'];
        $countemail = 1;
    } else {
        $fontColorEmail = null;
        $imgEmail = 'none';
        $email = $rowGetOld['email'];
        $countemail = 0;
    }
	if ($rowGetNew['contact_person'] != $rowGetOld['contact_person'] && $rowGetNew['contact_person']!=null) {
        $fontColorcontactPerson = 'red';
        $imgcontactPerson = 'display';
        $contact_person = $rowGetNew['contact_person'];
	} else {
		$fontColorcontactPerson = null;
		$imgcontactPerson = 'none';
		$contact_person = $rowGetNew['contact_person'];
	}
	if ($rowGetNew['emergency'] != $rowGetOld['emergency'] && $rowGetNew['emergency']!=null) {
		$fontColorEmergency = 'red';
		$imgEmergency = 'display';
		$emergency = $rowGetNew['emergency'];
	} else {
		$fontColorEmergency = null;
		$imgEmergency = 'none';
		$emergency = $rowGetNew['emergency'];
	}
	if ($rowGetNew['emergency_relationship'] != $rowGetOld['emergency_relationship'] && $rowGetNew['emergency_relationship']!=null) {
		$fontColorErelationship = 'red';
		$imgErelationship= 'display';
		$emergency_relationship = $rowGetNew['emergency_relationship'];
	} else {
		$fontColorErelationship = null;
		$imgErelationship = 'none';
		$emergency_relationship = $rowGetNew['emergency_relationship'];
	}
    if ($rowGetNew['kin_contact_person'] != $rowGetOld['kin_contact_person'] && $rowGetNew['kin_contact_person']!=null) {
        $fontColorKincontactPerson = 'red';
        $imgKincontactPerson = 'display';
        $kin_contact_person = $rowGetNew['kin_contact_person'];
    } else {
        $fontColorKincontactPerson = null;
        $imgKincontactPerson = 'none';
        $kin_contact_person = $rowGetNew['kin_contact_person'];
    }
    if ($rowGetNew['kin_emergency'] != $rowGetOld['kin_emergency'] && $rowGetNew['kin_emergency']!=null) {
        $fontColorKinEmergency = 'red';
        $imgKinEmergency = 'display';
        $kin_emergency = $rowGetNew['kin_emergency'];
    } else {
        $fontColorKinEmergency = null;
        $imgKinEmergency = 'none';
        $kin_emergency = $rowGetNew['kin_emergency'];
    }
    if ($rowGetNew['kin_emergency_relationship'] != $rowGetOld['kin_emergency_relationship'] && $rowGetNew['kin_emergency_relationship']!=null) {
        $fontColorKinErelationship = 'red';
        $imgKinErelationship= 'display';
        $kin_emergency_relationship = $rowGetNew['kin_emergency_relationship'];
    } else {
        $fontColorKinErelationship = null;
        $imgKinErelationship = 'none';
        $kin_emergency_relationship = $rowGetNew['kin_emergency_relationship'];
    }
    if ($rowGetNew['kin_ic'] != $rowGetOld['kin_ic'] && $rowGetNew['kin_ic']!=null) {
        $fontColorKinIC = 'red';
        $imgKinIC= 'display';
        $kin_ic = $rowGetNew['kin_ic'];
    } else {
        $fontColorKinIC = null;
        $imgKinIC = 'none';
        $kin_ic = $rowGetNew['kin_ic'];
    }
    if ($rowGetNew['address'] != $rowGetOld['address'] && $rowGetNew['address'] !=null) {
        $fontColorMail = 'red';
        $imgAddress = 'display';
        $address = $rowGetNew['address'];
        $countaddress = 1;
    } else {
        $fontColorMail = null;
        $imgAddress = 'none';
        $address = $rowGetOld['address'];
        $countaddress = 0;
    }
    if ($rowGetNew['address1'] != $rowGetOld['address1'] && $rowGetNew['address1'] !=null) {
        $fontColorMail1 = 'red';
        $imgAddress1 = 'display';
        $address1 = $rowGetNew['address1'];
        $countaddress1 = 1;
    } else {
        $fontColorMail1 = null;
        $imgAddress1 = 'none';
        $address1 = $rowGetOld['address1'];
        $countaddress1 = 0;
    }
    if ($rowGetNew['postal_code'] != $rowGetOld['postal_code'] && $rowGetNew['postal_code'] !=null) {
        $fontPostalCode = 'red';
        $imgPostalCode = 'display';
        $postal_code = $rowGetNew['postal_code'];
        $count_postal_code = 1;
    } else {
        $fontPostalCode = null;
        $imgPostalCode = 'none';
        $postal_code = $rowGetOld['postal_code'];
        $count_postal_code = 0;
    }
    if ($rowGetNew['city'] != $rowGetOld['city'] && $rowGetNew['city'] !=null) {
        $fontCity = 'red';
        $imgCity = 'display';
        $city = $rowGetNew['city'];
        $count_city= 1;
    } else {
        $fontCity = null;
        $imgCity = 'none';
        $city = $rowGetOld['city'];
        $count_city = 0;
    }
    if ($rowGetNew['state'] != $rowGetOld['state'] && $rowGetNew['state'] !=null) {
        $fontState = 'red';
        $imgState = 'display';
        $state = $rowGetNew['state'];
        $count_state= 1;
    } else {
        $fontState = null;
        $imgState = 'none';
        $state = $rowGetOld['state'];
        $count_state = 0;
    }
    if ($rowGetNew['adrsCountry'] != $rowGetOld['adrsCountry'] && $rowGetNew['adrsCountry'] !=null) {
        $fontAdrsCountry = 'red';
        $imgAdrsCountry = 'display';
        $adrsCountry = $rowGetNew['adrsCountry'];
        $count_adrsCountry= 1;
    } else {
        $fontAdrsCountry = null;
        $imgAdrsCountry = 'none';
        $adrsCountry = $rowGetOld['adrsCountry'];
        $count_adrsCountry = 0;
    }

    if ($rowGetNew['gender'] != $rowGetOld['gender'] && $rowGetNew['gender'] !=null) {
        $fontColorGender = 'red';
        $imgGender = 'display';
        $gender = $rowGetNew['gender'];
        $countgender = 1;
    } else {
        $fontColorGender = null;
        $imgGender = 'none';
        $gender = $rowGetOld['gender'];
        $countgender = 0;
    }

    if ($rowGetNew['race'] != $rowGetOld['race'] && $rowGetNew['race'] !=null) {
        $fontColorRace = 'red';
        $imgRace = 'display';
        $race = $rowGetNew['race'];
        $countrace = 1;
    } else {
        $fontColorRace = null;
        $imgRace = 'none';
        $race = $rowGetOld['race'];
        $countrace = 0;
    }

    if ($rowGetNew['religion'] != $rowGetOld['religion'] && $rowGetNew['religion'] !=null) {
        $fontColorReligion = 'red';
        $imgReligion = 'display';
        $religion = $rowGetNew['religion'];
        $countreligion = 1;
    } else {
        $fontColorReligion = null;
        $imgReligion = 'none';
        $religion = $rowGetOld['religion'];
        $countreligion = 0;
    }

    if ($rowGetNew['marital'] != $rowGetOld['marital'] && $rowGetNew['marital'] !=null) {
        $fontColorMarital = 'red';
        $imgMarital = 'display';
        $marital = $rowGetNew['marital'];
        $countmarital = 1;
    } else {
        $fontColorMarital = null;
        $imgMarital = 'none';
        $marital = $rowGetOld['marital'];
        $countmarital = 0;
    }

    if ($rowGetNew['spouse_work'] != $rowGetOld['spouse_work'] && $rowGetNew['spouse_work'] != null) {
        $fontColorSpouse = 'red';
        $imgSpouse = 'display';
        $spouseWork = $rowGetNew['spouse_work'];
        $countspouse = 1;
    } else {
        $fontColorSpouse = null;
        $imgSpouse = 'none';
        $spouseWork = $rowGetOld['spouse_work'];
        $countspouse = 0;
    }
	 if ($rowGetNew['spouse_name'] != $rowGetOld['spouse_name'] && $rowGetNew['spouse_name'] != null) {
        $fontColorSpouseName = 'red';
        $fontColorSpouseName = 'display';
        $spouseName = $rowGetNew['spouse_name'];
        $countspouseName = 1;
    } else {
        $fontColorSpouseName = null;
        $fontColorSpouseName = 'none';
        $spouseName = $rowGetOld['spouse_name'];
        $countspouseName = 0;
    }
	if ($rowGetNew['spouse_company'] != $rowGetOld['spouse_company'] && $rowGetNew['spouse_company'] != null) {
        $fontColorSpouseCompany = 'red';
        $imgSpouseCompany = 'display';
        $spouseCompany = $rowGetNew['spouse_company'];
        $countspouseCompany = 1;
    } else {
        $fontColorSpouseCompany = null;
        $imgSpouseCompany = 'none';
        $spouseCompany = $rowGetOld['spouse_company'];
        $countspouseCompany = 0;
    }
    if ($rowGetNew['dob'] != $rowGetOld['dob'] && $rowGetNew['dob'] !=null) {
        $fontColorDob = 'red';
        $imgDob = 'display';
        $dob = $rowGetNew['dob'];
        $countdob = 1;
    } else {
        $fontColorDob = null;
        $imgDob = 'none';
        $dob = $rowGetOld['dob'];
        $countdob = 0;
    }

    if ($rowGetNew['num_of_kids'] != $rowGetOld['num_of_kids'] && $rowGetNew['num_of_kids'] !=0) {
        $fontColorChild = 'red';
        $imgChild = 'display';
        $child = $rowGetNew['num_of_kids'];
        $countkid = 1;
    } else {
        $fontColorChild = null;
        $imgChild = 'none';
        $child = $rowGetOld['num_of_kids'];
        $countkid = 0;
    }

    if ($rowGetNew['join_date'] != $rowGetOld['join_date'] && $rowGetNew['join_date'] !=null) {
        $fontColorJoin = 'red';
        $imgJoin = 'display';
        $join = $rowGetNew['join_date'];
        $countjoin = 1;
    } else {
        $fontColorJoin = null;
        $imgJoin = 'none';
        $join = $rowGetOld['join_date'];
        $countjoin = 0;
    }

    if ($rowGetNew['resign_date'] != $rowGetOld['resign_date'] && $rowGetNew['resign_date'] !=null) {
        $fontColorResign = 'red';
        $imgResign = 'display';
        $resign = $rowGetNew['resign_date'];
        $countresign = 1;
    } else {
        $fontColorResign = null;
        $imgResign = 'none';
        $resign = $rowGetOld['resign_date'];
        $countresign = 0;
    }
	if ($rowGetNew['reasign_reason'] != $rowGetOld['reasign_reason'] && $rowGetNew['reasign_reason'] !=null) {
        $fontColorReason = 'red';
        $imgResign = 'display';
        $resign_reason = $rowGetNew['reasign_reason'];
        $countresign = 1;
    } else {
        $fontColorReason = null;
        $imgResign = 'none';
        $resign_reason = $rowGetOld['reasign_reason']; 
        $countresign = 0;
    }
	if ($rowGetNew['last_working_day'] != $rowGetOld['last_working_day'] && $rowGetNew['last_working_day'] !=null) {
        //$fontColorlast = 'red';
        //$imgResign = 'display';
        $last_working_day = $rowGetNew['last_working_day'];
        $countresign = 1;
    } else {
        $fontColorlast = null;
        $imgResign = 'none';
        $last_working_day = $rowGetOld['last_working_day'];
        $countresign = 0;
    }
	if ($rowGetNew['officail_working_day'] != $rowGetOld['officail_working_day'] && $rowGetNew['officail_working_day'] != null) {
        //$fontColoroff = 'red';
        //$imgResign = 'display';
        $officail_working_day = $rowGetNew['officail_working_day'];
        $countresign = 1;
    } else {
        $fontColoroff = null;
        $imgResign = 'none';
        $officail_working_day = $rowGetOld['officail_working_day'];
        $countresign = 0;
    }

    if ($rowGetNew['zakat'] != $rowGetOld['zakat'] && $rowGetNew['zakat'] !=null) {
        $fontColorZakat = 'red';
        $imgZakat = 'display';
        $zakat = $rowGetNew['zakat'];
        $countzakat = 1;
    } else {
        $fontColorZakat = null;
        $imgZakat = 'none';
        $zakat = $rowGetOld['zakat'];
        $countzakat = 0;
    }

    if ($rowGetNew['epf_num'] != $rowGetOld['epf_num'] && $rowGetNew['epf_num'] !=null) {
        $fontColorEpf = 'red';
        $imgEpf = 'display';
        $epf = $rowGetNew['epf_num'];
        $countepf = 1;
    } else {
        $fontColorEpf = null;
        $imgEpf = 'none';
        $epf = $rowGetOld['epf_num'];
        $countepf = 0;
    }

    if ($rowGetNew['socso_num'] != $rowGetOld['socso_num'] && $rowGetNew['socso_num'] != null) {
        $fontColorSocso = 'red';
        $imgSocso = 'display';
        $socso = $rowGetNew['socso_num'];
        $countsocso = 1;
    } else {
        $fontColorSocso = null;
        $imgSocso = 'none';
        $socso = $rowGetOld['socso_num'];
        $countsocso = 0;
    }

    if ($rowGetNew['income_tax_num'] != $rowGetOld['income_tax_num'] && $rowGetNew['income_tax_num'] !=null) {
        $fontColorItax = 'red';
        $imgItax = 'display';
        $iTax = $rowGetNew['income_tax_num'];
        $countitax = 1;
    } else {
        $fontColorItax = null;
        $imgItax = 'none';
        $iTax = $rowGetOld['income_tax_num'];
        $countitax = 0;
    }

    if ($rowGetNew['bank_acc_id'] != $rowGetOld['bank_acc_id'] && $rowGetNew['bank_acc_id'] !=null) {
        $fontColorBank = 'red';
        $imgBank = 'display';
        $bank = $rowGetNew['bank_acc_id'];
        $countbank = 1;
    } else {
        $fontColorBank = null;
        $imgBank = 'none';
        $bank = $rowGetOld['bank_acc_id'];
        $countbank = 0;
    }

    if ($rowGetNew['bank_acc_num'] != $rowGetOld['bank_acc_num'] && $rowGetNew['bank_acc_num'] !=null) {
        $fontColorBankNum = 'red';
        $imgBankNum = 'display';
        $bankNum = $rowGetNew['bank_acc_num'];
        $countbanknum = 1;
    } else {
        $fontColorBankNum = null;
        $imgBankNum = 'none';
        $bankNum = $rowGetOld['bank_acc_num'];
        $countbanknum = 0;
    }

    $totaledit = $countname + $countic + $countphone + $countaddress + $countaddress1 + $count_postal_code + $count_city + $count_state + $count_adrsCountry + $countdob + $countemail + $countgender + $countjoin + $countkid + $countmarital + $countmobile + $countrace + $countreligion + $countresign + $countspouse + $countzakat + $countepf + $countsocso + $countitax + $countbank + $countbanknum;
    $topedit = $countname;
    $piedit = $countic + $countphone + $countaddress + $countaddress1 + $count_postal_code + $count_city + $count_state + $count_adrsCountry + $countdob + $countemail + $countgender + $countjoin + $countkid + $countmarital + $countmobile + $countrace + $countreligion + $countresign + $countspouse;
    $saledit = $countzakat + $countepf + $countsocso + $countitax + $countbank + $countbanknum;
} else {

    $name = $rowGetOld['full_name'];
	
    $ic = $rowGetOld['ic'];
	
	$passport = $rowGetOld['passport'];
	$passport_expiry = $rowGetOld['passport_expiry'];
	$work_permit= $rowGetOld['work_permit'];
	$work_permit_expiry = $rowGetOld['work_permit_expirty'];
    $phone = $rowGetOld['phone'];
    $mobile = $rowGetOld['mobile'];
    $email = $rowGetOld['email'];
    $address = $rowGetOld['address'];
    $address1 = $rowGetOld['address1'];
    $postal_code = $rowGetOld['postal_code'];
    $city = $rowGetOld['city'];
    $state = $rowGetOld['state'];
    $adrsCountry = $rowGetOld['adrsCountry'];
    $gender = $rowGetOld['gender'];
    $race = $rowGetOld['race'];
    $religion = $rowGetOld['religion'];
    $marital = $rowGetOld['marital'];
	$spouse_name=$rowGetOld['spouse_name'];
    $spouseWork = $rowGetOld['spouse_work'];
	$spouseCompany = $rowGetOld['spouse_company'];
    $dob = $rowGetOld['dob'];
    $child = $rowGetOld['num_of_kids'];
    $join = $rowGetOld['join_date'];
	$confirm_date = $rowGetOld['confirm_date'];
    $resign = $rowGetOld['resign_date'];
    $zakat = $rowGetOld['zakat'];
    $epf = $rowGetOld['epf_num'];
    $socso = $rowGetOld['socso_num'];
    $iTax = $rowGetOld['income_tax_num'];
    $bank = $rowGetOld['bank_acc_id'];
    $bankNum = $rowGetOld['bank_acc_num'];
	$country = $rowGetOld['country'];
	$username = $rowGetOld['username'];
	$contact_person = $rowGetOld['contact_person'];
	$emergency = $rowGetOld['emergency'];
	$emergency_relationship = $rowGetOld['emergency_relationship'];
    $kin_contact_person = $rowGetOld['kin_contact_person'];
    $kin_emergency = $rowGetOld['kin_emergency'];
    $kin_emergency_relationship = $rowGetOld['kin_emergency_relationship'];
    $kin_ic = $rowGetOld['kin_ic'];
	$e_date_pk_fz = $rowGetOld['e_date_pk_fz'];
	$e_date_westport = $rowGetOld['e_date_westport'];
	$e_date_johor_port = $rowGetOld['e_date_johor_port'];
	$e_date_ptp = $rowGetOld['e_date_ptp'];
	$e_date_tlp = $rowGetOld['e_date_tlp'];
    $e_date_north_port = $rowGetOld['e_date_north_port'];
	$fontColorpk= null;
    $fontColoruname = null;
    $fontColorName = null;
    $fontColorIc = null;
	$fontColorc = null;
	 $fontColorwp = null;
	  $fontColorpe = null;
	  $fontColorp = null;
    $fontColorPhone = null;
    $fontColorMobile = null;
    $fontColorEmail = null;
    $fontColorMail = null;
    $fontColorMail1 = null;
    $fontPostalCode = null;
    $fontCity = null;
    $fontState = null;
    $fontAdrsCountry = null;
    $fontColorGender = null;
    $fontColorRace = null;
    $fontColorReligion = null;
    $fontColorMarital = null;
    $fontColorSpouse = null;
    $fontColorDob = null;
    $fontColorChild = null;
    $fontColorJoin = null;
    $fontColorResign = null;
    $fontColorZakat = null;
    $fontColorEpf = null;
    $fontColorSocso = null;
    $fontColorItax = null;
    $fontColorBank = null;
    $fontColorBankNum = null;
	$fontColorwesp= null;
	$fontColorjohp= null;
	$fontColorptp= null;
	$fontColortlp= null;
    $fontColornorp= null;
	
}

?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>