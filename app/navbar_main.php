<?php
$queryGetEmp = mysql_query("SELECT distinct employee.full_name,employee.id as eid FROM employee
  WHERE EXISTS (SELECT * FROM injury_details
                WHERE injury_details.emp_id = employee.id)
OR
EXISTS (SELECT * FROM incident_detail
                WHERE incident_detail.emp_id = employee.id)
OR
EXISTS (SELECT * FROM injury_management
                WHERE injury_management.emp_id = employee.id)");
$count=mysql_num_rows($queryGetEmp);
$rowGetEmp = mysql_fetch_array($queryGetEmp);
$em_id=$rowGetEmp['eid'];

$userID = $_COOKIE["igen_user_id"];

/* human resource */  
if (isset($_GET["loc"]) == true && ($_GET["loc"] == "home" || $_GET["loc"] == "leave_calendar" || $_GET["loc"] == "admin_appraisal"   || $_GET["loc"] == "incident_management" || $_GET["loc"] == "emp_transfer" || $_GET["loc"] == "view_profile_new" || $_GET["loc"] == "view_attendance" || $_GET["loc"] == "new_profile" || $_GET["loc"] == "incident_record" || $_GET["loc"] == "dashboard" || $_GET["loc"] == "disciplinary_record" || $_GET["loc"] == "import_excel")) { 

    $bg_color_pr = '';
    $bg_color_ea = '';
    $bg_color_hr = '#009ece';
    $bg_color_p = '';
    $bg_color_e = '';  
    $bg_color_ps = '';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_ap = '';
    $left = '120px';
    $display_pr = 'display: none;';
    $display_ea = 'display: none;'; 
    $display_hr = 'display: block;';
    $display_p = 'display: none;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: none;';
    $a_hr_color = 'style="color: black; font-weight: bold;"';
    $a_hr_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
	$a_dis_color = 'display: none;'; 
    $a_dis_grad = 'display: none;';
    /* emp profile */
} elseif (isset($_GET["eloc"]) == true && ($_GET["eloc"] == "emp_view_profile" || $_GET["eloc"] == "edit_emp_profile")) {
    $bg_color_pr = '#009ece';
    $bg_color_ea = '';
    $bg_color_hr = '';
    $bg_color_p = '';
    $bg_color_e = '';
    $bg_color_ps = '';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_ap = '';
    $left = '70px';
    $display_pr = 'display: block;';
    $display_ea = 'display: none;';
    $display_hr = 'display: none;';
    $display_p = 'display: none;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: none;';
    $e_pr_color = 'style="color: black; font-weight: bold;"';
    $e_pr_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
    /* emp payroll */
} elseif (isset($_GET["loc"]) == true && ($_GET["loc"] == "payroll")) {
    $bg_color_pr = '';
    $bg_color_ea = '';
    $bg_color_hr = '';
    $bg_color_p = '#009ece';
    $bg_color_e = '';
    $bg_color_ps = '';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_ap = '';
    $left = '60px';
    $display_pr = 'display: none;';
    $display_ea = 'display: none;';
    $display_hr = 'display: none;';
    $display_p = 'display: block;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: none;';
    $a_p_color = 'style="color: black; font-weight: bold;"'; 
    $a_p_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
	$a_dis_color = 'display: none;'; 
    $a_dis_grad = 'display: none;';
}elseif (isset($_GET["eloc"]) == true && ($_GET["eloc"] == "emp_appraisal")) {
    $bg_color_pr = '';
    $bg_color_ea = '';
    $bg_color_hr = '';
    $bg_color_ap = '#009ece';
    $bg_color_e = '';
    $bg_color_ps = '';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_p = '';
    $left = '60px';
    $display_pr = 'display: none;';
    $display_ea = 'display: none;';
    $display_hr = 'display: none;';
    $display_p = 'display: block;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: none;'; 
    $a_pp_color = 'style="color: black; font-weight: bold;"'; 
    $a_ap_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
    /* e application */
}elseif (isset($_GET["loc"]) == true && ($_GET["loc"] == "appraisal-form")) {
    $bg_color_pr = '';
    $bg_color_ea = '';
    $bg_color_hr = '';
    $bg_color_ap = '#009ece';
    $bg_color_e = '';
    $bg_color_ps = '';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_p = '';
    $left = '60px';
    $display_pr = 'display: none;';
    $display_ea = 'display: none;';
    $display_hr = 'display: none;';
    $display_p = 'display: block;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: none;';
    $a_pp_color = 'style="color: black; font-weight: bold;"'; 
    $a_ap_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
	$a_dis_color = 'display: none;'; 
    $a_dis_grad = 'display: none;';
    /* e application */
} elseif (isset($_GET["eloc"]) == true && ($_GET["eloc"] == "emp_claim_app" || $_GET["eloc"] == "emp_training_app" || $_GET["eloc"] == "movement" || $_GET["eloc"] == "emp_leave_app" || $_GET["eloc"] == "emp_ot_app" || $_GET["eloc"] == "holiday_replacement" || $_GET["eloc"] == "emp_loan_app" )) {
    $bg_color_pr = '';
    $bg_color_ea = '#009ece';
    $bg_color_hr = '';
    $bg_color_p = '';
    $bg_color_e = '';
    $bg_color_ps = '';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_ap = '';
    $left = '100px';
    $display_pr = 'display: none;';
    $display_ea = 'display: block;';
    $display_hr = 'display: none;';
    $display_p = 'display: none;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: none;';
    $e_ea_color = 'style="color: black; font-weight: bold;"'; 
    $e_ea_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
    /* e-application */
} elseif (isset($_GET["loc"]) == true && ($_GET["loc"] == "e_replacement" || $_GET["loc"] == "emp_claim" || $_GET["loc"] == "e_training" || $_GET["loc"] == "e_leave" || $_GET["loc"] == "e_overtime" || $_GET["loc"] == "e_career" || $_GET["loc"] == "e_loan" || $_GET["loc"] == "emp_movement")) {
    $bg_color_pr = '';
    $bg_color_ea = '';
    $bg_color_hr = '';
    $bg_color_p = '';
    $bg_color_e = '#009ece';
    $bg_color_ps = '';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_ap = '';
    $left = '190px';
    $display_pr = 'display: none;';
    $display_ea = 'display: none;';
    $display_hr = 'display: none;';
    $display_p = 'display: none;';
    $display_e = 'display: block;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: none;';
    $a_e_color = 'style="color: black; font-weight: bold;"';
    $a_e_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
	$a_dis_color = 'display: none;'; 
    $a_dis_grad = 'display: none;';
    /* planning */
} elseif (isset($_GET["loc"]) == true && ($_GET["loc"] == "planning" || $_GET["loc"] == "simulation")) {
    $bg_color_pr = '';
    $bg_color_ea = '';
    $bg_color_hr = '';
    $bg_color_p = '';
    $bg_color_e = '';
    $bg_color_ps = '#009ece';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_ap = '';
    $left = '150px';
    $display_pr = 'display: none;';
    $display_ea = 'display: none;';
    $display_hr = 'display: none;';
    $display_p = 'display: none;';
    $display_e = 'display: none;';
    $display_ps = 'display: block;';
    $display_m = 'display: none;';
    $display_r = 'display: none;';
    $a_ps_color = 'style="color: black; font-weight: bold;"';   
    $a_ps_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
	$a_dis_color = 'display: none;'; 
    $a_dis_grad = 'display: none;';
    /* maintenance */ 
} elseif (isset($_GET["loc"]) == true && ($_GET["loc"] == "holiday_group_edit" || $_GET["loc"] == "property_type" || $_GET["loc"] == "appraisal_cycle" || $_GET["loc"] == "import_epf" || $_GET["loc"] == "import_socso"|| $_GET["loc"] == "import_pcb"|| $_GET["loc"] == "rating"|| $_GET["loc"] == "Questions"|| $_GET["loc"] == "session" || $_GET["loc"] == "increment_approval"|| $_GET["loc"] == "employee_type"|| $_GET["loc"] == "bank_management" || $_GET["loc"] == "company" || $_GET["loc"] == "holiday_group_management" || $_GET["loc"] == "approval_mgnt" || $_GET["loc"] == "shift" || $_GET["loc"] == "time_attendance_add" || $_GET["loc"] == "time_attendance"  || $_GET["loc"] == "time_attendance_add_sche" || $_GET["loc"] == "predefined_letter" || $_GET["loc"] == "time_table" || $_GET["loc"] == "branch_management" || $_GET["loc"] == "holiday_management" || $_GET["loc"] == "property_maintain" || $_GET["loc"] == "benefits_entitlement" || $_GET["loc"] == "loan_management" || $_GET["loc"] == "leave_maintain" || $_GET["loc"] == "training_management" || $_GET["loc"] == "position_management" || $_GET["loc"] == "level_management" || $_GET["loc"] == "allowance" || $_GET["loc"] == "department" || $_GET["loc"] == "group" || $_GET["loc"] == "leave_type" || $_GET["loc"] == "time_table_add" || $_GET["loc"] == "overtime_management" || $_GET["loc"] == "performance_appraisal" || $_GET["loc"] == "allowance_processing" || $_GET["loc"] == "claims_payroll"|| $_GET["loc"] == "deduction_payroll")) {
    $bg_color_pr = '';
    $bg_color_ea = '';
    $bg_color_hr = ''; 
    $bg_color_p = '';
    $bg_color_e = '';
    $bg_color_ps = '';
	$bg_color_ap = '';
    $bg_color_m = '#009ece';
    $bg_color_r = '';
    $left = '100px';
    $display_pr = 'display: none;';
    $display_ea = 'display: none;';
    $display_hr = 'display: none;';
    $display_p = 'display: none;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: block;';
    $display_r = 'display: none;';
    $a_m_color = 'style="color: black; font-weight: bold;"';
    $a_m_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
	$a_dis_color = 'display: none;'; 
    $a_dis_grad = 'display: none;';
    /* report */
} elseif (isset($_GET["loc"]) == true && ($_GET["loc"] == "form" || $_GET["loc"] == "report")) {
    $bg_color_pr = '';
    $bg_color_ea = '';
    $bg_color_hr = '';
    $bg_color_p = '';
    $bg_color_e = '';
    $bg_color_ps = '';
    $bg_color_m = '';
	$bg_color_ap = '';
    $bg_color_r = '#009ece';
    $left = '80px';
    $display_pr = 'display: none;';
    $display_ea = 'display: none;';
    $display_hr = 'display: none;';
    $display_p = 'display: none;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: block;';
    $a_r_color = 'style="color: black; font-weight: bold;"';
    $a_r_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
	$a_dis_color = 'display: none;'; 
    $a_dis_grad = 'display: none;';
} elseif (isset($_GET["loc"]) == true && ($_GET["loc"] == "incident_record_view") || ($_GET["loc"] == "incident_report") || ($_GET["loc"] == "appraisal_group")) {  
    $bg_color_pr = '';
    $bg_color_ea = '#009ece';
    $bg_color_hr = '';
    $bg_color_p = '';
    $bg_color_e = '';
    $bg_color_ps = '';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_ap = '';
    $left = '100px';
    $display_pr = 'display: none;';
    $display_ea = 'display: block;';
    $display_hr = 'display: none;';
    $display_p = 'display: none;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: none;';
    $e_ea_color = 'display: none;'; 
    $e_ea_grad = 'display: none;';
	$appr_color = 'style="color: black; font-weight: bold;"'; 
    $appr_grad = 'class="topbar_tab"';
	$a_dis_color = 'display: none;'; 
    $a_dis_grad = 'display: none;';
    /* e-application */
} elseif (isset($_GET["loc"]) == true && ($_GET["loc"] == "disciplinary" || $_GET["loc"] == "counselling" || $_GET["loc"] == "investigation" || $_GET["loc"] == "domestic_inquiry")){
    $bg_color_pr = '';
    $bg_color_ea = '';
    $bg_color_hr = '';
    $bg_color_p = '#009ece';
    $bg_color_e = '';
    $bg_color_ps = '';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_ap = '';
    $left = '60px';
    $display_pr = 'display: none;';
    $display_ea = 'display: none;';
    $display_hr = 'display: none;';
    $display_p = 'display: block;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: none;';
    $a_dis_color = 'style="color: black; font-weight: bold;"'; 
    $a_dis_grad = 'class="topbar_tab"';
	$appr_color = 'display: none'; 
    $appr_grad = 'display: none';
   
}else {
    $bg_color_pr = '';
    $bg_color_ea = '';
    $bg_color_hr = '';
    $bg_color_p = '';
    $bg_color_e = '';
    $bg_color_ps = '';
    $bg_color_m = '';
    $bg_color_r = '';
	$bg_color_ap = '';
    $display_pr = 'display: none;';
    $display_ea = 'display: none;';
    $display_hr = 'display: none;';
    $display_p = 'display: none;';
    $display_e = 'display: none;';
    $display_ps = 'display: none;';
    $display_m = 'display: none;';
    $display_r = 'display: none;';
}

include("leave_alert.php");



?>
<style>
    .topbar_tab{
        /*        height: 0;*/
        height: 32px;
        width: 97%;
        position: relative; 
        top: 6px;
        /*        border-bottom: 35px solid white; 
                border-left: 0px solid transparent; 
                border-right: 10px solid transparent; */

        background-image: url('css/theme_c/BG_Tab.png');
        background-repeat: repeat-x;

        border-left: none;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topright: 5px;
        border-top-right-radius: 5px;
        -webkit-border-top-left-radius: 5px;
        -moz-border-radius-topleft: 5px;
        border-top-left-radius: 5px;

        background-color: #e7e6e6; 
        background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ffffff), to(#d1d3d4)); 
        background: -webkit-linear-gradient(top, #ffffff, #d1d3d4); 
        background: -moz-linear-gradient(top, #ffffff, #d1d3d4); 
        background: -ms-linear-gradient(top, #ffffff, #d1d3d4); 
        background: -o-linear-gradient(top, #ffffff, #d1d3d4);
    }
	.count-style{
		background:#781715;
		margin-left: -4px; 
		position: relative; 
	    top: -8px;color: #fff; 
		font-style: italic; 
		border-radius: 4px; 
		padding-left: 2px; 
		padding-right: 3px; 
	}
</style>
<div class="topbar" style="width: 100%; border-collapse: collapse;">
    <table style="width: 1200px; margin-left: auto; margin-right: auto;">
        <tr>
            <?php if ($igen_dash == "dash_hide") { ?>
                <td style="width: 121px; height: 40px;">
                    <ul class="sf-menu">
                        <li><a href="?eloc=emp_view_profile&viewId=<?php echo $_COOKIE["igen_user_id"] ?>" <?php echo $e_pr_color; ?>><!--<i class="fas fa-id-card" <?php echo $e_pr_color; ?> >--></i>My Profile</a></li>
						
                    </ul>
                    <div <?php echo $e_pr_grad; ?>>&nbsp;</div>
                </td>
            <?php } ?>
            <?php if ($igen_a_hr != "a_hr_hide") { ?>
                <td style="width: 170px; height: 40px;">
                    <ul class="sf-menu">
                        <li>
                            <a href="#" <?php echo $a_hr_color; ?>>Human Resource</a>
                            <ul>
                                <li class="current"><a href="?loc=home">Employee List</a></li>
                                <?php if ($igen_a_hr == "a_hr_edit") { ?>
                                   <li class="current"><a href="?loc=emp_transfer">Employee Transfer</a></li> 
                                <?php } ?>
								<?php if ($igen_a_hr == "a_hr_edit") { ?>
                                  <!-- <li class="current"><a href="?loc=incident_management&viewId=<?php echo $em_id ?>">Incident Management</a></li> -->
                                <?php } ?>
								  
                                <li class="current"><a href="?loc=leave_calendar">Leave Calendar</a></li>
								
                            </ul>
                        </li>
                    </ul>
                    <div <?php echo $a_hr_grad; ?>>&nbsp;</div>
                </td>
            <?php } ?>
            <?php if ($igen_a_pr != "a_pr_hide") { ?>
                <td style="width: 90px; height: 40px;">
                    <ul class="sf-menu">
                        <li>
                        <li class="current"><a href="?loc=payroll" <?php echo $a_p_color; ?>>Payroll</a></li>
                        </li>
                    </ul>
                    <div <?php echo $a_p_grad; ?>>&nbsp;</div>
                </td>
            <?php } ?>
            <?php if ($igen_e_ea != "e_ea_hide") { ?>
                <td style="width: 133px;">
                    <ul class="sf-menu">
                        <li>
                            <a href="#" <?php echo $e_ea_color; ?>><!--<i class="fas fa-align-justify" <?php echo $e_ea_color; ?>></i>-->Applications</a>
                            <ul>
                                <li class="current"><a href="?eloc=emp_claim_app">Claim</a></li>
								<li class="current"><a href="?eloc=emp_loan_app">Loan</a></li>
                                <li class="current"><a href="?eloc=emp_leave_app">Leave</a></li>
								<li class="current"><a href="?eloc=movement">Movement</a></li>
                                
                                <li class="current"><a href="?eloc=emp_ot_app">Overtime</a></li>
                                <li class="current"><a href="?eloc=emp_training_app">Training</a></li>
                                <li class="current"><a href="?eloc=holiday_replacement">Holiday Replacement</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div <?php echo $e_ea_grad; ?>>&nbsp;</div>
                </td>
				
            <?php } ?>
            <?php if ($igen_a_ea != "a_ea_hide") { ?>
                <td style="width: 120px; height: 40px;"> 
                    <ul class="sf-menu">
                        <li>
                            <a href="#" <?php echo $a_e_color; ?>>Approval <?php if($total_count!=0){?><span class="count-style"><?php echo $total_count; ?></span>   <?php }  ?></a>
                             <ul >
                               <!-- <li class="current"><a href="?loc=e_career">Career</a></li>-->
                                <li class="current"><a href="?loc=emp_claim&str1=Pending&str2=Approved&str3=Rejected&e=edit">Claim
								<?php if($count1!=0){?><span class="count-style"><?php echo  $count1; ?></span>   <?php }  ?></a></li>
								<li class="current"><a href="?loc=e_loan&str1=Pending&str2=Approved&str3=Rejected">Loan
								<?php if($count2!=0){?><span class="count-style"><?php echo  $count2; ?></span>   <?php }  ?></a></li>
                                <li class="current"><a href="?loc=e_leave&str1=Pending&str2=Approved&str3=Rejected&e=edit">Leave
								<?php if($count!=0){?><span class="count-style"><?php echo $count; ?></span>   <?php }  ?></a></li>
								<li class="current"><a href="?loc=emp_movement&str1=Pending&str2=Approved&str3=Rejected&e=edit">Movement
								<?php if($move1_count!=0){?><span class="count-style"><?php echo  $move1_count; ?></span>   <?php }  ?></a></li>
                                
                                <li class="current"><a href="?loc=e_overtime&str1=Pending&str2=Approved&str3=Rejected&e=edit">Overtime
								<?php if($count7!=0){?><span class="count-style"><?php echo  $count7; ?></span>   <?php }  ?></a></li>
                                <li class="current"><a href="?loc=e_training&str1=Pending&str2=Approved&str3=Rejected&e=edit">Training
								<?php if($count5!=0){?><span class="count-style"><?php echo  $count5; ?></span>   <?php }  ?></a></li>
                                <li class="current"><a href="?loc=e_replacement&str1=Pending&str2=Approved&str3=Rejected&e=edit">Holiday Replacement
								<?php if($count6!=0){?><span class="count-style"><?php echo  $count6; ?></span>   <?php }  ?></a></li>
                            </ul>
                        </li>
                    </ul>
                    <div <?php echo $a_e_grad; ?>>&nbsp;</div>
                </td>
            <?php } ?>
			
			<?php
			if($igen_epr=="epr_view" || $igen_epr=="epr_edit"){ 
			
			   if($igen_epr != "epr_hide"){
				   
              			
			?>
				<td style="width: 100px;">
                    <ul class="sf-menu">
                        <li>
                            <a href="?loc=incident_record_view" <?php echo $appr_color; ?>>Accident</a>
                        </li>
                    </ul>
                    <div <?php echo $appr_grad; ?>>&nbsp;</div>
                </td>
			<?php
			}
			}
			?>
            <?php if ($igen_a_ps != "a_ps_hide") { ?>
		
                <td style="width: 175px; height: 40px;">
                     <ul class="sf-menu">
                        <li>
                            <a href="?loc=simulation" <?php echo $a_ps_color; ?>>Bonus & Increment</a>
                           <!-- <ul>
                                <li class="current"><a href="?loc=planning">Planning</a></li>
                                <li class="current"><a href="?loc=simulation">Bonus &#38; Increment</a></li>
                            </ul>-->
                        </li>
                    </ul>
                    <div <?php echo $a_ps_grad; ?>>&nbsp;</div>
                </td>
            <?php } ?>
			<?php if ($igen_a_m != "a_m_hide") { ?>
                <td style="width: 130px; height: 40px;">
                    <ul class="sf-menu">
                        <li>
                            <a href="#" <?php echo $a_m_color; ?>>Maintenance</a>
                            <ul>
                                <li><a href="#">Employees</a>
                                    <ul>
                                        <li class="current"><a href="?loc=allowance">Allowance</a></li>
										<li class="current"><a href="?loc=claims_payroll">Claims</a></li>
										<li class="current"><a href="?loc=deduction_payroll">Deduction</a></li>
										<li class="current"><a href="?loc=loan_management">Loans</a></li>
										<li class="current"><a href="?loc=allowance_processing">Deductions & Earnings Payroll</a></li>
                                        <li class="current"><a href="?loc=overtime_management">Overtime</a></li>
                                        <li class="current"><a href="?loc=property_maintain">Company Asset</a></li>
										<li class="current"><a href="?loc=benefits_entitlement">Benefits Entitled</a></li>
                                        <li class="current"><a href="?loc=shift">Shift</a></li>
                                        <li class="current"><a href="?loc=time_attendance">Time Attendance</a></li>
                                        <li class="current"><a href="?loc=time_attendance_add_sche">Schedule Time Attendance</a></li>
                                        <li class="current"><a href="?loc=training_management">Training</a></li>
										
                                    </ul>
                                </li>
						
                                <li><a href="#">General</a>
                                    <ul>
                                       <!-- <li class="current"><a href="?loc=performance_appraisal">Appraisal</a></li>-->
                                        <li class="current"><a href="?loc=approval_mgnt">Approval Work flow </a></li>
										<li class="current"><a href="?loc=increment_approval">Increment Approval</a></li>
                                        <li class="current"><a href="?loc=branch_management">Branch</a></li>
                                        <li class="current"><a href="?loc=company">Company</a></li>
                                        <li class="current"><a href="?loc=department">Department</a></li>
										<li class="current"><a href="?loc=bank_management">Bank</a></li>
										<li class="current"><a href="?loc=employee_type">Employee type</a></li>
                                        <li class="current"><a href="?loc=group">Section/Unit</a></li>
                                        <li class="current"><a href="?loc=position_management">Position</a></li>
                                        <li class="current"><a href="?loc=predefined_letter">Pre-defined Letters</a></li>
                                        <li class="current"><a href="?loc=property_type">Company Asset Type</a></li>
                                        <li class="current"><a href="?loc=level_management">User Permission</a></li>
										<li class="current"><a href="?loc=session">Time logout</a></li>
                                    </ul>
                                </li>
								<!-- <li><a href="#">Appraisal</a> 
                                    <ul >
                                        <li class="current"><a href="#">Appraisal Template</a>
										 <ul style="margin-left:60px;">
                                        <li class="current"><a href="?loc=performance_appraisal">Create Forms</a>
										 <li class="current"><a href="?loc=Questions">Create Questions</a></li>
										 <li class="current"><a href="?loc=rating">Create Rating</a></li>
										</ul>
										</li>
										</li>
                                        <li class="current"><a href="?loc=appraisal_cycle">Appraisal Cycle</a></li>
										
                                     </ul>
                                </li>-->
                                <li><a href="#">Holiday</a>
                                    <ul>
                                        <li class="current"><a href="?loc=holiday_management">Holiday</a></li>
                                        <li class="current"><a href="?loc=holiday_group_management">Holiday Group</a></li>
                                     </ul>
                                </li>
                                <li><a href="#">Leave</a>
                                    <ul>
                                        <li class="current"><a href="?loc=leave_type">Leave</a></li>
                                        <li class="current"><a href="?loc=leave_maintain">Leave Group</a></li>
                                    </ul>
                                </li>
                                <?php if ($igen_a_m == "a_m_edit") { ?>
								
                                    <li><a href="#">Spreadsheet</a>
                                        <ul>
                                            <li class="current"><a href="?loc=import_epf">EPF</a></li>
                                            <li class="current"><a href="?loc=import_socso">SOCSO</a></li>
                                            <li class="current"><a href="?loc=import_pcb">PCB</a></li>
											<li class="current"><a href="?loc=import_eis">EIS</a></li>
											<li class="current"><a href="?loc=import_fweis">FWEIS</a></li>
                                        </ul>
                                    </li>
									
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                    <div <?php echo $a_m_grad; ?>>&nbsp;</div>
                </td>
            <?php } ?>
			<?php if ($igen_disc == "disc_show") { ?>
		
                <td style="width: 120px; height: 40px;">
                     <ul class="sf-menu">
                        <li>
                            <a href="?loc=disciplinary" <?php echo $a_dis_color; ?>>Disciplinary</a>
								<ul>
                                <li class="current"><a href="?loc=disciplinary">Disciplinary</a></li>
								<?php if ($igen_a_hr == "a_hr_view") { ?>
									<li class="current"><a href="?loc=counselling">Counselling</a></li>
								<?php } ?>
								<?php if ($igen_a_hr == "a_hr_edit") { ?>
									<li class="current"><a href="?loc=counselling">Counselling</a></li>
									<li class="current"><a href="?loc=investigation">Investigation</a></li>
									<li class="current"><a href="?loc=domestic_inquiry">Domestic Inquiry</a></li>
								<?php } ?>
								</ul>
                        </li>
                    </ul>
                    <div <?php echo $a_dis_grad ; ?>>&nbsp;</div>
                </td>
            <?php } ?>
			<?php if ($igen_appraisal != "appraisal_hide") { ?>
		
                <td style="width: 115px; height: 40px;">
                     <ul class="sf-menu">
                        <li>
                            <a href="?eloc=emp_appraisal" <?php echo $a_pp_color; ?>><!--<i class="fas fa-file-alt" <?php echo $a_pp_color; ?>></i>-->Appraisal</a>
                           <!-- <ul>
                                <li class="current"><a href="?loc=planning">Planning</a></li>
                                <li class="current"><a href="?loc=simulation">Bonus &#38; Increment</a></li>
                            </ul>-->
                        </li>
                    </ul>
                    <div <?php echo $a_ap_grad ; ?>>&nbsp;</div>
                </td>
            <?php } ?>
            
            <?php if ($igen_a_r != "a_r_hide") { ?>
                <td style="width: 110px; height: 40px;">
                    <ul class="sf-menu">
                        <li>
                            <a href="#" <?php echo $a_r_color; ?>>Reporting</a>
                            <ul>
                                <li class="current"><a href="?loc=report">Reports</a></li>
                                <li class="current"><a href="?loc=form">Government Forms</a></li>
                                <li class="current"><a href="?loc=attendance_report_normal">Attendance Normal Report</a></li>
                                <li class="current"><a href="?loc=attendance_report_shift">Attendance Shift Report</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div <?php echo $a_r_grad; ?>>&nbsp;</div>
                </td>
            <?php } ?>
            <td>&nbsp;</td>
        </tr>
    </table>
</div>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>