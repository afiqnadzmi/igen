<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$sql2 = "SELECT * FROM employee WHERE id = '" . $getID . "';";
$sql_result2 = mysql_query($sql2);
while ($newArray2 = mysql_fetch_array($sql_result2)) {
    $basic_salary = $newArray2['salary'];
}
?>    
<div style="padding-bottom: 5px;">
    <div id="loanDiv" style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;">
        <?php if ($igen_a_hr == "a_hr_edit") { ?>
            <div style="padding-bottom: 5px;"><input class="button" type="button" value="Add" onclick="add_advsal1(<?php echo $getID ?>)"/></div>
            <table border="0"  style="padding-bottom: 5px; border-spacing: 5px;">
                <tr>
                    <td style="width: 120px;">Amount (RM)</td>
                    <td><input type="text" id="advsalInput1" style="padding:3px;width:213px;border:1px solid gray;"/></td>
                </tr>
				<tr>
		<td style="width: 120px;">Monthly Calculation for </td>		
<td><select name="month" id="month">
<option value="1">january</option>
<option value="2">february</option>
<option value="3">march</option>
<option value="4">april</option>
<option value="5">may</option>
<option value="6">june</option>
<option value="7">july</option>
<option value="8">august</option>
<option value="9">september</option>
<option value="10">october</option>
<option value="11">november</option>
<option value="12">december</option>
</select></td>
</tr>

            </table>
        <?php } ?>
        <div id="comisioncontain">
            <table id="tableadvsal1" class="TFtable" border="0" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th style="width: 150px;">Month</th>
                        <th style="width: 690px; padding-right: 10px; text-align: right;">Amount (RM)</th>
                        <th class="aligncenter" style="width: 100px;">Action</th>
                    </tr>
                </thead>

                <?php
                $sql1 = "SELECT * FROM comission WHERE emp_id = '" . $getID . "';";
                $sql_result1 = mysql_query($sql1);
                $num = 0;
                while ($newArray = mysql_fetch_array($sql_result1)) {
                    $num = $num + 1;
					$mont=$newArray['Month'];
					if($mont==1){
					$mont="January";
					}else if($mont==2){
					$mont="February";
					}else if($mont==3){
					$mont="Match";
					}else if($mont==4){
					$mont="April";
					}else if($mont==5){
					$mont="May";
					}else if($mont==6){
					$mont="June";
					}else if($mont==7){
					$mont="July";
					}else if($mont==8){
					$mont="August";
					}else if($mont==9){
					$mont="September";
					}else if($mont==10){
					$mont="October";
					}else if($mont==11){
					$mont="November";
					}else if($mont==12){
					$mont="December";
					}
                    ?><tr class="plugintr">
                        <td><?php echo $num ?></td>
                        <td><?php echo $mont; ?></td>
                        <td style="padding-right: 10px; text-align: right;"><?php echo number_format($newArray['amount'], 2, '.', '') ?></td>
                        <td class="aligncenter"><a href='javascript:onclick=del_comision(<?php echo $newArray['id'] ?>)'><i class="fas fa-trash-alt" style="color:#000;" aria-hidden="true"></i></a></td>
                    </tr>
                <?php } ?>

            </table>
        </div>
    </div>
</div>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
