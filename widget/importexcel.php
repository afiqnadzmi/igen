<?php

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$uploaddir = 'tmp/';
$file = basename($_FILES['excel_file']['name']);
$new_path = $uploaddir . basename($_FILES['excel_file']['name']);

if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $new_path)) {
    parseExcel($new_path);
    if ($error_list) {
        header("location:?loc=import_excel&m=error&e=" . $error_list);
    } else if ($empty) {
        header("location:?loc=import_excel&m=ept");
    } else {
        header("location:?loc=import_excel&m=done");
    }
} else {
    header("location:?loc=import_excel&m=error");
}

function parseExcel($excel_file_name_with_path) {
    $data = new Spreadsheet_Excel_Reader();
    global $error_list, $empty;
    $data->setUTFEncoder('iconv');
    $data->setOutputEncoding('UTF-8'); //UTF-8
    $data->read($excel_file_name_with_path);
  $j=200;
    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
       /* if (
                $data->sheets[0]['cells'][$i][1] != "" &&
                $data->sheets[0]['cells'][$i][2] != "" &&
                $data->sheets[0]['cells'][$i][3] != "" &&
                $data->sheets[0]['cells'][$i][4] != "" &&
                $data->sheets[0]['cells'][$i][5] != "" &&
                $data->sheets[0]['cells'][$i][6] != "" &&
                $data->sheets[0]['cells'][$i][7] != "" &&
                $data->sheets[0]['cells'][$i][8] != "" &&
                $data->sheets[0]['cells'][$i][9] != "" &&
                $data->sheets[0]['cells'][$i][10] != "" &&
               // $data->sheets[0]['cells'][$i][11] != "" &&
                //$data->sheets[0]['cells'][$i][12] != "" &&
                $data->sheets[0]['cells'][$i][13] != "" &&
                $data->sheets[0]['cells'][$i][14] != "" &&
                $data->sheets[0]['cells'][$i][15] != "" &&
                $data->sheets[0]['cells'][$i][16] != "" &&
                $data->sheets[0]['cells'][$i][17] != "" &&
                $data->sheets[0]['cells'][$i][18] != "" &&
                $data->sheets[0]['cells'][$i][19] != "" &&
                $data->sheets[0]['cells'][$i][20] != "" &&
				$data->sheets[0]['cells'][$i][21] != "" &&
				$data->sheets[0]['cells'][$i][22] != "" &&
				$data->sheets[0]['cells'][$i][23] != "" &&
				$data->sheets[0]['cells'][$i][24] != "" &&
				$data->sheets[0]['cells'][$i][25] != "" &&
				$data->sheets[0]['cells'][$i][26] != "" &&
                $data->sheets[0]['cells'][$i][27] != ""
        ) {*/
            // A 
			
            $full_name = $data->sheets[0]['cells'][$i][1];
			$nationality = $data->sheets[0]['cells'][$i][2];
            $ic = $data->sheets[0]['cells'][$i][3];
			$dob = $data->sheets[0]['cells'][$i][4];
			$gender = $data->sheets[0]['cells'][$i][5];
			$race = $data->sheets[0]['cells'][$i][6];
			$religion = $data->sheets[0]['cells'][$i][7];
			$marital = $data->sheets[0]['cells'][$i][8];
			$join_date = $data->sheets[0]['cells'][$i][9];
			$confirm_date = $data->sheets[0]['cells'][$i][10];
			$passport_no = $data->sheets[0]['cells'][$i][11];
			$passport_expiry = $data->sheets[0]['cells'][$i][12];
            $mobile = $data->sheets[0]['cells'][$i][13];
			$emergency= $data->sheets[0]['cells'][$i][14];
			$emergency_num= $data->sheets[0]['cells'][$i][15];
			$emergency_relationship= $data->sheets[0]['cells'][$i][16];
			$email = $data->sheets[0]['cells'][$i][17];
            $address = $data->sheets[0]['cells'][$i][18];
			$spuse_name = $data->sheets[0]['cells'][$i][19];
			$spouse_work = $data->sheets[0]['cells'][$i][20];
			$spouse_company = $data->sheets[0]['cells'][$i][21];
			$num_of_child = $data->sheets[0]['cells'][$i][22];
    
          
            
           //B
            $username = $data->sheets[0]['cells'][$i][23];
			$username="baiduri".$j."@baiduridimensi.com";
			$pwd=md5("123456");
            $emp_status_id = $data->sheets[0]['cells'][$i][24];
			$company_id = $data->sheets[0]['cells'][$i][25];
            $branch_id = $data->sheets[0]['cells'][$i][26];
            $dep_id = $data->sheets[0]['cells'][$i][27];
            $group_id = $data->sheets[0]['cells'][$i][28];
            $position_id = $data->sheets[0]['cells'][$i][29];
            $shift_id = $data->sheets[0]['cells'][$i][30];
            $permission_id = $data->sheets[0]['cells'][$i][31];
			$leave_group_id = $data->sheets[0]['cells'][$i][32];
			$value=$ic;
             $fir6=substr($value, 0, 6);
            $mid2=substr($value, 6, 2);
            $last4=substr($value, 8, 4);
             
             /*$ic=$fir6."-".$mid2."-".$last4;*/
			 $epf="Y";
			 $socso="Y";
			 $pcp="Y";
          
            // C
            $contract = $data->sheets[0]['cells'][$i][33];
            $salary_type_id = $data->sheets[0]['cells'][$i][34];
			$payment_type = $data->sheets[0]['cells'][$i][35];
			$bank_type = $data->sheets[0]['cells'][$i][36];
			$bank_num = $data->sheets[0]['cells'][$i][37];
            $salary_amount = $data->sheets[0]['cells'][$i][38];
			$salary_amount=str_replace (",", "", $salary_amount);
			$epf_number = $data->sheets[0]['cells'][$i][39];
			$socso_number = $data->sheets[0]['cells'][$i][40];
			$incomeTax_num = $data->sheets[0]['cells'][$i][41];
			$zakat_amount = $data->sheets[0]['cells'][$i][42];
			$work_permit = $data->sheets[0]['cells'][$i][43];
			$pkfz_expiry_pass = $data->sheets[0]['cells'][$i][44];
			$westPort_expiry_pass = $data->sheets[0]['cells'][$i][45];
			$johorPort_expiry_pass = $data->sheets[0]['cells'][$i][46];
			$ptp_expiry_pass = $data->sheets[0]['cells'][$i][47];
			$tpl_expiry_pass = $data->sheets[0]['cells'][$i][48];
			$employeeID_new = $data->sheets[0]['cells'][$i][49];
			$employeeID_old = $data->sheets[0]['cells'][$i][50];
            
            $dateOfDay = date("Y-m-d");
            $dateOfBirth = $dob;

            $yearOfDay = substr($dateOfDay, 0, 4);
            $yearOfBirth = substr($dateOfBirth, 0, 4);
            $age = $yearOfDay - $yearOfBirth;
            $realAge = abs($age);

            if ($realAge >= 55) {
                $category2 = 'Y';
            } else {
                $category2 = 'N';
            }

            /*$queryGetCompany = mysql_query('SELECT company_id FROM branch WHERE id = ' . $branch_id);
            $rowGetCompany = mysql_fetch_array($queryGetCompany);
            $company_id = $rowGetCompany["company_id"];*/

            $table = "employee";
            $key = array();
            $values = array();
            //A1
			$key[] = "id";
            $values[] = insertvalue($employeeID_new);
            $key[] = "full_name";
            $values[] = insertvalue($full_name);
			$key[] = "country";
            $values[] = insertvalue($nationality);
            $key[] = "ic";
            $values[] = insertvalue($ic);
            $key[] = "pwd";
            $values[] = insertvalue($pwd);
			$key[] = "passport";
            $values[] = insertvalue($passport_no);
            $key[] = "mobile";
            $values[] = insertvalue($mobile);
            $key[] = "contact_person";
            $values[] = insertvalue($emergency);
            $key[] = "emergency";
            $values[] = insertvalue($emergency_num);			
            $key[] = "email";
            $values[] = insertvalue($email);
            $key[] = "gender";
            $values[] = insertvalue($gender);
            $key[] = "race";
            $values[] = insertvalue($race);
            $key[] = "religion";
            $values[] = insertvalue($religion);
            $key[] = "marital";
            $values[] = insertvalue($marital); 
            $key[] = "spouse_name";
            $values[] = insertvalue($spuse_name);			
            $key[] = "spouse_work";
            $values[] = insertvalue($spouse_work);
			$key[] = "num_of_kids";
            $values[] = insertvalue($num_of_child);
            $key[] = "dob";
			  $dob=insertdate($dob);
            $values[] = insertvalue($dob);
            $key[] = "join_date";
            $join_date = insertdate($join_date);
			$values[] = insertvalue($join_date);
            $key[] = "image_src";
            $values[] = insertvalue("images/Gra_ProfilePhoto.png");
            $key[] = "category2";
            $values[] = insertvalue($category2);

            //B1
            $key[] = "username";
            $values[] = insertvalue($username);
			$key[] = "address";
            $values[] = insertvalue($address);
            $key[] = "emp_status";
            $values[] = insertvalue($emp_status_id);
            $key[] = "company_id";
            $values[] = insertvalue($company_id);
            $key[] = "branch_id";
            $values[] = insertvalue($branch_id);
            $key[] = "dep_id";
            $values[] = insertvalue($dep_id);
            $key[] = "group_id";
            $values[] = insertvalue($group_id);
            $key[] = "position_id";
            $values[] = insertvalue($position_id);
             $key[] = "group_for_leave_id";
            $values[] = insertvalue($leave_group_id); 			
            $key[] = "shift_id";
            $values[] = insertvalue($shift_id);
            $key[] = "level_id";
            $values[] = insertvalue($permission_id);
			 $key[] = "epf";
            $values[] = insertvalue($epf);
			 $key[] = "socso";
            $values[] = insertvalue($socso);
			 $key[] = "pcp";
            $values[] = insertvalue($pcp);

            //C1
            $key[] = "is_contract";
            $values[] = insertvalue($contract);
            $key[] = "salary_type";
            $values[] = insertvalue($salary_type_id);
			$key[] = "payment_type";
            $values[] = insertvalue($payment_type);
			$key[] = "bank_acc_id";
            $values[] = insertvalue($bank_type);
			$key[] = "bank_acc_num";
            $values[] = insertvalue($bank_num);
            $key[] = "salary";
            $values[] = insertvalue($salary_amount);
			$key[] = "epf_num";
            $values[] = insertvalue($epf_number);
			$key[] = "socso_num";
            $values[] = insertvalue($socso_number);
			$key[] = "income_tax_num";
            $values[] = insertvalue($incomeTax_num);
			$key[] = "zakat";
            $values[] = insertvalue($zakat_amount);
			$key[] = "e_date_pk_fz";
            $values[] = insertvalue($pkfz_expiry_pass);
			$key[] = "e_date_westport";
            $values[] = insertvalue($westPort_expiry_pass);
			$key[] = "e_date_johor_port";
            $values[] = insertvalue($johorPort_expiry_pass);
			$key[] = "e_date_ptp";
            $values[] = insertvalue($ptp_expiry_pass);
			$key[] = "e_date_tlp";
            $values[] = insertvalue($tpl_expiry_pass);
            $key[] = "emp_old_id";
            $values[] = insertvalue($employeeID_old);
            $keysdata = join(",", $key);
            $valuedata = join(",", $values); 

            $sql = "select * from employee where username='" . $username . "'";
            if (mysql_num_rows(mysql_query($sql)) > 0) {
                $error_list .= $username . ",";
            } else {
		
                $id = insert_importexcel($table, $keysdata, $valuedata);

                $table1 = "emp_promotion";
                $key1 = array();
                $values1 = array();
                $key1[] = "emp_id";
                $values1[] = insertvalue($id);
                $key1[] = "date_updated";
                $values1[] = insertvalue(date('Y-m-d'));
                $key1[] = "position_id";
                $values1[] = insertvalue($position_id);
                $key1[] = "salary";
                $values1[] = insertvalue($salary_amount);

                $keysdata1 = join(",", $key1);
                $valuedata1 = join(",", $values1);

                insert($table1, $keysdata1, $valuedata1);
            }
			 $j++;
        /*} else {
            $empty .= $i . ",";
        }*/
    }
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>