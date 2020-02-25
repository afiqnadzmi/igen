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
            <div style="padding-bottom: 5px;"><input class="button" type="button" value="Add" onclick="add_advsal(<?php echo $basic_salary ?>)"/></div>
            <table border="0" style="padding-bottom: 5px; border-spacing: 5px;">
                <tr>
                    <td style="width: 120px;">Amount (RM)</td>
                    <td><input type="text" id="advsalInput" style="padding:3px;width:213px;border:1px solid gray;"/></td>
                </tr>
					<tr id="y">
            <td style="">Month And Year</td>
            <td>
                <select id="finalmonth" style="width: auto;">
                    <?php
                    $count = 0;
                    for ($i = 1; $i < 13; $i++) {
                        $m = date('n');
                        $pf_sql = "SELECT id FROM payroll_finalised WHERE finalise_month='" . $i . "' AND finalise_year='" . date('Y') . "' AND is_close = 1";
                        $pf_rs = mysql_query($pf_sql);
                        if ($pf_rs && mysql_num_rows($pf_rs) > 0) {
                            $finalised = "disabled";
                            $count = $count + 1;
                        } else {
                            $finalised = "";
                        }
                        ?>
                        <option <?php echo $finalised ?> value="<?php echo $i ?>"><?php echo date('M', mktime(0, 0, 0, $i, 1, date("Y"))) ?></option>
                    <?php } ?>
                </select> 
				 <select style="width: 80px;" id="finalyear" onchange="changeYearFinal(this.value)">
                    <?php for ($i = date("Y"); $i >= date("Y") - 5; $i--) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </td>
            
        </tr>
            </table>
        <?php } ?>
        <div id="advsalcontain">
            <table id="tableadvsal"  class="TFtable" border="0" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 10px;">No.</th>
                        <th style="width: 100px;">Date</th>
                        <th style="width: 200px; padding-right: 10px;">Advance Amount (RM)</th>
                        <th class="aligncenter" style="width: 10px;">Action</th>
                    </tr>
                </thead>

                <?php
                $sql1 = "SELECT * FROM advance_salary WHERE emp_id = '" . $getID . "';";
                $sql_result1 = mysql_query($sql1);
                $num = 0;
                while ($newArray = mysql_fetch_array($sql_result1)) {
                    $num = $num + 1;
                    ?><tr class="plugintr">
                        <td><?php echo $num ?></td>
                        <td><?php echo $newArray['request_date'] ?></td>
                        <td style="padding-right: 10px; text-align: right;"><?php echo number_format($newArray['advance_amount'], 2, '.', '') ?></td>
                        <td class="aligncenter"><a href='javascript:onclick=del_advsal(<?php echo $newArray['id'] ?>)'><i class="fas fa-trash-alt" style="color:#000;" aria-hidden="true"></i></a></td>
                    </tr>
                <?php } ?>

            </table>
        </div>
    </div>
</div>
