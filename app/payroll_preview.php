<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
include_once "app/test_jason.php";
include_once "app/test.php";
include_once "app/loh.php";

?>
<style>
.tableth-preview th {
    background-color: black;
    color: white;
    padding-left: 3px;
    padding-right: 3px;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 2px;
}
.tableth-preview tr td {
    padding-left: 5px;
}
tr.sub-total {
    background-color: #f9b53f;
    color: #000;
    padding-left: 10px;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 2px;
    font-weight: bold;
    text-align: left;
}
</style>
		<p>
		
      <div> <p style="text-align: center;font-size:large;"><b>Payroll Summary</b></p> </div>
 
   
        <div class="tablediv">
            <table border="1" class="tableth-preview" style="border-collapse: collapse;width: 100%;">
			<thead>
				<tr>
				   <th>Employee</th>
					<th>Basic Salary</th>
					<th>Allowance</th>
					<th>OT Amount</th>
					<th>Claims</th>
					<th>Commission</th>
					<th>Bonus</th>
					<th>Loan</th>
					<th>Employee EPF</th>
					<th>Emplyee Socso</th>
					<th>Employee EIS</th>
					<th>Employer EPF</th>
					<th>Emplyer Socso</th>
					<th>Emplyer EIS</th>
					<th>Income Tax</th>
					<th>Sakat</th>
					<th>Net Paid</th>
					<th>Nationality</th>
				</tr>
			</thead>
		    <tbody>
            <?php
                if (isset($_GET['emp_id']) == true && isset($_GET["mon"]) && isset($_GET["year"])) {
                    //$emp_id = $_GET['emp_id'];
                    $month = isset($_GET["mon"]) ? $_GET["mon"] : date('n');
                    $year = isset($_GET["year"]) ? $_GET["year"] : date('Y');
                    $checkJoin = checkEmpJoinIn($emp_id, $month, $year);
                    $start_date = 1;
                     //include_once 'app/payroll_search.php';
					$total_basic_salary="0.00";$total_all="0.00";$total_ot_am="0.00";$total_claim="0.00";$total_comm="0.00";$total_baonus="0.00";
					$total_ee_epf="0.00";$total_ee_socso="0.00";$total_ee_eis="0.00";$total_er_epf="0.00";$total_er_socso="0.00";$total_er_eis="0.00";
					$total_pcb="0.00";$total_zakat="0.00";$get_total_loan ="0.00";$total_net_pay="0.00";
					
                    $getEmpStatus ="SELECT emp_status, zakat, id, full_name, epf, country FROM employee Where emp_status='Active'";
					//$getEmpStatus.=" AND id in(" . $_GET["emp_id"] . ")"; 
					if (!empty($_GET["emp_id"])) {
						$getEmpStatus.=" AND id in(" . $_GET["emp_id"] . ")";
					} else {
						if ($_GET["dep"] == "0") {
							$getEmpStatus.=" AND branch_id=" . $_GET["branch"];
						} else {
							$getEmpStatus.=" AND dep_id=" . $_GET["dep"];
						}
					}
					
					$rs = mysql_query($getEmpStatus);
					$num_row = mysql_num_rows($rs);

                   while($rowEmpStatus = mysql_fetch_array($rs)){
                    $emp_status = $rowEmpStatus["emp_status"];
					$zakat = $rowEmpStatus["zakat"];
                    $emp_id=$rowEmpStatus["id"];
					$got_epf =$rowEmpStatus["epf"];
					$full_name = $rowEmpStatus["full_name"];
					$nationality=$rowEmpStatus["country"];
                    if ($emp_status == "Active" && $checkJoin != 0) {
                            $finalised = false;
                           // include 'app/calculate_payroll.php';
								//echo"Testttss";
								
							$mod_month = str_pad($month, 2, '0', STR_PAD_LEFT);
							$mod_date = str_pad($start_date, 2, '0', STR_PAD_LEFT);
							$total_day_month = date('t', mktime(0, 0, 0, $month, 1, $year));
							$complete_end_date = $year . '-' . $mod_month . '-' . $total_day_month;
							$complete_start_date = $year . '-' . $mod_month . '-' . $mod_date;
							$total_working_day = days_in_month($emp_id, $month, $year);
							$total_working_hours = 8;

							//function
							$get_basic = basic_salary($emp_id);
							$daily_rate = $get_basic / $total_working_day;
							$get_salary_per_hours = salary_per_hours($get_basic, $emp_id, $month, $year);
							$get_overtime = overtime($emp_id, $month, $year);

							$get_allowance_epf = allowance($emp_id, "epf");
							$get_allowance_socso = allowance($emp_id, "socso");
							$get_allowance_pcb = allowance($emp_id, "pcb");
							$total_allowance = allowance($emp_id);
							$get_comission_epf=comission($emp_id, $month);
							$get_unpaid_leave = unpaid_leave($emp_id, $month, $year, $get_salary_per_hours);
							$get_absent = absent($emp_id, $month, $year, $get_salary_per_hours);
							$get_bonus = bonus($emp_id, date("Y-m-d", mktime(0, 0, 0, $month, 1, $year)));
							$get_loan = loan($emp_id);
							$get_late_leave = late_leave($emp_id, $month, $year, $get_salary_per_hours);
							$get_advance_salary = advance_salary($emp_id, $month, $year);
							$get_claim = claim($emp_id, $month, $year);
							$get_paid_leave = paid_leave($emp_id, $month, $year);
							$get_days_absent = days_absent($emp_id, $month, $year);
							$get_days_at_work = days_at_work($emp_id, $month, $year);
							$get_late_leave_time = late_leave_time($emp_id, $month, $year);
							$get_unpaid_leave_time = unpaid_leave_time($emp_id, $month, $year);
							$get_designation = designation($emp_id);
							$get_name = emp_name($emp_id);
							$ot_dur = ot_duration($emp_id, $month, $year);

							//echo "$get_basic + $get_overtime + $get_bonus + $total_allowance - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary;<br />";
							//$gross_pay = $get_basic + $get_overtime + $get_bonus + $total_allowance - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary;
							//$gross_pay = $get_basic + $get_overtime + $get_bonus - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary;
							//$gross_pay = $get_basic + $get_overtime + $get_bonus - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave;
							//
							//check employee join date
							$checkJoin = checkEmpJoinIn($emp_id, $month, $year);
							$emp_joindate = getEmpJoinDate($emp_id);
							$minusJoin = 0;
							if (chk_position_late($emp_id, 'attendance') == '1') {
							//if employee join in that particular month
								if ($checkJoin == "1") {
									$getDate = explode('-', $emp_joindate);
									$countJoin = 0;
									for ($i = 1; $i < $getDate[2]; $i++) {
										$chk_date = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
										$chkDate = chk_emp_tt($emp_id, $chk_date);
										if ($chkDate != false) {
											$countJoin = $countJoin + 1;
										}
									}
									$get_days_absent = 0;
									$minusJoin = $daily_rate * $countJoin;
								}
							} else {
							//if employee join in that particular month
								if ($checkJoin == "1") {
									$get_days_absent = 0;
								}
							}
							$resign_date = get_resign_date($emp_id, $month, $year);
							if ($resign_date == false) {
								$gross_pay = $get_basic + $get_overtime + $get_bonus - $get_unpaid_leave - $get_absent - $get_late_leave - $minusJoin;
							} else {
								$ori_gross_pay = $get_basic;
								$resigner_no_work_days = days_in_month($emp_id, $month, $year, date('j', strtotime($resign_date))) - days_absent($emp_id, $month, $year);
								$resigner_total_work_day = days_in_month($emp_id, $month, $year);
								$gross_pay = $ori_gross_pay / $resigner_total_work_day * $resigner_no_work_days + $get_overtime + $get_bonus - $get_unpaid_leave - $get_late_leave - $minusJoin;
								$get_days_at_work = $resigner_no_work_days - $get_paid_leave - ($get_unpaid_leave_time / 8);
							}

							if($get_basic<=5000.01 && $got_epf=="Y"){
								$get_employer_epf = ($gross_pay + $get_allowance_epf + $get_comission_epf)*0.13;
							  }else{
								if ($get_bonus == 0) {
									$get_employer_epf = employer_epf($emp_id, $gross_pay + $get_allowance_epf + $get_comission_epf);
									
								} else {
									$get_employer_epf = employer_epf_bonus($emp_id, $gross_pay + $get_allowance_epf + $get_comission_epf, $get_basic, $get_bonus);
									
								}

							}

							//echo $gross_pay;
							//echo "$gross_pay= $get_basic + $get_overtime + $get_bonus + $total_allowance - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary<br />";
							//echo "gross pay=".$gross_pay;
							//echo "$gross_pay=$get_basic + $get_overtime + $get_bonus + $total_allowance - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary";
							//echo "$get_absent = absent($emp_id, $month, $year, $get_salary_per_hours)";
							 $get_socso = socso($gross_pay + $get_allowance_socso + $get_comission_epf, $emp_id);
							 $get_epf = epf($emp_id, $gross_pay + $get_allowance_epf + $get_comission_epf);
							 $get_pcb = pcb($emp_id, $gross_pay + $total_allowance  + $get_allowance_pcb + $get_comission_epf, $get_epf); 
							 $get_employer_eis = employer_eis($gross_pay, $emp_id);
							 $get_employee_eis = employee_eis($gross_pay, $emp_id);
							 
							if (chk_age_more_55($emp_id)) {
								$get_employer_socso = employer_socso2($gross_pay + $get_allowance_socso + $get_comission_epf, $emp_id); //more than 55 years old
								$get_socso = 0; //more than 55 years old no need pay socso
							} else {
								$get_employer_socso = employer_socso($gross_pay + $get_allowance_socso + $get_comission_epf, $emp_id);
								
							}

							$gross_pay = $gross_pay + $total_allowance + $get_comission_epf;
							if (is_muslim($emp_id)) {
								$zakat = get_zakat($emp_id);
								$pcb = ($get_pcb - $zakat);
								if ($pcb < 0) {
									$pcb = 0;
								}
								//echo "$gross_pay - $get_epf - $get_socso - $pcb + $get_claim";
								$net_pay = $gross_pay - $get_epf - $get_socso - $pcb + $get_claim - $get_advance_salary - $get_loan;
								//echo "$net_pay = $gross_pay - $get_epf - $get_socso - $pcb + $get_claim";
							} else {
								//echo "$gross_pay - $get_epf - $get_socso - $get_pcb + $get_claim";
								$net_pay = $gross_pay - $get_epf - $get_socso - $get_pcb + $get_claim - $get_advance_salary - $get_loan;
								//echo "$net_pay = $gross_pay - $get_epf - $get_socso - $get_pcb + $get_claim";
							}
             }
                    
               // }
				
                if ($finalised == true) {
                    $employer_total_epf = employer_total_epf($emp_id, $year, $month);
                    $employer_total_socso = employer_total_socso($emp_id, $year, $month);
                    $employee_total_epf = employee_total_epf($emp_id, $year, $month);
                    $employee_total_socso = employee_total_socso($emp_id, $year, $month);
                } elseif ($finalised == false) {
                    $employer_total_epf = employer_total_epf($emp_id, $year, $month) + $get_employer_epf;
                    $employer_total_socso = employer_total_socso($emp_id, $year, $month) + $get_employer_socso;
                    $employee_total_epf = employee_total_epf($emp_id, $year, $month) + $get_epf;
                    $employee_total_socso = employee_total_socso($emp_id, $year, $month) + $get_socso;
					
                }
				
				if ($finalised==true) {
					// Claims
					$sql_claim = 'SELECT * FROM  payroll_claim  where emp_id = "' . $emp_id . '" and payout_month=' . $month . ' and payout_year=' . $year . ' and payroll_finalised_id=' . $finalised_id;
					$rs_claim = mysql_query($sql_claim);
					$num_row = mysql_num_rows($rs_claim);
				
					//Deduction
					$sql_deduction = 'SELECT * FROM  payroll_deduction  where emp_id = "' . $emp_id . '" and payout_month=' . $month . ' and payout_year=' . $year . ' and payroll_finalised_id=' . $finalised_id;
					$rs_deduction = mysql_query($sql_deduction);
					$num_row_deduction = mysql_num_rows($rs_deduction);
				}else if ($finalised==false) {
					// Claims
					$sql_claim = "select * from employee_claim where emp_id ='" . $emp_id. "'  and year(claim_date)=" . $year . " and month(claim_date)=" . $month . " and claim_status='Approved'";
					$rs_claim = mysql_query($sql_claim);
					$num_row = mysql_num_rows($rs_claim);
					
				}
				
	
				
            
            //include_once 'app/payroll_search.php';
			$total_basic_salary += $get_basic; $total_all += $total_allowance; $total_ot_am += $get_overtime ; $total_comm += $get_comission_epf; $total_baonus += $get_bonus;
			$total_ee_epf += $get_epf; $total_ee_socso += $get_socso; $total_ee_eis += $get_employee_eis; $total_er_epf += $get_employer_epf;$total_er_socso += $get_employer_socso;
			$total_er_eis += $get_employer_eis; $total_pcb += $get_pcb; $total_zakat += $zakat; $get_total_loan +=$get_loan; $total_net_pay += $net_pay

            ?>


             <tr>
			    <td><?php echo ucfirst($full_name); ?></td> 
                <td><?php echo number_format($get_basic, 2); ?></td> 
				<td><?php echo number_format($total_allowance, 2); ?></td>	
				<td><?php echo number_format($get_overtime, 2); ?></td>
				<td>
				<?php
				if($num_row > 0){
					while ($row = mysql_fetch_array($rs_claim)) {
						$s_arr = explode(" ", $row['claim_type']);
						//echo "s".ucfirst($s_arr['0'])."_".$s_arr['1'];
						echo ucfirst($s_arr['0'])."<span style='color:#F8F8F8'>_</span>".$s_arr['1'].":<span style='color:#F8F8F8'>_</span>".number_format($row['claim_amount'], 2); 
				?>	
					    <!-- <span class="label"><?php echo ucfirst($row['claim_type']);  ?></span>:<span class="value"> <?php echo number_format($row['claim_amount'], 2) ?></span>-->
						 <br>					
				<?php
                      $total_claim += $row['claim_amount'];
					}
				}else{
					echo"0.00";
				}
				?> 
				</td>
				<td><?php echo number_format($get_comission_epf, 2); ?></td> 
				<td><?php echo number_format($get_bonus, 2); ?></td> 
				<td><?php echo number_format($get_loan, 2); ?></td> 	
				<td><?php echo number_format($get_epf, 2) ;?></td> 
				<td><?php echo number_format($get_socso, 2); ?></td> 
				<td><?php echo number_format($get_employee_eis, 2); ?></td> 
				<td><?php echo number_format($get_employer_epf, 2); ?></td> 
				<td><?php echo number_format($get_employer_socso, 2); ?></td>
				<td><?php echo number_format($get_employer_eis, 2); ?></td>				
				<td><?php echo number_format($get_pcb, 2); ?></td> 
				<td><?php echo number_format($zakat, 2);?></td> 
				<td><?php echo number_format($net_pay, 2);?></td>				
             </tr>
			 
		<?php
	
			}
		?>
			<tr class="sub-total">
	            <td>TOTAL</td>
                <td><?php echo number_format($total_basic_salary, 2); ?></td> 
				<td><?php echo number_format($total_all, 2); ?></td>	
				<td><?php echo number_format($total_ot_am, 2); ?></td>
				<td><?php echo number_format($total_claim, 2); ?></td>
				<td><?php echo number_format($total_comm, 2); ?></td> 
				<td><?php echo number_format($total_baonus, 2); ?></td> 
				<td><?php echo number_format($get_total_loan, 2); ?></td> 	
				<td><?php echo number_format($total_ee_epf, 2) ;?></td> 
				<td><?php echo number_format($total_ee_socso, 2); ?></td> 
				<td><?php echo number_format($total_ee_eis, 2); ?></td> 
				<td><?php echo number_format($total_er_epf, 2); ?></td> 
				<td><?php echo number_format($total_er_socso, 2); ?></td>
				<td><?php echo number_format($total_er_eis, 2); ?></td>				
				<td><?php echo number_format($total_pcb, 2); ?></td> 
				<td><?php echo number_format($total_zakat, 2);?></td> 
				<td><?php echo number_format($total_net_pay, 2);?></td>
				 				
			</tr>
	   <?php     
		}
		?>
		     </tbody>
            </table>
         </div>





<script type="text/javascript">
<?php
if (isset($_GET["message"])) {
    ?>
            alert("Selected month has been finalised.");
    <?php
}
?>
</script>
<script type="text/javascript">
    function changeYearFinal(year){
        var month=$('#finalmonth').val();
        $.ajax({
            type:"POST",
            url:"?widget=monthDis_payroll",
            data:{
                action:"dropdown",
                month : month,
                year : year
            },
            success:function(data){
                $('#finalmonth').empty().append(data);
                $.ajax({
                    type:"POST",
                    url:"?widget=monthDis_payroll",
                    data:{
                        action:"getcount",
                        month : month,
                        year : year
                    },
                    success:function(data){
                        $('#finalizedcount').empty().html(data);
                    }
                });
            }
        });
    }
    
    function loadPopupBox() {
        $('#popup_box').fadeIn("slow");
        $(".main_div").css({
            "opacity": "0.3"  
        }); 		
    }

    function unloadPopupBox() {
        $('#popup_box').fadeOut("slow");
        $(".main_div").css({
            "opacity": "1"  
        }); 
    }	
    
    function view_payroll(emp, company, branch, dep, mon, year){
        var status = $("#emp_status").val();
        window.location='?loc=payroll&print=true&selection=all&status='+status+'&emp_id='+emp+'&company='+company+'&branch='+branch+'&dep='+dep+'&mon='+mon+'&year='+year;
    }
    
    function printpay(month,year,emp_id){
        if(emp_id == ""){
            alert("Please Select Employee");
        }else{
            window.open("?widget=printpayroll&selection=1&emp_id="+emp_id+"&month="+month+"&year="+year);
        }
    }
    
    function printpayall(month,year,branch,emp,dep){
	    var emp_id=emp;
        var status = $("#emp_status").val(); 
        window.open("?widget=printpayroll&selection=2&status="+status+"&emp_id="+emp_id+"&branch_id="+branch+"&dep_id="+dep+"&month="+month+"&year="+year);
    }
    
    function displaytable(selection){

        if(selection == 1){
            $('#table1').css({"display": "block"});
        }
        else if(selection == 2){
            $('#table1').css({"display": "none"});
        }
        
        $("#showresult").css({"display": "none"});
        $('#printpay').css({"display": "none"});
        $('#confirmBtn').css({"display": "none"});
        $("#dropBranch").val("");
        $("#emp_name").val("");
        $("#showAllEmpTable").empty();
        $("#selectdep").empty().append("<option value=''>--Please Select--</option>");
    }

    function showresult(){
		var dept = $("#selectdep").val();
		var month="<?php echo $_GET['mon'];?>";
		var year="<?php echo $_GET['year'];?>";
		var branch_id="<?php echo $_GET['branch'];?>";
	$checking=false;
	 $.ajax({
            type:"POST",
            url:"?widget=check_payroll",
            data:{
                dept:dept,
				branch_id:branch_id,
				month:month,
				year:year
            },
            success:function(data){
				if(data=="false"){
					var company = $("#dropCompany").val();
					var branch = $("#dropBranch").val();
					var dept = $("#selectdep").val();
					var selection = $("#selection").val();
					var emp_name = $("#emp_name").val();
					var emp_status = $("#emp_status").val();
					
					var error1 = [];
					
					if(selection == 1){
						if(emp_name == ""){
							error1.push("Employee");
						}
					}
					
					if(company == ""){
						error1.push("Company");
					}
					if(branch == ""){
						error1.push("Branch");
					}
					if(dept == ""){
						error1.push("Department");
					}
					
					var error_data1 = '';
					for(var i=0; i< error1.length; i++){
						error_data1 = error_data1 + error1[i] + "; "
					}
					var data1 = "";
					if(error1.length > 0){
						data1 = "Please Select :\n"+error_data1;
					}
							
					if(error1.length > 0){
						alert(data1);
					}else{
						if(selection == "1"){
							window.location="?loc=payroll&print=true&emp_id=<?php echo $_GET["emp_id"] ?>&mon="+$("#ddlmon").val()+"&year="+$("#ddlyear").val();
						}else if(selection == "2"){
							window.location="?loc=payroll&print=true&selection=all&status="+emp_status+"&company="+company+"&branch="+branch+"&dep="+dept+"&emp_id=<?php echo $_GET["emp_id"] ?>&mon="+$("#ddlmon").val()+"&year="+$("#ddlyear").val();
						}
					}
			   }else{
			   alert(data);
			   
			   }
            }
        });
    }
    
    function finalisepayroll(){
        var getcount = $("#finalizedcount").html();
        var month=$('#finalmonth').val();
        var year=$('#finalyear').val();
        $.ajax({
            type:"POST",
            url:"?widget=monthDis_payroll",
            data:{
                action:"getEmpAmt",
                month : month,
                year : year
            },
            success:function(data){
                if(data != "0"){
                    var confirmView = confirm(data);
                    if(confirmView){
                        $.ajax({
                            type:"POST",
                            url:"?widget=monthDis_payroll",
                            data:{
                                action:"getpayrollid",
                                month : month,
                                year : year
                            },
                            success:function(data){
                                if(getcount == 12){
                                }else{
                                    var result = confirm('Are you sure you want to finalize for this month?');
                                    if(result){
                                        window.location='?widget=finalise_payroll&payroll_id='+data+'&month='+month+'&year='+year;
                                    }
                                }
                            }
                        });        
                    }else{
                        $.ajax({
                            type:'POST',
                            url:"?widget=monthDis_payroll",
                            data:{
                                action:"getEmpID",
                                month : month,
                                year : year
                            },
                            success:function(data){
                                window.open('?widget=notconfirm_emplist&emp='+data,'mywindow','location=1,status=1,scrollbars=1,width=850,height=700');  
                            }
                        })
                    }
                }else{
                    $.ajax({
                        type:"POST",
                        url:"?widget=monthDis_payroll",
                        data:{
                            action:"getpayrollid",
                            month : month,
                            year : year
                        },
                        success:function(data){
                            if(getcount == 12){
                            }else{
                                var result = confirm('Are you sure you want to finalize for this month?');
                                if(result){
                                    window.location='?widget=finalise_payroll&payroll_id='+data+'&month='+month+'&year='+year;
                                }
                            }
                        }
                    });        
                }
            }
        });  
    }

    /*Original Closing Function*/
    //    function finalisepayroll(){
    //        var getcount = $("#finalizedcount").html();
    //        var month=$('#finalmonth').val();
    //        var year=$('#finalyear').val();
    //        $.ajax({
    //            type:"POST",
    //            url:"?widget=monthDis_payroll",
    //            data:{
    //                action:"getpayrollid",
    //                month : month,
    //                year : year
    //            },
    //            success:function(data){
    //                if(getcount == 12){
    //                }else{
    //                    var result = confirm('Are you sure you want to finalize for this month?');
    //                    if(result){
    //                        window.location='?widget=finalise_payroll&payroll_id='+data+'&month='+month+'&year='+year;
    //                    }
    //                }
    //            }
    //        });
    //    }
</script>

<style type="text/css">
    #popup_box { 
        display: none;
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:150px;  
        width:350px;  
        background:#FFFFFF;  
        left: 500px;
        top: 200px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: 15px;  	
        /* additional features, can be omitted */
        /*        border:2px solid #ff0000;  */
        border:10px solid #C4C4C7;
        padding:15px;  
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;
    }

    #popupBoxClose { 
        line-height:15px;  
        right:5px;  
        top:5px;  
        position:absolute;  
        color:#6fa5e2;  
        font-weight:500;  	
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