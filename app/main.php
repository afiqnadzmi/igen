<?php

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
  /* 

*/
?>

<?php
/*
$emp_id="4";
$month="5";
$year="2014";
include_once "app/test_jason.php";
include_once "app/test.php";
include_once "app/loh.php";
overtime($emp_id, $month, $year);

exit();

*/
/*
  $date= "2018-2-12";
  

date_sub($date, date_interval_create_from_date_string('10 days'));
$confir_date=date_format($date, 'Y-m-d');
echo $confir_date;
*/
/*
$date_cur=date('Y-m-d');
$confir_dat=date('Y-m-d', strtotime("now +10 days") );

error_reporting(0);

include "plugins/mailer/mailapp.php";
$subject = 'HR Application';

// Email notification for employee probation
$sql3 = "SELECT * FROM employee  WHERE confirm_date>'".$date_cur."' AND confirm_date<'".$confir_dat."'";
                           
                    $rs3 = mysql_query($sql3);
					$count1= mysql_num_rows($sql3);
					
					
                  while($row3= mysql_fetch_array($rs3)){
				  $dep=$row3['dep_id'];
				  $em_id=$row3['id'];
				  $name=$row3['full_name'];
				  
				  $email=$row3['email'];
				  $probation=$row3['probation'];
				 $confir=$row3['confirm_date'];
				  $sql2 = "SELECT e.full_name as name,e.email as e_email FROM department d, employee e  WHERE d.head_emp_id=e.id and d.id='".$dep."'";
                          
                    $rs2 = mysql_query($sql2);
					$count= mysql_num_rows($sql2);
					$row2 = mysql_fetch_array($rs2);
					$head_email=$row2['e_email'];
					$head_name=$row2['name'];
					
					if($probation=="" || $probation==null ){
					
					
							$msg = 'Dear  '.$head_name.' ,<br>';
        $msg.='The probation period for '.$name.' will end after 7 days <br> ';
        $msg.='Do not reply to this email as this was a computer generated email. <br>'; 
		
     
        	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
        
		 mailto($head_email, $subject, $msg, $headers);
					
					$sql = 'UPDATE employee SET probation = "yes" WHERE id = ' . $em_id . ';';
                   $sql_result = mysql_query($sql);
					}
					
					
					
					
				  }
				  
// Email notification for public holidays

/*$sql_c = "select * from company";
$rs_c = mysql_query($sql_c);
$row_c= mysql_fetch_array($rs_c);
$c_name=$row_c['name'];
$sql3_h = "SELECT * FROM public_holiday";
                           
                    $rs3_h = mysql_query($sql3_h);
					$count1_h= mysql_num_rows($sql3_h);
					
					
                  while($row3_h= mysql_fetch_array($rs3_h)){
				      
				  $date_cur1=strtotime($date_cur);
				   $datestart1=strtotime($row3_h['from_date']);
				  $datestar=strtotime($row3_h['from_date']);
				 
				  $check=($datestart1 - $date_cur1)/86400;;
				  $end_day=strtotime($row3_h['to_date']);
				  $p_name=$row3_h['occasion_name'];
				  $notify=$row3_h['notify'];
				  $secs = $end_day - $datestar;
                  $duration = $secs / 86400 + 1;
				  
				  $p_id=$row3_h['id'];
				 
				  
				if($duration==1){
				  $day="day";
				  }else{
				  $day="days";
				  }
				  $sql2_h = "SELECT e.full_name as name,e.email as e_email FROM employee e ";
                          
                    $rs2_h = mysql_query($sql2_h);
					$count_h= mysql_num_rows($sql2_h);
					while($row2_h = mysql_fetch_array($rs2_h)){
					$u_email=$row2_h['e_email'];
					$f_name=$row2_h['name'];
					
					
					
					if($check < "15" && $check>"0" ){
					if($check < "2" && $check>"0" && $notify!="renotify"){
				   $msg = '<p> Dear  <B>'.$f_name.'</B> ,</p>';
				   $msg.='<p>&nbsp</p>';
        $msg.='<P> The office will be close Tomorrow as it is the public holiday of <B>'.$p_name.'</B></p>';
		$msg.='<p>&nbsp</p>';
       $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
						 $msg.='<p>&nbsp</p>';
						$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
						 $msg.='<p>&nbsp</p>';
		   
        	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 mailto($u_email, $subject, $msg, $headers);
		$sql = 'UPDATE public_holiday  SET notify = "renotify" WHERE id = ' . $p_id . ';';
                   $sql_result = mysql_query($sql);
					
					}
					
					if($notify=="" || $notify==null){
				 $msg = '<p> Dear  <B>'.$f_name.'</B> ,</p>';
				   $msg.='<p>&nbsp</p>';
        $msg.='<p>There will be <B>'. $duration .' '.$day.'</B> of public holiday for <B>'. $p_name .'</B> From <B>'.$row3_h['from_date'].'</B> To <B>'.$row3_h['to_date'].'</B></p>';		
		
       		$msg.='<p>&nbsp</p>';
       $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
						 $msg.='<p>&nbsp</p>';
						$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
						 $msg.='<p>&nbsp</p>'; 
		
     
        	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
           
		 mailto($u_email, $subject, $msg, $headers);
					
					$sql = 'UPDATE public_holiday  SET notify = "yes" WHERE id = ' . $p_id . ';';
                   $sql_result = mysql_query($sql);
				   
				   }
				   }
				   if($check <="0"){
					$sql = 'UPDATE public_holiday  SET notify = "" WHERE id = ' . $p_id . ';';
                   $sql_result = mysql_query($sql);
				   
				   
				   }
				   
					}
					
			
					
					
				  }
			
		
	*/			

if ($_COOKIE['igen_id'] != '' || $_COOKIE['igen_user_id'] != '') {
    if (isset($_COOKIE["igen_id"]) == true) {
        $sqlLevel = 'SELECT * FROM user_permission WHERE id=1';
    } elseif (isset($_COOKIE["igen_user_id"]) == true) {
        $sqlLevel = 'SELECT up.* FROM user_permission AS up INNER JOIN employee AS e ON e.level_id = up.id WHERE e.id=' . $_COOKIE['igen_user_id'];
        $sqlView = 'SELECT upv.branch_id, upv.company_id FROM user_permission AS up
                    INNER JOIN employee AS e ON e.level_id = up.id
                    JOIN user_permission_view AS upv ON upv.user_permission_id = up.id
                    WHERE e.id=' . $_COOKIE['igen_user_id'];
    }
    $queryLevel = mysql_query($sqlLevel);
    $rowLevel = mysql_fetch_array($queryLevel);
    $igen_a_hr = $rowLevel["a_hr"];
    $igen_a_pr = $rowLevel["a_pr"];
    $igen_a_ea = $rowLevel["a_ea"];
    $igen_a_ps = $rowLevel["a_ps"];
    $igen_a_m = $rowLevel["a_m"];
    $igen_a_r = $rowLevel["a_r"];
    $igen_e_ep = $rowLevel["e_ep"];
    $igen_e_ea = $rowLevel["e_ea"];
    $igen_dash = $rowLevel["dashboard"];
	 $igen_epr = $rowLevel["epr"];
    $igen_userpermission = $rowLevel["id"];
	$igen_appraisal = $rowLevel["appraisal"];
	$igen_disc = $rowLevel["disc"];

    if (isset($_COOKIE["igen_view"]) == true && $_COOKIE["igen_view"] == "0") {
        if (isset($_COOKIE["igen_id"]) == true) {
            $igen_companylist = "";
            $igen_branchlist = "";
        } elseif (isset($_COOKIE["igen_user_id"]) == true) {
            /* Check user_permission_view if restricted access permission */
            $queryView = mysql_query($sqlView);
            $countView = mysql_num_rows($queryView);
            $rowView = mysql_fetch_array($queryView);

            if ($countView > 0) {
                $igen_branchlist = $rowView["branch_id"];
                $getEmpBranchList = explode(",", $igen_branchlist);

                for ($i = 0; $i < count($getEmpBranchList); $i++) {
                    $query = mysql_query('SELECT company_id FROM branch WHERE id=' . $getEmpBranchList[$i]);
                    $row = mysql_fetch_array($query);
                    $company = $company . $row["company_id"] . ',';
                }
                $igen_companylist = substr($company, 0, -1);
            } else {
                $igen_companylist = "";
                $igen_branchlist = ""; 
            }
        }
    } else {
        if (isset($_COOKIE["igen_id"]) == true) {
            $igen_companylist = $_COOKIE["igen_view"];
            $sqlBranchView = 'SELECT id FROM branch WHERE company_id=' . $_COOKIE["igen_view"];
            $queryBranchView = mysql_query($sqlBranchView);
            while ($rowBranchView = mysql_fetch_array($queryBranchView)) {
                $igen_branchlist = $igen_branchlist . $rowBranchView["id"] . ',';
            }
            $igen_branchlist = substr($igen_branchlist, 0, -1);
        } elseif (isset($_COOKIE["igen_user_id"]) == true) {
            /* Check user_permission_view if restricted access permission */
            $queryView = mysql_query($sqlView);
            $countView = mysql_num_rows($queryView);
            $rowView = mysql_fetch_array($queryView);

            if ($countView > 0) {
                $queryBranchView = mysql_query('SELECT id FROM branch WHERE id IN (' . $rowView["branch_id"] . ') AND company_id = ' . $_COOKIE["igen_view"]);
                while ($rowBranchView = mysql_fetch_array($queryBranchView)) {
                    $igen_branchlist = $igen_branchlist . $rowBranchView["id"] . ',';
                }
                $igen_branchlist = substr($igen_branchlist, 0, -1);
                $igen_companylist = $_COOKIE["igen_view"];
            } else {
                $igen_companylist = $_COOKIE["igen_view"];
                $sqlBranchView = 'SELECT id FROM branch WHERE company_id=' . $_COOKIE["igen_view"];
                $queryBranchView = mysql_query($sqlBranchView);
                while ($rowBranchView = mysql_fetch_array($queryBranchView)) {
                    $igen_branchlist = $igen_branchlist . $rowBranchView["id"] . ',';
                }
                $igen_branchlist = substr($igen_branchlist, 0, -1);
            }
        }
    }
	 if (isset($_COOKIE["igen_user_id"])) {
			$user_id = $_COOKIE["igen_user_id"];
		}else if (isset($_COOKIE["igen_id"])){
			$user_id = $_COOKIE["igen_id"];
		}
	$sql2 = "SELECT * FROM approval WHERE
                            (superior_1=" . $user_id
                            . " OR superior_2=" . $user_id . " OR superior_3=" . $user_id . ")";
                    $rs2 = mysql_query($sql2);
					$count_approval= mysql_num_rows( $rs2);
				$query_a ="SELECT * FROM approval_m  WHERE  emp_id='".$user_id."';";
               $level_a = mysql_query($query_a);
               $row_a = mysql_fetch_assoc($level_a);
               $totalRows_a = mysql_num_rows($level_a);
				$a_emp = $row_a['emp_id'];
				$a_backup = $row_a['backup'];
				
				  $query_backup ="SELECT full_name, id FROM employee WHERE id='".$a_backup."';";
               $level_backup = mysql_query($query_backup);
               $row_backup = mysql_fetch_assoc($level_backup);
               $totalRows_backup = mysql_num_rows($level_backup);
			   $e_backup=$row_backup['full_name'];
				
			$query_level1 ="SELECT a.superior_1, a.level_pos_1 FROM approval a WHERE  a.superior_1='".$user_id."';";
               $level1 = mysql_query($query_level1);
               $row_level1 = mysql_fetch_assoc($level1);
			   //echo"test".$row_level1['level_pos_1'];
               $totalRows_level1 = mysql_num_rows($level1);
			   $query_level2 ="SELECT a.superior_2 , a.level_pos_2 FROM approval a WHERE  a.superior_2='".$user_id."';";
               $level2 = mysql_query($query_level2);
               $row_level2 = mysql_fetch_assoc($level2);
               $totalRows_level2 = mysql_num_rows($level2);
			   $query_level3 ="SELECT a.superior_3, a.level_pos_3 FROM approval a WHERE  a.superior_3='".$user_id."';";
               $level3 = mysql_query($query_level3);
               $row_level3 = mysql_fetch_assoc($level3);
               $totalRows_level3 = mysql_num_rows($level3);
			   $query_name1 ="SELECT full_name, id, image_src FROM employee WHERE id='".$row_level1['level_pos_1']."';";
               $level_name1 = mysql_query($query_name1);
               $row_name1 = mysql_fetch_assoc($level_name1);
               $totalRows_name1 = mysql_num_rows($level_name1);
			   $e_name1=$row_name1['full_name'];
			 
			    $query_name2 ="SELECT full_name, id , image_src FROM employee WHERE id='".$row_level2['level_pos_2']."';";
               $level_name2 = mysql_query($query_name2);
               $row_name2 = mysql_fetch_assoc($level_name2);
               $totalRows_name2 = mysql_num_rows($level_name2);
			   $e_name2=$row_name2['full_name'];
			   
			   $query_name3 ="SELECT full_name, id, image_src FROM employee WHERE id='".$row_level3['level_pos_3']."';";
               $level_name3 = mysql_query($query_name3);
               $row_name3 = mysql_fetch_assoc($level_name3);
               $totalRows_name3 = mysql_num_rows($level_name3);
			   $e_name3=$row_name3['full_name'];		
                  $query = mysql_query('SELECT * FROM employee WHERE id=' . $user_id . ';');
				  
                $row_emp = mysql_fetch_array($query); 
				
				//echo"ful_name".$user_id;

    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
            <title>HR  & Payroll System</title>
			 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
			 <link rel="stylesheet" href="css/bootstrap.min.css">
			 <link rel="stylesheet" type="text/css" href="css/superfish.css" media="screen"/>
             <link type="text/css" rel="stylesheet" href="css/main.css" />
			  <link rel="stylesheet" href="css/styles.css">
			 <link rel="stylesheet" href="css/scrollToTop.css">
             <link type="text/css" href="css/themes/dark-hive/jquery-ui-1.8.4.custom.css" rel="stylesheet" />
			 <link type="text/css" href="css/themes/dark-hive/jquery.ui.all.css" rel="stylesheet" />
			
            <link rel="stylesheet" type='text/css' href="plugins/jPaginate/css/style.css" />
            <link type="text/css"  rel="stylesheet" href="plugins/datepicker/css/date.css" />
            <link type="text/css"  rel="stylesheet" href="plugins/datepicker/css/datepicker.css" />
             <link type="text/css"  rel="stylesheet" href="plugins/datepicker/css/ui-lightness/jquery-ui-1.8.4.custom.css" />
               <!--<link rel="stylesheet" type="text/css" href="js/jquery.datetimepicker.css"/>-->
			<!--<script src="https://kit.fontawesome.com/bcf44e39d1.js" crossorigin="anonymous"></script>-->
			<script type="text/javascript" src="js/fontawesome.js"></script>
            <script type="text/javascript" src="js/displaytime.js"></script>
		   <!-- <script type="text/javascript" src="js/jquery1.js"></script>-->
			<link href="js/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
			<script type="text/javascript" src="js/uploadify/jquery-1.4.2.min.js"></script>
			<script type="text/javascript" src="js/uploadify/swfobject.js"></script>
			<script type="text/javascript" src="js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
		
			<script type="text/javascript" src="js/date.js"></script>
            <!--<script type="text/javascript" src="js/jquery.datetimepicker.js"></script>-->
            <script type="text/javascript" src="plugins/datepicker/js/datepicker.js"></script>
            <script type="text/javascript" src="plugins/datepicker/js/jquery-ui.min.js" ></script>
            <script type="text/javascript" src="js/jquery-ui.min.js"></script>
            <script type="text/javascript" src="js/superfish.js"></script>
            <script type="text/javascript" src="js/function.js"></script>
			 <script type="text/javascript" src="js/md5.js"></script>
            <script type="text/javascript" src="js/ui/minified/jquery.ui.core.min.js"></script>
            <script type="text/javascript" src="js/ui/minified/jquery.ui.widget.min.js"></script>
            <script type="text/javascript" src="js/ui/minified/jquery.ui.datepicker.min.js"></script>
            <script type="text/javascript" src="plugins/jPaginate/jquery.paginate.js"></script>
			 <script type="text/javascript" src="js/jquery-scrollToTop.js"></script>
			<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
			<script type="text/javascript" src="js/jquery-ui.js"></script>
			<script src = "js/highcharts/highcharts.js"></script>
			<script src = "js/highcharts/exporting.js"></script>
			<script src = "js/highcharts/export-data.js"></script>
			<script src = "js/highcharts/item-series.js"></script>
			<script src = "js/highcharts/highcharts-3d.js"></script>
			
		  
		  
		 <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>-->
		   <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" charset="utf-8" src="plugins/datatable/js/jquery.dataTables.js"></script> 
            <script type="text/javascript" charset="utf-8" src="plugins/datatable/js/FixedColumns.js"></script>
			 <script type="text/javascript" src="js/timepicker.js"></script>
            <style type="text/css" title="currentStyle">
                /*    @import "plugins/datatable/css/demo_page.css";*/
                @import "plugins/datatable/css/demo_table_jui.css";
                @import "plugins/datatable/css/themes/smoothness/jquery-ui-1.8.4.custom.css";
            </style>
			<link rel="stylesheet" href="css/colorbox.css" />
	
		<script src="js/jquery.colorbox.js"></script>
         <script type="text/javascript" src="js/jq.js"></script>
		 <script type="text/javascript" src="js/script.js"></script>
		 <script type="text/javascript" src="js/sort.js"></script>
		 <script type="text/javascript" src="js/pager.js"></script>
         <script type="text/javascript">
		<!--	$(document).ready(function(){}) -->
                $(function() {
                    var height = $(window).height()-180;             
                    $("#content_div").css("min-height", function(){ return height});
                    $("input[type=text]").attr('autocomplete','off');
                });
				

				function back(){
					history.back(-1);
				}
                function logout(){
                    $.ajax({
                        url:'?widget=logoutAction',
                        success:function(data){
                            if(data==true){
                                window.location='?loc=home'
                            }else{
                                alert('Error While Logging Out')
                            }
                        }
                    })
                }
				
                function changeView(company_id){
                    $.ajax({
                        type:'POST',
                        url:'?widget=setcookieview',
                        data:{
                            company_id:company_id
                        },
                        success:function(data){
                            window.location.reload();
                        }
                    })
                }
				$(document).ready(function(){
					//Examples of how to assign the Colorbox event to elements
					$(".group1").colorbox({rel:'group1'});
					$(".group2").colorbox({rel:'group2', transition:"fade"});
					$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
					$(".group4").colorbox({rel:'group4', slideshow:true});
					$(".ajax").colorbox();
					$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
					$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
					$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
					$(".inline").colorbox({inline:true, width:"50%"});
					$(".callbacks").colorbox({
						onOpen:function(){ alert('onOpen: colorbox is about to open'); },
						onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
						onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
						onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
						onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
					});

					$('.non-retina').colorbox({rel:'group5', transition:'none'})
					$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
					
					//Example of preserving a JavaScript event for inline calls.
					$("#click").click(function(){ 
						$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
						return false;
					});
			});
			
			function process(){ 
				var backup =$("#a_backup").val();
				var lv_backup ="";
				
				 var lv1=$("#level1").val();
				 var lv2=$("#level2").val();
				 var lv3=$("#level3").val();
				var id=$("#user").val();
				
				 var lv_1="";
				 var lv_2="";
				 var lv_3="";
				 if ($("input.lv1_backup").is(":checked")){
				 lv_backup =$("#lv1_backup").val();
				}
				
				if ($("input.lv1").is(":checked")){
				 lv_1 =$(".lv1").val();
				}
				if ($("input.lv2").is(":checked")){
				 lv_2 =$(".lv2").val();
				}
				
				if ($("input.lv3").is(":checked")){
				 lv_3 =$(".lv3").val();
				}
				
						
				
			
			   
				if(lv1=="" && lv2=="" && lv3==""){
			   alert("Please Select delegate to")
			   
			   }else{
			  
			   
			   
				$.ajax({
				type:'Post',
				url:"?widget=delegate_leave",
				data:{
				   lv1:lv1,
				   lv2:lv2,
				   lv3:lv3,
				   lv_2:lv_2,
				   lv_1:lv_1,
				   lv_3:lv_3,
				   backup:backup,
				   lv_backup:lv_backup,
				   id:id
				   
				},
				success:function(data){
				if(data==1){
				alert("Successfully Updated")
				location.reload();
				}else{
				alert("Errror Occur while processing")
				location.reload();
				}
					
				}
			})
			   
		 }
       
    }
            </script>
		  <?php	include "session/timeout.php"; ?>
        </head>
        <body onload="initSession()"> 
		<input type='hidden' id='user' value='<?php echo $user_id ?>'>
            <div id="MainContainer" >
				<div class="top-divs">
					<div id="top_div">
						<table style="position: relative; top: 5px;">
							<tr>
								<td align="left" rowspan="2" style="color: #fff;">
									<?php
									if (isset($_COOKIE["igen_is_admin"]) == true && $_COOKIE["igen_is_admin"] == "1") {
										echo '<a class="logo" href="?loc=dashboard" style="text-decoration : none; color: #000">Baiduri@Work</a>';
									} else {
										if (isset($_COOKIE["igen_user_id"]) == true) {
											$sql = 'SELECT up.dashboard FROM user_permission AS up 
												INNER JOIN employee AS e
												ON e.level_id = up.id
												WHERE e.id = ' . $_COOKIE["igen_user_id"];
											$query = mysql_query($sql);
											$row = mysql_fetch_array($query);
											if ($row["dashboard"] == "dash_show") {
												echo '<a class="logo" href="?loc=dashboard" style="text-decoration : none; color: #000">Baiduri@Work</a>';
											} else {
												echo '<a class="logo" href="?eloc=emp_view_profile" style="text-decoration : none; color: #000">Baiduri@Work</a>';
											}
										}
									}
									?>
								</td>
								<td class="alignright" id="time_display" style="font-size: 13px;"><span id="curTime"></span><?php echo '&nbsp;<br/><i class="fas fa-calendar-alt"></i>' . date("F d, Y", time()); ?></td>
							</tr>
							<tr style="color: #000;">
								<td style="text-align: right; font-size: 13px;">
									<span>
										<?php
						
										if ((isset($_COOKIE["igen_id"]) == true || $rowLevel["id"]==1)|| ($igen_branchlist != "" && $igen_companylist != "")) { ?>
											<select id="dropView" onchange="changeView(this.value)">
												<option value="0">--All Companies--</option>
												<?php
												echo $rowLevel["id"];
												if (isset($_COOKIE["igen_id"]) == true) {
													$sqlShowCompany = 'SELECT * FROM company ORDER BY code';
												} elseif (isset($_COOKIE["igen_user_id"]) == true) {
													$queryView = mysql_query($sqlView);
													$countView = mysql_num_rows($queryView);
													$rowView = mysql_fetch_array($queryView);

													if ($countView > 0) {
														$getEmpBranchList = explode(",", $rowView["branch_id"]);
														for ($i = 0; $i < count($getEmpBranchList); $i++) {
															$query = mysql_query('SELECT company_id FROM branch WHERE id=' . $getEmpBranchList[$i]);
															$row = mysql_fetch_array($query);
															$company = $company . $row["company_id"] . ',';
														}
														$company = substr($company, 0, -1);
														$sqlShowCompany = 'SELECT * FROM company WHERE id IN (' . $company . ') ORDER BY code';
													} else {
														$sqlShowCompany = 'SELECT * FROM company ORDER BY code';
													}
												}
												$queryShowCompany = mysql_query($sqlShowCompany);
												while ($rowShowCompany = mysql_fetch_array($queryShowCompany)) {
													if ($_COOKIE["igen_view"] == $rowShowCompany["id"]) {
														echo '<option value="' . $rowShowCompany["id"] . '" selected="true">' . $rowShowCompany["code"] . '</option>';
													} else {
														echo '<option value="' . $rowShowCompany["id"] . '">' . $rowShowCompany["code"] . '</option>';
													}
												}
												?>
											</select>
										<?php } ?>
								
									</span>&nbsp;&nbsp;
							 <?php
							
								
									if (isset($_COOKIE["igen_is_admin"]) == true && $_COOKIE["igen_is_admin"] == "1") {
										print '<span>' . $_COOKIE["igen_username"] . '</span>';
									} else {
										print '<a style="color: #000;" href="?eloc=emp_view_profile"><i class="fas fa-user-alt"></i>' . $row_emp['full_name'] . '</a>';
									
									}
									echo "<span>&nbsp;|&nbsp;</span>";
								
									?>
									
								  <?php
									if($igen_a_ea=="a_ea_edit"){
									
									?>
									
									<span class="cursor_pointer" onmouseover="className='mouseover cursor_pointer'" onmouseout="className='mouseout cursor_pointer'"><a class='inline' href="#inline_content"><i class="fas fa-exchange-alt" style="color:#000;" aria-hidden="true"></i> <!--<i class="fas fa-exchange-alt" style="color:#000;" aria-hidden="true"></i>-->Delegate</a></span> |
									<?php
									}
									?>
								
									<span class="cursor_pointer" onmouseover="className='mouseover cursor_pointer'" onmouseout="className='mouseout cursor_pointer'" onclick="logout()"><i class="fas fa-sign-out-alt"></i>Logout</span> 
								</td>
							</tr>
						</table>
					</div>
					<div><?php include_once 'app/navbar_main.php'; ?></div>
				</div>
                <div id="content_div" >
                    <div class="contentdiv"> 
                        <div id="content">
					      
                            <?php
													
                            if (isset($_GET['loc'])) {
                                $location = $_GET["loc"];
                            } else {
                                $location = $_GET["eloc"];
                            }
                            $sqlPermission = 'SELECT mm.name, m.is_sub FROM main_menu AS mm 
                                              INNER JOIN menu AS m ON m.main_id = mm.id 
                                              WHERE m.menu_name = "' . $location . '"';
                            $queryPermission = mysql_query($sqlPermission);
                            $rowPermission = mysql_fetch_array($queryPermission);
                            $permission = $rowPermission["name"] . "_hide";
                            $permission1 = $rowPermission["name"] . "_view";
							
                            if ($rowPermission["is_sub"] == "1") {
								
                                if ($rowPermission["name"] == "" || $igen_a_hr == $permission || $igen_a_ea == $permission || $igen_a_m == $permission || $igen_a_hr == $permission1 || $igen_a_ea == $permission1 || $igen_a_m == $permission1) {
                                    $display = "hide";
                                } else {
                                    $display = "show";
									
                                }
                            } else {
                                if ($rowPermission["name"] == "" || $igen_a_hr == $permission || $igen_a_pr == $permission || $igen_a_ea == $permission || $igen_a_ps == $permission || $igen_appraisal==$permission || $igen_disc==$permission || $igen_a_m == $permission || $igen_a_r == $permission || $igen_dash == $permission || $igen_e_ep == $permission || $igen_e_ea == $permission) {
                                    $display = "hide";
                                } else {
                                    $display = "show";
									
                                }
                            }
							
                            if (isset($_GET['loc'])) {
                                if ($display == "hide") {
                                    include_once 'app/main.php';
                                } elseif ($display == "show") {
                                    if ($_GET['loc'] != 'home') {
                                        include_once 'app/' . $_GET['loc'] . '.php';
                                    } else {
                                        include_once 'app/home.php';
                                    }
                                }
                            } else {
                                if ($display == "hide") {
                                    include_once 'app/main.php';
                                } elseif ($display == "show") {
                                    if (isset($_GET['eloc']) && $_GET['eloc'] != 'home') {
                                        include_once 'app/e_' . $_GET['eloc'] . '.php';
                                    } else {
                                        include_once 'app/e_emp_view_profile.php';
                                    }
                                }
                            }
                            ?>
                        </div> 
                    </div> 
					
<?php   
if($count_approval>0 || $totalRows_a>0){
?>
<!-- This contains the hidden content for inline calls -->
		<div style='display:none'> 
			<div id='inline_content' style='padding:10px; background:#eee;'>
			<input type="button"  value="Save" id="editBut" onclick="process()">
			 <br>
			 <table id="table_" >
        <thead><tr>
            <th style="20%">Approval level</th>
           
			<th style="20%">Delegate to</th>
            <th width="20%">Restore to Myself</th>
        </tr></thead><tbody>
		<?php 
		if($totalRows_level1!=0){
		?>
		<tr>
		<td bgcolor="#99FF33">Level 1</td>
		
		<td><select name="level1" id="level1">
		<?php
		if($e_name1!=""){
		
		?>
	  <option value="<?php echo $row_name1['id']; ?>"><?php echo $row_name1['full_name']; ?></option>
	  
        <?php
          }else{
		  
		  echo '<option value="">none</option>';
		  
		  }
      //$status="active"
        $sql = "SELECT e.full_name,  e.id as eid, e.level_id, u.a_ea, u.id as uid FROM  employee e, user_permission u WHERE u.a_ps='a_ps_show' AND e.level_id=u.id AND emp_status='Active'";
      
      //  $sql .=$status; 

       

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
		if($row_name1['id']!=$rs['eid'] && $user_id!=$rs['eid']){
           ?>
		   
         <option value="<?php echo $rs['eid']; ?>"><?php echo $rs['full_name']; ?></option>
	
      
          
		   <?php
		   
           }
        }
		
			 
		   if($row_level1['level_pos_1']!=0){
		
		?>
		</select></td> 
	   <td > <input style="margin-left:20px" name="lv1" type="checkbox" class="lv1" id="lv1" value="Y" /> </td>
	  <?php
	  }
		}
		
		if($totalRows_level2!=0){
	   ?>
		<tr>
		<td bgcolor="#99FF33">Level 2</td>
		
		<td><select name="level2" id="level2">
			<?php
		if($e_name2!=""){
		
		?>
	  <option value="<?php echo $row_name2['id']; ?>"><?php echo $row_name2['full_name']; ?></option>
	  
        <?php
          }else{
		  ?> 
	  <option value="">None</option>
        <?php 
}
      //$status="active"
       $sql = "SELECT e.full_name,  e.id as eid, e.level_id, u.a_ea, u.id as uid FROM  employee e, user_permission u WHERE u.a_ps='a_ps_show' AND e.level_id=u.id AND emp_status='Active'";
      
      //  $sql .=$status;

       

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
           
         if($row_name2['id']!=$rs['eid'] && $user_id!=$rs['eid']){
           ?>
		   
         <option value="<?php echo $rs['eid']; ?>"><?php echo $rs['full_name']; ?></option>
	
      
          
		   
		   
          
		   
		   <?php
		   }
           
        }
		   if($row_level2['level_pos_2']!=0){
		
		?>
		</select></td> 
	   <td > <input style="margin-left:20px" name="lv2" type="checkbox" class="lv2" id="lv2" value="Y" /> </td>
	  <?php
	  }
		}
		if($totalRows_level3!=0){
	   ?>
		<tr>
		<td bgcolor="#99FF33">Level 3</td>
		
		<td><select name="level3" id="level3">
	  	<?php
		if($e_name3!=""){
		
		?>
	  <option value="<?php echo $row_name3['id']; ?>"><?php echo $row_name3['full_name']; ?></option>
	  
        <?php
          }else{
		  ?>
	  <option value="">None</option>
        <?php
        }
      //$status="active"
	  
        $sql = "SELECT e.full_name,  e.id as eid, e.level_id, u.a_ea, u.id as uid FROM  employee e, user_permission u WHERE u.a_ps='a_ps_show' AND e.level_id=u.id AND emp_status='Active'";
      
      //  $sql .=$status; 

       

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
         if($row_name3['id']!=$rs['eid'] && $user_id!=$rs['eid']){
           ?>
		   
         <option value="<?php echo $rs['eid']; ?>"><?php echo $rs['full_name']; ?></option>
	
      
          
		   
		   
          
		   
		   <?php
		   }
           
        }
		   if($row_level3['level_pos_3']!=0){
		
		?>
		</select></td> 
	   <td > <input style="margin-left:20px" name="lv3" type="checkbox" class="lv3" id="lv3" value="Y" /> </td>
	  <?php
	  }
		}
		}else if($count_approval==0 && $totalRows_a>0){
		
		
		?>
		<div style='display:none'>

			<div id='inline_content' style='padding:10px; background:#eee;'>
			<input type="button"  value="Save" id="editBut" onclick="process()">
			 
			 <table id="table_" >
        <thead><tr>
            <th style="20%"><!--Approval level--></th> 
           
			<th style="20%">Delegate to</th>
            <th width="20%">Restore to Myself</th>
        </tr></thead><tbody>
		<?php 
		if($totalRows_a!=0){    
		
		?>
		<tr>
		<td bgcolor="#99FF33">Head of department delegation</td>
		
		<td><select name="level1" id="a_backup">
		<?php
		if($e_backup!=""){
		
		?>
	  <option value="<?php echo $row_backup['id']; ?>"><?php echo $row_backup['full_name']; ?></option>
	  
        <?php
          }else{
		  
		  echo '<option value="">none</option>';
		  
		  }
      //$status="active"
        $sql = "SELECT e.full_name,  e.id as eid, e.level_id, u.a_ea, u.id as uid FROM  employee e, user_permission u WHERE u.a_ps='a_ps_show' AND e.level_id=u.id AND emp_status='Active'";
      
      //  $sql .=$status; 

       

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
		if($row_backup['id']!=$rs['eid'] && $user_id!=$rs['eid']){
           ?>
		   
         <option value="<?php echo $rs['eid']; ?>"><?php echo $rs['full_name']; ?></option>
	
      
          
		   <?php
		   
           }
        }
		
			 
		   if($a_backup!=0){
		
		?>
		</select></td> 
	   <td > <input style="margin-left:20px" name="lv1" type="checkbox" class="lv1_backup" id="lv1_backup" value="Y" /> </td>
	  <?php
	  }
		}
	
		}
        ?>
		
		</tr></tbody>
   </table>
			</div>
		</div>					
                </div>   
                <div class="bottomlabel"><?php 

				include_once 'app/footer.php'; ?></div> 
            </div> 
        </body>
    </html>
    <?php

} else {
    include('app/login.php');
}
?>
  
    <script type="text/javascript">
       /* $(document).ready(function($) {
		
            $('body').scrollToTop({skin: 'square'});
        });*/
	
    </script>
<style>
#cboxLoadedContent {
    height: auto !important;
}
</style>
<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
