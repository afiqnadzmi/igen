<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$action=$_POST['action'];

if($action=="1"){
$sql_result = mysql_query("DELETE FROM incident_detail WHERE id = '" . $_POST['id'] . "'");

if ($sql_result == 1) {

    echo'
	<p style="font-size:15px">Incident Details</p>
	<table id="tableRe" style="width: 100%;">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
						<th style="width: 100px;">photo</th>
                        <th style="width: 10px;">Type</th>
                        <th style="width: 100px;">Date<font color="#E6E6E6">_</font>reported</th>
                        <th style="width: 100px;">Name</th>
						 <th style="width: 100px;">Addedby</th>
						  <th style="width: 100px;">Date<font color="#E6E6E6">_</font>Added</th>
						   <th style="width: 100px;">Incident<font color="#E6E6E6">_</font>happen<font color="#E6E6E6">_</font>off<font color="#E6E6E6">_</font>site</th>
						    <th style="width: 100px;">Location</th>
							
								 
                        <th class="aligncenter" style="width: 150px;">Action</th>
                    </tr>
                </thead>';
    $num = 0;
    $sql1 = "SELECT * FROM incident_detail WHERE emp_id = '" . $_POST['userid'] . "';";
    $sql_result1 = mysql_query($sql1);
    while ($newArray = mysql_fetch_array($sql_result1)) {
        $num = $num + 1;
        $mouseover = 'class="cursor_pointer" onMouseover="emp_app_note(' . $newArray['id'] . ')" onMouseout="emp_app_note_hide()"';
        echo"<tr class='plugintr'>
                    <td>" . $num . "</td>
                    <td ><img  width='100px' height='100px' src='uploads/leave/" . $newArray['photo'] . "'</td>
                    <td " . $mouseover . ">". $newArray['type'] . "</td>
                    <td>" . $newArray['date_report'] . "</td>
					 <td>" .  $newArray['name']  . "</td>
					  <td>" . $newArray['added']  . "</td>
					   <td>" .$newArray['date']. "</td>
					    <td>" . $newArray['incident_happen'] . "</td>
						 <td>" .$newArray['location']  . "</td>
						
                    <td class='aligncenter'><a href='javascript:onclick=del(" . $newArray['id'] . ")'>Delete</a></td>
                    </tr>";
    }

    echo'</table>';
} else {
    print false;
}

}else if($action=="2"){

$sql_result = mysql_query("DELETE FROM injury_details  WHERE id = '" . $_POST['id'] . "'");
if ($sql_result == 1) {
    echo'<p style="font-size:15px">Injury Details</p>
            <table id="tableRe1" style="width: 100%;">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
						<th style="width: 100px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Multiple<font color="#E6E6E6">_</font>Location</th>
                        <th style="width: 100px;">General<font color="#E6E6E6">_</font>Injuries/ Poisonings/Diseases</th>
                        <th style="width: 110px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Head</th>
                        <th style="width: 100px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Neck</th>
						 <th style="width: 100px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Upper Limb</th>
						  <th style="width: 100px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Trunk</th>
						   <th style="width: 100px;">Location<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury: Lower limb</th>		 
                        <th class="aligncenter" style="width: 100px;">Action</th>
                    </tr>
                </thead>';
    $num = 0;
		
    $sql1 = "SELECT * FROM injury_details  WHERE emp_id = '" . $_POST['userid'] . "';";
    $sql_result1 = mysql_query($sql1);
    while ($newArray = mysql_fetch_array($sql_result1)) {
        $num = $num + 1;
        $mouseover = 'class="cursor_pointer" onMouseover="emp_app_note(' . $newArray['id'] . ')" onMouseout="emp_app_note_hide()"';
          echo"<tr class='plugintr'>
                    <td>" . $num . "</td>
                    <td >" . $newArray['m_location'] . "'</td>
                    <td " . $mouseover . ">". $newArray['g_injuries']. "</td>
                    <td>" . $newArray['head'] . "</td>
					 <td>" .  $newArray['neck']  . "</td>
					  <td>" . $newArray['upper_limb']  . "</td>
					   <td>" .$newArray['trunk']. "</td>
					    <td>" . $newArray['lower_limb'] . "</td>
						
						<td class='aligncenter'><a href='javascript:onclick=del1(" . $newArray['id'] . ")'>Delete</a></td>
                    
                    </tr>";
    }

    echo'</table>';
} else {
    print false;
}
}else if($action=="3"){

$sql_result = mysql_query("DELETE FROM injury_management  WHERE id = '" . $_POST['id'] . "'");
if ($sql_result == 1) {
    echo'<p style="font-size:15px">Injury Management</p>
            <table id="tableRe2" style="width: 100%;">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th> 
						<th style="width: 300px;">Treatment<font color="#E6E6E6">_</font>Required</th>
                        <th style="width: 150px;">Outcome<font color="#E6E6E6">_</font>Accident</th>
                        <th style="width: 200px;">Medical<font color="#E6E6E6">_</font>Condition</th>		 
                        <th class="aligncenter" style="width: 150px;">Action</th>
                    </tr>
                </thead>';
    $num = 0;
		
    $sql1 = "SELECT * FROM injury_management  WHERE emp_id = '" . $_POST['userid'] . "';";
    $sql_result1 = mysql_query($sql1);
    while ($newArray = mysql_fetch_array($sql_result1)) {
        $num = $num + 1;
        $mouseover = 'class="cursor_pointer" onMouseover="emp_app_note(' . $newArray['id'] . ')" onMouseout="emp_app_note_hide()"';
        echo"<tr class='plugintr'>
                    <td>" . $num . "</td>
                    <td >" . $newArray['TreatmentRequired']. "'</td>
                    <td " . $mouseover . ">" .$newArray['OutcomeAccident'] . "</td>
                    <td>" . $newArray['MedicalCondition'] . "</td>
					  <td class='aligncenter'><a href='javascript:onclick=del2(" . $newArray['id'] . ")'>Delete</a></td>
					  
                    </tr>";
    }

    echo'</table>';
} else {
    print false;
}
}
?>


<script type="text/javascript" charset="utf-8">

        $('#tableRe').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
 
	
	 
        $('#tableRe1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 $('#tableRe2').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
  

</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>