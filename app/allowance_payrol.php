<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style type="text/css">
    #popup_box1 { 
        display: none;
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:300px;  
        width:500px;  
        background:#FFFFFF;  
        left: 300px;
        top: 150px;
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

    #container1 {

        /*        width:100%;
                height:100%;*/
    }

    a{  
        cursor: pointer;  
        text-decoration:none;  
    } 

    /* This is for the positioning of the Close Link */
    #popupBoxClose1 { 
        line-height:15px;  
        right:5px;  
        top:5px;  
        position:absolute;  
        color:#6fa5e2;  
        font-weight:500;  	
    }
</style>
<?php
$Months = array("1"=>"January", "2"=>"Febuary", "3"=>"March", "4"=>"April", "5"=>"May", "6"=>"June", "7"=>"July", "8"=>"August", "9"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");

 if(isset($_GET['eva'])){//view evolved allowance
?>
 <table id="tableAllowance" class="TFtable" border="0" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr class="pluginth">
                        <th style="width:5%;">No.</th>
						<th style="width:25%;">Full Name</th>
                        <th style="width:20%;">Allowance Type</th>
                        <th style="width:2%;">Amount (RM)</th>
						<th style="width:2%;">Monthly</th>
						<th style="width:2%;">Year</th>
						<th style="width:5%;">Action</th>
                    </tr>
                </thead>
                <?php
			   
                $num = 0;
                $sql = "SELECT ev.allowance_amount as eva, ev.month as mon, ev.year as yr, ev.id as evid, ev.allowance_id, ev.emp_id, e.full_name, a.allowance_name FROM employee_evallowance AS ev
                        INNER JOIN allowance AS a 
						INNER JOIN employee AS e
                        ON a.id = ev.allowance_id
                        WHERE ev.emp_id =e.id order by e.full_name";
                $sql_result = mysql_query($sql);
                while ($newArray = mysql_fetch_array($sql_result)) {
					 $mon="-";
					foreach($Months as  $key => $month){
					    if($key==$newArray['mon']){
							$mon=$month;
						}
					}
                    $num = $num + 1;
                    echo"<tr class='plugintr'>
                            <td style= 'width:5%;'>" . $num . "</td>
							<td style= 'width:25%;'>" . strtoupper ($newArray['full_name']) . "</td>
                            <td style= 'width:30%;'>" . $newArray['allowance_name'] . "</td>
                            <td style= 'width:7%;'>" . number_format($newArray['eva'], 2, '.', '') . "</td>
							<td style= 'width:10%;'>" . $mon . "</td>
							<td style= 'width:5%;'>" . $newArray['yr'] . "</td>
							<td style= 'width:5%; text-align:center;'>";
							if ($igen_a_m == "a_m_edit") {
								echo "<a title='Edit' onclick='edit_evallowance(" . $newArray['evid'] . ")'><i class='far fa-edit' style='color:#000;' ></i></a>&nbsp;|&nbsp;<a title='Delete' onclick='del_all(" . $newArray['evid'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>";
							}
						echo "</td
                            </tr>";
                }
				
			//Edit evolved allowance
			
                ?>
				
          </table>
            
<?php
 }else if(isset($_GET['dva'])){//view Deduction
?>
 <table id="tableAllowance" class="TFtable" border="0" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr class="pluginth">
                        <th style="width:5%;">No.</th>
						<th style="width:25%;">Full Name</th>
                        <th style="width:15%;">Deduction title</th>
                        <th style="width:10%;">Amount (RM)</th>
						<th style="width:10%;">Type</th>
						<th style="width:5%;">Month</th>
						<th style="width:5%;">Year</th>
						<th style="width:5%;">Action</th>
                    </tr>
                </thead>
                <?php
                $num = 0;
				
                $sql = "SELECT de.deduction_amount as dea,de.type as detype, de.month as mon, de.year as yr, de.id as deid, de.deduction_id, de.emp_id, e.full_name, dp.deduction_name FROM employee_deduction AS de
                        INNER JOIN deduction_payroll AS dp 
						INNER JOIN employee AS e
                        ON dp.id = de.deduction_id
                        WHERE de.emp_id =e.id order by e.full_name";
                $sql_result = mysql_query($sql);
                while ($newArray = mysql_fetch_array($sql_result)) {
                    $num = $num + 1;
					$type="";
                    $mon="-";
				    $year="-";
					if($newArray['detype']==1){
						$type="Fixed";
					}else{
						$type="Monthly";
						$year=$newArray['yr'];
					}
					foreach($Months as  $key => $month){
					    if($key==$newArray['mon']){
							$mon=$month;
						}
					}
					
                    echo"<tr class='plugintr'>
                            <td style= 'width:5%;'>" . $num . "</td>
							<td style= 'width:25%;'>" . strtoupper ($newArray['full_name']) . "</td>
                            <td style= 'width:15%;'>" . $newArray['deduction_name'] . "</td>
                            <td style= 'width:10%;'>" . number_format($newArray['dea'], 2, '.', '') . "</td>
							<td style= 'width:10%;'>" .$type. "</td>
							<td style= 'width:10%;'>" . $mon ."</td>
							<td style= 'width:5%;'>" . $year . "</td>
							<td style= 'width:5%; text-align:center;'>";
							if ($igen_a_m == "a_m_edit" && $newArray['detype']==1) {
								echo "<a title='Delete' onclick='del_all(" . $newArray['deid'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>";
							}else if ($igen_a_m == "a_m_edit" && $newArray['detype']==2) {
								echo "<a title='Edit' onclick='edit_deduction(" . $newArray['deid'] . ")'><i class='far fa-edit' style='color:#000;' ></i></a>&nbsp;|&nbsp;<a title='Delete' onclick='del_all(" . $newArray['deid'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>";
							}	
						echo "</td
                            </tr>";
                }
				
			//Edit evolved allowance
			
                ?>
          </table>
		 
            
<?php
 }else  if(isset($_GET['cl'])){//view Claims
?>
		<table id="tableAllowance" class="TFtable" border="0" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr class="pluginth">
                        <th style="width:5%;">No.</th>
						<th style="width:25%;">Full Name</th>
                        <th style="width:20%;">Claim Name</th>
                        <th style="width:10%;">Claim No</th>
                        <th style="width:8%;">Amount (RM)</th>
						<th style="width:10%;">Claim Date</th>
						<th style="width:10%;">Applied Date</th>
						<th style="width:45%;">Action</th>
                    </tr>
                </thead>
                <?php
                $num = 0;
                $sql = "SELECT ec.claim_item_title,ec.claim_no,ec.amount, ec.claim_date, ec.insert_date, ec.id as ecid, e.full_name FROM employee_claim AS ec
						INNER JOIN employee AS e
                        WHERE ec.emp_id =e.id AND ec.claim_status = 'Approved' order by e.full_name";
                $sql_result = mysql_query($sql);
                while ($newArray = mysql_fetch_array($sql_result)) {
                    $num = $num + 1;
                    echo"<tr class='plugintr'>
                            <td style= 'width:5%;'>" . $num . "</td>
							<td style= 'width:25%;'>" . strtoupper ($newArray['full_name']) . "</td>
                            <td style= 'width:20%;'>" . $newArray['claim_item_title'] . "</td>
							<td style= 'width:10%;'>" . $newArray['claim_no'] . "</td>
                            <td style= 'width:8%;'>" . number_format($newArray['amount'], 2, '.', '') . "</td>
							<td style= 'width:10%;'>" . date('m-d-Y', strtotime($newArray['claim_date'])) . "</td>
							<td style= 'width:10%;'>" . date('m-d-Y', strtotime($newArray['insert_date'])) . "</td>
							<td style= 'width:45%; text-align: center;'>";
							if ($igen_a_m == "a_m_edit") {
								echo "<a title='Edit' onclick='edit_claim(" . $newArray['ecid'] . ")'><i class='far fa-edit' style='color:#000;' ></i></a>&nbsp;|&nbsp;<a title='Delete' onclick='del_all(" . $newArray['ecid'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>";
							}
						echo "</td
                            </tr>";
                }
				
			//Edit evolved allowance
			
                ?>
          </table>
            
<?php
 }else{//View fixed allowance
?>
		<table id="tableAllowance" class="TFtable" border="0" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr class="pluginth">
                        <th style="width:5%;">No.</th>
						<th style="width:35%;">Full Name</th>
                        <th style="width:30%;">Allowance Type</th>
                        <th style="width:20%;">Amount (RM)</th>
						<th style="width:45%;">Action</th>
                    </tr>
                </thead>
                <?php
                $num = 0;
                $sql = "SELECT ea.id as eaid, a.allowance_name, e.full_name, a.allowance_amount FROM employee_allowance AS ea
                        INNER JOIN allowance AS a 
						INNER JOIN employee AS e
                        ON a.id = ea.allowance_id
                        WHERE ea.emp_id =e.id order by e.full_name";
                $sql_result = mysql_query($sql);
                while ($newArray = mysql_fetch_array($sql_result)) {
                    $num = $num + 1;
                    echo"<tr class='plugintr'>
                            <td style= 'width:5%;'>" . $num . "</td>
							<td style= 'width:35%;'>" . strtoupper ($newArray['full_name']) . "</td>
                            <td style= 'width:30%;'>" . $newArray['allowance_name'] . "</td>
                            <td style= 'width:15%;'>" . number_format($newArray['allowance_amount'], 2, '.', '') . "</td>
							<td style= 'width:45%; text-align:center;'>";
							if ($igen_a_m == "a_m_edit") {
								echo "<a title='Delete' onclick='del_all(" . $newArray['eaid'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>";
							}
						echo "</td
                             </tr>";
                }
                ?>
            </table>
    <br/>
	
<?php
 }
 
 if(!isset($_GET['eveid']) && $_GET['eveid']!=""){//view evolved allowance
    
 ?>
		<table id="tableAllowance" class="TFtable" border="0" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr class="pluginth">
						<th style="width:35%;">Employee Name</th>
                        <th style="width:30%;">Allowance Type</th>
                        <th style="width:20%;">Amount (RM)</th>
                    </tr>
                </thead>
                <?php/*
                $num = 0;
                $sql = "SELECT ea.id as eaid, a.allowance_name, e.full_name, a.allowance_amount FROM employee_allowance AS ea
                        INNER JOIN allowance AS a 
						INNER JOIN employee AS e
                        ON a.id = ea.allowance_id
                        WHERE ea.emp_id =e.id  AND ea.id=". $_GET['eveid'];
                $sql_result = mysql_query($sql);
                while ($newArray = mysql_fetch_array($sql_result)) {
                    $num = $num + 1;
                    echo"<tr class='plugintr'>
                            <td style= 'width:5%;'>" . $num . "</td>
							<td style= 'width:35%;'>" . strtoupper ($newArray['full_name']) . "</td>
                            <td style= 'width:30%;'>" . $newArray['allowance_name'] . "</td>
                            <td style= 'width:15%;'>" . number_format($newArray['allowance_amount'], 2, '.', '') . "</td>
							<td style= 'width:45%;'>";
							if ($igen_a_m == "a_m_edit") {
								echo "<a onclick='edit_evallowance(" . $newArray['eaid'] . ")'><input type='button' style='width:40px; float: none!important; padding-left: 7px !important;' value='Edit' id='editBut'></a>&nbsp;|&nbsp;<a onclick='del(" . $newArray['eaid'] . ")'><input type='button' style='width:52px;float: none!important; padding-left: 7px !important;' value='Delete' id='editBut'></a>";
							}
						echo "</td
                             </tr>";
                }*/
                ?>
		</table>
<?php
 }
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>