<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

if ($rowGetNew['full_name'] != $rowGetOld['full_name'] && $rowGetNew['full_name']!=null) {
    $fontColorName = 'red';
    $imgName = 'block';
    $name = $rowGetNew['full_name'];
} else {
    $fontColorName = null;
    $imgName = 'none';
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

if ($rowGetNew['ic'] != $rowGetOld['ic'] && $rowGetNew['ic']!=null) {
    $fontColorIc = 'red';
    $imgIc = 'display';
    $ic = $rowGetNew['ic'];
} else {
    $fontColorIc = null;
    $imgIc = 'none';
    $ic = $rowGetOld['ic'];
}
 if ($rowGetNew['passport'] != $rowGetOld['passport'] && $rowGetNew['passport']!=null) {
        $fontColorp = 'red';
        $imgp = 'display';
        $passport = $rowGetNew['passport'];
        $countp = 1;
    } else {
        $fontColorp = null;
        $imgp = 'none';
        $passport = $rowGetOld['passport'];
        $countp = 0;
    }
	 
	 if ($rowGetNew['work_permit'] != $rowGetOld['work_permit'] && $rowGetNew['work_permit']!=null) {
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
	
		 if ($rowGetNew['passport_expiry'] != $rowGetOld['passport_expiry'] && ($rowGetNew['passport_expiry']!=null)) {
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
	 if ($rowGetNew['country'] != $rowGetOld['country'] && $rowGetNew['country']!=null) {
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

if ($rowGetNew['phone'] != $rowGetOld['phone'] && $rowGetNew['phone']!=null) {
    $fontColorPhone = 'red';
    $imgPhone = 'display';
    $phone = $rowGetNew['phone'];
} else {
    $fontColorPhone = null;
    $imgPhone = 'none';
    $phone = $rowGetOld['phone'];
}

if ($rowGetNew['mobile'] != $rowGetOld['mobile'] && $rowGetNew['mobile']!=null) {
    $fontColorMobile = 'red';
    $imgMobile = 'display';
    $mobile = $rowGetNew['mobile'];
} else {
    $fontColorMobile = null;
    $imgMobile = 'none';
    $mobile = $rowGetOld['mobile'];
}

if ($rowGetNew['email'] != $rowGetOld['email'] && $rowGetNew['email']!=null) {
    $fontColorEmail = 'red';
    $imgEmail = 'display';
    $email = $rowGetNew['email'];
} else {
    $fontColorEmail = null;
    $imgEmail = 'none';
    $email = $rowGetOld['email'];
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

if ($rowGetNew['address'] != $rowGetOld['address']) {
    $fontColorMail = 'red';
    $imgAddress = 'display';
    $address = $rowGetNew['address'];
} else {
    $fontColorMail = null;
    $imgAddress = 'none';
    $address = $rowGetOld['address'];
}

if ($rowGetNew['gender'] != $rowGetOld['gender'] && $rowGetNew['gender']!=null) {
    $fontColorGender = 'red';
    $imgGender = 'display';
    $gender = $rowGetNew['gender'];
} else {
    $fontColorGender = null;
    $imgGender = 'none';
    $gender = $rowGetOld['gender'];
}

if ($rowGetNew['race'] != $rowGetOld['race'] && $rowGetNew['race']!=null) {
    $fontColorRace = 'red';
    $imgRace = 'display';
    $race = $rowGetNew['race'];
} else {
    $fontColorRace = null;
    $imgRace = 'none';
    $race = $rowGetOld['race'];
}

if ($rowGetNew['religion'] != $rowGetOld['religion'] && $rowGetNew['religion']!=null) {
    $fontColorReligion = 'red';
    $imgReligion = 'display';
    $religion = $rowGetNew['religion'];
} else {
    $fontColorReligion = null;
    $imgReligion = 'none';
    $religion = $rowGetOld['religion'];
}

if ($rowGetNew['marital'] != $rowGetOld['marital'] && $rowGetNew['marital']!=null) {
    $fontColorMarital = 'red';
    $imgMarital = 'display';
    $marital = $rowGetNew['marital'];
} else {
    $fontColorMarital = null;
    $imgMarital = 'none';
    $marital = $rowGetOld['marital'];
}

if ($rowGetNew['spouse_work'] != $rowGetOld['spouse_work'] && $rowGetNew['spouse_work']!=null) {
    $fontColorSpouse = 'red';
    $imgSpouse = 'display';
    $spouseWork = $rowGetNew['spouse_work'];
} else {
    $fontColorSpouse = null;
    $imgSpouse = 'none';
    $spouseWork = $rowGetOld['spouse_work'];
}

if ($rowGetNew['spouse_company'] != $rowGetOld['spouse_company'] && $rowGetNew['spouse_company']!=null) {
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

if ($rowGetNew['dob'] != $rowGetOld['dob'] && $rowGetNew['dob']!=null) {
    $fontColorDob = 'red';
    $imgDob = 'display';
    $dob = $rowGetNew['dob'];
} else {
    $fontColorDob = null;
    $imgDob = 'none';
    $dob = $rowGetOld['dob'];
}

if ($rowGetNew['num_of_kids'] != $rowGetOld['num_of_kids'] && $rowGetNew['num_of_kids']!=0) {
    $fontColorChild = 'red';
    $imgChild = 'display';
    $child = $rowGetNew['num_of_kids'];
} else {
    $fontColorChild = null;
    $imgChild = 'none';
    $child = $rowGetOld['num_of_kids'];
}

if ($rowGetNew['join_date'] != $rowGetOld['join_date'] && $rowGetNew['join_date']!=null) {
    $fontColorJoin = 'red';
    $imgJoin = 'display';
    $join = $rowGetNew['join_date'];
} else {
    $fontColorJoin = null;
    $imgJoin = 'none';
    $join = $rowGetOld['join_date'];
}

if ($rowGetNew['resign_date'] != $rowGetOld['resign_date'] && $rowGetNew['resign_date']!=null) {
    $fontColorResign = 'red';
    $imgResign = 'display';
    $resign = $rowGetNew['resign_date'];
} else {
    $fontColorResign = null;
    $imgResign = 'none';
    $resign = $rowGetOld['resign_date'];
}

if ($rowGetNew['profile'] != $rowGetOld['profile'] && $rowGetNew['profile']!=null) {
    $fontColorProfile = 'red';
    $imgProfile = 'display';
    $profile = $rowGetNew['profile'];
} else {
    $fontColorProfile = null;
    $imgProfile = 'none';
    $profile = $rowGetOld['profile'];
}

if ($rowGetNew['zakat'] != $rowGetOld['zakat'] && $rowGetNew['zakat']!=null) {
    $fontColorZakat = 'red';
    $imgZakat = 'display';
    $zakat = $rowGetNew['zakat'];
} else {
    $fontColorZakat = null;
    $imgZakat = 'none';
    $zakat = $rowGetOld['zakat'];
}

if ($rowGetNew['epf_num'] != $rowGetOld['epf_num'] && $rowGetNew['epf_num']!=null) {
    $fontColorEpf = 'red';
    $imgEpf = 'display';
    $epf = $rowGetNew['epf_num'];
} else {
    $fontColorEpf = null;
    $imgEpf = 'none';
    $epf = $rowGetOld['epf_num'];
}

if ($rowGetNew['socso_num'] != $rowGetOld['socso_num'] && $rowGetNew['socso_num']!=null) {
    $fontColorSocso = 'red';
    $imgSocso = 'display';
    $socso = $rowGetNew['socso_num'];
} else {
    $fontColorSocso = null;
    $imgSocso = 'none';
    $socso = $rowGetOld['socso_num'];
}

if ($rowGetNew['income_tax_num'] != $rowGetOld['income_tax_num'] && $rowGetNew['income_tax_num']!=null) {
    $fontColorItax = 'red';
    $imgItax = 'display';
    $iTax = $rowGetNew['income_tax_num'];
} else {
    $fontColorItax = null;
    $imgItax = 'none';
    $iTax = $rowGetOld['income_tax_num'];
}

if ($rowGetNew['bank_acc_id'] != $rowGetOld['bank_acc_id'] && $rowGetNew['bank_acc_id']!=null) {
    $fontColorBank = 'red';
    $imgBank = 'display';
    $bank = $rowGetNew['bank_acc_id'];
} else {
    $fontColorBank = null;
    $imgBank = 'none';
    $bank = $rowGetOld['bank_acc_id'];
}

if ($rowGetNew['bank_acc_num'] != $rowGetOld['bank_acc_num'] && $rowGetNew['bank_acc_num']!=null) {
    $fontColorBankNum = 'red';
    $imgBankNum = 'display';
    $bankNum = $rowGetNew['bank_acc_num'];
} else {
    $fontColorBankNum = null;
    $imgBankNum = 'none';
    $bankNum = $rowGetOld['bank_acc_num'];
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