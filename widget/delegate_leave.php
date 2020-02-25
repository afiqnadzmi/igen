
<?php
$lv1=$_POST['lv1'];
$lv2=$_POST['lv2'];
$lv3=$_POST['lv3'];
$lv_2=$_POST['lv_2'];
$lv_1=$_POST['lv_1'];
$lv_3=$_POST['lv_3'];
$user_id=$_POST['id'];
 $totalRows_level="";
 $backup=$_POST['backup'];
 $lv_backup=$_POST['lv_backup'];
 if($backup==""){
  if($lv_1=="Y"){
  $query_level1 ="UPDATE approval SET level_pos_1='0'  WHERE  superior_1='".$user_id."' ;";
               $level1 = mysql_query($query_level1);
			   $totalRows_level = 1;
  
  
  
  }else{
       if($lv1!=""){
               $query_level1 ="UPDATE approval SET level_pos_1='$lv1'  WHERE  superior_1='".$user_id."' ;";
               $level1 = mysql_query($query_level1);
			   $totalRows_level = 1;
			   }
		}	   
		  if($lv_2=="Y"){
               $query_level2 ="UPDATE approval SET level_pos_2='0'  WHERE  superior_2='".$user_id."';";
               $level2 = mysql_query($query_level2);
			   $totalRows_level = 1;

         }else{	  
              
        if($lv2!=""){
               $query_level2 ="UPDATE approval SET level_pos_2='$lv2'  WHERE  superior_2='".$user_id."';";
               $level2 = mysql_query($query_level2);
			   $totalRows_level = 1;
			   
			   }
			   
			   }
			 if($lv_3=="Y"){
			   $query_level3 ="UPDATE approval SET level_pos_3='0'  WHERE  superior_3='".$user_id."';";
               $level3 = mysql_query($query_level3);
			   $totalRows_level = 1;
			 
			 
			 }else{
			
	  if($lv3!=""){
               $query_level3 ="UPDATE approval SET level_pos_3='$lv3'  WHERE  superior_3='".$user_id."';";
               $level3 = mysql_query($query_level3);
			   $totalRows_level = 1;
			   }   
			}
			
			}else{
			if($lv_backup=="Y"){
			$query_b ="UPDATE approval_m SET backup='0'  WHERE  emp_id='".$user_id."';";
               $level_b = mysql_query($query_b);
			   $totalRows_level =1; 
			   }else{
			 if($backup!=""){
			   $query_b ="UPDATE approval_m SET backup='$backup'  WHERE  emp_id='".$user_id."';";
               $level_b = mysql_query($query_b);
			   $totalRows_level = 1;
			   }
			   }
			}
			
		if($totalRows_level>0){
	echo "1";
		
		}else{
		
	echo "0";
		}
?>
