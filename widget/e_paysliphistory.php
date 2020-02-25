<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
if (isset($_COOKIE["igen_user_id"]) == true) {
    $sql = 'SELECT * FROM employee WHERE id=' . $_COOKIE["igen_user_id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Payslip History for <?php echo $row["full_name"] ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link type="text/css"  rel="stylesheet" href="/plugins/datepicker/css/date.css" />
        <link type="text/css"  rel="stylesheet" href="/plugins/datepicker/css/datepicker.css" />
        <link type="text/css"  rel="stylesheet" href="/plugins/datepicker/css/ui-lightness/jquery-ui-1.8.4.custom.css" />
        <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="plugins/datepicker/js/datepicker.js"></script>
        <script type="text/javascript" src="plugins/datepicker/js/jquery-ui.min.js" ></script>

        <style>
            .tableth th
            {
                /*    background-color:#F8F8F8;*/
                background-color: darkblue;
                color: white;
                padding: 5px 0 5px 10px;
                text-align: left;
            }
            .tabletr
            {
                /*    background-color:#F8F8F8;*/
                background-color: beige;
                color: black;
            }
            .tabletr td{
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 10px;
            }
            a{
                text-decoration:none;
            }
            .button {
                height: 30px;
                width:70px;
                -moz-border-radius: 7px;
                border-radius: 7px;
                padding:2px 2px;
                color: white;
                cursor: pointer;
                position: relative;
                top: -6px;
                background-color: blue;
                background-image: url('css/theme_c/BG_Button.png');
                background-repeat: repeat-x;

            }

            .button:hover {
                height: 30px;
                width:70px;
                -moz-border-radius: 7px;
                border-radius: 7px;
                padding:3px 2px;
                background-color:#0099CC;
                color: white;
                cursor: pointer; 

            }
        </style>
    </head>
    <body>
        <div style="padding: 10px; width: 97%;">
            <div style='clear:both'></div>
            <div>
                <span style="font-weight: bold; ">Search by Year</span>&nbsp;&nbsp;<input type="text" id="payslipyear" style="width: 150px;" />
                <input class="button" type='button' value='Search' onclick='search()' style="position: relative; top: -2px;" />
            </div>
            <div style="border: 1px solid black; margin-top: 10px;">
                <table style="border-collapse: collapse;width: 100%; font-size: 13px;">
                    <tr class="tableth">
					   <th style='width: 30px;'></th>
                        <th style='width: 30px;'>No.</th>
                        <th style='width: 130px;'>Year & Month</th>
                        <th style='width: 180px;'>Designation</th>
                        <th>Net Paid (RM)</th>
                        <th style='width: 70px;'>View</th>
                    </tr>
                    <?php
					$f_month="";
					$e_id="";
					$f_year="";
                    if (isset($_GET["year"])) {
                        $sql = 'SELECT pf.finalise_month, pf.finalise_year, p.id as pid, p.netpaid, p.designation
                                FROM payroll_report AS p
                                JOIN payroll_finalised AS pf
                                ON p.payroll_finalised_id=pf.id
                                where p.emp_id="' . $_COOKIE["igen_user_id"] . '" and pf.finalise_year=' . $_GET["year"] . ' 
                                ORDER BY pf.finalise_year, pf.finalise_month';
                    } else {
                        $sql = 'SELECT pf.finalise_month, pf.finalise_year, p.id as pid, p.netpaid, p.designation
                                FROM payroll_report AS p
                                JOIN payroll_finalised AS pf
                                ON p.payroll_finalised_id=pf.id
                                where p.emp_id="' . $_COOKIE["igen_user_id"] . '"
                                ORDER BY pf.finalise_year, pf.finalise_month';
                    }
                    $month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    $sql_result = mysql_query($sql);
                    $num = 0;
                    while ($row = mysql_fetch_array($sql_result)) {
                        $num = $num + 1;
						$f_month=$row['finalise_month'];
						$e_id=$_COOKIE["igen_user_id"];
					    $f_year= $row['finalise_year'];
                        echo "<tr class='tabletr'>
						      <td><input type='checkbox' value='".$row['finalise_month']."' id='mult'></td>
                            <td>" . $num . "</td>
                            <td>" . $row['finalise_year'] . " " . $month[$row['finalise_month']] . "</td>
                            <td>" . $row['designation'] . " </td> 
                            <td>" . $row['netpaid'] . " </td> 
                            <td><a href='javascript:view(" . $_COOKIE["igen_user_id"] . "," . $row['finalise_month'] . "," . $row['finalise_year'] . ")'>View</a></td>
                            </tr>";
                    }
                    ?>
                </table>
				<a href='javascript:view1("<?php echo $e_id  ?>","<?php echo $f_month ?>","<?php echo $f_year ?>")'><input type="button" value="View Multiple" id="editBut"></a>
				
            </div>
        </div>
        <script language='javascript' type='text/javascript'>
            function search(){
                var year=$('#payslipyear').val();
                window.location='?widget=e_paysliphistory&year='+year;
            }
            function view(id,m,y){
                window.open('?widget=printpayroll&emp_id='+id+'&month='+m+'&year='+y, '_blank');
            }
			function view1(id,m,y){
			var val = "";
			
			
			$(':checkbox:checked').each(function(i){
			 val+=$(this).val()+",";
			});
			if(val==""){
			alert("Please Select")
			}else{
			val=val.substring(0,val.length - 1);
			
			 window.open('?widget=printpayroll&emp_id='+id+'&month='+val+'&year='+y, '_blank');
			
			}
			
               //
            }
        </script>
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