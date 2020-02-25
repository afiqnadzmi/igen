<?php
error_reporting(E_ALL);
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

session_start();
$uploaddir = 'tmp/';
$file = basename($_FILES['excel_file']['name']);

$new_path = $uploaddir . basename($_FILES['excel_file']['name']);

if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $new_path)) {
  
   parseExcel($new_path);
    audit_trail("import_attendance", $_FILES['excel_file']['name']);
} else {
    $_SESSION['upload_msg']='Fail to upload excel file.';
}

function parseExcel($file) {
echo $file;
    $data = new Spreadsheet_Excel_Reader();
    $data->setUTFEncoder('iconv');
    $data->setOutputEncoding('UTF-8'); //UTF-8
    $data->read($file);
	
	$proceed="true";
	
    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
	    $id=$data->sheets[0]['cells'][$i][1];
		$work_in_date=$data->sheets[0]['cells'][$i][2];
		$in_time=$data->sheets[0]['cells'][$i][3];
		$out_time=$data->sheets[0]['cells'][$i][4];
	 
	 
 
		if(checkavailid('employee','id', $id)!='0'
			&&is_numeric($data->sheets[0]['cells'][$i][1])&&$data->sheets[0]['cells'][$i][1]!='' 
			&& $data->sheets[0]['cells'][$i][2]!='' && $data->sheets[0]['cells'][$i][3]!='' 
			&& $data->sheets[0]['cells'][$i][4]!=''){
			if(checkavailid('attendance','emp_id="'.$data->sheets[0]['cells'][$i][1].'" and work_in_date="'.$data->sheets[0]['cells'][$i][2].'"')>0){
				delete('attendance','emp_id="'.$data->sheets[0]['cells'][$i][1].'" and work_in_date="'.$data->sheets[0]['cells'][$i][2].'"');
			}
		
			//$flag=0;
			//while($flag<2){
			     
		           
				$key = array();
				$values = array();
				$key[] = "emp_id";
				$values[] = insertvalue($data->sheets[0]['cells'][$i][1]);
				$key[] = "work_in_date";
				$values[] = insertvalue(insertdate($work_in_date));
				$key[] = "work_in_time";
				$values[] = insertvalue($data->sheets[0]['cells'][$i][3]);
				$key[] = "work_out_time";
				$values[] = insertvalue($data->sheets[0]['cells'][$i][4]);
               $keysdata = join(",", $key);
				$valuedata = join(",", $values);
				$insert_arr[]=array('keys'=>$keysdata,'values'=>$valuedata);				
              /*				
				if($flag==0){
					$values[] = insertvalue($data->sheets[0]['cells'][$i][3]);
					$values[] = insertvalue('');
				}else{
					$values[] = insertvalue('');
					$values[] = insertvalue($data->sheets[0]['cells'][$i][4]);
				}
				
				$flag++;
				
			}
			*/
		}else{
		  
	echo "<script language='javascript' type='text/javascript'> ";


echo "alert('Please make sure to fill up all the field.')";



echo "</script>";
echo "<script language='javascript' type='text/javascript'>";
echo " self.location='?loc=import_attendance'";
echo "</script>";
exit();
			$proceed="false";
			$err=$err.'<br />Error on ';
			(chk_value($data->sheets[0]['cells'][$i][1],'B',$i)!='')?($err_arr[]=chk_value($data->sheets[0]['cells'][$i][1],'B',$i)):'';
			(chk_value($data->sheets[0]['cells'][$i][2],'K',$i)!='')?($err_arr[]=chk_value($data->sheets[0]['cells'][$i][2],'K',$i)):'';
			(chk_value($data->sheets[0]['cells'][$i][3],'W',$i)!='')?($err_arr[]=chk_value($data->sheets[0]['cells'][$i][3],'W',$i)):'';
			(chk_value($data->sheets[0]['cells'][$i][4],'Z',$i)!='')?($err_arr[]=chk_value($data->sheets[0]['cells'][$i][4],'Z',$i)):'';
			$err.=join(', ',$err_arr);
			unset($err_arr);
		}
    }
	
//	if($proceed){

	if($proceed){
		$result=true;
		begin();
		
		foreach($insert_arr as $i_a){
			$rs=insert("attendance", $i_a['keys'], $i_a['values']);
			if(!$rs){
				$result=false;
			}
		}
		if($result){
			commit();
			$_SESSION['upload_msg']='Inserted successful.';
		}else{
			rollback();
			$_SESSION['upload_msg']='Error occurred when insert. Please try again.';
		}
			echo "<script language='javascript' type='text/javascript'> ";


echo "alert('Successfully Imported.')";



echo "</script>";
echo "<script language='javascript' type='text/javascript'>";
echo " self.location='?loc=import_attendance'";
echo "</script>";
	}else{
		$_SESSION['upload_msg']=$err;
	}
	
	//header('location:?loc=import_attendance');
//}
}
function chk_value($content,$col_alphabet,$row_num){
	$msg='';
	if($col_alphabet=='B'&&!is_numeric($content)){
		$msg=' -> Must be numeric.';
	}elseif($col_alphabet=='B'&&checkavailid('employee','id='.$content)=='0'){
		$msg=' -> Employee ID '.$content.' is not found';
	}
	// elseif($col_alphabet=='K'&&!preg_match('/\d{4}-\d{2}-\d{2}/',$content)){
		// $msg=' -> Date must be in yyyy-mm-dd format';
	// }
	elseif($content==''&&$col_alphabet=='W'){
		$msg=' -> Time In must have value';
	}elseif($content==''&&$col_alphabet=='Z'){
		$msg=' -> Time Out must have value';
	}
	if(''!=$msg){
		return $col_alphabet.$row_num.$msg;
	}
	return '';
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>