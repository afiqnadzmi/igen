<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$id = $_POST['id'];
$query = mysql_query('SELECT * FROM employee WHERE id=' . $id . ';');
$row = mysql_fetch_array($query);
 $epf1 =$row['epf'];
 $socso1 =$row['socso'];
 $pcp1 =$row['pcp'];
 $eis =$row['eis'];
 $cap =$row['cap'];
$queryJoin = mysql_query('SELECT b.id, b.name FROM employee AS e INNER JOIN bank AS b ON e.bank_acc_id=b.id WHERE e.id=' . $id . ';');
$rowBank = mysql_fetch_array($queryJoin);

$queryBank2 = mysql_query('SELECT * FROM bank ORDER BY name');
$sqlgetovertime = mysql_query('SELECT * FROM overtime ORDER BY overtime_name');
$rowCountOverTime = mysql_num_rows($sqlgetovertime);
$position = $row["position_id"];

$sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $id);
$rowGetNew = mysql_fetch_array($sqlGetNew);
$rowCount = mysql_num_rows($sqlGetNew);

if ($rowCount > 0) {

    if ($rowGetNew['zakat'] != $row['zakat']) {
        $fontColorZakat = 'red';
        $imgZakat = 'display';
        $zakat = $rowGetNew['zakat'];
    } else {
        $fontColorZakat = null;
        $imgZakat = 'none';
        $zakat = $row['zakat'];
    }

    if ($rowGetNew['epf_num'] != $row['epf_num']) {
        $fontColorEpf = 'red';
        $imgEpf = 'display';
        $epf = $rowGetNew['epf_num'];
    } else {
        $fontColorEpf = null;
        $imgEpf = 'none';
        $epf = $row['epf_num'];
    }

    if ($rowGetNew['socso_num'] != $row['socso_num']) {
        $fontColorSocso = 'red';
        $imgSocso = 'display';
        $socso = $rowGetNew['socso_num'];
    } else {
        $fontColorSocso = null;
        $imgSocso = 'none';
        $socso = $row['socso_num'];
    }

    if ($rowGetNew['income_tax_num'] != $row['income_tax_num']) {
        $fontColorItax = 'red';
        $imgItax = 'display';
        $iTax = $rowGetNew['income_tax_num'];
    } else {
        $fontColorItax = null;
        $imgItax = 'none';
        $iTax = $row['income_tax_num'];
    }

    if ($rowGetNew['bank_acc_id'] != $row['bank_acc_id']) {
        $fontColorBank = 'red';
        $imgBank = 'display';
        $bank = $rowGetNew['bank_acc_id'];
    } else {
        $fontColorBank = null;
        $imgBank = 'none';
        $bank = $row['bank_acc_id'];
    }

    if ($rowGetNew['bank_acc_num'] != $row['bank_acc_num']) {
        $fontColorBankNum = 'red';
        $imgBankNum = 'display';
        $bankNum = $rowGetNew['bank_acc_num'];
    } else {
        $fontColorBankNum = null;
        $imgBankNum = 'none';
        $bankNum = $row['bank_acc_num'];
    }
} else {
    $fontColorZakat = null;
    $fontColorEpf = null;
    $fontColorSocso = null;
    $fontColorItax = null;
    $fontColorBank = null;
    $fontColorBankNum = null;

    $zakat = $row['zakat'];
    $epf = $row['epf_num'];
    $socso = $row['socso_num'];
    $iTax = $row['income_tax_num'];
    $bank = $row['bank_acc_id'];
    $bankNum = $row['bank_acc_num'];

    $imgZakat = 'none';
    $imgEpf = 'none';
    $imgSocso = 'none';
    $imgItax = 'none';
    $imgBank = 'none';
    $imgBankNum = 'none';
}

if ($row) {
    echo '<table id="titlebar" style="width:98.5%; padding-right: 5px;">
            <tr>
                <td style="font-size:large;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;Salary
                </td>
                <td onclick="saveSal(' . $id . ', ' . $position . ')" id="editBut" >Save</td>
                <td onclick="cancelSal()" id="editBut" >Cancel</td>
            </tr>
        </table>
        <div style="min-height:500px;">
        <table>
            <tr>
                <td>
                    <table style="padding-top:20px;padding-left:20px">
                        <tr>
                            <td style="padding-top:5px;width:200px;">Under Contract<span class="red"> *</span></td>
                            <td style="padding-top:5px;">'?>
							<input type="text" value="<?php echo $row["is_contract"];?>" readonly id="dropcontract">
                            <?php
                           echo' </td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Salary Type<span class="red"> *</span></td>
                            <td style="padding-top:5px;">
                                <select id="dropsalarytype" style="width:250px;">
                                <option value="0">--Please Select--</option>';

    if ($row['salary_type'] == "bs") {
        $st_type_bs = 'selected="selected"';
    } elseif ($row['salary_type'] == "mn") {
        $st_type_mn = 'selected="selected"';
    } elseif ($row['salary_type'] == "wk") {
        $st_type_wk = 'selected="selected"';
    } elseif ($row['salary_type'] == "dy") {
        $st_type_dy = 'selected="selected"';
    } elseif ($row['salary_type'] == "hr") {
        $st_type_hr = 'selected="selected"';
    }
    echo '<option value="bs" ' . $st_type_bs . '>Basic Salary</option>
          <option value="mn" ' . $st_type_mn . '>Monthly</option>
          <option value="wk" ' . $st_type_wk . '>Weekly</option>
          <option value="dy" ' . $st_type_dy . '>Daily</option>
          <option value="hr" ' . $st_type_hr . '>Hourly</option>';

    echo '</select>
                          </td>
                        </tr>
						<tr>
                                <td style="padding-top:5px;width:200px;">Payment Type<span class="red"> *</span></td>
                                <td style="padding-top:5px;">
                                    <select style="width:250px;" id="paymentType" onchange="paymentType(this.value)">
                                        <option value="0" >--Please Select--</option>';
										 if ($row['payment_type'] == "cash") {
												$pay_type_cash = 'selected="selected"';
											} elseif ($row['payment_type'] == "bank") {
												$pay_type_bank = 'selected="selected"';
											} elseif ($row['payment_type'] == "cheque") {
                                                $pay_type_cheque = 'selected="selected"';
                                            } 
                                       echo' <option value="cash" '.$pay_type_cash.'>Cash</option>
										<option value="bank" '.$pay_type_bank.'>Bank</option>
                                        <option value="cheque" '.$pay_type_cheque.'>Cheque</option>
                                    </select>
                                </td>
                            </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Salary Amount (RM)<span class="red"> *</span></td>
                            <td style="padding-top:5px"><input type="text" id="textsalary" value="' . number_format($row['salary'], 2, '.', '') . '" style="width:250px;" /></td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Bank Type</td>
                            <td style="padding-top:5px;">
                            <select id="dropbank" style="width:250px">
                            <option value="0">--Please Select--</option>';
    while ($rowBank2 = mysql_fetch_array($queryBank2)) {
        echo '<option value="' . $rowBank2['id'] . '"';
        if ($rowBank2['id'] == $bank) {
            echo 'selected="selected"';
            $bankSpec = $row['bank_acc_id'];
        } else {
            echo '';
        }
        echo '>' . $rowBank2['name'] . '</option>';
    }

    echo '</select></td>';
    if ($fontColorBank == 'red') {
        $bankOld = mysql_query('SELECT name FROM bank WHERE id = ' . $bankSpec);
        $rowBankOld = mysql_fetch_array($bankOld);


        echo '<td style="padding-top:5px;">
                                      <a href="javscript:void()" style="width:200px;color:red;">' . $rowBankOld['name'] . '</a>
                                  </td>
                                  <td style="padding-top:6px;">
                                      <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapproveSal(' . $id . ',\'bank_acc_id\')" />
                                  </td>';
    }
    echo '</tr>
                        <tr>
                            <td style="padding-top:6px;width:200px">Bank Account Number</td>
                            <td style="padding-top:6px;"><input type="text" id="textbankacc" value="' . $bankNum . '" style="width:250px;" /></td>';
    if ($fontColorBankNum == 'red') {
        echo '<td style="padding-top:5px;">
                                      <a href="javscript:void()" style="width:200px;color:red;">' . $row['bank_acc_num'] . '</a>
                                  </td>
                                  <td style="padding-top:6px;">
                                      <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapproveSal(' . $id . ',\'bank_acc_num\')" />
                                  </td>';
    }
    echo '</tr>';
    echo '<tr>
	 <tr>
                            <td style="padding-top:5px;width:200px;">Salary Grade</td>
                            <td style="padding-top:5px;">'?>
							<input type="text" value="<?php echo $row["salary_grade"];?>" id="salaryGrade">
                            <?php
                           echo' </td>
                        </tr>
                            <td style="padding-top:5px;width:200px;">EPF Number</td>
                            <td style="padding-top:5px"><input type="text" id="textepf" value="' . $epf . '" style="width:250px;" /></td>';
    if ($fontColorEpf == 'red') {
        echo '<td style="padding-top:5px;">
                                      <a href="javscript:void()" style="width:200px;color:red;">' . $row['epf_num'] . '</a>
                                  </td>
                                  <td style="padding-top:6px;">
                                      <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapproveSal(' . $id . ',\'epf_num\')" />
                                  </td>';
    }
    echo '</tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Socso Number</td>
                            <td style="padding-top:5px"><input type="text" id="textsocso" value="' . $socso . '" style="width:250px;"/></td>';
    if ($fontColorSocso == 'red') {
        echo '<td style="padding-top:5px;">
                                      <a href="javscript:void()" style="width:200px;color:red;">' . $row['socso_num'] . '</a>
                                  </td>
                                  <td style="padding-top:6px;">
                                      <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapproveSal(' . $id . ',\'socso_num\')" />
                                  </td>';
    }
    echo '</tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Income Tax Number</td>
                            <td style="padding-top:5px"><input type="text" id="textitax" value="' . $iTax . '" style="width:250px;" /></td>';
    if ($fontColorItax == 'red') {
        echo '<td style="padding-top:5px;">
                                      <a href="javscript:void()" style="width:200px;color:red;">' . $row['income_tax_num'] . '</a>
                                  </td>
                                  <td style="padding-top:6px;">
                                      <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapproveSal(' . $id . ',\'income_tax_num\')" />
                                  </td>';
    }
    echo '</tr>
                 <tr>
                            <td style="padding-top:5px;width:200px;">Zakat (RM)</td>
                            <td style="padding-top:5px;"><input type="text" id="textzakat" value="';
    if ($zakat != "" && $zakat != 0) {
        echo number_format($zakat, 2, '.', '');
    }
    echo '" style="width: 250px;" /></td>';
    if ($fontColorZakat == 'red') {
        echo '<td style="padding-top:5px;">
                                      <a href="javscript:void()" style="width:200px;color:red;">';
        if ($zakat != "" && $zakat != 0) {
            echo number_format($zakat, 2, '.', '');
        }
        echo '</a>
                                  </td>
                                  <td style="padding-top:6px;">
                                      <img src="images/button_cancel_icon.png" style="cursor:pointer;width:15px;height:15px;" onclick="disapproveSal(' . $id . ',\'zakat\')" />
                                  </td>';
    }
    echo '</tr>';
	?>
	<tr>
                                <td>Include or Exclude From</td>
                                <td>
                                    <?php
									
                                    if ($epf1=="Y") {
                                        $e_epf = 'checked="checked"';
                                    }
									
                                    if ( $socso1 == "Y") {
                                        $e_socso = 'checked="checked"';
                                    }
                                    if ( $pcp1 == "Y") {
                                        $e_pcb = 'checked="checked"';
                                    }
									if ( $eis == "Y") {
                                        $eis = 'checked="checked"';
                                    }
									
                                    ?>
                                    <input type="checkbox" name="allowance" value="epf" id="epf" <?php echo $e_epf; ?> />&nbsp;&nbsp;EPF&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="allowance" value="socso" id="socso" <?php echo $e_socso; ?> />&nbsp;&nbsp;SOCSO&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="allowance" value="eis" id="eis" <?php echo $eis; ?> />&nbsp;&nbsp;EIS&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="allowance" value="pcb" id="pcb" <?php echo $e_pcb; ?>/>&nbsp;&nbsp;PCB
                                </td>
                            </tr>
							<?php
                        echo'<tr>
                            <td style="padding-top:5px;width:200px;">Overtime</td>
                            <td style="padding-top:5px">
                                <select id="dropovertime" style="width:250px">
                                <option value="0">--Please Select--</option>';
    while ($rowOvertime = mysql_fetch_array($sqlgetovertime)) {
        if ($rowOvertime['id'] == $row['overtime_type']) {
            echo '<option value="' . $rowOvertime['id'] . '" selected="selected" >' . $rowOvertime['overtime_name'] . '</option>';
        } else {
            echo '<option value="' . $rowOvertime['id'] . '">' . $rowOvertime['overtime_name'] . '</option>';
        }
		
    }
    echo '</select>
        </td> <td>';   
	   if($row['salary'] > 2000 && $rowCountOverTime > 0){
		    if ($cap=="Y") {
               $cap = 'checked="checked"';
            }
			echo'<input type="checkbox" name="overtime-cap" value="cap" id="cap" style="margin-top: 24px; margin-left: 10px;"'.$cap.'> Cap &nbsp;&nbsp;&nbsp;<br> <span style="margin-left: 26px; font-style: italic; font-size: 10px"> Please tick the checkbox to cap the employee salary when calculating the overTime </span>';
		}
								
		echo'</td>
           </tr>';
    echo '</table>
                </td>
            </tr>
        </table>
        </div>';
} else {
    print false;
}
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>