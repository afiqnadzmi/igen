<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

//$bs = basic_salary1(45);
////echo $bs; // 3000 salary
//
//$ot = overtime(45,4);
////echo $ot;
//
//$absent_de = absent(1,4,2012,12.5);
//echo $absent_de;


//ok
function ot_duration($emp_id, $month, $year) {
    $sql = 'SELECT sum(total_minutes/60) as total_hours FROM employee_overtime 
            where ot_status="Approved" and emp_id = ' . $emp_id . ' and month(ot_date)=' . $month . ' 
            and year(ot_date)=' . $year . ';';
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);

    return $row['total_hours'];
}

//ok
function basic_salary($emp_id) {
    $sql = 'SELECT * FROM employee WHERE id = ' . $emp_id . ' limit 1 ';
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    return $row['salary'];
}

//need improvement
function salary_per_hours_overtime($basic_salary, $emp_id, $month, $year, $total_working_hours) {
    $total_date = date("t", mktime(0, 0, 0, $month, 1, $year));
	$num_work_day = $total_date;
	
    //$num_work_day = 30; 
	//$working_hours =8
    $working_hours = $total_working_hours;
	
	
    //echo "$basic_salary / ($num_work_day * $working_hours) in 1-$month-$year<br />";
    $hourly_rate = $basic_salary / ($num_work_day * $working_hours);
    return $hourly_rate;
}
//need improvement
function salary_per_hours($basic_salary, $emp_id, $month, $year, $total_working_hours) {
    $num_work_day = days_in_month($emp_id, $month, $year);
    //$num_work_day = 30; 
	//$working_hours = $total_working_hours;
    $working_hours = $total_working_hours;

    //echo "$basic_salary / ($num_work_day * $working_hours) in 1-$month-$year<br />";
    $hourly_rate = $basic_salary / ($num_work_day * $working_hours);
    return $hourly_rate;
}

//OverTime Calculation Old (NO attendance attached)
/*function overtime($emp_id, $month, $year, $total_working_hours) {
    $sql2 = 'SELECT * FROM employee_overtime WHERE MONTH(ot_date) = ' . $month . ' AND YEAR(ot_date) = ' . $year . ' AND emp_id = ' . $emp_id
            . ' AND ot_status = "Approved"';
    $rs2 = mysql_query($sql2);
    while ($row2 = mysql_fetch_array($rs2)) {
	
        $ot_date = $row2['ot_date'];
        $total_min = $row2['total_minutes'];
        $total_hours = $total_min / 60;
		

        $sql3 = 'SELECT * FROM overtime where emp_id = ' . $emp_id . ';';
        $rs4 = mysql_query($sql3);
        $row3 = mysql_fetch_array($rs4);

        $w_rate = $row3['week_end_rate'];
        $h_rate = $row3['holiday_rate'];
        $n_rate = $row3['normal_rate'];
		$cap = $row3['cap'];
		$resting_day = $row3['resting_day'];
   
        $get_basic = basic_salary($emp_id);
		 
         if($cap=="Y" &&  $get_basic > 2000){//If the salary is more than 2000 and cap is yes, cap the salary to 2,000
			$get_basic=2000;
		}
        $get_salary_per_hours = salary_per_hours_overtime($get_basic, $emp_id, $month, $year, $total_working_hours);
		
       
        $day = date("N", strtotime($ot_date));
          //  return $resting_day."=".$day;
		//	exit();
        $sql5 = 'SELECT e.id AS emp_id, ph.id AS ph_id, ph.* FROM employee AS e
                INNER JOIN branch AS b
                ON b.id = e.branch_id
                JOIN holiday_for_group AS hfg
                ON hfg.group_id = b.holi_group_id
                JOIN public_holiday AS ph
                ON ph.id = hfg.holiday_id
                WHERE e.id = ' . $emp_id . ' AND ph.from_date <= "' . $ot_date . '" AND ph.to_date >= "' . $ot_date . '"';
        $query5 = mysql_query($sql5);
        $row5 = mysql_fetch_array($query5);
        $num_rows5 = mysql_num_rows($query5);
        $ph_date = $row5["ph_id"];

		//If OT apply date is public holiday 
        if ($num_rows5 > 0) {
            //Check if employee replace holiday 
            $sql4 = 'SELECT * FROM holiday_replacement as hr
                    INNER JOIN public_holiday AS ph
                    ON hr.pub_holiday_id = ph.id
                    WHERE hr.emp_id = ' . $emp_id . ' AND hr.replacement_status = "Approved"
                    AND hr.pub_holiday_id =  ' . $ph_date;
            $rs5 = mysql_query($sql4);

            if ($rs5 != FALSE && mysql_num_rows($rs5) > 0) {
                if ($day == $resting_day) {
                    //$ot_pay = $get_salary_per_hours * $w_rate * $total_hours;
					$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $w_rate));
                    $ot1 = "w_rate";
                } else {
                    //$ot_pay = $get_salary_per_hours * $n_rate * $total_hours;
					$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $n_rate));
                    $ot1 = "n_rate";
                }
            } else {
                //$ot_pay = $get_salary_per_hours * $h_rate * $total_hours;
				$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $h_rate));
                $ot1 = "h_rate";
            }
        } else {
            // Check if employee replace holiday 
            $sql4 = 'SELECT * FROM holiday_replacement as hr
                    INNER JOIN public_holiday AS ph
                    ON hr.pub_holiday_id = ph.id
                    WHERE hr.emp_id = ' . $emp_id . ' AND hr.replacement_status = "Approved"
                    AND hr.replace_date="' . $ot_date . '"';
            $rs5 = mysql_query($sql4);

            if ($rs5 != FALSE && mysql_num_rows($rs5) > 0) {
                //$ot_pay = $get_salary_per_hours * $h_rate * $total_hours;
				$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $h_rate));
                $ot1 = "h_rate";
            } else {
                if ($day == $resting_day) {
                    //$ot_pay = $get_salary_per_hours * $w_rate * $total_hours;
					$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $w_rate));
                    $ot1 = "w_rate";
                } else {
                    //$ot_pay = $get_salary_per_hours * $n_rate * $total_hours;
					$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $w_rate));
                    $ot1 = "n_rate";
                }
            }
        }
    }

    if ($ot_pay == "") {
         return 0;
    } else {
	   return $ot_pay;
    }
}*/

// new (Integrated with the attendance)
function overtime($emp_id, $month, $year, $total_working_hours) {
	
    $sql2 = 'SELECT * FROM employee_overtime WHERE MONTH(ot_date) = ' . $month . ' AND YEAR(ot_date) = ' . $year . ' AND emp_id = ' . $emp_id
            . ' AND ot_status = "Approved"';
    $rs2 = mysql_query($sql2);
    while ($row2 = mysql_fetch_array($rs2)) {
	
        $ot_date = $row2['ot_date'];
        $total_min = $row2['total_minutes'];
        $total_hours = $total_min / 60;
	
		//$sql_att = 'select * from attendance where emp_id = ' . $emp_id . ' and work_in_date = "' .$ot_date. '"';
		$sql_att = 'select * from attendance where emp_id = "'.$emp_id.'" and work_in_date = "'.$ot_date.'"';
                $rs_att = mysql_query($sql_att);
				$row_att = mysql_fetch_array($rs_att);
                $num_row = mysql_num_rows($rs_att);
		
		
         if ($num_row > 0) {
			$worked_hours=explode(".",$row_att['work']);
			$overtime = explode(".",$row_att['overtime']);
			$short = explode(".",$row_att['short']);
			$ot_hr= $overtime[0];
			$ot_mn = $overtime[1];
			$shot_hr=$short[0];
			$short_mn =$short[1];
			$overTime_attendance=0;
		
			if($ot_hr > 1){
				
				if($ot_mn >= $short_mn){
					$overTime_attendance=($ot_hr - $shot_hr).".".($ot_mn - $short_mn);
				}else{
					$overTime_attendance=($ot_hr - $shot_hr).".".(60 - ($short_mn - $ot_mn));
				}
			}
        
			 if($total_hours > ($overTime_attendance - 1)){
					$total_hours=$overTime_attendance -1;
				}
		 
			 if($total_hours > 0){
					$sql3 = 'SELECT ot.week_end_rate, ot.holiday_rate, ot.normal_rate, e.cap, e.shift_id FROM employee e INNER JOIN overtime ot on e.overtime_type = ot.id where e.id= ' . $emp_id . ';';
					$rs4 = mysql_query($sql3);
					$row3 = mysql_fetch_array($rs4);

					$w_rate = $row3['week_end_rate'];
					$h_rate = $row3['holiday_rate'];
					$n_rate = $row3['normal_rate'];
					$cap = $row3['cap'];
					$shift_id = $row3['shift_id'];
					
			   
					$get_basic = basic_salary($emp_id);
					 
					 if($cap=="Y" &&  $get_basic > 2000){//If the salary is more than 2000 and cap is yes, cap the salary to 2,000
						$get_basic=2000;
					}
					$get_salary_per_hours = salary_per_hours_overtime($get_basic, $emp_id, $month, $year, $total_working_hours);
					
				   
					$day = date("N", strtotime($ot_date));
					//$resting_day = resting_days($day, $shift_id);
					

					$sql5 = 'SELECT e.id AS emp_id, ph.id AS ph_id, ph.* FROM employee AS e
							INNER JOIN branch AS b
							ON b.id = e.branch_id
							JOIN holiday_for_group AS hfg
							ON hfg.group_id = b.holi_group_id
							JOIN public_holiday AS ph
							ON ph.id = hfg.holiday_id
							WHERE e.id = ' . $emp_id . ' AND ph.from_date <= "' . $ot_date . '" AND ph.to_date >= "' . $ot_date . '"';
					$query5 = mysql_query($sql5);
					$row5 = mysql_fetch_array($query5);
					$num_rows5 = mysql_num_rows($query5);
					$ph_date = $row5["ph_id"];

					/* If OT apply date is public holiday */
					if ($num_rows5 > 0) {
				
						/* Check if employee replace holiday */
						$sql4 = 'SELECT * FROM holiday_replacement as hr
								INNER JOIN public_holiday AS ph
								ON hr.pub_holiday_id = ph.id
								WHERE hr.emp_id = ' . $emp_id . ' AND hr.replacement_status = "Approved"
								AND hr.pub_holiday_id =  ' . $ph_date;
						$rs5 = mysql_query($sql4);

						if ($rs5 != FALSE && mysql_num_rows($rs5) > 0) {
						
							if (resting_days($day, $shift_id)==1) {
								//$ot_pay = $get_salary_per_hours * $w_rate * $total_hours;
								$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $w_rate));
								$ot1 = "w_rate";
							} else {
								//$ot_pay = $get_salary_per_hours * $n_rate * $total_hours;
								$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $n_rate));
								$ot1 = "n_rate";
							}
						} else {
							
							if(($worked_hours[0] - 1) >= $total_working_hours){
								$total_hours = $total_hours + $total_working_hours;
							}else{
								$total_hours = $total_hours + $worked_hours[0];
							}
							//return $worked_hours[0] - 1 ."=".$total_working_hours."=".$total_hours;
							
							//$ot_pay = $get_salary_per_hours * $h_rate * $total_hours;
							$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $h_rate));
							$ot1 = "h_rate";
			
						}
					} else {
						
						/* Check if employee replace holiday */
						$sql4 = 'SELECT * FROM holiday_replacement as hr
								INNER JOIN public_holiday AS ph
								ON hr.pub_holiday_id = ph.id
								WHERE hr.emp_id = ' . $emp_id . ' AND hr.replacement_status = "Approved"
								AND hr.replace_date="' . $ot_date . '"';
						$rs5 = mysql_query($sql4);

						if ($rs5 != FALSE && mysql_num_rows($rs5) > 0) {
							//$ot_pay = $get_salary_per_hours * $h_rate * $total_hours;
							$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $h_rate));
							$ot1 = "h_rate";
						} else {
						
							if (resting_days($day, $shift_id)==1) {
								//$ot_pay = $get_salary_per_hours * $w_rate * $total_hours;
								$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $w_rate));
								$ot1 = "w_rate";
							} else {
									
								//$ot_pay = $get_salary_per_hours * $n_rate * $total_hours;
								$ot_pay = $ot_pay + (($get_basic/26/8) * ($total_hours * $n_rate));
								$ot1 = "n_rate";
							}
						}
					}
		 }
	  }
    }

    if ($ot_pay == "") {
         return 0;
    } else {
	   return $ot_pay;
    }
}

function resting_days($day, $shift_id){
	$sql3 = 'SELECT `from_time`, `to_time` FROM `emp_time_table` WHERE day='.$day.' and `shift_id`='.$shift_id;
			$rs4 = mysql_query($sql3);
		    $row3 = mysql_fetch_array($rs4);
		
	        if($row3['from_time']=="00:00:00" && $row3['to_time']=="00:00:00"){
				 return 1;
			}else{
				return 0;
			}
	
}

//ok
function public_holiday($abs_date, $empid) {
    /* $sql2 = 'SELECT id FROM public_holiday 
      where from_date='.$abs_date.'
      or to_date='.$abs_date.'
      or (from_date<'.$abs_date.' and to_date>='.$abs_date.'); '; */
    $sql2 = 'SELECT id FROM 
			(SELECT * FROM public_holiday where id in
			(SELECT holiday_id FROM holiday_for_group h where group_id=
			(SELECT holi_group_id FROM branch b where b.id=
			(SELECT branch_id FROM employee where id='.$empid.')))) tbl
			where from_date="' . $abs_date . '"
			or to_date="' . $abs_date . '"
			or (from_date<"' . $abs_date . '" and to_date>="' . $abs_date . '");';
    $rs2 = mysql_query($sql2);
    if ($rs2 && mysql_num_rows($rs2) > 0) {
        return true;
    } else {
        return FALSE;
    }
}

//OK
function holiday_replacement($abs_date, $empid) {
    $sql = 'select id from holiday_replacement where emp_id = ' . $empid
            . ' and replace_date = "' . $abs_date . '" and replacement_status="Approved"';
    //echo $sql;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//OK
function chk_leave($abs_date, $empid) {
    $sql2 = 'SELECT id FROM employee_leave 
		where (from_date="' . $abs_date . '"
		or to_date="' . $abs_date . '"
		or (from_date<"' . $abs_date . '" and to_date>="' . $abs_date . '")) and request_status="Approved" 
		and emp_id=' . $empid . ' limit 1;';
    //echo $sql2;
    $rs2 = mysql_query($sql2);
    if ($rs2 && mysql_num_rows($rs2) > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//ok 
function chk_emp_tt($emp_id, $chk_date) {
    $day = date("N", strtotime($chk_date));
    //$sql="SELECT * FROM emp_time_table where emp_id='".$emp_id."' and `day`='".$day."'";
    $sql = 'SELECT * FROM emp_time_table e
					where shift_id=(SELECT shift_id FROM employee e where id="' . $emp_id . '") and `day`="' . $day . '"';
    //echo $sql;
    $rs = mysql_query($sql);
    $c = 0;
    if ($rs && mysql_num_rows($rs) > 0) {
        while ($row = mysql_fetch_array($rs)) {
            if ($row["from_time"] != '00:00:00' && $row["to_time"] != '00:00:00') {
                $c = $c + 1;
            }
        }
        return $c; //1 or 2
    } else {
        return false;
    }
}

function chk_training($emp_id, $chk_date) {
    $sql2 = 'SELECT e.id FROM employee_training e
				left join training t
				on e.training_id=t.id 
				where (from_date="' . $chk_date . '"
				or to_date="' . $chk_date . '"
				or (from_date<"' . $chk_date . '" and to_date>="' . $chk_date . '")) and request_status="Approved" 
				and employee_id=' . $emp_id . ' limit 1;';
	//echo $sql2.'<br />';
    $rs2 = mysql_query($sql2);
    if ($rs2 && mysql_num_rows($rs2) > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//Ok
function absent($emp_id, $month, $year, $salary_per_hour, $total_working_hours) {
    $chk = chk_position_late($emp_id, 'attendance');
    if ($chk == '0') {
		
        //run
        $total_day_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $mod_month = str_pad($month, 2, '0', STR_PAD_LEFT);
        $sum_of_hours = 0;
		$j=0;
        for ($i = 1; $i <= $total_day_month; $i++) {
            $day = date('N', mktime(0, 0, 0, $month, $i, $year));
            $w_sql = 'SELECT id
					FROM emp_time_table e
					where shift_id=(SELECT shift_id FROM employee e where id="' . $emp_id . '")
					and `day`="' . $day . '" and is_work_day="Y"'; //YY
            $w_rs = mysql_query($w_sql);
            if ($w_rs && mysql_num_rows($w_rs) > 0) {
				 
                $date = str_pad($i, 2, '0', STR_PAD_LEFT);
                $sql = 'select * from attendance where emp_id = ' . $emp_id . ' and work_in_date = "' . $year . '-' . $mod_month . '-' . $date . '"';
                $rs = mysql_query($sql);
                $num_row = mysql_num_rows($rs);
                if ($num_row == 0) {
                    $absent_date = $year . '-' . $mod_month . '-' . $date;
					
					if(!chk_training($emp_id, $absent_date) ){
						
						$abs_date_re = public_holiday($absent_date, $emp_id);
						//$abs_date_re is true if got public holiday
						if ($abs_date_re == FALSE) {
							$j++;
							$holi_rep_re = holiday_replacement($absent_date, $emp_id);
							//$holi_rep_re is true if got holiday replacement
							if ($holi_rep_re == false) {
								$leave_check_re = chk_leave($absent_date, $emp_id);
								//$leave_check_re is true if employee got apply leave
								if ($leave_check_re == false) {
									$emp_tt_re = chk_emp_tt($emp_id, $absent_date);
									//$emp_tt_re is session number 1,2 if employee is working that day
									//echo $absent_date;
		                         
									if ($emp_tt_re == 2) {
										//$full_work_hrs = 8;
										$full_work_hrs = $total_working_hours;
										$sum_of_hours += $full_work_hrs;
									/*} else if ($emp_tt_re == 1) {
										//$half_work_hrs = 4;
										$half_work_hrs = $total_working_hours / 2;
										$sum_of_hours += $half_work_hrs;*/
									}
								}
							}
						}
					}
                } /*else if ($num_row == 1) {
                    $absent_date = $year . '-' . $mod_month . '-' . $date;
                    $emp_tt_re = chk_emp_tt($emp_id, $absent_date);
                    if ($emp_tt_re == 2) {
                        //echo $absent_date;
						if(!chk_training($emp_id, $absent_date) ){
							//$half_work_hrs = 4;
							$half_work_hrs = $total_working_hours / 2;
							$sum_of_hours += $half_work_hrs;
						}
                    }
                }*/
	
            }
        }
        return $sum_of_hours * $salary_per_hour;
    } else {
        return 0;
    }
}



//no use
//$r=chk_tt(1,"2012-03-04");
/* function chk_tt($chk_date){
  $day=date("N",strtotime($chk_date));
  $sql="SELECT * FROM time_table where `day`='".$day."'";
  $rs=mysql_query($sql);
  $c=0;
  if($rs&&mysql_num_rows($rs)>0){
  while($row=mysql_fetch_array($rs)){
  if($row["from_time"]!='00:00:00'&&$row["to_time"]!='00:00:00'){
  $c=$c+1;
  }
  }
  return $c;//1 or 2
  }else{
  return false;
  }
  } */

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>