<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
set_time_limit(0);
$uploaddir = 'tmp/';
$file = basename($_FILES['excel_file']['name']);
$new_path = $uploaddir . basename($_FILES['excel_file']['name']);

if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $new_path)) {
    parseExcel($new_path);
    header("location:?loc=import_pcb&m=done");
} else {
    header("location:?loc=import_pcb&m=error");
}



function parseExcel($excel_file_name_with_path) {
    //$d_sql = 'delete from employee_pcb';
   // $d_rs = mysql_query($d_sql);

    $data = new Spreadsheet_Excel_Reader();

    $data->setUTFEncoder('iconv');
    $data->setOutputEncoding('UTF-8'); //UTF-8
    $data->read($excel_file_name_with_path);
   // delete("employee_pcb");

    for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {
        if ($data->sheets[0]['cells'][$i][1] != "") {
            $from_amt = $data->sheets[0]['cells'][$i][1];
            $to_amt = $data->sheets[0]['cells'][$i][2];
			
         if($from_amt <= 86085){ // Salary is less than 86086
			$single = $data->sheets[0]['cells'][$i][3];
            $married_separate = $data->sheets[0]['cells'][$i][4];
            $married_separate1 = $data->sheets[0]['cells'][$i][5];
            $married_separate2 = $data->sheets[0]['cells'][$i][6];
            $married_separate3 = $data->sheets[0]['cells'][$i][7];
            $married_separate4 = $data->sheets[0]['cells'][$i][8];
            $married_separate5 = $data->sheets[0]['cells'][$i][9];
            $married_separate6 = $data->sheets[0]['cells'][$i][10];
            $married_separate7 = $data->sheets[0]['cells'][$i][11];
            $married_separate8 = $data->sheets[0]['cells'][$i][12];
            $married_separate9 = $data->sheets[0]['cells'][$i][13];
            $married_separate10 = $data->sheets[0]['cells'][$i][14];
		 }else{ // Salary is greater than 86085
			$single = $from_amt * 0.28;
			$married_separate =  $from_amt * 0.28;
            $married_separate1 = $from_amt * 0.28;
            $married_separate2 = $from_amt * 0.28;
            $married_separate3 = $from_amt * 0.28;
            $married_separate4 = $from_amt * 0.28;
            $married_separate5 = $from_amt * 0.28;
            $married_separate6 = $from_amt * 0.28;
            $married_separate7 = $from_amt * 0.28;
            $married_separate8 = $from_amt * 0.28;
            $married_separate9 = $from_amt * 0.28;
            $married_separate10 =$from_amt * 0.28;
		 }
		 
		if($from_amt <= 87755){ // Salary is less than 87756
			$married_separate11 = $data->sheets[0]['cells'][$i][15];
			$married_separate12 = $data->sheets[0]['cells'][$i][16];
			$married_separate13 = $data->sheets[0]['cells'][$i][17];
			$married_separate14 = $data->sheets[0]['cells'][$i][18];
			$married_separate15 = $data->sheets[0]['cells'][$i][19];
			$married_separate16 = $data->sheets[0]['cells'][$i][20];
			$married_separate17 = $data->sheets[0]['cells'][$i][21];
			$married_separate18 = $data->sheets[0]['cells'][$i][22];
			$married_separate19 = $data->sheets[0]['cells'][$i][23];
			$married_separate20 = $data->sheets[0]['cells'][$i][24];
		  }else{ // Salary is greater than 87755
			$married_separate11 = $from_amt * 0.28;
			$married_separate12 = $from_amt * 0.28;
			$married_separate13 = $from_amt * 0.28;
			$married_separate14 = $from_amt * 0.28;
			$married_separate15 = $from_amt * 0.28;
			$married_separate16 = $from_amt * 0.28;
			$married_separate17 = $from_amt * 0.28;
			$married_separate18 = $from_amt * 0.28;
			$married_separate19 = $from_amt * 0.28;
			$married_separate20 = $from_amt * 0.28;
		  }
			
          if($from_amt <= 86085){ // Salary is less than 86086
				$married_combine = $data->sheets[0]['cells'][$i][25];
				$married_combine1 = $data->sheets[0]['cells'][$i][26];
				$married_combine2 = $data->sheets[0]['cells'][$i][27];
				$married_combine3 = $data->sheets[0]['cells'][$i][28];
				$married_combine4 = $data->sheets[0]['cells'][$i][29];
				$married_combine5 = $data->sheets[0]['cells'][$i][30];
				$married_combine6 = $data->sheets[0]['cells'][$i][31];
				$married_combine7 = $data->sheets[0]['cells'][$i][32];
				$married_combine8 = $data->sheets[0]['cells'][$i][33];
				$married_combine9 = $data->sheets[0]['cells'][$i][34];
				$married_combine10 = $data->sheets[0]['cells'][$i][35];
			}else{
				$married_combine  = $from_amt * 0.28;
				$married_combine1 = $from_amt * 0.28;
				$married_combine2 = $from_amt * 0.28;
				$married_combine3 = $from_amt * 0.28;
				$married_combine4 = $from_amt * 0.28;
				$married_combine5 = $from_amt * 0.28;
				$married_combine6 = $from_amt * 0.28;
				$married_combine7 = $from_amt * 0.28;
				$married_combine8 = $from_amt * 0.28;
				$married_combine9 = $from_amt * 0.28;
				$married_combine10= $from_amt * 0.28;
			}
			
			if($from_amt <= 87755){ // Salary is less than 87756
				$married_combine11 = $data->sheets[0]['cells'][$i][36];
				$married_combine12 = $data->sheets[0]['cells'][$i][37];
				$married_combine13 = $data->sheets[0]['cells'][$i][38];
				$married_combine14 = $data->sheets[0]['cells'][$i][39];
				$married_combine15 = $data->sheets[0]['cells'][$i][40];
				$married_combine16 = $data->sheets[0]['cells'][$i][41];
				$married_combine17 = $data->sheets[0]['cells'][$i][42];
				$married_combine18 = $data->sheets[0]['cells'][$i][43];
				$married_combine19 = $data->sheets[0]['cells'][$i][45];
				$married_combine20 = $data->sheets[0]['cells'][$i][46];
			}else{
				$married_combine11 = $from_amt * 0.28;
				$married_combine12 = $from_amt * 0.28;
				$married_combine13 = $from_amt * 0.28;
				$married_combine14 = $from_amt * 0.28;
				$married_combine15 = $from_amt * 0.28;
				$married_combine16 = $from_amt * 0.28;
				$married_combine17 = $from_amt * 0.28;
				$married_combine18 = $from_amt * 0.28;
				$married_combine19 = $from_amt * 0.28;
				$married_combine20 = $from_amt * 0.28;
			}
			

            $is_more_20 = $data->sheets[0]['cells'][$i][47];


            $table = "employee_pcb";
            $key = array();
            $values = array();

            $key[] = "fr_amt";
            $values[] = insertvalue($from_amt);
            $key[] = "to_amt";
            $values[] = insertvalue($to_amt);
            $key[] = "single";
            $values[] = insertvalue($single);

            $key[] = "married_separate";
            $values[] = insertvalue($married_separate);
            $key[] = "married_separate1";
            $values[] = insertvalue($married_separate1);
            $key[] = "married_separate2";
            $values[] = insertvalue($married_separate2);
            $key[] = "married_separate3";
            $values[] = insertvalue($married_separate3);
            $key[] = "married_separate4";
            $values[] = insertvalue($married_separate4);
            $key[] = "married_separate5";
            $values[] = insertvalue($married_separate5);
            $key[] = "married_separate6";
            $values[] = insertvalue($married_separate6);
            $key[] = "married_separate7";
            $values[] = insertvalue($married_separate7);
            $key[] = "married_separate8";
            $values[] = insertvalue($married_separate8);
            $key[] = "married_separate9";
            $values[] = insertvalue($married_separate9);
			$key[] = "married_separate10";
            $values[] = insertvalue($married_separate10);
            $key[] = "married_separate11";
            $values[] = insertvalue($married_separate11);
			$key[] = "married_separate12";
            $values[] = insertvalue($married_separate12);
			$key[] = "married_separate13";
            $values[] = insertvalue($married_separate13);
			$key[] = "married_separate14";
            $values[] = insertvalue($married_separate14);
			$key[] = "married_separate15";
            $values[] = insertvalue($married_separate15);
			$key[] = "married_separate16";
            $values[] = insertvalue($married_separate16);
			$key[] = "married_separate17";
            $values[] = insertvalue($married_separate17);
			$key[] = "married_separate18";
            $values[] = insertvalue($married_separate18);
			$key[] = "married_separate19";
            $values[] = insertvalue($married_separate19);
			$key[] = "married_separate20";
            $values[] = insertvalue($married_separate20);
		

            $key[] = "married_combine";
            $values[] = insertvalue($married_combine);
            $key[] = "married_combine1";
            $values[] = insertvalue($married_combine1);
            $key[] = "married_combine2";
            $values[] = insertvalue($married_combine2);
            $key[] = "married_combine3";
            $values[] = insertvalue($married_combine3);
            $key[] = "married_combine4";
            $values[] = insertvalue($married_combine4);
            $key[] = "married_combine5";
            $values[] = insertvalue($married_combine5);
            $key[] = "married_combine6";
            $values[] = insertvalue($married_combine6);
            $key[] = "married_combine7";
            $values[] = insertvalue($married_combine7);
            $key[] = "married_combine8";
            $values[] = insertvalue($married_combine8);
            $key[] = "married_combine9";
            $values[] = insertvalue($married_combine9);
            $key[] = "married_combine10";
            $values[] = insertvalue($married_combine10);
			$key[] = "married_combine11";
            $values[] = insertvalue($married_combine11);
			$key[] = "married_combine12";
            $values[] = insertvalue($married_combine12);
			$key[] = "married_combine13";
            $values[] = insertvalue($married_combine13);
			$key[] = "married_combine14";
            $values[] = insertvalue($married_combine14);
			$key[] = "married_combine15";
            $values[] = insertvalue($married_combine15);
			$key[] = "married_combine16";
            $values[] = insertvalue($married_combine16);
			$key[] = "married_combine17";
            $values[] = insertvalue($married_combine17);
			$key[] = "married_combine18";
            $values[] = insertvalue($married_combine18);
			$key[] = "married_combine19";
            $values[] = insertvalue($married_combine19);
			$key[] = "married_combine20";
            $values[] = insertvalue($married_combine20);
			
            $key[] = "is_more_20";
            $values[] = insertvalue($is_more_20);

            $keysdata = join(",", $key);
            $valuedata = join(",", $values);
            insert($table, $keysdata, $valuedata, "getid");
        }
    }
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