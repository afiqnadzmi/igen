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
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        $month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Quickpay Payroll Report For <?php echo $_GET['from'] . ' to ' . $_GET['to']; ?></title>
        <style type="text/css">
            .tableth th{
                background-color: black;
                color: white;
                padding-left: 40px;
                padding-right: 40px;
                padding-top: 5px;
                padding-bottom: 5px;

            }
            .tabletr{
                background-color: white;
                color: black;
            }
            .tabletr td{
                padding-top: 5px;
                padding-bottom: 5px;

            }
        </style>
    </head>
    <body>
        <p style="text-align: center;font-size:large;"><b>Quickpay Payroll Report For <?php echo $_GET['from'] . ' to ' . $_GET['to']; ?></b></p>

        <table border="1" style="border-collapse:collapse;">
            <tr class="tableth">
                <th style="width:70%">Employee No.</th>
                <th>Employee No. (New ID)</th>
                <th>Employee Name</th>     
                <th>Department</th>
				        <th>Group</th>
				        <th>Basic</th>
                <th>NPL</th>
                <th>Addpay</th>
                <th>Overtime</th>
                <th>Allowance/Claim Type</th>
                <th>Allowance/Claim (RM)</th>
                <th>Gross</th>
                <th>E'EPF</th>
                <th>E'SOC</th>
                <th>E'EIS</th>
                <th style="width:70%">PCB</th>
                <th>Deduction Type</th>
                <th>Deduction Amount (RM)</th>
                <th>NETTPAY</th>
                <th>R'EPF</th>
                <th>R'SOC</th>
                <th>R'EIS</th>
                <th>R'LEVY</th>
            </tr>
            <?php
                $month = date("F", strtotime($_GET['from']));
                $year = date("Y", strtotime($_GET['from']));

                $sql = "SELECT e.*, d.dep_name FROM quickpay_payroll e, department d WHERE e.dep_id = d.id";

                if (!empty($_GET["emp_id"]) && $_GET["emp_id"] != "all") {
                  $emp_id=explode (",", $_GET["emp_id"]);
                  $a="";
                  foreach($emp_id as $val){
                    $a.="'".$val."',";
                  }
                  $a=mb_substr($a, 0, -1);
                  //echo $a;
                    //$a = $_GET['emp_id'];
                    $sql.=" AND e.emp_no in ($a) AND e.emp_month='$month' AND e.emp_year = $year GROUP BY e.emp_name";
                } 
                //else {
                //   if ($_GET["dep_id"] == "0") {
                //         $sql.=" AND e.branch_id = " . $_GET["branch_id"];
                //     } else {
                //         $sql.=" AND e.dep_id = " . $_GET["dep_id"];
                //     }
                // } AND e.emp_month = $monthstrin




                //Comment Area
                //<th>Company</th>
                //<th>Branch</th>
                //<th>Employee Type</th>
                //<td>" . $newArray['company'] . "</td>
                //<td>" . $newArray['branch'] . "</td>
                //<td>" . $newArray['emp_type'] . "</td>
                //SELECT e.emp_name, d.dep_name FROM quickpay_payroll e, department d WHERE e.dep_id = d.id


              //$year = date("Y", strtotime($_GET['from']));
              // $timestring = $_GET['from']->format('M');
              //$yearstring = $_GET['from']->format('Y');
                
              //echo $sql;
              //echo "<br><br><br><br><br>";
              // echo $timestring;
              //echo "<br><br><br><br><br>";
              //echo $month ;

              //echo "<br><br><br><br><br>";
              //$abdi = NULL;
              //echo $abdi;
            
            $sql_result = mysql_query($sql);
            if ($sql_result && mysql_num_rows($sql_result) > 0) {
                $adv_amount = 0;
                while ($newArray = mysql_fetch_array($sql_result)) //{

                    
                echo "<tr class='tabletr' style='background-color:#E3E4FA'>
                      <td align=center>" . $newArray['emp_no'] . "</td>
                      <td align=center>" . $newArray['emp_new_ID'] . "</td>
                      <td>" . $newArray['emp_name'] . "</td>
                      <td align=center>" . $newArray['dep_name'] . "</td>
                      <td align=center>" . $newArray['emp_group'] . "</td>
                      <td align=center>" . $newArray['emp_basic'] . "</td>
                      <td align=center>" . $newArray['emp_npl'] . "</td>
                      <td align=center>" . $newArray['emp_addpay'] . "</td>
                      <td align=center>" . $newArray['emp_ot'] . "</td>
                      <td align=center>" . $newArray['allowance_claim_type'] . "</td>
                      <td align=center>" . $newArray['allowance_claim_amount'] . "</td>
                      <td align=center>" . $newArray['emp_gross'] . "</td>
                      <td align=center>" . $newArray['eepf'] . "</td>
                      <td align=center>" . $newArray['esoc'] . "</td>
                      <td align=center>" . $newArray['eeis'] . "</td>
                      <td align=center>" . $newArray['pcb'] . "</td>
                      <td align=center>" . $newArray['deduction_type'] . "</td>
                      <td align=center>" . $newArray['deduction_amount'] . "</td>
                      <td align=center>" . $newArray['nettpay'] . "</td>
                      <td align=center>" . $newArray['repf'] . "</td>
                      <td align=center>" . $newArray['rsoc'] . "</td>
                      <td align=center>" . $newArray['reis'] . "</td>
                      <td align=center>" . $newArray['rlevy'] . "</td>

                      </tr>";
            } else {
                echo "<tr class='tabletr'>
                      <td colspan='23' style='text-align:center'>No record found.</td>
                      </tr>";
            }
            ?>
        </table>
    </body>
</html>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>