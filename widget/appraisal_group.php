<?php
if(isset($_GET['id'])){
	$curnt_time=date("Y-m-d H:i:s");
	$sql_e = mysql_query("SELECT * FROM employee WHERE id='".$_COOKIE['igen_user_id']."'");
	while($row_e=mysql_fetch_array($sql_e)){
		$emp_name=$row_e['full_name'];
	}
		$i=0;
		$emp_id=$_POST['emp_id'];
		$id=$_POST['part'];
				
		$from=date('Y-m-d', strtotime($_POST['from']));
		$to=date('Y-m-d', strtotime($_POST['to']));
		$peroid=date('Y-m-d', strtotime($_POST['peroid']));
		$company=$_POST['company'];
		$status=$_POST['act'];
		$date=date('Y-m-d', strtotime($_POST['date_joined']));
		$sub="";
		$group="";
		$sub_group_id="";	
		$group_id="";
		
		$sql = "UPDATE p_particular SET c_peroid='" . $peroid . "', p_from='" . $from . "', p_to='" . $to . "', join_date='" . $date . "' WHERE id='".$id."'";
		$query = mysql_query($sql);
				
		foreach($_POST["question"] as $thisName) 
			{ 
					$sql_result9 = mysql_query("SELECT * FROM appraisal_draft  WHERE id=" .$thisName. ";");
					while($row_q=mysql_fetch_array($sql_result9)){
					if($row_q['rate']!=$_POST["rating"][$i]){

					 
					  
					  $sql = "INSERT INTO appraisal_audit(rate, new_rate, changed_date, changed_by, q_id) VALUES ('" . $row_q['rate'] . "','" . $_POST["rating"][$i] . "','" . $curnt_time. "','" .$emp_name. "','" .$thisName. "')";
					  $query = mysql_query($sql);
					  
					}
					}
			
		
		   $sql = "UPDATE appraisal_draft SET rate='" . $_POST["rating"][$i] . "', comment='" . $_POST["desc"][$i]. "', status='" .$status. "'  WHERE id='".$thisName."'";
			$query = mysql_query($sql);
			
			$i++;
			
			}
			
		if($query){
		  echo "<script language='javascript' type='text/javascript'> ";


			echo "alert('Successfully updated')";



			echo "</script>";
			echo "<script language='javascript' type='text/javascript'>";
			
			echo " self.location='?loc=apraisal'";
			echo "</script>";
		
		
		}


}else{

if(isset($_POST['submit'])){
	$i=0;
	$name=$_POST['n'];
	 
	$emp_id=$_POST['emp_id'];
	$from=date('Y-m-d', strtotime($_POST['from']));
	$to=date('Y-m-d', strtotime($_POST['to']));
	$peroid=date('Y-m-d', strtotime($_POST['peroid']));
	$company=$_POST['company'];
	$status=$_POST['act'];
	$date=date('Y-m-d', strtotime($_POST['date_joined']));

    $sub="";
	$group="";
	$sub_group_id="";
	$group_id="";
		
	if(($_POST['from']=="" || $_POST['to']=="" || $_POST['peroid']=="")){
		
			echo "<script language='javascript' type='text/javascript'> ";


			echo "alert('Please Keyin Current Review Period, From and To fields')";



			echo "</script>";
			echo "<script language='javascript' type='text/javascript'>";
			echo " self.location='?loc=appraisal_group&emp_id=".$emp_id."&n=".$name."&d=".$date."'";
			echo "</script>";
			 exit();
		}
		
		$sql = "INSERT INTO p_particular(c_peroid, p_from, p_to, emp_id,join_date, company) VALUES ('" . $peroid . "','" . $from . "','" . $to . "','" . $emp_id . "','" . $date . "','" . $company . "')";
		$query = mysql_query($sql);
		$sub_id=mysql_insert_id();
				
    foreach($_POST["question"] as $thisName) 
		{ 

			if($_POST['group'][$i]!=$group){
			   $sql1 = "INSERT INTO draft_group(group_name, p_id) VALUES ('" . $_POST['group'][$i]. "', '" . $sub_id. "')";
				$query1 = mysql_query($sql1);
				$group_id=mysql_insert_id();
			
			}
			if($_POST['sub'][$i]!=$sub){
				$sql2 = "INSERT INTO draft_sub(group_id, sub_name) VALUES ('" .$group_id. "','" . $_POST['sub'][$i]. "')";
				$query2 = mysql_query($sql2);
				$sub_group_id=mysql_insert_id();
			
			}
		
			$sql = "INSERT INTO appraisal_draft(question,description,  p_id, sub_id, rate, comment, status) VALUES ('" . $_POST['question1'][$i]. "','" . $_POST['q_desc'][$i]. "','" . $sub_id. "' ,'" . $sub_group_id. "','" . $_POST["rating"][$i] . "','" . $_POST["desc"][$i]. "','" .$status. "')";
			$query = mysql_query($sql);
			$group=$_POST['group'][$i];
			$sub=$_POST['sub'][$i];
			$i++;
		
		}
		
		if($query){
		
			$sql = "DELETE  FROM multiple_appraisee where emp_id=".$emp_id;
			$query = mysql_query($sql);
			echo "<script language='javascript' type='text/javascript'> ";
			echo "alert('Successfully updated .')";
			echo "</script>";
			echo "<script language='javascript' type='text/javascript'>";
			echo " self.location='?loc=appraisal_group&from=".$from."&to=".$to."&peroid=".$peroid."'";
			echo "</script>";
		
		}
		


}

}

?>