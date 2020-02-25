<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$emp_id = $_POST["id"];
$year = $_POST["year"];
$month = $_POST["month"];
$data_full = explode('|', $_POST["data_full"]);

for ($i = 0; $i < count($data_full); $i++) {
    $data = explode(',', $data_full[$i]);
    if ($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "") {
        if ((preg_match('/([0-1][0-9]|2[0-3]):([0-5][0-9])/', $data[1])) && (preg_match('/([0-1][0-9]|2[0-3]):([0-5][0-9])/', $data[2])) && (preg_match('/([0-1][0-9]|2[0-3]):([0-5][0-9])/', $data[3])) && (preg_match('/([0-1][0-9]|2[0-3]):([0-5][0-9])/', $data[4]))) {
            $correct = $correct . $data[0] . "," . $data[1] . "," . $data[2] . "," . $data[3] . "," . $data[4] . "|";
        } else {
            $wrong = $wrong . "\n" . $data[0];
            $wrong_data = $data[0] . "|" . $wrong_data;
        }
    } else {
        if ($data[1] != "" || $data[2] != "" || $data[3] != "" || $data[4] != "") {
            $missing = $missing . "\n" . $data[0];
            $missing_data = $data[0] . "|" . $missing_data;
        }
    }
}

if ($wrong_data == "" || $wrong_data == " ") {
    $wrong_num = 0;
} else {
    $wrong1 = explode('|', $wrong_data);
    $wrong_num = count($wrong1) - 1;
}

if ($missing_data == "" || $missing_data == " ") {
    $missing_num = 0;
} else {
    $missing1 = explode('|', $missing_data);
    $missing_num = count($missing1) - 1;
}

if ($missing_num == 0) {
    if ($wrong_num > 0) {
        print json_encode(array('msg' => "wrong_format", 'date' => $wrong));
    } else {
        if ($correct == "" || $correct == " ") {
            print json_encode(array('msg' => "empty"));
        } else {
		
            $sql3 = 'DELETE FROM attendance WHERE emp_id = ' . $emp_id . ' AND YEAR(work_in_date) = "' . $year . '" AND MONTH(work_in_date) = "' . $month . '"';
            $query3 = mysql_query($sql3);
			
			$table="attendance";
			// declare the table
			$criteria=keyvalue("emp_id",$emp_id);
			$criteria=keyvalue("YEAR(work_in_date)",$year);
			$criteria=keyvalue("MONTH(work_in_date))",$month);
			// declare the where condition
			$query3=delete($table, $criteria);
			//copyy this for query(true)
			
            $correct_full = explode('|', $correct);
            $correct_count = count($correct_full) - 2;
            for ($i = 0; $i <= $correct_count; $i++) {
                $correct_data = explode(',', $correct_full[$i]);
				
                // $sql1 = 'INSERT INTO attendance (emp_id, work_in_date, work_in_time, work_out_time) VALUES (' . $emp_id . ', "' . $correct_data[0] . '", "' . $correct_data[1] . '", "' . $correct_data[3] . '")';
                // $sql2 = 'INSERT INTO attendance (emp_id, work_in_date, work_in_time, work_out_time) VALUES (' . $emp_id . ', "' . $correct_data[0] . '", "' . $correct_data[4] . '", "' . $correct_data[2] . '")';
                // $query1 = mysql_query($sql1);
                // $query2 = mysql_query($sql2);
				
				$table1="attendance";
				$key1=array();
				$values1=array();
				//declare table variable and array
				$key1[]="emp_id";
				$values1[]=insertvalue($emp_id);
				$key1[]="work_in_date";
				$values1[]=insertvalue($correct_data[0]);
				$key1[]="work_in_time";
				$values1[]=insertvalue($correct_data[1]);
				$key1[]="work_out_time";
				$values1[]=insertvalue($correct_data[3]);
				//assign the table column and value variable to array
				$keysdata1=join(",",$key1);
				$valuedata1=join(",",$values1);
				$query1=insert($table1,$keysdata1,$valuedata1); 
				//copy this for query(true)
				
				$table="attendance";
				$key=array();
				$values=array();
				//declare table variable and array
				$key[]="emp_id";
				$values[]=insertvalue($emp_id);
				$key[]="work_in_date";
				$values[]=insertvalue($correct_data[0]);
				$key[]="work_in_time";
				$values[]=insertvalue($correct_data[4]);
				$key[]="work_out_time";
				$values[]=insertvalue($correct_data[2]);
				//assign the table column and value variable to array
				$keysdata=join(",",$key);
				$valuedata=join(",",$values);
				$query=insert($table,$keysdata,$valuedata); 
				//copy this for query(true)
            }
            print json_encode(array('msg' => "correct"));
			$name=retrieve_value('employee','full_name','id',$emp_id);
            audit_trail("editattendance", $name);
        }
    }
} else {
    if ($missing_num > 0) {
        print json_encode(array('msg' => "empty_field", 'date' => $missing));
    }
}

//audit_trail("Employee", "Time Attendance", "Edit");

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>