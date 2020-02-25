<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$eid = isset($_GET["eid"]) ? $_GET["eid"] : "";
if ($eid != "") {
    $style = "block";
    $sql = "SELECT * FROM group_for_leave where id='" . $eid . "' limit 1";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
} else {
    $style = "none";
}
?>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    });
</script>
<div class="main_div">
    <div id="con">
        <br/>
        <div class="header_text">
            <span>Allowance & Claim Payroll Processing</span>
        </div>
	<?php 
		if ($eid == "") {
	?>
        <div class="main_content">
            <div class="tablediv">
                <table id="tbl">
		      <?php
				if(isset($_GET['evid']) && $_GET['evid']!=""){//Allow adding if editing is not set
			    	 $sql = "SELECT ev.allowance_amount as eva, ev.id as evid, ev.allowance_id, ev.emp_id, e.full_name, a.allowance_name FROM employee_evallowance AS ev
                        INNER JOIN allowance AS a 
						INNER JOIN employee AS e
                        ON a.id = ev.allowance_id
                        WHERE ev.emp_id =e.id AND ev.id=". $_GET['evid'];
					$sql_result = mysql_query($sql);
					while ($newArray = mysql_fetch_array($sql_result)) {
				?>
				    <tr>
                        <td colspan="3">
                            <input class="button" type="button" value="Save" onclick="save_all_claim(<?php echo $_GET['evid'];?>)" style="width: 70px;"/>
                            <input class="button" type="button" value="Back" onclick="clearNew()" style="width: 70px;"/>
                        </td>
                    </tr>
					<tr class="evolve-all-ename">
                        <td style="width: 200px;">Employee Name <span class="red"> *</span></td>
                        <td>							
							<input type="text" style="width:250px !important;" id="ev_all_ename" value="<?php echo $newArray['full_name']; ?>" readonly>
                        </td>
                    </tr>
					<tr class="evolve-all-type">
                        <td style="width: 200px;">Allowance Type <span class="red"> *</span></td>
                        <td>							
							<input type="text" style="width:250px !important;" id="ev_all_type" value="<?php echo $newArray['allowance_name'];?>" readonly>
                        </td>
                    </tr>
					<tr class="evolve-all-amount">
                        <td style="width: 200px;">Amount <span class="red"> *</span></td>
                        <td>							
							<input type="text" style="width:250px !important;" id="ev_all_amount" value="<?php echo $newArray['eva'];?>">
                        </td>
                    </tr>
                    
				<?php
					}
                    
				}else if(isset($_GET['dvaid']) && $_GET['dvaid']!=""){//Allow Editing Deduction if editing is not set
						$sql = "SELECT dp.deduction_name, ed.deduction_id, ed.deduction_amount as edamount, ed.id as edid, e.full_name FROM employee_deduction AS ed
                        INNER JOIN deduction_payroll AS dp 
						INNER JOIN employee AS e
                        ON dp.id = ed.deduction_id
                        WHERE ed.emp_id =e.id AND ed.type=2 AND ed.id=". $_GET['dvaid'];
					$sql_result = mysql_query($sql);
					while ($newArray = mysql_fetch_array($sql_result)) {
				?>
						<tr>
							<td colspan="3">
								<input class="button" type="button" value="Save" onclick="save_all_claim(<?php echo $_GET['dvaid'];?>)" style="width: 70px;"/>
								<input class="button" type="button" value="Back" onclick="clearNew()" style="width: 70px;"/>
							</td>
						</tr>
						<tr class="evolve-all-ename">
							<td style="width: 200px;">Employee Name <span class="red"> *</span></td>
							<td>							
								<input type="text" style="width:250px !important;" id="ev_all_ename" value="<?php echo $newArray['full_name']; ?>" readonly>
							</td>
						</tr>
						<tr class="evolve-all-type">
							<td style="width: 200px;">Allowance Type <span class="red"> *</span></td>
							<td>							
								<input type="text" style="width:250px !important;" id="ev_all_type" value="<?php echo $newArray['deduction_name'];?>" readonly>
							</td>
						</tr>
						<tr class="evolve-all-amount">
							<td style="width: 200px;">Amount <span class="red"> *</span></td>
							<td>							
								<input type="text" style="width:250px !important;" id="ev_all_amount" value="<?php echo $newArray['edamount'];?>">
							</td>
						</tr>
                    
				<?php
					}
                    
				}else if(isset($_GET['evid']) && $_GET['evid']!=""){//Allow adding if editing is not set
			    	 $sql = "SELECT ev.allowance_amount as eva, ev.id as evid, ev.allowance_id, ev.emp_id, e.full_name, a.allowance_name FROM employee_evallowance AS ev
                        INNER JOIN allowance AS a 
						INNER JOIN employee AS e
                        ON a.id = ev.allowance_id
                        WHERE ev.emp_id =e.id AND ev.id=". $_GET['evid'];
					$sql_result = mysql_query($sql);
					while ($newArray = mysql_fetch_array($sql_result)) {
				?>
				    <tr>
                        <td colspan="3">
                            <input class="button" type="button" value="Save" onclick="save_all_claim(<?php echo $_GET['evid'];?>)" style="width: 70px;"/>
                            <input class="button" type="button" value="Back" onclick="clearNew()" style="width: 70px;"/>
                        </td>
                    </tr>
					<tr class="evolve-all-ename">
                        <td style="width: 200px;">Employee Name <span class="red"> *</span></td>
                        <td>							
							<input type="text" style="width:250px !important;" id="ev_all_ename" value="<?php echo $newArray['full_name']; ?>" readonly>
                        </td>
                    </tr>
					<tr class="evolve-all-type">
                        <td style="width: 200px;">Allowance Type <span class="red"> *</span></td>
                        <td>							
							<input type="text" style="width:250px !important;" id="ev_all_type" value="<?php echo $newArray['allowance_name'];?>" readonly>
                        </td>
                    </tr>
					<tr class="evolve-all-amount">
                        <td style="width: 200px;">Amount <span class="red"> *</span></td>
                        <td>							
							<input type="text" style="width:250px !important;" id="ev_all_amount" value="<?php echo $newArray['eva'];?>">
                        </td>
                    </tr>
                    
				<?php
					}
                    
				}else if(isset($_GET['clid']) && $_GET['clid']!=""){//Allow adding if editing is not set
				  
			    	 $sql = "SELECT * FROM employee_claim ec
							 INNER JOIN employee e
							 WHERE ec.emp_id =e.id AND ec.id=".$_GET['clid'];
					$sql_result = mysql_query($sql);
					while ($newArray = mysql_fetch_array($sql_result)) {
				?>
				    <tr>
                        <td colspan="3">
                            <input class="button" type="button" value="Save" onclick="save_all_claim(<?php echo $_GET['clid'];?>)" style="width: 70px;"/>
                            <input class="button" type="button" value="Back" onclick="clearNew()" style="width: 70px;"/>
                        </td>
                    </tr>
					<tr class="evolve-all-ename">
                        <td style="width: 200px;">Employee Name <span class="red"> *</span></td>
                        <td>							
							<input type="text" style="width:250px !important;" id="ev_all_ename" value="<?php echo $newArray['full_name']; ?>" disabled>
                        </td>
                    </tr>
					<tr class="evolve-all-type">
                        <td style="width: 200px;">Claim Name <span class="red"> *</span></td>
                        <td>							
							<input type="text" style="width:250px !important;" id="claim_name" value="<?php echo $newArray['claim_item_title'];?>" disabled>
                        </td>
                    </tr>
					<tr class="evolve-all-type">
                        <td style="width: 200px;">Claim No. <span class="red"> *</span></td>
                        <td>							
							<input type="text" style="width:250px !important;" id="claim_number" value="<?php echo $newArray['claim_no'];?>">
                        </td>
                    </tr>
					<tr class="evolve-all-amount">
                        <td style="width: 200px;">Amount <span class="red"> *</span></td>
                        <td>							
							<input type="text" style="width:250px !important;" id="claim_amount" value="<?php echo $newArray['amount'];?>">
                        </td>
                    </tr>
					<tr>
								<td>Claim Date<span class="red"> *</span></td>
								<td><input type="text"  class="input_text" id="claim_date" style="width: 250px" value="<?php echo $newArray['claim_date'];?>" /></td>
							</tr>
                    
				<?php
					}
				}else{//Allow evolve allowance to be edited if the evid is set
				?>
				    <tr>
                        <td>Company <span class="red"> *</span></td>
                        <td>
                            <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                if ($igen_companylist != "") {
                                    $queryCompany = mysql_query('SELECT * FROM company WHERE id IN (' . $igen_companylist . ') ORDER BY code');
                                } else {
                                    $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                }
                                while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                    if ($igen_companylist != "") {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        if ($rowCompany["is_default"] == "1") {
                                            echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                        } else {
                                            echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Branch <span class="red"> *</span></td>
                        <td>
                            <select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                if ($igen_branchlist == "") {
                                    $queryCompany = mysql_query('SELECT * FROM company WHERE is_default=1 LIMIT 1');
                                    $rowCompany = mysql_fetch_array($queryCompany);
                                    $queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowCompany["id"] . '" ORDER BY branch_code');
                                }
                                while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                    echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px;">Departments <span class="red"> *</span></td>
                        <td>
						<?php
							/*if(isset($_GET['eid'])){
									 $dep_id=$_GET['eid'];
							?>
						
							<?php
									
									$sql = 'SELECT id, dep_name FROM department WHERE id in('.$dep_id.') AND is_active=1';
									$query = mysql_query($sql);
									while ($row = mysql_fetch_array($query)) {
									  echo'<select class="input_text" name="selectdep" id="selectdep" style="width: 250px;" onchange="selectdep()">';
										     echo '<option value="' . $row["id"] . '" selected>' . $row["dep_name"] . '</option>';
										echo' </select><br>';
									}
								
								 }else{*/
								?>
							<select class="input_text" name="selectdep" id="selectdep" style="width: 250px;" onchange="selectdep()">
                                <option value="">--Please Select--</option>
                            </select>							
							<input type="hidden" id="b_id" value="">
                        </td>
                    </tr>
					 <tr>
                        <td style="width: 200px;">Type <span class="red"> *</span></td>
                        <td>
							<select class="input_text" name="allowance-claim" id="allowance_claim" style="width: 250px;" onchange="selectAllowanceType(this.value)">
								<option value="2">Claim</option>
								<option value="1">Allowance</option>
								<option value="3">Deduction</option>
                            </select>							
							<input type="hidden" id="b_id" value="">
                        </td>
                    </tr>
					<tr class="claim-allowance" style="display:none">
                        <td style="width: 200px;">Allowance/Dedution Type <span class="red"> *</span></td>
                        <td>
							<select class="input_text" name="allowance-type" id="allowance_type" style="width: 250px;">
                                <option value="">--Please Select--</option>
								<option value="1">Fixed</option>
								<option value="2">Monthly</option>
                            </select>							
							<input type="hidden" id="b_id" value="">
                        </td>
                    </tr>
                     <tr>
                        <td colspan="3">
                            <input class="button" type="button" value="Add" onclick="add_emp_list()" style="width: 70px;"/>
                            <input class="button" type="button" value="Clear" onclick="clearfield()" style="width: 70px;"/>
                        </td>
                    </tr>
                    
				<?php
				}
				?>
                </table>
            </div>
        </div>
	<?php 
	 }else{
		
	?>
     <div class="main_content" id="updatetable" style="display: <?php echo $style ?>;">
            <div class="tablediv">
			<?php
				if($_GET['type']=="1"){
			?>
					<div style="padding-top: 10px;padding-bottom: 5px;">
						<?php if ($eid != "") { ?>
							<input type="button" class="button" value="Save" onclick="updategroup(<?php echo $eid ?>)" style="width: 70px;"/>
							<input type='button' class="button" value='back' onclick='clearNew()' style="width: 70px;" />
						<?php } else { ?>
							<input type='button' class="button" value='Add' onclick='savegroup()' style="width: 70px;" />
						<?php 
							} 
							
						 if($_GET['allowance']=="2"){
							 $readonly='';
						 ?>
						 <table>
								<tr>
									<td>Allowance Date<span class="red"> *</span></td>
									<td><input type="text"  class="input_text" id="allowance_date" style="width: 250px" /></td>
								</tr>
							</table>
						 <?php }else{
									$readonly='readonly';
								}
							?>
							
						
					</div>
					<div class="table">
						<div style="border: 1px solid black;padding-bottom: 10px;background-color: beige;">
							<table id="tbl" class="bold bordercollapse" style="width: 100%;">
								<tr class="tableth">
									<th style="width: 200px;">Employee</th>
									<th style="width: 180px;">Allowance</th>
									<th style="width: 180px;">Allowance Amount</th>
									<!--<th style="width: 180px;">Tonnage</th>-->
									<th></th>
								</tr>
								<?php
									//Get all the allowance
									if($_GET['allowance']!=0){
										$sql_allowance = "select * from allowance where allowance_type=".$_GET['allowance'];
									}else{
										$sql_allowance = "select * from allowance";
									}
									$result_allowance = mysql_query($sql_allowance);
									//Select all the employee based on department and branch
									$confirmed = explode(",", $_GET['c']);
									$confirmedemp = "";
									$dep_id=$_GET['eid'];
									for ($i = 0; $i <= count($confirmed); $i++) {
										if ($confirmed[$i] != "") {
											$data = " AND id <> " . $confirmed[$i];
											$confirmedemp = $confirmedemp . $data;
										}
									}
			
									$sql = "select * from employee  where emp_status = 'Active' AND dep_id in($dep_id) AND branch_id = " . $_GET['b'];
									$result = mysql_query($sql);
								 ?>
										<tr class="tabletr" name='leave_row' style="background-color: beige; color: black;">
											<td>
												<select id="employee" style="width: 250px;"  name='tid'>
													<option value="">--Please Select--</option>
													<?php
													while ($rs = mysql_fetch_array($result)) {							
														echo '<option value="' . $rs['id'] . '">' .$rs['full_name']. '</option>';
													}
													?>
												</select>
											</td>
											<td>
											  <select id="allowance" style="width: 250px;" name="fy" onchange="allowance(this)">
													<option value="">--Please Select--</option>
													<?php
													while ($rs_allowance = mysql_fetch_array($result_allowance)) {
														/*foreach ($idss as $id) {
															if ($id == $rs['id'])
																$checked = "checked";
														}
														print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT). "</td><td>" . $rs['full_name'] . "</td><td><input type='checkbox' name='" . $rs['full_name'] . "'class='check' value='" . $rs['id'] . "' $checked></td>";
														$checked = "";*/
									
														echo '<option value="' . $rs_allowance['id'] . '">' .$rs_allowance['allowance_name']. '</option>';
													}
													?>
												</select>
											   
											</td>
											<td>
											   <input name='ty' id="allowance_id" type='text' value="0" <?php echo $readonly ;?>//>
											</td>
											<!--<td>
												<input name='days' type='text' value="<?php //echo $newArray1["days"]; ?>" />
											</td>-->
											<td>
												<input type="hidden" id="departments" value="<?php echo $_GET['eid'] ?>">
												<input type="hidden" id="branches" value="<?php echo $_GET['b'] ?>">
												<input type="button" value=" + " onclick="addemployee(this,<?php echo $_GET['eid']; ?>)" name="addr" /><?php
												
										if ($temp_name == $rs['full_name']) {
													?>
													<input type='button' value=' x ' onclick='removerow(this)' />
													<?php
												}
												?>
											</td>
										</tr>
										
							</table>
						</div>
					</div>
			<?php
				}else if($_GET['type']=="3"){
			?>
					<div style="padding-top: 10px;padding-bottom: 5px;">
						<?php if ($eid != "") { ?>
							<input type="button" class="button" value="Save" onclick="updategroup(<?php echo $eid ?>)" style="width: 70px;"/>
							<input type='button' class="button" value='back' onclick='clearNew()' style="width: 70px;" />
						<?php } else { ?>
							<input type='button' class="button" value='Add' onclick='savegroup()' style="width: 70px;" />
						<?php 
							} 
							
						 if($_GET['allowance']=="2"){
							 $readonly='';
						 ?>
						 <table>
								<tr>
									<td>Deduction Date<span class="red"> *</span></td>
									<td><input type="text"  class="input_text" id="allowance_date" style="width: 250px" /></td>
								</tr>
							</table>
						 <?php }else{
									$readonly='readonly';
								}
							?>
							
						
					</div>
					<div class="table">
						<div style="border: 1px solid black;padding-bottom: 10px;background-color: beige;">
							<table id="tbl" class="bold bordercollapse" style="width: 100%;">
								<tr class="tableth">
									<th style="width: 200px;">Employee</th>
									<th style="width: 180px;">Deduction</th>
									<th style="width: 180px;">Deduction Amount</th>
									<!--<th style="width: 180px;">Tonnage</th>-->
									<th></th>
								</tr>
								<?php
									//Get all the allowance
									if($_GET['allowance']!=0){
										$sql_deduction = "select * from deduction_payroll where deduction_type=".$_GET['allowance'];
									}else{
										$sql_deduction = "select * from deduction_payroll";
									}
									$result_deduction = mysql_query($sql_deduction);
									//Select all the employee based on department and branch
									$confirmed = explode(",", $_GET['c']);
									$confirmedemp = "";
									$dep_id=$_GET['eid'];
									for ($i = 0; $i <= count($confirmed); $i++) {
										if ($confirmed[$i] != "") {
											$data = " AND id <> " . $confirmed[$i];
											$confirmedemp = $confirmedemp . $data;
										}
									}
			
									$sql = "select * from employee  where emp_status = 'Active' AND dep_id in($dep_id) AND branch_id = " . $_GET['b'];
									$result = mysql_query($sql);
								 ?>
										<tr class="tabletr" name='leave_row' style="background-color: beige; color: black;">
											<td>
												<select id="employee" style="width: 250px;"  name='tid'>
													<option value="">--Please Select--</option>
													<?php
													while ($rs = mysql_fetch_array($result)) {							
														echo '<option value="' . $rs['id'] . '">' .$rs['full_name']. '</option>';
													}
													?>
												</select>
											</td>
											<td>
											  <select id="allowance" style="width: 250px;" name="fy" onchange="allowance(this)">
													<option value="">--Please Select--</option>
													<?php
													while ($rs_deduction = mysql_fetch_array($result_deduction)) {
														/*foreach ($idss as $id) {
															if ($id == $rs['id'])
																$checked = "checked";
														}
														print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT). "</td><td>" . $rs['full_name'] . "</td><td><input type='checkbox' name='" . $rs['full_name'] . "'class='check' value='" . $rs['id'] . "' $checked></td>";
														$checked = "";*/
									
														echo '<option value="' . $rs_deduction['id'] . '">' .$rs_deduction['deduction_name']. '</option>';
													}
													?>
												</select>
											   
											</td>
											<td>
											   <input name='ty' id="allowance_id" type='text' value="0" <?php echo $readonly ;?>//>
											</td>
											<!--<td>
												<input name='days' type='text' value="<?php //echo $newArray1["days"]; ?>" />
											</td>-->
											<td>
												<input type="hidden" id="departments" value="<?php echo $_GET['eid'] ?>">
												<input type="hidden" id="branches" value="<?php echo $_GET['b'] ?>">
												<input type="button" value=" + " onclick="addemployee(this,<?php echo $_GET['eid']; ?>)" name="addr" /><?php
												
										if ($temp_name == $rs['full_name']) {
													?>
													<input type='button' value=' x ' onclick='removerow(this)' />
													<?php
												}
												?>
											</td>
										</tr>
										
							</table>
						</div>
					</div>
			<?php
				}else{
			?>
			  		<div style="padding-top: 10px;padding-bottom: 5px;">
						<?php if ($eid != "") { ?>
							<input type="button" class="button" value="Save" onclick="updategroup()" style="width: 70px;"/>
							<input type='button' class="button" value='back' onclick='clearNew()' style="width: 70px;" />
						<?php } else { ?>
							<input type='button' class="button" value='Add' onclick='savegroup()' style="width: 70px;" />
						<?php } ?>
						<table>
							<tr>
								<td>Claim Date<span class="red"> *</span></td>
								<td><input type="text"  class="input_text" id="claim_date" style="width: 250px" /></td>
							</tr>
						</table>
					</div>
					
					<div class="table">
						<div style="border: 1px solid black;padding-bottom: 10px;background-color: beige;">
							<table id="tbl" class="bold bordercollapse" style="width: 100%;">
								<tr class="tableth">
									<th style="width: 200px;">Employee</th>
									<th style="width: 180px;">Claim</th>
									<th style="width: 100px;">Claim Amount</th>
									<th style="width: 100px;">Clain Number</th>
									<th style="width: 100px;">Require approval</th>
									<th></th>
								</tr>
								<?php
									//Get all the allowance
									$sql_claim = "select * from claim_payroll";
									$result_claim = mysql_query($sql_claim);
									//Select all the employee based on department and branch
									$confirmed = explode(",", $_GET['c']);
									$confirmedemp = "";
									$dep_id=$_GET['eid'];
									for ($i = 0; $i <= count($confirmed); $i++) {
										if ($confirmed[$i] != "") {
											$data = " AND id <> " . $confirmed[$i];
											$confirmedemp = $confirmedemp . $data;
										}
									}
			
									$sql = "select * from employee  where emp_status = 'Active' AND dep_id in($dep_id) AND branch_id = " . $_GET['b'];
									$result = mysql_query($sql);
								 ?>
										<tr class="tabletr" name='leave_row' style="background-color: beige; color: black;">
											<td>
												<select id="employee" style="width: 250px;"  name='tid'>
													<option value="">--Please Select--</option>
													<?php
													while ($rs = mysql_fetch_array($result)) {							
														echo '<option value="' . $rs['id'] . '">' .$rs['full_name']. '</option>';
													}
													?>
												</select>
											</td>
											<td>
											  <select id="allowance" style="width: 250px;" name="fy" onchange="claim(this)">
													<option value="">--Please Select--</option>
													<?php
													while ($rs_claim = mysql_fetch_array($result_claim)) {
														/*foreach ($idss as $id) {
															if ($id == $rs['id'])
																$checked = "checked";
														}
														print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT). "</td><td>" . $rs['full_name'] . "</td><td><input type='checkbox' name='" . $rs['full_name'] . "'class='check' value='" . $rs['id'] . "' $checked></td>";
														$checked = "";*/
									
														echo '<option value="' . $rs_claim['id'] . '">' .$rs_claim['claim_name']. '</option>';
													}
													?>
												</select>
											   
											</td>
											<td>
											   <input name='ty' id="amount_id" type='text' value="0" />
											</td>
											<td>
											   <input name='cn' id="claim_number" type='text' value="" />
											</td>
											<td>
											   <input name='rapp' id="require_approval" type='checkbox' value="" />
											</td>
											<td>
												<input type="hidden" id="departments" value="<?php echo $_GET['eid'] ?>">
												<input type="hidden" id="branches" value="<?php echo $_GET['b'] ?>">
												<input type="button" value=" + " onclick="addemployee_claim(this,<?php echo $_GET['eid']; ?>)" name="addr" /><?php
												
										if ($temp_name == $rs['full_name']) {
													?>
													<input type='button' value=' x ' onclick='removerow(this)' />
													<?php
												}
												?>
											</td>
										</tr>
										
							</table>
						</div>
					</div>

			<?php
				} 
			?>
            </div>
        </div>
	<?php
      }
     ?>
     </div>
	 <br>
		 <div class="panel-group" id="accordion">
			<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a href="#collapsetwo" data-toggle="collapse" data-parent="accordion">Allowance, Claim & Deduction Payroll History</a>
						</h4>
					</div>
			</div>
		</div>

		<div id="collapsetwo" class="panel-collapse collapse in allowanc-payroll" >
			<div class="panel-body"> 
			 <div class="tabs" style="margin-top:-3px; padding:0px 0px 50px 0px">
			
			   <div class="tab tab1">
				   <input type="radio" id="tab-1" name="tab-group-1" checked>
				
				   <label for="tab-1" onclick="change(0)">Fixed Allowance</label>
				   
				   </div>
				<div class="tab tab2" >
				   <input type="radio" id="tab-2" name="tab-group-1">
				   <label for="tab-2" id="tab2" onclick="change(1)">Monthly Allowance</label>
				   
				  
				 </div> 
				 <div class="tab tab3" >
				   <input type="radio" id="tab-3" name="tab-group-1">
				   <label for="tab-3" id="tab3" onclick="change(2)">Claims</label>
				   
				  
				   </div> 
				   <div class="tab tab4" >
				   <input type="radio" id="tab-4" name="tab-group-1">
				   <label for="tab-4" id="tab4" onclick="change(3)">Deduction</label>
				   
				  
				   </div> 
				  
			   </div>
				 <hr>
					<?php
						include("allowance_payrol.php");
					?>


		</div>
		</div>
	</div>  
<script type="text/javascript">
    function view(id){
        window.location="?loc=allowance_processing&eid=" + id;
    }

    function addemployee(obj,id){
		var department=$("#departments").val();
		var branches=$("#branches").val(); 
		var allowance_type="<?php echo $_GET['allowance']; ?>";
		var types="<?php echo $_GET['type']; ?>";
	    var readonly="";
		if(allowance_type==1){
			var readonly="readonly";
		}
		
		$.ajax({
                dataType:'json',
                url:"?widget=showemployee_sim",
				//dataType: 'json',
               data:{
					departments:department,
					branches:branches,
					type:allowance_type,
					types:types
				},
                success:function(data){
					//var allowance=allowance("All");
					$(obj).parent().parent().after("<tr class='tabletr' name='leave_row'><td><select id='employee' style='width: 250px;' name='tid'>"+data.data1+"</select></td><td><select id='allowance' style='width: 250px;' name='fy' onchange='allowance(this)'>"+data.data2+"</select></td><td><input name='ty' type='text' value='0' "+readonly+"/></td></td><td><input type='button' value=' + ' onclick='addemployee(this,"+id+")' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
					//$(obj).parent().parent().after("<tr class='tabletr' name='leave_row'><td><select id='employee' style='width: 250px;'>"+data+"</select></td><td><input name='fy' type='text' value=''/></td><td><input name='ty' type='text' value='' /></td><td><input name='days' type='text' value='' /></td><td><input type='button' value=' + ' onclick='addemployee(this,"+id+")' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
					$(obj).hide();
                    
                } 

            });
    }
	
	function addemployee_claim(obj,id){
		var department=$("#departments").val();
		var branches=$("#branches").val();  	
		$.ajax({
                dataType:'json',
                url:"?widget=showemployee_sim",
				//dataType: 'json',
               data:{
					departments:department,
					branches:branches,
					action:"claim"
				},
                success:function(data){
					//var allowance=allowance("All");
					$(obj).parent().parent().after("<tr class='tabletr' name='leave_row'><td><select id='employee' style='width: 250px;' name='tid'>"+data.data1+"</select></td><td><select id='claim' style='width: 250px;' name='fy' onchange='claim(this)'>"+data.data2+"</select></td><td><input name='ty' type='text' value='' /></td><td><input name='cn' type='text' value='' /></td><td><input name='rapp' type='checkbox' value='' /></td><td><input type='button' value=' + ' onclick='addemployee_claim(this,"+id+")' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
					//$(obj).parent().parent().after("<tr class='tabletr' name='leave_row'><td><select id='employee' style='width: 250px;'>"+data+"</select></td><td><input name='fy' type='text' value=''/></td><td><input name='ty' type='text' value='' /></td><td><input name='days' type='text' value='' /></td><td><input type='button' value=' + ' onclick='addemployee(this,"+id+")' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
					$(obj).hide();
                    
                } 

            });	
	}

    function removerow(obj){
        $(obj).parent().parent().prev().find("[name=addr]").show();
        $(obj).parent().parent().remove();
    }
    function clearNew(){
        window.location='?loc=allowance_processing';
    }
    function addnewbox(){
        $('#addnewbox').toggle('slow');
    }
    function add_leave(){
        var error1 = [];
        var error3 = [];
        
        var grp_name = $("#group_name").val();
        if(grp_name == "" || grp_name == " "){
            error1.push("Leave Group Name");
        }
        var l=$("#selected_leave_list").val();
        if(l!=null){
        }else{
            error3.push("Leave Type");
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error3.length > 0){
            alert(data1 + data3);
        }else{
            $("#tbl").empty().append("<tr class='tableth'><th style='width: 200px;'>Leave Type</th><th style='width: 180px;'>From Year</th><th style='width: 180px;'>To Year</th><th style='width: 180px;'>Days of Leave</th><th></th></tr>");
            $("#selected_leave_list option").each(function(){
                $("#tbl").append("<tr name='leave_row' style='background-color: beige; color: black;'><td style='padding-left: 10px;'>"+$(this).text()+"<input name='tid' value='"+$(this).val()+"' type='hidden' /></td><td style='padding-left: 10px;'><input name='fy' type='text' /></td><td style='padding-left: 10px;'><input name='ty' type='text' /></td><td style='padding-left: 10px;'><input name='days' type='text' /></td><td style='padding-left: 10px;'><input type='button' value=' + ' onclick='addrow(this,"+$(this).val()+")' name='addr' /></td></tr>");
            });
            $('#updatetable').fadeIn();//.toggle('slow');
        }
    }
    
    function updategroup(gid){
        var employee_id='', allowance_id='', allowance_amount='', claim_number='',calim_title='',req_approval='',str='';
		var allowance_type="<?php echo $_GET['allowance']; ?>";
		var type="<?php echo $_GET['type']; ?>";
		
		var date="", claim_date="";
		
		if(allowance_type==2){//Evolved Allowance
			date=$("#allowance_date").val();
			if(date==""){
				if(type==1){
					alert("Please keyin allowance date");
				}else if(type==3){
					alert("Please keyin Deduction date");
				}
				exit();
			}
		}
		if(type==2){//Evolved Allowance
			claim_date=$("#claim_date").val();
			if(claim_date==""){
				alert("Please keyin claim date");
				exit();
			}
		}
        var gn=$("#group_name").val();
        $("#tbl").children().find("[name=leave_row]").each(function(i,dom){
            employee_id=$(dom).find("[name=tid]").val(); 
            allowance_id=$(dom).find("[name=fy]").val();
            allowance_amount=$(dom).find("[name=ty]").val();
			if(type==2){
				claim_number=$(dom).find("[name=cn]").val();
				if($(dom).find("[name=rapp]").is(":checked")){
					req_approval="Yes";
				}else{
					req_approval="No";
				}
				calim_title=$(dom).find("[name=fy] option:selected").text();
			}
            //y3=$(dom).find("[name=days]").val();
			if(type!=2){
				if(employee_id!="" && allowance_id!="" && allowance_amount!="" && allowance_amount!=0){
					str+=employee_id+','+allowance_id+','+allowance_amount+';';
				}
			}else{
				if(employee_id!="" && allowance_id!="" && allowance_amount!="" && allowance_amount!=0 && claim_number!=""){
					str+=employee_id+','+allowance_id+','+allowance_amount+','+claim_number+','+calim_title+','+req_approval+';';
				}
			}
			
			if(str==""){
				exit();
			}
        });
   
		//Allowance
		if(type==1){
			if(allowance_type==1){
				$.ajax({
					type:"POST",
					url:"?widget=add_payroll_allowance",
					data:{
						allowance_type:allowance_type,
						str:str,
						type:type
					},
					success:function(data){
						if(data == true){
							alert("Allowance Updated");
							window.location = '?loc=allowance_processing&fixed=fall';
						}else{
							alert("Error While Processing");
						}
					}
				})
			}else if(allowance_type==2){
				$.ajax({
					type:"POST",
					url:"?widget=add_payroll_allowance",
					data:{
						allowance_type:allowance_type,
						str:str,
						type:type,
						date:date
					},
					success:function(data){
						if(data == true){
							alert("Allowance Updated");
							window.location = '?loc=allowance_processing&eva=evall';
						}else{
							alert("Error While Processing");
						}
					}
				})
			}
		}else if(type==2){// Claim
			$.ajax({
				type:"POST",
				url:"?widget=add_payroll_allowance",
				data:{
					str:str,
					claim_date:claim_date,
					claim_number:claim_number,
					calim_title:calim_title,
					type:type
				},
				success:function(data){
					if(data == true){
						alert("Claim Updated");
						window.location = '?loc=allowance_processing&cl=cl';
					}else{
						alert("Error While Processing");
					}
				}
			})
		}else if(type==3){// Deduction
			$.ajax({
				type:"POST",
				url:"?widget=add_payroll_allowance",
				data:{
					allowance_type:allowance_type,
					str:str,
					type:type,
					date:date
				},
				success:function(data){
					if(data == true){
						alert("Deduction Updated");
						window.location = '?loc=allowance_processing&dva=dva';
					}else{
						alert("Error While Processing");
					}
				}
			})
		}
    }
    function addtogroup(){
        var leave_id = $("#leaveIDSpan").html();
        if(leave_id == ""){
            $("#leave_list option:selected").each(function(i,dom){
                $("#selected_leave_list").append(dom);
            }); 
        }else{
            $("#leave_list option:selected").each(function(i,dom){
                $("#selected_leave_list").append(dom);
            }); 
            
            var selectedOptions = $.map($('#selected_leave_list option'),
            function(e) { return $(e).val(); } );
            var list = selectedOptions.join(',');

            $.ajax({
                type:"POST",
                url:"?widget=getLeaveGroupType",
                data:{
                    leave_id:leave_id,
                    list:list
                },
                success:function(data){
                    $("#tbl").empty().append("<tr class='tableth'><th style='width: 200px;'>Leave Type</th><th style='width: 180px;'>From Year</th><th style='width: 180px;'>To Year</th><th style='width: 180px;'>Days of Leave</th><th></th></tr>");
                    $("#tbl").append(data);
                    $('#updatetable').fadeIn();//.toggle('slow');
                }
            })
        }
    }
    function removefromgroup(){
        var leave_id = $("#leaveIDSpan").html();
        if(leave_id == ""){
            $("#selected_leave_list option:selected").each(function(i,dom){
                $("#leave_list").append(dom);
            }); 
        }else{
            $("#selected_leave_list option:selected").each(function(i,dom){
                $("#leave_list").append(dom);
            }); 
            
            var selectedOptions = $.map($('#selected_leave_list option'),
            function(e) { return $(e).val(); } );
            var list = selectedOptions.join(',');

            $.ajax({
                type:"POST",
                url:"?widget=getLeaveGroupType",
                data:{
                    leave_id:leave_id,
                    list:list
                },
                success:function(data){
                    $("#tbl").empty().append("<tr class='tableth'><th style='width: 200px;'>Leave Type</th><th style='width: 180px;'>From Year</th><th style='width: 180px;'>To Year</th><th style='width: 180px;'>Days of Leave</th><th></th></tr>");
                    $("#tbl").append(data);
                    $('#updatetable').fadeIn();//.toggle('slow');
                }
            })
        }
    }
    
    /*function savegroup(){
        var id='', y1='', y2='', y3='',str='';
        var gn=$("#group_name").val();
        $("#tbl").children().find("[name=leave_row]").each(function(i,dom){
            id=$(dom).find("[name=tid]").val(); 
            y1=$(dom).find("[name=fy]").val();
            y2=$(dom).find("[name=ty]").val();
            y3=$(dom).find("[name=days]").val();
            str+=id+','+y1+','+y2+','+y3+';';
        });
        $.ajax({
            type:"POST",
            url:"?widget=save_group",
            data:{
                gn:gn,
                str:str
            },
            success:function(data){
                if(data == true){
                    alert("Leave Group Added");
                    window.location = '?loc=allowance_processing';
                }else{
                    alert("Error While Processing");
                }
            }
        })
    }*/
	function save_all_claim(id){ 
		var action="<?php 
			 if(isset($_GET['cl']) && $_GET['cl']!=""){
				 echo $_GET['cl'];
			 }else if(isset($_GET['eva']) && $_GET['eva']!=""){
				 echo $_GET['eva'];
			 }else if(isset($_GET['dva']) && $_GET['dva']!=""){
				 echo $_GET['dva'];
			 }
		?>";
		if(id==""){ // Don't proceed editing if the table id is empty
				exit();
		}
	
		if(action=="evall"){ // Allowance
			
			var amount=$("#ev_all_amount").val();
			if(amount==""){
				alert("Please keyin allowanc amount");
				exit();
			}
			$.ajax({
				type:"POST",
				url:"?widget=edit_evAllowance",
				data:{
					id:id,
					amount:amount,
					action:action
				},
				success:function(data){
					if(data == true){
						alert("Allowance updated");
						window.location = '?loc=allowance_processing&eva=evall';
					}else{
						alert("Error While Processing");
					}
				}
			})
		}else if(action=="dva"){ // Deduction
			
			var amount=$("#ev_all_amount").val();
			if(amount==""){
				alert("Please keyin amount");
				exit();
			}
			$.ajax({
				type:"POST",
				url:"?widget=edit_evAllowance",
				data:{
					id:id,
					amount:amount,
					action:action
				},
				success:function(data){
					if(data == true){
						alert("Deduction updated");
						window.location = '?loc=allowance_processing&dva=dva';
					}else{
						alert("Error While Processing");
					}
				}
			})
		}else if(action=="cl"){ // Claim
			var amount=$("#claim_amount").val();
			var claim_number=$("#claim_number").val();
			var claim_date=$("#claim_date").val();
			if(amount=="" || claim_number=="" || claim_date==""){
				alert("All the Fields with (*) can not be empty");
				exit();
			}
			$.ajax({
				type:"POST",
				url:"?widget=edit_evAllowance",
				data:{
					id:id,
					amount:amount,
					claim_number:claim_number,
					claim_date:claim_date,
					action:action
				},
				success:function(data){
					if(data == true){
						alert("Claim updated");
						window.location = '?loc=allowance_processing&cl=cl';
					}else{
						alert("Error While Processing");
					}
				}
			})
		}
		
    }
	
    /*function delete_group(id){
        var r=confirm("Are you sure you want to delete this record?");
        if(r){
            $.ajax({
                type:"POST",
                url:"?widget=del_leavegroup",
                data:{
                    id:id
                },
                success:function(data){
                    if(data == true){
                        alert("Leave Group Deleted");
                        window.location='?loc=allowance_processing';
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }*/
	function del_all(id){

		var action ="<?php 
					  if(isset($_GET['eva'])){ 
						 echo $_GET['eva'];
					  }else if(isset($_GET['fixed'])){ 
						 echo $_GET['fixed'];
					  }else if(isset($_GET['cl'])){ 
						 echo $_GET['cl'];
					  }else if(isset($_GET['dva'])){ 
						 echo $_GET['dva'];
					  }
					?>";
		
        var r=confirm("Are you sure you want to delete this record?");
        if(r){
            $.ajax({
                type:"POST",
                url:"?widget=del_allow_claim",
                data:{
                    id:id,
					action:action
                },
                success:function(data){
                    if(data == true){
						if(action=="evall"){
							alert("Allowance Deleted");
							window.location='?loc=allowance_processing&eva=evall';
						}else if(action=="fall"){
							alert("Allowance Deleted");
							window.location='?loc=allowance_processing&fixed=fall';
						}else if(action=="cl"){
							alert("Allowance Deleted");
							window.location='?loc=allowance_processing&cl=cl';
						}else if(action=="dva"){
							alert("Allowance Deleted");
							window.location='?loc=allowance_processing&dva=dva';
						}
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }
    function edit(id){
        window.location="?loc=allowance_processing&eid="+id;
    }
	function showBranch(company_id){
        var branch = $("#branchSpan").html();
        $.ajax({
            type:"POST",
            url:"?widget=showbranch_form",
            data:{
                company_id:company_id,
                branch:branch
            },
            success:function(data){
                $("#dropBranch").empty().append(data);
                $("#selectdep").empty().append("<option value=''>--Please Select--</option>");
                $("#employee_list_view").val("");
                $("#employee_ids").html("");
            }
        });
    } 
    
    function showDep(branch_id){
        $.ajax({
            type:"POST",
            url:"?widget=showdept_sim",
            data:{
                branch_id:branch_id
            },
            success:function(data){
                $("#selectdep").empty().append(data);
                $("#employee_list_view").val("");
                $("#employee_ids").html("");
				$("#b_id").val(branch_id);
			$("select#selectdep").after('<input type="button" value=" + " onclick="addrow(this)" name="addr" />');
            }
        });
    }
	function addrow(obj){ 
	var b_id=$("#b_id").val();
	 $.ajax({
                type:'POST',
                url:"?widget=showdept_sim",
                data:{
				branch_id:b_id
                    
                },
                success:function(data){
				
			 $(obj).parent().parent().after("<tr  name='leave_row'><td></td><td><select class='input_text' name='selectdep' id='nm' class='selectdep' style='width: 250px;'>"+data+"</select><input type='button'  id='add' value=' + ' onclick='addrow(this)' name='addr' />&nbsp;<input type='button'  id='rem' value=' x ' onclick='removerow(this)' /></td></tr>");
        $(obj).hide();
                    
                } 

            });
       
    } 
	function removerow(obj){
        $(obj).parent().parent().prev().find("[name=addr]").show(); 
        $(obj).parent().parent().remove();
    }

    
    function selectdep(){ 
        $("#employee_list_view").empty(); 
    }
     function select(intype){
	 var status = intype;
	 if(status=="m"){ 
	 $(".tableth").show();
	 $(".tabletr").show();
	  $("#calintr1").hide();
	  $(".tabletr1").hide();
	  $("#button1").hide();
	  $("#button2").hide();
	 }else{
	  $(".tableth").hide();
	 $(".tabletr").hide();
	  $("#calintr1").show();
	  $(".tabletr1").show();
	 }
	
	}
	function add_emp_list(){
        $("#employee_list_view").val(""); 
        $("#employee_ids").html("");
        var confirmedemp = $("#confirmedemp").html();
        var department = $("#selectdep").val();
		var type=$("#allowance_claim").val();
		var allowance_type=$("#allowance_type").val();
		if(allowance_type==""){
			allowance_type=0;
		}
		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){
             
            y1=$(dom).find("[name=selectdep]").val();
            department+="," + y1
        });
        var branch = $("#dropBranch").val();
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
			window.location="?loc=allowance_processing&eid="+department+"&b="+branch+"&c="+confirmedemp+"&type="+type+"&allowance="+allowance_type;
        }
    }
	function allowance(obj){ 
            //var row = $(this).parents('tr');
            //var desc = row.find('input[name="ty"]').val();
			//$(this).closest('tr').find('input[name="ty"]').val();
			//var text = $(this).parent().next('td').next('td').val();
			//var id=$(this).val();
			var type="<?php echo $_GET['type'];  ?>"
			var id =obj.value;
			var tr = $(obj).closest('tr');
			var qty = tr.find('input[name="ty"]');
	
	 $.ajax({
                type:'POST',
                url:"?widget=allowance_ammount",
                data:{
				id:id,
				type:type
                    
                },
                success:function(data){
                      qty.val(data);
                } 

            });
       
    } 
	
	function claim(obj){ 
			var id =obj.value;
			var tr = $(obj).closest('tr');
			var qty = tr.find('input[name="ty"]');
	
	 $.ajax({
                type:'POST',
                url:"?widget=claim_ammount",
                data:{
				id:id  
                },
                success:function(data){
                      qty.val(data);
                } 

            });
       
    } 
	
	function selectAllowanceType(value){
		if(value==1 || value==3){
			$(".claim-allowance").show();
		}else{
			$(".claim-allowance").hide();
		}
		
	}
	 var currentYear = (new Date).getFullYear();
     var currentMonth = (new Date).getMonth() + 1;
     var currentDay = (new Date).getDate();
	$("#claim_date").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
		minDate: new Date((currentYear - 1), 12, 1)	
    });
	$("#allowance_date").datepicker({
        dateFormat: 'mm yy',
        changeMonth: true,
        changeYear: true,
		minDate: new Date((currentYear - 1), 12, 1) 
    });
	
	function change(id){
		if(id==1){  
			window.open('?loc=allowance_processing&eva=evall', '_parent')
		 }else if(id==2){  
			window.open('?loc=allowance_processing&cl=cl', '_parent')
		 }else if(id==3){  
			window.open('?loc=allowance_processing&dva=dva', '_parent')
		 }else{
			window.open('?loc=allowance_processing&fixed=fall', '_parent')
		 }
	}
	 oTable = $('#tableAllowance').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
	function edit_evallowance(id){
        window.location="?loc=allowance_processing&eva=evall&evid=" + id;
    }
	function edit_deduction(id){
        window.location="?loc=allowance_processing&dva=dva&dvaid=" + id;
    }
	function edit_claim(id){
        window.location="?loc=allowance_processing&cl=cl&clid=" + id;
    }
    function del(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=del_allowance",
                data:{
                    id:id
                },
                success:function(data){
                    if(data == true){
                        alert("Allowance Deleted");
                        window.location = '?loc=allowance';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }
</script>
	<style>
	textarea {
    resize: none;
}
    .tabs {
      position: relative;   
    
      clear: both;
      margin: 0px 0;
	  font-size: 14px;
 
    }
    .tab {
      float: left;
    }
    .tab label {
	 
		padding: 10px;
		margin-left: -1px;
		position: relative;
		left: 1px;
		padding: 10px 30px;
		background-color: #2b2a2a;
		width: 89px;
		color: #fff;
		font-size: 13px;
		cursor: pointer;
    }
    .tab [type=radio] {
      display: none;   
    }
    .content {
      position: absolute;
      top: 28px;
      left: 0;
      background: #000;
      right: 0;
      bottom: 0;
      padding: 20px;
      border: 1px solid #ccc; 
    }
	
	<?php  
	if(isset($_GET['eva'])){
	
	
	?>
		[type=radio]:checked ~ label {
		  z-index: 2;
		}
		
		#tab2{
			background: #e48e0f;
			color: #000;
			z-index: 2;
			font-weight: bold;
		}
	
	
	<?php
	}else if(isset($_GET['cl'])){
	
	
	?>
		[type=radio]:checked ~ label {
		  z-index: 2;
		}
		
		#tab3{
			background: #e48e0f;
			color: #000;
			z-index: 2;
			font-weight: bold;
		}
	
	
	<?php
	}else if(isset($_GET['dva'])){
	
	
	?>
		[type=radio]:checked ~ label {
		  z-index: 2;
		}
		
		#tab4{
			background: #e48e0f;
			color: #000;
			z-index: 2;
			font-weight: bold;
		}
	
	
	<?php
	}else{
	?>
		[type=radio]:checked ~ label {
			background: #e48e0f;
			color: #000;
			z-index: 2;
			font-weight: bold;
		}
		
	<?php
	}
	?>
   
	</style>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>