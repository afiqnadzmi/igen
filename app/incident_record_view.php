<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>

<script type="text/javascript" charset="utf-8">
    $(function() {
        oTable = $('#normal_abnormal').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
   
</script>
<?php

$user_id = $_COOKIE['igen_user_id']; 
if($igen_epr=="epr_edit"){
	$query = mysql_query('SELECT e.full_name, e.id as empid, ir.id as irid, ir.report_of, ir.incident_date,ir.department,ir.sex,ir.victim_job_title,ir.created_by FROM employee AS e INNER JOIN incident_report AS ir ON e.id = ir.name WHERE (action=2 OR created_by='.$user_id.')');
}else{
	$query = mysql_query('SELECT e.full_name, e.id as empid, ir.id as irid, ir.report_of, ir.incident_date,ir.department,ir.sex,ir.victim_job_title,ir.created_by FROM employee AS e INNER JOIN incident_report AS ir ON e.id = ir.name WHERE created_by='.$user_id);
}

//$rowQuery = mysql_fetch_array($query);
//echo $rowQuery['created_by']."".$user_id;
//echo "TESTT".$rowQuery['full_name'];

?>
<div class="main_div" style="margin-left:0px">
   <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Accident/Incident Management</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 

    <div class="header_text">
        <span>Accident/Incident Management</span>
        <span style="float: right;">
            <?php if ($igen_epr=="epr_view" || $igen_epr=="epr_edit") { ?>
                <table>
                    <tr>
                        <td><input id="editBut" type="button" onclick="addData()" value="Add New" style="width:100px" /></td>
                    </tr>
                </table>
            <?php } ?>
        </span>
    </div>
    <div class="main_content" style="margin-top: 10px;">
        <div class="plugindiv">
            <table id="normal_abnormal" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width:100px;">ID</th>
                        <th style="width:300px;">Name</th>
						 <th class="aligncentertable" style="width:200px;">Incident Typess</th>
                        <th class="aligncentertable" style="width:104px !important;">Incident Date</th>
                        <th class="aligncentertable" style="width:110px;">Department</th>
                        <th style="width:50px;">Gender</th>
                        <th class="aligncentertable" style="width:150px;">Action</th>
                    </tr>
                </thead>

                <?php

                while($rowQuery = mysql_fetch_array($query)){
					   $inc_date="00-00-0000";
					   if($rowQuery['incident_date']!="0000-00-00"){
							$inc_date=date("d-m-Y", strtotime($rowQuery['incident_date']));
					   }
						echo '<td><a href="?loc=view_profile_new&viewId=' . $rowQuery['empid'] . '">EMP' . str_pad($rowQuery['empid'], 6, "0", STR_PAD_LEFT) . '</a></td>';
						echo '<td>' . $rowQuery['full_name'] . '</td>
						      <td class="aligncentertable">' . $rowQuery['report_of'] . '</td>
							  <td class="aligncentertable">' . $inc_date .'</td>
							  <td class="aligncentertable">' . $rowQuery['department'] . '</td>
							  <td class="aligncentertable">' . $rowQuery['sex'] . '</td> <td class="aligncentertable">';
					    if($user_id==$rowQuery['created_by']){
							echo' <a href="?loc=incident_report&edt=' . $rowQuery['irid'] . '"><i class="far fa-edit" style="color:#000;" ></i></a>'; 
						}else{
							echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;";
						}
							echo'&nbsp;|&nbsp; <a href="?ewidget=incident_report_print&viewid=' . $rowQuery['irid'] . '" target="_blank"><i style="color:#000;" class="far fa-eye"></i></a></td></tr>';
				}
            
                   ?>
				   
            </table>
        </div>
    </div>
</div></div></div>
<script type="text/javascript">
    function addData(){
        window.location='?loc=incident_report';
    }
    
    function importData(){
        window.location='?loc=import_excel';
    }
    
    function findData(){
        var search = $('#searchInput').val()
        window.location='?loc=home&search='+search;
    }

    function clearData(){
        document.getElementById('searchInput').value="";
        window.location='?loc=home'
    }
</script>

<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>