<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php



$comp_id=$_GET['company_id'];

/* HR Report Variables */
$tableth="<th></th>";
$tabletd_l="";
$tabletd_f="";
$tabletd_mc="";
$tabletd_resign="";
$salary_l="";
$salary_f="";
$salary_total="";
$open_head_count="";
$closing_head_count="";
$table_dep="";
$ot_duration="";
$allowance="";
$ot_amount="";
$local="";
$foreigner="";
$mc="";
$resign="";
$new_hired="";
$open_head_counta="";

$local_company=0;
$foreign_company=0;
$local_staff_cost=0;
$foreign_staff_cost=0;
$ot_hours_clocked=0;
$ot_cost=0;
$allowance_cost=0;

$local_staff_cost_com=0;
$foreign_staff_cost_com=0;
$ot_hours_clocked_com=0;
$ot_cost_com=0;
$allowance_cost_com=0;
/* END HR Report Variables */
/* Wages Report Variables*/
$wages_local="";
$wages_foreign="";
/* End */
$new="";
$year=date('Y');
$month=date('m');
// Variables for Montly employee cost
$table_wages_td="";
$total_dep=0;
$total_jan_dep=0;$total_feb_dep=0;$total_mar_dep=0;$total_apr_dep=0;$total_may_dep=0;$total_jun_dep=0;$total_july_dep=0;
$total_aug_dep=0;$total_sep_dep=0;$total_oct_dep=0;$total_nov_dep=0;$total_dec_dep=0;
$employer_epf_jan=0;$employer_epf_feb=0;$employer_epf_mar=0;$employer_epf_apr=0;$employer_epf_may=0;$employer_epf_jun=0;$employer_epf_july=0;$employer_epf_aug=0;$employer_epf_sep=0;$employer_epf_oct=0;
$employer_epf_nov=0;$employer_epf_dec=0;
$employer_socso_jan=0;$employer_socso_feb=0;$employer_socso_mar=0;$employer_socso_apr=0;$employer_socso_may=0;$employer_socso_jun=0;$employer_socso_july=0;$employer_socso_aug=0;$employer_socso_sep=0;$employer_socso_oct=0;
$employer_socso_nov=0;$employer_socso_dec=0;
$employer_eis_jan=0;$employer_eis_feb=0;$employer_eis_mar=0;$employer_eis_apr=0;$employer_eis_may=0;$employer_eis_jun=0;$employer_eis_july=0;$employer_eis_aug=0;$employer_eis_sep=0;$employer_eis_oct=0;
$employer_eis_nov=0;$employer_eis_dec=0;
$employer_hrdf_jan=0;$employer_hrdf_feb=0;$employer_hrdf_mar=0;$employer_hrdf_apr=0;$employer_hrdf_may=0;$employer_hrdf_jun=0;$employer_hrdf_july=0;$employer_hrdf_aug=0;$employer_hrdf_sep=0;$employer_hrdf_oct=0;
$employer_hrdf_nov=0;$employer_hrdf_dec=0;
$employer_fweis_jan=0;$employer_fweis_feb=0;$employer_fweis_mar=0;$employer_fweis_apr=0;$employer_fweis_may=0;$employer_fweis_jun=0;$employer_fweis_july=0;$employer_fweis_aug=0;$employer_fweis_sep=0;$employer_fweis_oct=0;
$employer_fweis_nov=0;$employer_fweis_dec=0;
// End

//Get the employee group by department
$sql_local= "SELECT d.dep_name, d.id as did,count(e.id) as count , sum(e.salary) as salary FROM employee e LEFT JOIN department d on d.id = e.dep_id WHERE e.company_id='".$comp_id."' AND e.dep_id!=0 GROUP BY d.dep_name, d.id";
//$sql= "SELECT * from employee";
$sql_result_local = mysql_query($sql_local);

while($rs = mysql_fetch_array($sql_result_local)){
	/* HR Report */
	$sql_mc=mysql_query('SELECT sum(num_days) as mc FROM employee_leave WHERE depid="'.$rs['did'].'" and request_status="Approved" and leave_type_id=2 and year("leave_date")="'.$year.'"');
	$rs_mc = mysql_fetch_array($sql_mc);
	$sql_resigned=mysql_query('SELECT COUNT(e.id) as resgined  FROM employee e WHERE e.dep_id="'.$rs['did'].'" and e.emp_status="Resigned"');
	$rs_resigned = mysql_fetch_array($sql_resigned);
	$sql_new=mysql_query('SELECT COUNT(e.id) as new  FROM employee e WHERE e.dep_id="'.$rs['did'].'" and Month("e.join_date")="'.$month.'"');
	$rs_new = mysql_fetch_array($sql_new);
	$sql_country_l=mysql_query('SELECT count(e.id) as count, sum(e.salary) as salary FROM employee e WHERE e.dep_id="'.$rs['did'].'" AND e.country="Malaysia"');
	$rs_country_l = mysql_fetch_array($sql_country_l);
	$sql_country_f=mysql_query('SELECT count(e.id) as count, sum(e.salary) as salary FROM employee e WHERE e.dep_id="'.$rs['did'].'" AND e.country!="Malaysia"');
	$rs_country_f = mysql_fetch_array($sql_country_f);
	
	$sql_ot=mysql_query('SELECT sum(`ot_amount`) as otamount, dep_id, sum(`ot_duration`) as ot_duration, sum(`allowance`) as allowance FROM `payroll_report` where dep_id="'.$rs['did'].'"');
	$rs_ot = mysql_fetch_array($sql_ot);
	
	$tableth.="<th>".$rs['dep_name']."</th>";
	$table_dep.=$rs['dep_name'].",";
	
	/*Local*/
	if($rs_country_l['count']!=0){
		$tabletd_l.="<td style='text-align: center !important;'>".$rs_country_l['count']."</td>";
	}else{
		$tabletd_l.="<td style='text-align: center !important;'>-</td>";
	}
	if($rs_country_l['salary']!=0){
		$salary_l.="<td style='text-align: center !important;'>".$rs_country_l['salary']."</td>";
	}else{
		$salary_l.="<td style='text-align: center !important;'>-</td>";
	}
	$local.=$rs_country_l['count'].",";
	$local_company+=$rs_country_l['count'];
	$local_staff_cost.=$rs_country_l['salary'].",";
	$local_staff_cost_com+=$rs_country_l['salary'];
	/*End*/
	/*Foreign*/
	if($rs_country_f['count']!=0){
		$tabletd_f.="<td style='text-align: center !important;'>".$rs_country_f['count']."</td>";
	}else{
		$tabletd_f.="<td style='text-align: center !important;'>-</td>";
	}
	if($rs_country_f['salary']!=0){
		$salary_f.="<td style='text-align: center !important;'>".$rs_country_f['salary']."</td>";
	}else{
		$salary_f.="<td style='text-align: center !important;'>-</td>";
	}
	$foreigner.=$rs_country_f['count'].",";
	$foreign_company+=$rs_country_f['count'];
	$foreign_staff_cost.=$rs_country_f['salary'].",";
	$foreign_staff_cost_com+=$rs_country_f['salary'];
	/*End*/

	if($rs_mc['mc']!="" || $rs_mc['mc']!=0){
		$tabletd_mc.="<td style='text-align: center !important;'>".$rs_mc['mc']."</td>";
		$mc.=$rs_mc['mc'].",";
	 }else{
		$tabletd_mc.="<td style='text-align: center !important;'>-</td>";
		$mc.="0".",";
	}
	if($rs_resigned['resgined']!="" || $rs_resigned['resgined']!=0){
		$tabletd_resign.="<td style='text-align: center !important;'>".$rs_resigned['resgined']."</td>";
		$resign.=$rs_resigned['resgined'].",";
	 }else{
		$tabletd_resign.="<td style='text-align: center !important;'>-</td>";
		$resign.="0".",";
	}
	if($rs_new['new']!="" || $rs_new['new']!=0){
		$new.="<td style='text-align: center !important;'>".$rs_new['new']."</td>";
		$new_hired.=$rs_new['new'].",";
	 }else{
		$new.="<td style='text-align: center !important;'>-</td>";
		$new_hired.="0".",";
	}
	if($rs_ot['otamount']!="" || $rs_ot['otamount']!="0.00"){
		$ot_amount.="<td style='text-align: center !important;'>".$rs_ot['otamount']."</td>";
		$ot_cost.=$rs_ot['otamount'].",";
		$ot_cost_com+=$rs_ot['otamount'];
	 }else{
		$ot_amount.="<td style='text-align: center !important;'>-</td>";
		$ot_cost.="0".",";
	}
	if($rs_ot['ot_duration']!="" || trim($rs_ot['ot_duration'])!="0.00"){
		$ot_duration.="<td style='text-align: center !important;'>".$rs_ot['ot_duration']."</td>";
		$ot_hours_clocked.=$rs_ot['ot_duration'].",";
		$ot_hours_clocked_com+=$rs_ot['ot_duration'];
	 }else{
		$ot_duration.="<td style='text-align: center !important;'>-</td>";
		$ot_hours_clocked.="0".",";
	}
	if($rs_ot['allowance']!="" || trim($rs_ot['allowance'])!="0.00"){
		$allowance.="<td style='text-align: center !important;'>".$rs_ot['allowance']."</td>";
		$allowance_cost.=$rs_ot['allowance'].",";
		$allowance_cost_com+=$rs_ot['allowance'];
	 }else{
		$ot_duration.="<td style='text-align: center !important;'>-</td>";
		$allowance_cost.="0".",";
	}
	$head_count= ($rs_country_l['count'] + $rs_country_f['count']) - $rs_resigned['resgined'];
	$open_head_count.="<td style='text-align: center !important;'>".$head_count."</td>";
	$closing_head_count.="<td style='text-align: center !important;'>".$rs['count']."</td>";
	$salary_total.="<td style='text-align: center !important;'>".$rs['salary']."</td>";
	
	/*End HR Report */
	/* Wages Report */
	
	$netpaid_jan_l="-";$netpaid_jan_f="-";$netpaid_feb_l="-";$netpaid_feb_f="-";$netpaid_mar_l="-";$netpaid_mar_f=="-";$netpaid_apr_l="-";$netpaid_apr_f="-";$netpaid_may_l="-";$netpaid_may_f="-";
	$netpaid_jun_l="-";$netpaid_jun_f="-";$netpaid_july_f="-"; $netpaid_july_l="-";$netpaid_aug_f="-";$netpaid_sep_l="-";$netpaid_sep_f="-";$netpaid_oct_l="-";$netpaid_oct_f="-";$netpaid_nov_l="-";
	$netpaid_nov_f="-";$netpaid_dec_f="-";$netpaid_dec_f="-";$total_jan=0;$total_feb=0;$total_mar=0;$total_apr=0;$total_may=0;$total_jun=0;$total_july=0;
	$total_aug=0;$total_sep=0;$total_oct=0;$total_nov=0;$total_dec=0;
	
	
	$sql_wages=mysql_query('SELECT SUM(p.netpaid) as netpaid, pf.finalise_month, d.dep_name, e.country , SUM(p.employer_epf) as epf, SUM(p.employer_socso) as socso, SUM(p.employer_eis) as eis, SUM(p.hrdf) as hrdf, SUM(p.fweis) as fweis FROM payroll_report p LEFT JOIN payroll_finalised pf on pf.id=p.payroll_finalised_id INNER JOIN department d on d.id=p.dep_id INNER JOIN employee e on e.dep_id=p.dep_id WHERE p.dep_id="'.$rs['did'].'" group by e.country');
	while($rs_wages = mysql_fetch_array($sql_wages)){
		
		if($rs_wages['finalise_month']==1){
			if($rs_wages['country']=="Malaysia"){
				$netpaid_jan_l=number_format($rs_wages['netpaid'],2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_jan_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_jan+=$rs_wages['netpaid'];
			$employer_epf_jan+=$rs_wages['epf'];
			$employer_socso_jan+=$rs_wages['socso'];
			$employer_eis_jan+=$rs_wages['eis'];
			$employer_hrdf_jan+=$rs_wages['hrdf'];
			$employer_fweis_jan+=$rs_wages['fweis'];
		}else if($rs_wages['finalise_month']==2){
			if($rs_wages['country']=="Malaysia"){
				$netpaid_feb_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_feb_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_feb+=$rs_wages['netpaid'];
			$employer_epf_feb+=$rs_wages['epf'];
			$employer_socso_feb+=$rs_wages['socso'];
			$employer_eis_feb+=$rs_wages['eis'];
			$employer_hrdf_feb+=$rs_wages['hrdf'];
			$employer_fweis_feb+=$rs_wages['fweis'];
		}else if($rs_wages['finalise_month']==3){
			if($rs_wages['country']=="Malaysia"){
				$netpaid_mar_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_mar_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_mar+=$rs_wages['netpaid'];
			$employer_epf_mar+=$rs_wages['epf'];
			$employer_socso_mar+=$rs_wages['socso'];
			$employer_eis_mar+=$rs_wages['eis'];
			$employer_hrdf_mar+=$rs_wages['hrdf'];
			$employer_fweis_mar+=$rs_wages['fweis'];
		}else if($rs_wages['finalise_month']==4){
			if($rs_wages['country']=="Malaysia"){
				$netpaid_apr_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_apr_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_apr+=$rs_wages['netpaid'];
			$employer_epf_apr+=$rs_wages['epf'];
			$employer_socso_apr+=$rs_wages['socso'];
			$employer_eis_apr+=$rs_wages['eis'];
			$employer_hrdf_apr+=$rs_wages['hrdf'];
			$employer_fweis_apr+=$rs_wages['fweis'];
		}else if($rs_wages['finalise_month']==5){
			if($rs_wages['country']=="Malaysia"){
				$netpaid_may_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_may_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_may+=$rs_wages['netpaid'];
			$employer_epf_may+=$rs_wages['epf'];
			$employer_socso_may+=$rs_wages['socso'];
			$employer_eis_may+=$rs_wages['eis'];
			$employer_hrdf_may+=$rs_wages['hrdf'];
			$employer_fweis_may+=$rs_wages['fweis'];
		}else if($rs_wages['finalise_month']==6){
			if($rs_wages['country']=="Malaysia"){
				$netpaid_jun_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_jun_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_jun+=$rs_wages['netpaid'];
			$employer_epf_jun+=$rs_wages['epf'];
			$employer_socso_jun+=$rs_wages['socso'];
			$employer_eis_jun+=$rs_wages['eis'];
			$employer_hrdf_jun+=$rs_wages['hrdf'];
			$employer_fweis_jun+=$rs_wages['fweis'];
			
		}else if($rs_wages['finalise_month']==7){
			if($rs_wages['country']=="Malaysia"){
				$netpaid_july_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_july_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_july+=$rs_wages['netpaid'];
			$employer_epf_july+=$rs_wages['epf'];
			$employer_socso_july+=$rs_wages['socso'];
			$employer_eis_july+=$rs_wages['eis'];
			$employer_hrdf_july+=$rs_wages['hrdf'];
			$employer_fweis_july+=$rs_wages['fweis'];
		}else if($rs_wages['finalise_month']==8){
			if($rs_wages['country']=="Malaysia"){
				$netpaid_aug_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_aug_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_aug+=$rs_wages['netpaid'];
			$employer_epf_aug+=$rs_wages['epf'];
			$employer_socso_aug+=$rs_wages['socso'];
			$employer_eis_aug+=$rs_wages['eis'];
			$employer_hrdf_aug+=$rs_wages['hrdf'];
			$employer_fweis_aug+=$rs_wages['fweis'];
		}else if($rs_wages['finalise_month']==9){
			
			if($rs_wages['country']=="Malaysia"){
				$netpaid_sep_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_sep_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_sep+=$rs_wages['netpaid'];
			$employer_epf_sep+=$rs_wages['epf'];
			$employer_socso_sep+=$rs_wages['socso'];
			$employer_eis_sep+=$rs_wages['eis'];
			$employer_hrdf_sep+=$rs_wages['hrdf'];
			$employer_fweis_sep+=$rs_wages['fweis'];
		}else if($rs_wages['finalise_month']==10){
			if($rs_wages['country']=="Malaysia"){
				$netpaid_oct_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_oct_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_oct+=$rs_wages['netpaid'];
			$employer_epf_oct+=$rs_wages['epf'];
			$employer_socso_oct+=$rs_wages['socso'];
			$employer_eis_oct+=$rs_wages['eis'];
			$employer_hrdf_oct+=$rs_wages['hrdf'];
			$employer_fweis_oct+=$rs_wages['fweis'];
		}else if($rs_wages['finalise_month']==11){
			if($rs_wages['country']=="Malaysia"){
				$netpaid_nov_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_nov_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_nov+=$rs_wages['netpaid'];
			$employer_epf_nov+=$rs_wages['epf'];
			$employer_socso_nov+=$rs_wages['socso'];
			$employer_eis_nov+=$rs_wages['eis'];
			$employer_hrdf_nov+=$rs_wages['hrdf'];
			$employer_fweis_nov+=$rs_wages['fweis'];
		}else if($rs_wages['finalise_month']==12){
			$netpaid_dec=number_format($rs_wages['netpaid'], 2);
			if($rs_wages['country']=="Malaysia"){
				$netpaid_dec_l=number_format($rs_wages['netpaid'], 2);
			}
			if($rs_wages['country']!="Malaysia"){
				$netpaid_dec_f=number_format($rs_wages['netpaid'], 2);
			}
			$total_dec+=$rs_wages['netpaid'];
			$employer_epf_dec+=$rs_wages['epf'];
			$employer_socso_dec+=$rs_wages['socso'];
			$employer_eis_dec+=$rs_wages['eis'];
			$employer_hrdf_dec+=$rs_wages['hrdf'];
			$employer_fweis_dec+=$rs_wages['fweis'];
		}
		
        
	}
	$total_jan_dep+=$total_jan;$total_feb_dep+=$total_feb;$total_mar_dep+=$total_mar;$total_apr_dep+=$total_apr;$total_may_dep+=$total_may;$total_jun_dep+=$total_jun;$total_july_dep+=$total_july;
		$total_aug_dep+=$total_aug;$total_sep_dep+=$total_sep;$total_oct_dep+=$total_oct;$total_nov_dep+=$total_nov;$total_dec_dep+=$total_dec;
	//echo $total_jun;
	//exit();
	//$total_dep+=$total_jan + $total_feb + $total_mar + $total_apr + $total_may + $total_jun + $total_july + $total_aug + $total_sep + $total_oct + $total_nov + $total_dec;
	$total_months= $total_jan + $total_feb + $total_mar + $total_apr + $total_may + $total_jun + $total_july + $total_aug + $total_sep + $total_oct + $total_nov + $total_dec;
	$total_dep+=$total_months;
	$table_wages_td.="<tr><td class='col' rowspan='2'>".$rs['dep_name']."</td><td class='rows'>L</td><td class='rows'>".$netpaid_jan_l."</td><td class='rows'>".$netpaid_feb_l."</td><td class='rows'>".$netpaid_mar_l."</td><td class='rows'>".$netpaid_apr_l."</td><td class='rows'>".$netpaid_may_l."</td><td class='rows'>".$netpaid_jun_l."</td><td class='rows'>".$netpaid_july_l."</td>
						<td class='rows'>".$netpaid_aug_l."</td><td class='rows'>".$netpaid_sep_l."</td><td class='rows'>".$netpaid_oct_l."</td><td class='rows'>".$netpaid_nov_l."</td><td class='rows'>".$netpaid_dec_l."</td><td class='rows' rowspan='2'>".number_format($total_months, 2)."</td></tr>
						<tr><td class='rows'>F</td><td class='rows'>".$netpaid_jan_f."</td><td class='rows'>".$netpaid_feb_f."</td><td class='rows'>".$netpaid_mar_f."</td><td class='rows'>".$netpaid_apr_f."</td><td class='rows'>".$netpaid_may_f."</td><td class='rows'>".$netpaid_jun_f."</td><td class='rows'>".$netpaid_july_f."</td>
						<td class='rows'>".$netpaid_aug_f."</td><td class='rows'>".$netpaid_sep_f."</td><td class='rows'>".$netpaid_oct_f."</td><td class='rows'>".$netpaid_nov_f."</td><td class='rows'>".$netpaid_dec_f."</td></tr>";
}



// Employee Cost Statistic
$table_wages_td.="<tr class='wages_total'><td class='rows' colspan='2'>Total</td><td class='rows'>".number_format($total_jan_dep, 2)."</td><td class='rows'>".number_format($total_feb_dep, 2)."</td><td class='rows'>".number_format($total_mar_dep, 2)."</td><td class='rows'>".number_format($total_apr_dep, 2)."</td><td class='rows'>".number_format($total_may_dep, 2)."</td><td class='rows'>".number_format($total_jun_dep, 2)."</td><td class='rows'>".number_format($total_july_dep, 2)."</td>
						<td class='rows'>".number_format($total_aug_dep, 2)."</td><td class='rows'>".number_format($total_sep_dep, 2)."</td><td class='rows'>".number_format($total_oct_dep, 2)."</td><td class='rows'>".number_format($total_nov_dep, 2)."</td><td class='rows'>".number_format($total_dec_dep, 2)."</td><td class='rows' rowspan='2'>".number_format($total_dep, 2)."</td></tr>";
						


$table_wages_th="<tr><th class='col'>Department</th><th class='col'>Status</th><th class='col'>Jan</th><th class='col'>Feb</th><th class='col'>Mar</th><th class='col'>Apr</th><th class='col'>May</th><th class='col'>June</th><th class='col'>July</th>
							<th class='col'>Aug</th><th class='col'>Sep</th><th class='col'>Oct</th><th class='col'>Nov</th><th class='col'>Dec</th><th class='col'>Total</th></tr>";
							

							
//Employee Other Cost Statistic							
$total_epf_month=$employer_epf_jan + $employer_epf_feb + $employer_epf_mar + $employer_epf_apr + $employer_epf_may + $employer_epf_jun + $employer_epf_july + $employer_epf_aug + $employer_epf_sep + $employer_epf_oct + $employer_epf_nov + $employer_epf_dec;
$total_socso_month=$employer_socso_jan + $employer_socso_feb + $employer_socso_mar + $employer_socso_apr + $employer_socso_may + $employer_socso_jun + $employer_socso_july + $employer_socso_aug + $employer_socso_sep + $employer_socso_oct + $employer_socso_nov + $employer_socso_dec;	
$total_eis_month=$employer_eis_jan + $employer_eis_feb + $employer_eis_mar + $employer_eis_apr + $employer_eis_may + $employer_eis_jun + $employer_eis_july + $employer_eis_aug + $employer_eis_sep + $employer_eis_oct + $employer_eis_nov + $employer_eis_dec;
$total_hrdf_month=$employer_hrdf_jan + $employer_hrdf_feb + $employer_hrdf_mar + $employer_hrdf_apr + $employer_hrdf_may + $employer_hrdf_jun + $employer_hrdf_july + $employer_hrdf_aug + $employer_hrdf_sep + $employer_hrdf_oct + $employer_hrdf_nov + $employer_hrdf_dec;
$total_fweis_month=$employer_fweis_jan + $employer_fweis_feb + $employer_fweis_mar + $employer_fweis_apr + $employer_fweis_may + $employer_fweis_jun + $employer_fweis_july + $employer_fweis_aug + $employer_fweis_sep + $employer_fweis_oct + $employer_fweis_nov + $employer_fweis_dec;

$total_company_cont_jan=$employer_epf_jan  + $employer_socso_jan + $employer_eis_jan + $employer_fweis_jan; $total_company_cont_feb=$employer_epf_feb  + $employer_socso_feb + $employer_eis_feb + $employer_fweis_feb;	$total_company_cont_mar=$employer_epf_mar  + $employer_socso_mar + $employer_eis_mar + $employer_fweis_mar;	$total_company_cont_apr=$employer_epf_apr  + $employer_socso_apr + $employer_eis_apr + $employer_fweis_apr;	
$total_company_cont_may=$employer_epf_may  + $employer_socso_may + $employer_eis_may + $employer_fweis_may;$total_company_cont_jun=$employer_epf_jun  + $employer_socso_jun + $employer_eis_jun + $employer_fweis_jun;$total_company_cont_july=$employer_epf_july  + $employer_socso_july + $employer_eis_july + $employer_fweis_july;$total_company_cont_aug=$employer_epf_aug  + $employer_socso_aug + $employer_eis_aug + $employer_fweis_aug;
$total_company_cont_sep=$employer_epf_sep  + $employer_socso_sep + $employer_eis_sep + $employer_fweis_sep;$total_company_cont_oct=$employer_epf_oct  + $employer_socso_oct + $employer_eis_oct + $employer_fweis_oct;$total_company_cont_nov=$employer_epf_nov  + $employer_socso_nov + $employer_eis_nov + $employer_fweis_nov;$total_company_cont_dec=$employer_epf_dec  + $employer_socso_dec + $employer_eis_dec + $employer_fweis_dec;

$overall_total_comapny_con=$total_company_cont_jan + $total_company_cont_feb + $total_company_cont_mar + $total_company_cont_apr + $total_company_cont_may + $total_company_cont_jun + $total_company_cont_july + $total_company_cont_aug + $total_company_cont_sep + $total_company_cont_oct + $total_company_cont_nov + $total_company_cont_dec;

$table_other_cost_th="<tr><th class='col'>Other Cost</th><th class='col'>Jan</th><th class='col'>Feb</th><th class='col'>Mar</th><th class='col'>Apr</th><th class='col'>May</th><th class='col'>June</th><th class='col'>July</th>
							<th class='col'>Aug</th><th class='col'>Sep</th><th class='col'>Oct</th><th class='col'>Nov</th><th class='col'>Dec</th><th class='col'>Total</th></tr>";
$table_other_cost_td="<tr><td class='col'>EPF Company Contribution</td><td class='rows'>".number_format($employer_epf_jan, 2)."</td><td class='rows'>".number_format($employer_epf_feb, 2)."</td><td class='rows'>".number_format($employer_epf_mar, 2)."</td><td class='rows'>".number_format($employer_epf_apr, 2)."</td><td class='rows'>".number_format($employer_epf_may, 2)."</td><td class='rows'>".number_format($employer_epf_jun, 2)."</td><td class='rows'>".number_format($employer_epf_july, 2)."</td>
						<td class='rows'>".number_format($employer_epf_aug, 2)."</td><td class='rows'>".number_format($employer_epf_sep, 2)."</td><td class='rows'>".number_format($employer_epf_oct, 2)."</td><td class='rows'>".number_format($employer_epf_nov, 2)."</td><td class='rows'>".number_format($employer_epf_dec, 2)."</td><td class='rows'>".number_format($total_epf_month, 2)."</td></tr>
						
						<tr><td class='col'>Socso Company Contribution</td><td class='rows'>".number_format($employer_socso_jan, 2)."</td><td class='rows'>".number_format($employer_socso_feb, 2)."</td><td class='rows'>".number_format($employer_socso_mar, 2)."</td><td class='rows'>".number_format($employer_socso_apr, 2)."</td><td class='rows'>".number_format($employer_socso_may, 2)."</td><td class='rows'>".number_format($employer_socso_jun, 2)."</td><td class='rows'>".number_format($employer_socso_july, 2)."</td>
						<td class='rows'>".number_format($employer_socso_aug, 2)."</td><td class='rows'>".number_format($employer_socso_sep, 2)."</td><td class='rows'>".number_format($employer_socso_oct, 2)."</td><td class='rows'>".number_format($employer_socso_nov, 2)."</td><td class='rows'>".number_format($employer_socso_dec, 2)."</td><td class='rows'>".number_format($total_socso_month, 2)."</td></tr>
						
						<tr><td class='col'>EIS Company Contribution</td><td class='rows'>".number_format($employer_eis_jan, 2)."</td><td class='rows'>".number_format($employer_eis_feb, 2)."</td><td class='rows'>".number_format($employer_eis_mar, 2)."</td><td class='rows'>".number_format($employer_eis_apr, 2)."</td><td class='rows'>".number_format($employer_eis_may, 2)."</td><td class='rows'>".number_format($employer_eis_jun, 2)."</td><td class='rows'>".number_format($employer_eis_july, 2)."</td>
						<td class='rows'>".number_format($employer_eis_aug, 2)."</td><td class='rows'>".number_format($employer_eis_sep, 2)."</td><td class='rows'>".number_format($employer_eis_oct, 2)."</td><td class='rows'>".number_format($employer_eis_nov, 2)."</td><td class='rows'>".number_format($employer_eis_dec, 2)."</td><td class='rows'>".number_format($total_eis_month, 2)."</td></tr>
						
						<tr><td class='col'>HRDF Company Contribution</td><td class='rows'>".number_format($employer_hrdf_jan, 2)."</td><td class='rows'>".number_format($employer_hrdf_feb, 2)."</td><td class='rows'>".number_format($employer_hrdf_mar, 2)."</td><td class='rows'>".number_format($employer_hrdf_apr, 2)."</td><td class='rows'>".number_format($employer_hrdf_may, 2)."</td><td class='rows'>".number_format($employer_hrdf_jun, 2)."</td><td class='rows'>".number_format($employer_hrdf_july, 2)."</td>
						<td class='rows'>".number_format($employer_eis_aug, 2)."</td><td class='rows'>".number_format($employer_hrdf_sep, 2)."</td><td class='rows'>".number_format($employer_hrdf_oct, 2)."</td><td class='rows'>".number_format($employer_hrdf_nov, 2)."</td><td class='rows'>".number_format($employer_hrdf_dec, 2)."</td><td class='rows'>".number_format($total_hrdf_month, 2)."</td></tr>
						
						<tr><td class='col'>FWEIS Company Contribution</td><td class='rows'>".number_format($employer_fweis_jan, 2)."</td><td class='rows'>".number_format($employer_fweis_feb, 2)."</td><td class='rows'>".number_format($employer_fweis_mar, 2)."</td><td class='rows'>".number_format($employer_fweis_apr, 2)."</td><td class='rows'>".number_format($employer_fweis_may, 2)."</td><td class='rows'>".number_format($employer_fweis_jun, 2)."</td><td class='rows'>".number_format($employer_fweis_july, 2)."</td>
						<td class='rows'>".number_format($employer_fweis_aug, 2)."</td><td class='rows'>".number_format($employer_fweis_sep, 2)."</td><td class='rows'>".number_format($employer_fweis_oct, 2)."</td><td class='rows'>".number_format($employer_fweis_nov, 2)."</td><td class='rows'>".number_format($employer_fweis_dec, 2)."</td><td class='rows'>".number_format($total_fweis_month, 2)."</td></tr>

						<tr class='wages_total'><td class='rows'>Total</td><td class='rows'>".number_format($total_company_cont_jan, 2)."</td><td class='rows'>".number_format($total_company_cont_feb, 2)."</td><td class='rows'>".number_format($total_company_cont_mar, 2)."</td><td class='rows'>".number_format($total_company_cont_apr, 2)."</td><td class='rows'>".number_format($total_company_cont_may, 2)."</td><td class='rows'>".number_format($total_company_cont_jun, 2)."</td><td class='rows'>".number_format($total_company_cont_july, 2)."</td>
						<td class='rows'>".number_format($total_company_cont_aug, 2)."</td><td class='rows'>".number_format($total_company_cont_sep, 2)."</td><td class='rows'>".number_format($total_company_cont_oct, 2)."</td><td class='rows'>".number_format($total_company_cont_nov, 2)."</td><td class='rows'>".number_format($total_company_cont_dec, 2)."</td><td class='rows'>".number_format($overall_total_comapny_con, 2)."</td></tr>";

//End						

//Get the employee group by country based on company
$mc_company=0;
$resigned_company=0;
$new_hired_company=0;
//Get the total employee by company
$sql_total_e=mysql_query('SELECT COUNT(e.id) as total  FROM employee e WHERE e.company_id="'.$comp_id.'"');
$rs_total_e = mysql_fetch_array($sql_total_e);
$total_employee=$rs_total_e['total'];
//Get the resigned employee by company
$sql_resigned=mysql_query('SELECT COUNT(e.id) as resgined  FROM employee e WHERE e.company_id="'.$comp_id.'" and e.emp_status="Resigned"');
$rs_resigned = mysql_fetch_array($sql_resigned);
$resigned_company=$rs_resigned['resgined'];
//Get the active employee by company
$sql_active=mysql_query('SELECT COUNT(e.id) as active  FROM employee e WHERE e.company_id="'.$comp_id.'" and e.emp_status="Active"');
$rs_active = mysql_fetch_array($sql_active);
$active_employee=$rs_active['active'];
//Get the active employee by company
$sql_inactive=mysql_query('SELECT COUNT(e.id) as inactive  FROM employee e WHERE e.company_id="'.$comp_id.'" and e.emp_status="Inactive"');
$rs_inactive = mysql_fetch_array($sql_inactive);
$inactive_employee=$rs_inactive['inactive'];
//Get the New Employee by comapny 
$sql_new=mysql_query('SELECT COUNT(e.id) as new  FROM employee e WHERE  e.company_id="'.$comp_id.'" and Month("e.join_date")="'.$month.'"');
$rs_new = mysql_fetch_array($sql_new);
$new_hired_company=$rs_new['new'];
//Get comapny name
$sql_cname=mysql_query('SELECT name FROM company where id="'.$comp_id.'"');
$rs_cname = mysql_fetch_array($sql_cname);
$company=$rs_cname['name'];
//Get employee mc by department
$sql_mcComany=mysql_query('SELECT dep_id FROM employee where company_id="'.$comp_id.'" and dep_id!=0 GROUP BY dep_id');
while($rs_mcComany = mysql_fetch_array($sql_mcComany)){
	$sql_mc=mysql_query('SELECT sum(num_days) as mc FROM employee_leave WHERE depid="'.$rs_mcComany['dep_id'].'" and request_status="Approved" and leave_type_id=2 and year("leave_date")="'.$year.'"');
	$rs_mc = mysql_fetch_array($sql_mc);
	$mc_company +=$rs_mc['mc'];
}
/* End HR Report*/


//Number of employee report
$tabletd="<tr><td style='text-align:left;'>Open HeadCount</td>".$open_head_count."</tr><tr><td style='text-align:left;padding-left: 17px;'>No. Local Employee</td>".$tabletd_l."</tr><tr><td style='text-align:left;padding-left: 17px;'>No. Foreign Employee</td>".$tabletd_f."</tr><tr><td style='text-align:left;padding-left: 17px;'>No. Sick Leave</td>".$tabletd_mc."</tr><tr><td style='text-align:left;padding-left: 17px;'>No. of New Hiring</td>".$new."</tr><tr><td style='text-align:left;padding-left: 17px;'>No. of Resigned</td>".$tabletd_resign."</tr><tr class='close_headcount'><td style='text-align:left;'>Close HeadCount</td>".$closing_head_count."</tr>";
//Salary Report
$tabletd_salary="<tr><td style='text-align:left;'>Total Emp Cost(RM)</td>".$salary_total."</tr><tr><td style='text-align:left;padding-left: 17px;'>Local Staff Cost(RM)</td>".$salary_l."</tr><tr><td style='text-align:left;padding-left: 17px;'>Foreign Staff Cost(RM)</td>".$salary_f."</tr><tr><td style='text-align:left;padding-left: 17px;'>Overtime Hrs Clocked</td>".$ot_duration."</tr><tr><td style='text-align:left;padding-left: 17px;'>overtime Cost(RM)</td>".$ot_amount."</tr><tr><td style='text-align:left;padding-left: 17px;'>Allowance Cost(RM)</td>".$allowance."</tr>";
//$tableth="<th></th>".$tableth;$table_dep

//Array
$data = array('data1' =>$tableth, 'data2' =>$tabletd, 'salary'=>$tabletd_salary, 'department' =>$table_dep, 'local'=>$local, 'foreign'=>$foreigner, 'mc'=>$mc, 'new_hired'=>$new_hired, 'resign'=>$resign,'company'=>$company, 
			  'local_company'=>$local_company, 'foreign_company'=>$foreign_company, 'mc_company'=>$mc_company, 'new_hired_company'=>$new_hired_company, 'resigned_company'=>$resigned_company,
			  'local_staff_cost'=>$local_staff_cost,'foreign_staff_cost'=>$foreign_staff_cost,'ot_hours_clocked'=>$ot_hours_clocked,'ot_cost'=>$ot_cost,'allowance_cost'=>$allowance_cost,
			  'local_staff_cost_com'=>$local_staff_cost_com,'foreign_staff_cost_com'=>$foreign_staff_cost_com,'ot_hours_clocked_com'=>$ot_hours_clocked_com,'ot_cost_com'=>$ot_cost_com,'allowance_cost_com'=>$allowance_cost_com,
			  'wages_stat_th'=>$table_wages_th,'wages_stat_td'=>$table_wages_td,'table_other_cost_th'=>$table_other_cost_th,'table_other_cost_td'=>$table_other_cost_td,'active'=>$active_employee,'inactive'=>$inactive_employee,
			  'total_employee'=>$total_employee,'resigned_company'=>$resigned_company); 
print json_encode($data);


/*
$data = array('data1' =>$tableth, 'data2' =>$tabletd);
print json_encode($data);
*/
?>
