<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
 
<?php 

if (isset($_GET['viewId']) == true) { 
     $getID = $_GET['viewId'];
	 
    $query = mysql_query('SELECT * FROM employee WHERE id=' . $getID . ';');
    $row = mysql_fetch_array($query); 

    $queryJoin = mysql_query('SELECT b.code, b.name FROM employee AS e INNER JOIN bank AS b WHERE e.bank_acc_id=b.id AND e.id=' . $getID . ';');
    $rowJoin = mysql_fetch_array($queryJoin);

    $queryDept = mysql_query('SELECT d.dep_name FROM department AS d INNER JOIN emp_group AS eg JOIN employee AS e ON d.id=eg.dep_id AND e.group_id = eg.id WHERE e.id = ' . $getID . ';');
    $rowDept = mysql_fetch_array($queryDept);

    $queryGroup = mysql_query('SELECT g.group_name FROM emp_group AS g INNER JOIN employee AS e ON g.id = e.group_id WHERE e.id=' . $getID . ';');
    $rowGroup = mysql_fetch_array($queryGroup);

    $queryLevel = mysql_query('SELECT l.name FROM level AS l INNER JOIN employee AS e ON l.id = e.level_id WHERE e.id = ' . $getID . ';');
    $rowLevel = mysql_fetch_array($queryLevel);

    $queryPos = mysql_query('SELECT p.id, p.position_name FROM position AS p INNER JOIN employee AS e ON p.id = e.position_id WHERE e.id = ' . $getID . ';');
    $rowPos = mysql_fetch_array($queryPos);

    $queryBranch = mysql_query('SELECT b.branch_code FROM branch AS b INNER JOIN employee AS e ON b.id = e.branch_id WHERE e.id = ' . $getID . ';');
    $rowBranch = mysql_fetch_array($queryBranch);

    $queryCompany = mysql_query('SELECT c.code, c.name FROM company AS c INNER JOIN employee AS e ON c.id = e.company_id WHERE e.id = ' . $getID . ';');
    $rowCompany = mysql_fetch_array($queryCompany);

    $sqlShift = "SELECT s.name as name FROM employee e
                left join shift s
		on e.shift_id=s.id where e.id=" . $getID . " limit 1";
    $rsShift = mysql_query($sqlShift);
    $rowShift = mysql_fetch_array($rsShift);
			$sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id ="'.$getID.'"');
$rowGetNew = mysql_fetch_array($sqlGetNew);
$numRow = mysql_num_rows($sqlGetNew);
$img=$rowGetNew['image_src']; 
$em=$rowGetNew['emp_id'];

    $userID = $getID;

    include 'view_old_new.php';

    ?>
	<input type="hidden" id="r_id" value="<?php echo $getID; ?>"> 
	<style>

.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

</style>
    <br/>
    <div class="main_div" style="margin-left:3px; position:relative; top:-18px">
		<div class="modal"></div>
			<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee Details</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">  
		<p>
		 <div  >
		 
                <?php include 'view_profile_top.php'; ?>
				
				</div></p>  
				</div></div>
			<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapsetwo" data-toggle="collapse" data-parent="accordion">Personal Information</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapsetwo" class="panel-collapse collapse" >
		<div class="panel-body"> 
		   <p>
            <div  >
			
            <div id="viewProfileTabs">
                <table>
                    <tr>
                        <td id="personal" onclick="personal()" <?php if (isset($_GET['t']) == false) { ?> style="color:orchid" <?php } ?> >PERSONAL INFORMATION</td>
                        <td id="salary" onclick="salary()" <?php if ($_GET['t'] == 's') { ?> style="color:orchid" <?php } ?>  >SALARY</td>
                       <!--<td id="ttable" onclick="tt()"  <?php if ($_GET['t'] == 't') { ?> style="color:orchid" <?php } ?>  >TIME TABLE</td> -->
                       <!-- <td id="record" onclick="record()"  <?php if ($_GET['t'] == 'r') { ?> style="color:orchid" <?php } ?>  >RECORD</td>-->
                    </tr>
                </table>
            </div>
            <!--end of tabs-->

            <div class="viewProfileInfo">
                <!--Personal Information-->
                <div><?php include 'view_profile_pi.php'; ?></div>
                <!--Salary-->
                <div><?php include 'view_profile_sal.php'; ?></div>
                <!--Time Table
                <div id="tt" style="display:none; padding-top:15px;">
                    <table id="titlebar" class="titleBarTo" style="width:98.5%;">
                        <tr>
                            <td style="font-size:large;font-weight: bold; ">
                                &nbsp;&nbsp;&nbsp;Time Table
                            </td>
                        </tr>
                    </table>
                    <div style="min-height:500px;"><?php include 'emp_time_table.php'; ?></div>
                </div>-->

                

                
            </div>
            <!--end of employee info-->
			</div>
			</p><br><br>
			</div></div>
<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a href="#collapsethree" data-toggle="collapse" data-parent="accordion">Family Information</a>
			</h4>
		</div>
	</div>
</div>

<div id="collapsethree" class="panel-collapse collapse" >
	<div class="panel-body"> 
	<p >
		<table class="titleBart">
		<tr>
		<td style="font-size:medium;">
		&nbsp;&nbsp;&nbsp;Family Information
		</td>
		<td style="width: 100px;">
		<?php
		if($igen_a_hr == "a_hr_edit"){							
		?>
		<a onclick="family_popup(1)"><input type="button" value="Add" id="editBut"></a> </td>
		<?php							
		}
		?>
		</tr>
		 </table><br>
				  <div id="family-information">
					 <table  class="TFtable" id="tablefamily" border="1px solid" style="border-collapse: collapse; width: 100%;">
						<thead>
							<tr class="pluginth">
								<th style="width:5px">No.</th>
								<th style="width:500px">Name</th>
								<th style="width:100px">Relationship</th>
								<th style="width:100px">Age</th>
								<th style="width:10px !important">Action</th>

							</tr>
						</thead>
						<?php
						// Displaying Education Background
						$num_loan=0;
						$sql = 'SELECT * FROM family WHERE emp_id=' . $getID;
						$rs = mysql_query($sql);

						while ($row = mysql_fetch_array($rs)) {
							$num_loan = $num_loan + 1;
							$relationship = $row['relationship'];
							$name = $row['name'];
							$age = $row['age'];
							$attachment = $row['attachment'];
							
						  
							echo'<tr class="plugintr">
									 <td style="width:30px">' .  $num_loan . '</td>
									<td style="width:30px">' . $name . '</td>
									<td style="width:150px">' . $relationship . '</td>
									
									<td style="width:150px">' . $age . '</td>';
								if($igen_a_hr == "a_hr_edit"){
								echo'
									<td style="width:10px,; cursor:pointer"><a  class="popup_window" style="text-decoration:none"  alt1="family" alt="'.$row['id'].'"><i class="far fa-edit" style="color:#000;" aria-hidden="true"></i></a></td>';
									
									}else{
									echo'<td style="width:10px">-</td>';
									}
								echo'</tr>';
						}
						?>
					</table>
				</div>
			 </p>
	</div>
</div> 
<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a href="#collapsefive" data-toggle="collapse" data-parent="accordion">Education Background</a>
			</h4>
		</div>
	</div>
</div>

<div id="collapsefive" class="panel-collapse collapse" >
	<div class="panel-body"> 
	<p >
		<table class="titleBart">
		<tr>
		<td style="font-size:medium;">
		&nbsp;&nbsp;&nbsp;Employee Education Background
		</td>
		<td style="width: 100px;">
		<?php
		if($igen_a_hr == "a_hr_edit"){							
		?>
		<a onclick="family_popup(2)"><input type="button" value="Add" id="editBut"></a> </td>
		<?php							
		}
		?>
		</tr>
		 </table><br>
				  <div id="edu">
					 <table  class="TFtable" id="tableedu" border="1px solid" style="border-collapse: collapse; width: 100%;">
						<thead>
							<tr class="pluginth">
								<th style="width:30px">No.</th>
								<th style="width:500px">Institute Name</th>
							  
								<th style="width:500px">Qualification</th>
								<th style="width:150px">Completion Date</th>
								<th style="width:150px">Transcript</th>
								<th style="width:100px">Action</th>

							</tr>
						</thead>
						<?php
						// Displaying Education Background
						$num_loan=0;
						$sql = 'SELECT * FROM education WHERE emp_id=' . $getID;
						$rs = mysql_query($sql);

						while ($row = mysql_fetch_array($rs)) {
							$num_loan = $num_loan + 1;
							$uni = $row['u_name'];
							$level = $row['level'];
							$year = $row['Session'];
							$attachment = $row['attachment'];
							
						  
							echo'<tr class="plugintr">
									 <td style="width:30px">' .  $num_loan . '</td>
									<td style="width:30px">' . $uni . '</td>
									<td style="width:150px">' . $level . '</td>
									
									<td style="width:150px">' . $year . '</td>';
									if($attachment!=null){
								echo '<td class="aligncentertable"><a href="uploads/transcript/' .$attachment. '" target="_blank"><i style="color:#000;" class="far fa-eye" aria-hidden="true"></i></a></td>';
								}else{
								echo '<td class="aligncentertable"></td>';
								}
								if($igen_a_hr == "a_hr_edit"){
								echo'
									<td style="width:150px,; cursor:pointer"><a  class="popup_window" style="text-decoration:none" href="#inline_content" alt1="ed" alt="'.$row['id'].'"> <i class="far fa-edit" style="color:#000;" aria-hidden="true"></i> </a></td>';
									
									}else{
									echo'<td style="width:150px">-</td>';
									}
								echo'</tr>';
						}
						?>
					</table>
				</div>
			 </p>
	</div>
</div> 
<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a href="#collapsefour" data-toggle="collapse" data-parent="accordion">Employment History</a>
			</h4>
		</div>
	</div>
</div>

<div id="collapsefour" class="panel-collapse collapse" >
	<div class="panel-body"> 
		<p>
			<table class="titleBart">
				<tr>
					<td style="font-size:medium">
					&nbsp;&nbsp;&nbsp;Employee History
					 </td>
					<td style="width: 100px;">
					<?php
						if($igen_a_hr == "a_hr_edit"){							
						?>
						<a onclick="family_popup(3)"><input type="button" value="Add"   id="editBut"></a>
						<?php							
						}
						?>
					</td>
				</tr>
				
			</table><br>

			<div id="emh" style="margin-bottom:3%">
				<table  class="TFtable" id="tableh" border="1px solid" style="border-collapse: collapse; width: 100%">
					<thead>
						<tr class="pluginth">
						<th style="width:30px">No.</th>
						<th style="width:300px">Company Name</th>
						<th style="width:100px">From Year</th>
						<th style="width:100px">To Year</th>
						<th style="width:500px">Reason</th> 
						<th style="width:100px">Action</th>
						</tr>
					</thead>
									 
					<?php
								// Displaying Employment History
						$num_loan=0;
						 $sql = 'SELECT * FROM employment_history WHERE emp_id=' . $getID; 
						$rs = mysql_query($sql);
						while ($row = mysql_fetch_array($rs)) {
							$num_loan = $num_loan + 1;
							$company = $row['company'];
							$from = $row['from_y'];
							$to = $row['to_y'];
							$reason = $row['reason'];
							echo'<tr class="plugintr">
							<td style="width:30px">' .  $num_loan . '</td> 
							<td style="width:30px">' . $company . '</td>
							<td style="width:150px">' . $from . '</td>
							<td style="width:150px">' . $to . '</td>
							<td style="width:150px">' . $reason . '</td>';
							if($igen_a_hr == "a_hr_edit"){
							 echo'
							<td style="width:150px; cursor:pointer"><a   class="popup_window" style="text-decoration:none; width:300px" alt1="h" href="#inline_content3" alt="'.$row['id'].'" ><i class="far fa-edit" style="color:#000;" aria-hidden="true"></i></a></td>';
							}else{
								echo'<td style="width:150px">-</td>';
							}
							echo'</tr>';
						}
					?>
				</table>		
			</div>
		</p>
	</div>
</div>
<!--<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a href="#collapseseven" data-toggle="collapse" data-parent="accordion">Employee Performance</a>
			</h4>
		</div>
	</div>
</div>

<div id="collapseseven" class="panel-collapse collapse" >
<div class="panel-body">
 <p>
<table class="titleBart">
<tr>
<td style="font-size:large;font-weight: bold;">
&nbsp;&nbsp;&nbsp;Employee Performance
</td>
<td style="width: 100px;">
					<?php
						if($igen_a_hr == "a_hr_edit"){							
						?>
						<a href="?loc=appraisal-form&esemid=<?php echo $getID ?>" target="blank"><input type="button" value="Add"   id="editBut"></a>
						<?php							
						}
						?>
					</td>
</tr>
</table><br>
<div style="margin-bottom:3%">
<table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
	<thead>
		<tr>           
			<td class="title_bold" style="width: 150px;">Employee Name</td>
			<td class="title_bold" style="width: 150px;">Appraisal Period</td>
			<td class="title_bold" style="width: 150px;">From Date</td>
			<td class="title_bold" style="width: 150px;">To Date</td>
			<td class="title_bold" style="width: 150px;">Evaluated By</td>
			<td class="title_bold" style="width: 150px;">Status</td>
			<td class="title_bold" style="width: 10px;">Action</td>
		</tr>    
	</thead>
<?php
	$sql_ev = mysql_query("SELECT a.evaluator, e.full_name FROM appraisal_cycle a, employee e WHERE a.evaluator=e.id AND a.employee LIKE ('%".$getID."%')");
	$count=mysql_num_rows($sql_ev);
	$row=mysql_fetch_array($sql_ev);
	$e_name=$row['full_name'];
		$count=0;
	$sql_rating = mysql_query("SELECT DISTINCT p.*, e.full_name, d.status FROM p_particular p, employee e, appraisal_draft d WHERE p.emp_id=e.id AND p.id=d.p_id AND p.emp_id='".$getID."' AND d.status!='INITIATED'");
	while($row_r=mysql_fetch_array($sql_rating)){
	echo"<tr>
			<td>".$row_r['full_name']. "</td>
			<td>".$row_r['c_peroid']. "</td>
			<td>".$row_r['p_from']. "</td>
			<td>".$row_r['p_to']. "</td>
			<td>".$e_name. "</td>
			<td>".$row_r['status'].
			"</td>";
	if($row_r['status']!='FINILIZED'){	
?>	
		<td style="width:100px;">
			<input type="button" value="Edit" id="editBut" onClick="process(<?php echo $row_r['id'] ;?>)" >
		</td>
<?php
	}else{
		echo'<td style="width:100px"><a href="?eloc=emp_appraisal&id='.$row_r['id'].'">VIEW</a></td>';
	}

?>
</tr>

<?php

	}

	?>

</table>
</div>
 </p>
</div>
</div>-->
<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a href="#collapsesix" data-toggle="collapse" data-parent="accordion">Employee Records</a>
			</h4>
		</div>
	</div>
</div>

<div id="collapsesix" class="panel-collapse collapse" >
<div class="panel-body">
	<p>
		<div><?php include 'view_profile_record.php'; ?></div>		  
		<div id="popPro">
		<!--display the pop up box for the Company Asset field-->
		</div>
		
		<div id="popbenefits">
		<!--display the pop up box for the Benifits Entitled field-->
		</div>
	</p>
</div>
</div>
	<!-- This contains the hidden content for Adding education background -->

<div class="family alleg" style="display:none">
	<input type="button"  id="editBut" value="Add" onclick="add_family('')" style="width: 100px;"/>
	<input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: #000;margin-bottom: 3px; margin-top: -3px;" type="button" value="X" onClick="closePopoup()">
	<table class="allegation family" style="border-collapse: collapse;width: 100%; font-size: 13px;">
			<tr >
					<td style="width: 150px;">Name<span class="red"> *</span></td>
					<td style="margin-bottom:20px"><input type="text" id="f_name" style="width: 250px;" /></td>
				</tr>
				<tr>
					<td>Relationship<span class="red"> *</span></td>
					<td><input type="text" id="f_relationship" style="width: 250px;" /></td>
				</tr>
				<tr>
					<td>Age<span class="red"> *</span></td>
					<td>
					<input type="text" id="f_age" style="width: 250px;" /></td>
				</tr>		
						
	</table>			 
</div>
			
<!-- This contains the hidden content for Adding education background -->
<div class="ed alleg" style="display:none">
	<input type="button"  id="editBut" value="Add" onclick="add_u('')" style="width: 100px;"/>
	<input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: #000;margin-bottom: 3px; margin-top: -3px;" type="button" value="X" onClick="closePopoup()">
	<table class="allegation ed" style="border-collapse: collapse;width: 100%; font-size: 13px;">
			<tr >
					<td style="width: 150px;">Institute Name<span class="red"> *</span></td>
					<td style="margin-bottom:20px"><input type="text" id="name" style="width: 250px;" /></td>
				</tr>
				<tr>
					<td>Qualification<span class="red"> *</span></td>
					<td><input type="text" id="level" style="width: 250px;" /></td>
				</tr>
				<tr>
					<td>Completion Date<span class="red"> *</span></td>
					<td>
					<input type="text" id="year" style="width: 250px;" /></td>
				</tr>
				<tr>
					<td style="vertical-align: top;">Transcript</td> 
					<td><input id="file_upload" name="file_upload" type="file" multiple="true" style="width:100px" />
						<input type="text" id="uploaded_img" style="width:250px; display: none; background-color:#D0D7F3;" readonly />
					</td>
				</tr>		
						
	</table>			 
</div>
			<!-- This contains the hidden content for Editing education background -->
<div style='display:none;'>
	<div id='inline_content' style='padding:10px; height:300px;  background-color:#E5E5E5;'>

	</div> 
</div>

<!-- This contains the hidden content for Adding Employment History -->
<div class="employee_history alleg" style="display:none">
	<input type="button"  id="editBut" value="Add" onclick=" add_emh('')" style="width: 100px;"/>
	<input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: #000;margin-bottom: 3px; margin-top: -3px;" type="button" value="X" onClick="closePopoup()">
	<table class="allegation employee_history" style="border-collapse: collapse;width: 100%; font-size: 13px;">
			<tr >
				<td style="width: 150px;">Company Name<span class="red"> *</span></td>
				<td style="margin-bottom:20px">
				<input type="text" id="company" style="width: 250px;" />
				</td>
			</tr>
			<tr>
				<td>From Year<span class="red"> *</span></td>
				<td><input type="text" id="from" maxlength="4" style="width: 250px;" /></td>
			</tr>
			<tr>
				<td>To Year<span class="red"> *</span></td>
				<td><input type="text" id="to" maxlength="4" style="width: 250px;" /></td>
			</tr>
			<tr>
				<td>Reason<span class="red"> *</span></td>
				<td><textarea id="reason"  rows="10" cols="39"> </textarea></td>
			</tr>		
						
	</table>			 
</div>
    <?php
}
$edited = $_GET['edited'];
?>
<input type="hidden" value="<?php echo $edited ?>" id="hiddenField"/>

<style>
.titleBart #editBut,
.dataTables_wrapper #editBut {
    padding: 9px !important;
    padding-top: 0px !important; 
}
</style>


<script type="text/javascript">

    function checkMarital(status){
        if(status == "M"){
            $("#marital_child").html("Number of Children<span class='red'> *</span>");
            $("#marital_spouse").html("Spouse Name<span class='red'> *</span>");
			 $("#spousename").html("Spouse Name<span class='red'> *</span>");
            $("#dropspouse").attr('disabled', false);
			$("#spousename").attr('disabled', false);
            $("#textchild").attr('disabled', false);
        }else if(status == "D"){
            $("#marital_child").html("Number of Children<span class='red'> *</span>");
            $("#marital_spouse").html("Spouse Working");
            $("#textchild").attr('disabled', false);
			$("#spousename").attr('disabled', true);
            $("#dropspouse").attr('disabled', true);
            $("#dropspouse").val("0");
        }else if(status == "S"){
            $("#marital_child").html("Number of Children");
            $("#marital_spouse").html("Spouse Working");
            $("#dropspouse").attr('disabled', true);
			$("#spousename").attr('disabled', true);
            $("#textchild").attr('disabled', true);
            $("#dropspouse").val("0");
            $("#textchild").val("");
        }else{
            $("#marital_child").html("Number of Children");
            $("#marital_spouse").html("Spouse Working");
            $("#dropspouse").attr('disabled', false);
            $("#textchild").attr('disabled', false);
			$("#spousename").attr('disabled', false);
            $("#dropspouse").val("0");
            $("#textchild").val("");
        } 
    }

    function add_field(){
        var field_no =  parseInt($("#field_no").html())+1;
        $("#field_no").html(field_no);
        $('#add_field_table').append("<tr><td style='width: 200px;'><input type='text' id='title_"+field_no+"' /></td><td style='padding-left: 10px;'><input type='text' id='value_"+field_no+"' style='width: 250px;' /></td></tr>");
    }
    
    function salaryhistory(emp_id){
        window.open('?widget=salaryhistory&emp_id='+emp_id,'mywindow','location=1,status=1,scrollbars=1,width=600,height=600');
    }
    
    function personal(){
        $("#record").css("color","black");
        $("#salary").css("color","black");
        $("#personal").css("color","orchid");
        $("#ttable").css("color","black"); 

        $('#pi').toggle('slow', function() {
        });
        $('#sal').hide('slow', function() {
        });
        $('#tt').hide('slow', function() {
        });
		/*
        $('#r').hide('slow', function() {
        });
		*/
    }
	 function del_advsal(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=advsaldel",
                data:{
                    id:id,
                    emp_id:<?php echo $_GET['viewId'] ?>
                },
                success:function(data){
                    if(data != false){
                        alert("Advance Salary Deleted")
                        $("#advsalcontain").empty().append(data);
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }


    function salary(){
        $("#record").css("color","black");
        $("#salary").css("color","orchid");
        $("#personal").css("color","black");
        $("#ttable").css("color","black");

        $('#sal').toggle('slow', function() {
        });
        $('#pi').hide('slow', function() {
        });
        $('#tt').hide('slow', function() {
        });
		/*
        $('#r').hide('slow', function() {
        });
		*/
    }
	function mous(){
	$("#profileIMG1").hide(100);
     $("#profileIMG2").show(100);
	} 
	
	function mous1(){
	$("#profileIMG1").show(100);
     $("#profileIMG2").hide(100);
	}

 $(function() { 
 
        var buttons = {
               
                Save: save
                
        };

        $('#fruits').dialog({ 
                autoOpen: false, 
                modal: true,
                buttons: buttons
        });

        $('#candy').dialog({ 
                autoOpen: false, 
                modal: true,
                buttons: buttons
        });
});

function update() {
        var boxes = new Array();
        $(':radio').each(function() {
                if ($(this).is(':checked')) {
                        boxes.push(
                                $(this).attr('name') + 
                                '=' +
                                $(this).val() 
                        );
                }
        });
       
        //alert('boxes: ' + boxes.join('&'));
}

function select() {
        $(':radio').prop('checked', true);
}

function deselect() {
        $(':radio').prop('checked', false);
}

function save() {
        // XXX how to implement?
		  var boxes = new Array();
        $(':radio').each(function() {
                if ($(this).is(':checked')) {
                        boxes.push( 
                                
                                $(this).val() 
                        );
                }
        });
     var m = boxes.join('&');
	 if(m!=""){
	 var id =$("#r_id").val();
	 $.ajax({
            type:'POST',
            url:'?widget=updateim',
            data:{
                m:m,
                id:id
            },
            success:function(data){
                if(data==1){
				location.reload(true);
				}
            }
        })
		}else{
		alert("Please select")
		}
        //$(this).dialog('close');
}

function cancel() {
        // XXX how to implement?
        $(this).dialog('close');
}
function close_colorbox() {
        // XXX how to implement?
		$.colorbox.close();
}

function tt(){
	
        $("#record").css("color","black");
        $("#salary").css("color","black");
        $("#personal").css("color","black");
        $("#ttable").css("color","orchid");

        $('#tt').toggle('slow', function() {
        });
        $('#sal').hide('slow', function() {
        });
        $('#pi').hide('slow', function() {
        });
        $('#r').hide('slow', function() {
        });
    }

    function record(){
        $("#record").css("color","orchid");
        $("#salary").css("color","black");
        $("#personal").css("color","black");
        $("#ttable").css("color","black");
         
        $('#r').toggle('slow', function() {
        });
        $('#sal').hide('slow', function() {
        });
        $('#tt').hide('slow', function() {
        });
        $('#pi').hide('slow', function() {
        });
    }

    function alltitle(obj,id_name){

        $("[name=lbltitle]").css("color","black");
        $("#"+id_name).css("color","orchid");
		 
        if($('#'+id_name+'_img').attr('src')=='images/But_DrillOut.png'){
            $('#'+id_name+'_img').attr('src','images/But_DrillIn.png');
        }else{
            $('#'+id_name+'_img').attr('src','images/But_DrillOut.png');
        }
    }
    function advsal(obj){
        $('#advsalDiv').toggle('slow');
        //alltitle(obj,"advsal");
    }
	 function revoke(obj){
        $('#revoke').toggle('slow');
        //alltitle(obj,"advsal");
    }
	function commis(obj){
	    
        $('#advsalDiv1').toggle('slow');
        alltitle(obj,"advsal1");
    }
	   function saveValue_admin(id, emp_id, from, to){
       
		// $(".modal").show();
		
        var e = document.getElementById("drop"+id);
        var status = e.options[e.selectedIndex].value;
		if(status==""){
		alert("Please Select Status");
		exit();
		
		}
		// $(".modal").show();
		
        $.ajax({
            type:"POST",
            //dataType:'json',
            url:"?widget=instantUpdate_revoke",
            data:{
                status:status,
                id:id,
				from:from,
				to:to,
                emp_id:emp_id
            },
            success:function(data){
	        
                if(data.query == "true"){
                    //alert("E-Leave Status Updated");
                    $("#updateStatus1"+id).empty().append(data.status);
					alert("Successfully revoked");
				 window.location = '?loc=view_profile_new&viewId=<?php echo $_GET["viewId"];  ?>';
                }else{
                    alert("Error While Proccessing");
                }
            }
        })
    }
    function claim(obj){
        $('#claimDiv').toggle('slow');
        alltitle(obj,"l_claim");
    }
    function remark(obj){
        $('#remarkDiv').toggle('slow');
        alltitle(obj,"remark");
    }
    function allowance(obj){
        $('#allowanceDiv').toggle('slow');
        alltitle(obj,"allowance");
    }
    function loan(obj){
        $('#loanDiv').toggle('slow');
        alltitle(obj,"loan");
    }
    function property(obj){
        $('#propertyDiv').toggle('slow');
        alltitle(obj,"property");
    }
	function benefits(obj){	
        $('#benefitsDiv').toggle('slow');
        alltitle(obj,"benefits");
    }
    function training(obj){
        $('#trainingDiv').toggle('slow');
        alltitle(obj,"training");
    }
	
	 function leave(obj){
        $('#leaveDiv').toggle('slow');
        alltitle(obj,"leave");
    }

    function changeGroup(dept_idTop){ 
        var id = <?php echo $getID ?>;
        $.ajax({
            type:'POST',
            url:'?widget=showgroup2',
            data:{
                dept_idTop:dept_idTop,
                id:id
            },
            success:function(data){
                $("#dropgroup").empty().append(data);
            }
        })
    }

    function editTop(){
	
        var userID = <?php echo $getID ?>;
        var edited = $('#hiddenField').val();
        $.ajax({
            type:'POST',
            url: '?widget=editprofiletop',
            data:{
                edited:edited,
                userID:userID
            },
            success: function(data) {
                if(data!=false){
                    $('#topDetails').empty().append(data);
                }else{
                    alert('Error While Processing');
                }
            }
        })
    }

    function cancelTop(){
        var userID = <?php echo $getID ?>;
        var edited = $('#hiddenField').val();
        $.ajax({
            type:'POST',
            url: '?widget=editprofiletopcancel',
            data:{
                edited:edited,
                userID:userID
            },
            success: function(data) {
                if(data!=false){
                   $('#topDetails').empty().append(data);
                }else{
                    alert('Error While Processing');
                }
            }
        })
    }
	function empStatus(val){
		if(val=="Resigned"){
			$(".resign_info").css('visibility', 'visible');
			alert(val);
		}else{
			$(".resign_info").css('visibility', 'collapse');
		}
	}

    function saveTop(){
        var userID = <?php echo $getID ?>;
        var name = $('#textname').val();
        var salary = $('#textsalary').val();
		var type=$('#type').val();
        var position = $("#droppos").val();
        var level=$("#textlevel").val();
        var dept = $("#dropdept").val();
        var group = $('#dropgroup').val();
        var branch = $('#dropbranch').val();
        var company = $("#dropCompany").val();
        var shift=$("#dropshift").val();
        var status = $("#dropempstatus").val();
		var country =$("#country").val();
        
        var error1 = []; 
        var error2 = [];
        
        if(name == "" || name == " "){ 
            error1.push("Full Name");
        }
        if(status == "0"){
            error2.push("Status");
        }
        if(company == "0"){
            error2.push("Company");
        }
		 if(status=="Resigned"){
			var last_working_day= $('#offDateText').val();
			var last_official_day= $('#lastDateText').val();
			var reasnresign = $('#reasnresign').val();
			var resigndate = $('#textresign').val();
			
			if(last_working_day==""){
				error1.push("Last Working Day");
			}
			if(last_official_day==""){
				error1.push("Officail Working Day	");
			}
			if(reasnresign==""){
				error1.push("Reason For Resign	");
			}
			if(resigndate==""){
				error1.push("Resign Date	");
			}
		}
		if(type == ""){
            error2.push("Employee type");
        }
        if(branch == "0" || branch == ""){
            error2.push("Branch");
        }
        if(dept == "0"){
            error2.push("Department");
        }
        if(group == "0"){
            error2.push("Group"); 
        }
        if(position == "0"){
            error2.push("Position");
        }
        if(shift == "0"){
            error2.push("Shift");
        }
        if(level == "0"){
            error2.push("User Permission");
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        
        var data1 = "";
        var data2 = ""; 
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Select :\n"+error_data2+"\n\n";
        }
        
        if(error1.length > 0 || error2.length > 0){
            alert(data1 + data2);
        }else{
			last_working_day= $('#offDateText').val();
			var last_official_day
			var lastDateText= $('#lastDateText').val();
			var reasnresign = $('#reasnresign').val();
			var resigndate
            $.ajax({
                type:'POST',
                url: '?widget=saveprofiletop',
                data:{
                    userID:userID,
                    name:name,
                    group:group,
                    dept:dept,
                    position:position,
                    level:level,
                    branch:branch,
                    salary:salary,
					type:type,
                    shift:shift,
                    company:company,
                    status:status,
					country :country,
					last_working_day:last_working_day,
					last_official_day:last_official_day,
					reasnresign:reasnresign,
					resigndate:resigndate
					
                },
                success: function(data) {
                    if(data!=false){
                        alert('Profile Updated');
						$('#topDetails').empty().append(data);
                        //location.reload();

                    }else{
                        alert('Error While Proccess');
                    }
                }
            })    
        }
    }

    function disapproveTop(id){
        $.ajax({
            type:'POST',
            url:'?widget=editdisapprovetop',
            data:{
                id:id
            },
            success:function(data){
                if(data==true){
                    alert("Profile Detail Changes Rejected");
					
                    window.location.reload();
                }
                else{
                    alert('Error While Processing');
                }
            }
        })
    }

    function editPI(id){
	
        var id = <?php echo $getID ?>;
        var edited = $('#hiddenField').val();
        $.ajax({
            type:'POST',
            url:'?widget=editprofilepi', 
            data:{
                id:id,
                edited:edited
            },
            success:function(data){
			
                if(data!=false){
				     
                    $('#editModePI').empty().append(data);
                }
                else{
                    alert('Error While Processing'); 
                }
            }
        })
		
    }

    function disapprovePi(id,type){
	
        $.ajax({
            type:'POST',
            url:'?widget=editdisapprovepi',
            data:{
                id:id,
                type:type
            }, 
            success:function(data){
                if(data==true){
                    alert('Profile Detail Changes Rejected');
                    window.location.reload();
                }
                else{
                    alert('Error While Processing');
                }
            }
        })
    }

    function cancelPI(){
        var empid = <?php echo $getID ?>;
        var edited = $('#hiddenField').val();
        $.ajax({
            type:'POST',
            url:'?widget=editprofilepicancel',
            data:{
                empid:empid,
                edited:edited
            },
            success:function(data){

                if(data!=false){
                    $('#editModePI').empty().append(data);
                }else{
                    alert('Error While Processing');
                }
            }
        })
    }

    function savePI(id){
		var em = checkEmail();
		if(em==false){
			exit();
		}

        var type = 'personal';
        var username = $('#textusername').val();
        
        var profile = $('#textprofile').val();
        var phone = $('#textphone').val();
        var reasnresign = $('#reasnresign').val();
		
        var ic1 = $('#ICText1').val();
        var ic2 = $('#ICText2').val();
        var ic3 = $('#ICText3').val();
        var ic = ic1 + "-" + ic2 + "-" + ic3;
        var emergency_contact = $("#emergency").val();
		var emergency_num = $("#emergency_num").val();
		var emergency_relationship = $("#emr").val();
		var kin_emergency_contact = $("#kin_emergency").val();
		var kin_emergency_num = $("#kin_emergency_num").val();
		var kin_emergency_relationship = $("#kin_emergencyrelationship").val();
		var kin_ic1 = $("#KinICText1").val();
		var kin_ic2 = $("#KinICText2").val();
		var kin_ic3 = $("#KinICText3").val();
		var kin_ic = kin_ic1 + "-" + kin_ic2 + "-" + kin_ic3;
		
		var e_date_pk_fz = $("#e_date_pk_fz").val(); 
		var e_date_westport = $("#e_date_westport").val();
		var e_date_johor_port= $("#e_date_johor_port").val();
		var e_date_ptp = $("#e_date_ptp").val();
		var e_date_tlp = $("#e_date_tlp").val();
		var e_date_north_port = $("#e_date_north_port").val();
		
		var spousename = $("#spousename").val();
        var mobile = $('#textmobile').val();
        var email = $('#textemail').val();
        var address = $('#textaddress').val();
        var dob = $('#textdob').val();
        var child = $('#textchild').val();
        var confirm=$('#confirm').val();
        var joindate = $('#textjoin').val();
		var offDateText= $('#offDateText').val();
		var lastDateText= $('#lastDateText').val();
		
        var resigndate = $('#textresign').val();
		
        var leaveGroup = $('#dropleave').val();
        var gender = $('#dropgender').val();
        var race = $('#dropRace').val();
        
        var marital = $("#dropmarital").val();
        var spouse = $("#dropspouse").val();
		var spouse_company = $("#company_name").val();
        var religion = $("#dropReligion").val();
        var country=$("#country").val();
		if(country!="Malaysia"){
			ic="";
		}
		var pn="", pe="", wp="", wpep = "";;
		
		if(ic==""){ 
			pn=$("#pass").val();
			pe=$("#pe").val();
			wp=$("#wp").val();
			wpep = $("#wpep").val();
		}
		var pissue_date="", wp_issuedate="", renew_passport="", renew_workPermit="", pkfz_issuedate="", renew_pkfz="";
		var westport_issuedate="",renew_westport="",johor_issuedate="",renew_johor="",ptp_issuedate="",renew_ptp="",tpl_issuedate="",renew_tpl="", NorthPort_issuedate="", renew_north_port="";
	   if($("#renewPassport").is(":checked")){
			pissue_date = $("#p_issuedate").val();
			renew_passport = "yes";
		}
		if($("#renewWorkPermit").is(":checked")){
			var wp_issuedate = $("#wp_issuedate").val();
			renew_workPermit = "yes";
		}
		if($("#renewpkfz").is(":checked")){
			pkfz_issuedate = $("#pkfz_issuedate").val();
			renew_pkfz = "yes";
		}
		if($("#renewwestport").is(":checked")){
			westport_issuedate = $("#westport_issuedate").val();
			renew_westport = "yes";
		}
		if($("#renewjohor").is(":checked")){
			johor_issuedate = $("#johor_issuedate").val();
			renew_johor = "yes";
		}
		if($("#renewptp").is(":checked")){
			ptp_issuedate = $("#ptp_issuedate").val();
			renew_ptp = "yes";
		}
		if($("#renewtlp").is(":checked")){
			tpl_issuedate = $("#tpl_issuedate").val();
			renew_tpl = "yes";
		}
		if($("#renewNorthPort").is(":checked")){
			NorthPort_issuedate = $("#NorthPort_issuedate").val();
			renew_north_port = "yes";
		}
		
        var num = $("#field_no").html();
        var i;
        var extrainfo = "";
        if(num > 0){
            for(i=1; i<=num; i++){
                if($("#title_"+i).val()!="" || $("#value_"+i).val()!=""){
                    extrainfo = extrainfo+$("#title_"+i).val() + "," + $("#value_"+i).val() + ";";
                }
            }
        }
        
        var error1 = [];
        var error2 = [];
        var error3 = [];
       if(ic!=""){
        if(ic1 == '' || ic1 == ' ' || ic2 == '' || ic2 == ' ' || ic3 == '' || ic3 == ' ' || ic1.length < 6 || ic2.length < 2 || ic3.length < 4){
            error1.push("I.C Number");
        }else{
            if(ic1.match(/^\d+$/) && ic2.match(/^\d+$/) && ic3.match(/^\d+$/)){
            }else{
                error2.push("I.C Number");
            }
        }
		}	
       
        if(mobile == "" || mobile == " "){ 
            error1.push("Mobile Number");
        }
		if(ic==""){ 
			if(pn == "" || pn == " "){ 
				error1.push("Passport Number");
			}
			if(pe == "" || pe == " "){ 
				error1.push("Passport Expiry");
			}
			if(wp == "" || wp == " "){ 
				error1.push("Work Permit");
			}
			if(wpep == "" || wpep == " "){ 
				error1.push("Work Permit Expiry");
			}
		}
		if(confirm == "" || confirm == " "){
            error1.push("Confirm Date");
        }
		if(emergency_contact == "" || emergency_contact == " "){
            error1.push("Emergency Contact Person");
        }
		if(emergency_num == "" || emergency_num == " "){
            error1.push("Emergency Contact Number");
        }
		if(emergency_relationship == "" || emergency_relationship == " "){
            error1.push("Emergency Contact Ralationship");
        }

        if(kin_emergency_contact == "" || kin_emergency_contact == " "){
            error1.push("Next Of Kin Contact Person");
        }
		if(kin_emergency_num == "" || kin_emergency_num == " "){
            error1.push("Next Of Kin Contact Number");
        }
		if(kin_emergency_relationship == "" || kin_emergency_relationship == " "){
            error1.push("Next Of Kin Ralationship");
        }
		
        if(email == "" || email == " "){
            error1.push("Email Address");
        }
		if($("#renewPassport").is(":checked")){
			if(pissue_date == "" || pissue_date == " "){
				error1.push("Passport Issue Date");
			}
		}
		if($("#renewWorkPermit").is(":checked")){
			if(wp_issuedate == "" || wp_issuedate == " "){
				error1.push("Work Permit Issue Date");
			}
		}
		
	
		if($("#renewpkfz").is(":checked")){
			if(pkfz_issuedate == "" || pkfz_issuedate == " "){
				error1.push("Issue Date (K FZ Pass)");
			}
		}
		if($("#renewwestport").is(":checked")){
			if(westport_issuedate == "" || westport_issuedate == " "){
				error1.push("Issue Date (Wesport Pass)");
			}
		}
		if($("#renewjohor").is(":checked")){
			if(johor_issuedate == "" || johor_issuedate == " "){
				error1.push("Issue Date (Johor Port Pass)");
			}
		}
		if($("#renewptp").is(":checked")){
			if(ptp_issuedate == "" || ptp_issuedate == " "){
				error1.push("Issue Date (PTP Pass) ");
			}
		}
		if($("#renewtlp").is(":checked")){
			if(tpl_issuedate == "" || tpl_issuedate == " "){
				error1.push("Issue Date (TPL Pass)");
			}
		}
		if($("#renewNorthPort").is(":checked")){
			if(NorthPort_issuedate == "" || NorthPort_issuedate == " "){
				error1.push("Issue Date (North Port Pass)");
			}
		}

        if(gender == 0){
            error3.push("Gender");
        }
        if(race == 0){
            error3.push("Race");
        }
        if(religion == 0){
            error3.push("Religion");
        }
        if(marital == 0){
            error3.push("Marital Status");
        }
        if(spouse == 0 && marital == "M"){
            error3.push("Spouse Working");  
        }
		if(spouse=="Y" && spouse_company==""){
			error3.push("Spouse Company");
		}
		if(spousename == "" && marital == "M"){
            error3.push("Spouse Name");  
        }
        if((child == "" || child == " ") && (marital == "M" || marital == "D")){
            error1.push("Number of Children");
        }else{
            if(child == "" || child == " "){
                child = 0;
            }else{
                if(child.match(/^\d+$/)){
                }else{
                    error2.push("Number of Children");
                }
            }
        }
        if(dob == "" || dob == " "){
            error1.push("Date of Birth");
        }
        if(joindate == "" || joindate == " "){
            error1.push("Join Date");
        }
        if(leaveGroup == "" || leaveGroup == "0"){
            error3.push("Leave Group");
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
	
                
        var data1 = "";
        var data2 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
        
        //if(error1.length > 0 || error2.length > 0 || error3.length > 0){
        //    alert(data1 + data2 + data3);
       // }else{
		
		
            $.ajax({
                type:'POST',
                url:'?widget=saveprofilepi',
                data:{
                    id:id,
                    ic:ic, 
                    phone:phone,
                    mobile:mobile,
                    email:email,
                    address:address,
                    race:race,
                    profile:profile,
                    dob:dob,
					e_date_pk_fz:e_date_pk_fz,
					e_date_westport:e_date_westport,
					e_date_johor_port:e_date_johor_port,
					e_date_ptp:e_date_ptp,
					e_date_tlp:e_date_tlp,
					e_date_north_port:e_date_north_port,
					reasnresign :reasnresign,
                    joindate:joindate,
					confirm:confirm,
                    resigndate:resigndate,
                    gender:gender,
                    marital:marital,
                    spouse:spouse,
                    child:child,
                    type:type,
                    religion:religion,
					lastDateText:lastDateText,
					offDateText:offDateText,
                    username:username,
					spousename:spousename,
					emergency_contact:emergency_contact,
					emergency_num:emergency_num,
					emergency_relationship:emergency_relationship,
					kin_emergency_contact:kin_emergency_contact,
					kin_emergency_num:kin_emergency_num,
					kin_emergency_relationship:kin_emergency_relationship,
					kin_ic:kin_ic,
                    leaveGroup:leaveGroup,
                    extrainfo:extrainfo,
					pn:pn,
					pe:pe,
					wp:wp,
					wpep:wpep,
					country:country,
					pissue_date:pissue_date,
					wp_issuedate:wp_issuedate,
					renew_passport:renew_passport, 
					renew_workPermit:renew_workPermit,
					pkfz_issuedate:pkfz_issuedate,
					renew_pkfz:renew_pkfz,
					westport_issuedate:westport_issuedate,
					renew_westport:renew_westport,
					johor_issuedate:johor_issuedate,
					renew_johor:renew_johor,
					ptp_issuedate:ptp_issuedate,
					renew_ptp:renew_ptp,
					tpl_issuedate:tpl_issuedate,
					renew_tpl:renew_tpl,
					NorthPort_issuedate:NorthPort_issuedate,
					renew_north_port:renew_north_port,
					spouse_company:spouse_company
                },
                success:function(data){
					//alert(data);
					//exit();
                    if(data!=false){
                        alert('Profile Updated');
                        $('#editModePI').empty().append(data);
                    }
                    else{
                        alert('Error While Ptrocessing');
                    }
                }
            })  
        //}
    }
	 function checkEmail() {

    var email = document.getElementById('textemail');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
    alert('Please provide a valid email address');
    email.focus;
    return false;
 }
}

    function editSal(id){
        var edited = $('#hiddenField').val();
        $.ajax({
            type:'POST',
            url:'?widget=editprofilesalary',
            data:{
                id:id,
                edited:edited
            },
            success:function(data){
                if(data!=false){
                    $('#editModeSAL').empty().append(data);
                }else{
                    alert('Error While Processing');
                }
            }
        })
    }

    function cancelSal(){
        var empid = <?php echo $getID ?>;
        $.ajax({
            type:'POST',
            url:'?widget=editprofilesalarycancel',
            data:{
                empid:empid
            },
            success:function(data){
                if(data!=false){
                    $('#editModeSAL').empty().append(data);
                }else{
                    alert('Error While Processing');
                }
            }
        })
    }

    function saveSal(id, position){
        var type = 'salary';
		var salaryGrade = $("#salaryGrade").val();
        var epf = $('#textepf').val();
        var socso = $('#textsocso').val();
		var eis = $('#eis').val();
        var itax = $('#textitax').val();
        var bankacc = $('#textbankacc').val();
        var timeplan = $('#texttimeplan').val();
        var salary = $('#textsalary').val();
        var zakat = $('#textzakat').val();
        var contract = $("#dropcontract").val();
        var bank = $("#dropbank").val();
        var overtime = $("#dropovertime").val();
        var salaryType = $("#dropsalarytype").val();
		var payment_type = $("#paymentType").val();
         if($('#epf').is(':checked')){
            var epf1="Y";
        }else{
            var epf1="N"; 
        }
        if($('#socso').is(':checked')){
            var socso1="Y";
        }else{
            var socso1="N";
        }
        if($('#pcb').is(':checked')){
            var pcb1="Y";
        }else{
            var pcb1="N";
        }
		if($('#eis').is(':checked')){
            var eis="Y";
        }else{
            var eis="N";
        }
		if($('#cap').is(':checked')){
            var cap="Y";
        }else{
            var cap="";
        }
	
        var error1 = [];
        var error2 = [];
        var error3 = [];
        if(contract == '0'){
            error3.push("Under Contract");
        }
        if(salaryType == '0'){
            error3.push("Salary Type");
        }
		if(payment_type == '0'){
            error3.push("Payment Type");
        }
        if(salary == '' || salary == ' '){
            error1.push("Salary Amount");
        }else{
            if(salary.match(/^\d+$/) || salary.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Salary Amount");
            }   
        }
        if(zakat != "" && zakat != " "){
            if(zakat.match(/^\d+$/) || zakat.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Zakat Amount");
            } 
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error2.length > 0 || error3.length > 0){
            alert(data1 + data2 + data3);
        }else{
            $.ajax({
                type:'POST',
                url:'?widget=saveprofilesalary',
                data:{
                    id:id,
                    epf:epf,
                    socso:socso,
					eis:eis,
                    itax:itax,
                    bankacc:bankacc,
                    timeplan:timeplan,
                    contract:contract,
                    bank:bank,
                    type:type,
					socso1:socso1,
					epf1:epf1,
					pcb1:pcb1,
                    overtime:overtime,
                    salary:salary,
                    salaryType:salaryType,
                    zakat:zakat,
                    position:position,
					payment_type:payment_type,
					cap:cap,
					salaryGrade:salaryGrade
                },
                success:function(data){
                    if(data!=false){
                        alert('Profile Updated');
                        $('#editModeSAL').empty().append(data);
                    }else{
                        alert('Error While Processing');
                    }
                }
            })    
        }
    }

    function disapproveSal(id,type){
        $.ajax({
            type:'POST',
            url:'?widget=editdisapprovesal',
            data:{
                id:id,
                type:type
            },
            success:function(data){
                if(data==true){
                    alert('Profile Detail Changes Rejected');
                    window.location='?loc=view_profile_new&viewId='+id+'&edited=Y&t=s';
                }
                else{
                    alert('Error While Processing');
                }
            }
        })
    }


    function loadPopupBox(){
        $.ajax({
            url: '?widget=popupProperty',
            data:{
                id:"<?php echo $getID ?>"
            },
            success: function(data) {
			
                $("#editModePRO").append(data);
            }
        })
    }
	function loadBenPopupBox(){
	
        $.ajax({
            url: '?widget=popupBenefits',
            data:{
                id:"<?php echo $getID ?>"
            },
            success: function(data) {
                $("#editModeBen").append(data);
            }
        })
    }
    
    function returnPro(id){
        var userID = <?php echo $getID ?>;
        var result = confirm("Are you sure you want to return this property?");
        if(result){
            $.ajax({
                type:'POST',
                url: '?widget=propertyreturn',
                data:{
                    id:id,
                    userID:userID
                },
                success: function(data) {
                    if(data!=false){
                        alert("Property Returned");
                        $('#editModePRO').empty().append(data);

                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
	
	function returnBen(id){
        var userID = <?php echo $getID ?>;
        var result = confirm("Are you sure you want to return this Benefits?");
        if(result){
            $.ajax({
                type:'POST',
                url: '?widget=benefitsreturn',
                data:{
                    id:id,
                    userID:userID
                },
                success: function(data) {
                    if(data!=false){
                        alert("Benefits Returned");
                        $('#editModeBen').empty().append(data);

                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }

    function editLoan() {
        var id = <?php echo $getID ?>;
        $.ajax({
            type:'POST',
            url: '?widget=editprofileloan',
            data:{
                id:id
            },
            success: function(data) {
                if(data!=false){
                    $('#loanDiv').empty().append(data);
                }else{
                    alert('Error While Processing');
                }
            }
        })
    }

    function cancelLoan(){
        var id = <?php echo $getID ?>;
        $.ajax({
            type:'POST',
            url: '?widget=editprofileloancancel',
            data:{
                id:id
            },
            success: function(data) {
                if(data!=false){
                    $('#loanDiv').empty().append(data);
                }else{
                    alert('Error While Processing');
                }
            }
        })
    }

    function saveLoan(){
        var id = <?php echo $getID ?>;
        var row = $('#takeRow').val();
        var selection = "";
        $('[name=dropDownLoan]').each(function(i,dom){
            selection += $(dom).val() + ',';
        });
        $.ajax({
            type:'POST',
            url: '?widget=saveprofileloan',
            data:{
                id:id,
                selection:selection
            },
            success: function(data) {
                if(data!=false){
                    alert('Profile Updated');
                    $('#loanDiv').empty().append(data);
                }else{
                    alert('Error While Processing');
                }
            }
        })
    }

    ////photo part
    function uploadImage(){
        $('#uploadImage').css({"display":"block"});
        $("#profileIMG").css({ // this is just for style
            "opacity": "3"
        });
    }
    
    function noUploadImage(){
        $('#uploadImage').css({"display":"none"});
        $("#profileIMG").css({ // this is just for style
            "opacity": "3"
        });
    }

    function uploadPic(id) {
        mywindow = window.open('?widget=editprofileupload&employeeID='+id,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
    }

    function deletePic(loc,id){
        var result = confirm('Are you sure you want to change your profile picture?');
        if(result){
            mywindow = window.open('?widget=editprofileupload&employeeID='+id,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
        }
        uploadPic(id);
    }
  
    function add_advsal(){
        var adv_amount = $("#advsalInput").val();
		var month=$("#finalmonth").val();
		var year=$("#finalyear").val();
		var i_month=$("#i_month").val();
	    var i_amount="";

	if(i_month!=""){
	i_amount=adv_amount/i_month;
	i_amount=i_amount.toFixed(2);
	}
	
		var date= year + "-" + month + "-" + 1;
        
        var error1 = [];
        var error2 = [];
        
        if(adv_amount == '' || adv_amount == ' '){
            error1.push("Advance Salary Amount");
        }else{
            if(adv_amount.match(/^\d+$/)){
            }else{
                error2.push("Advance Salary Amount");
            }   
        }
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2;
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1 + data2);
        }else{
            $.ajax({
                type:"POST",
                url:"?widget=advsaladd",
                data:{
                    adv_amount:adv_amount,
					i_amount:i_amount,
					i_month:i_month,
					date:date,
                    emp_id:<?php echo $getID ?>
                },
                success:function(data){
                    if(data != false){
                        alert("Advance Salary Added");
                        $("#advsalcontain").empty().append(data);
                        $("#advsalInput").val("");
						 $("#i_amount").val("");
						  $("#i_month").val("");
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }
	function add_advsal1(){
        var adv_amount = $("#advsalInput1").val();
        var month=$("#month").val();
        var error1 = [];
        var error2 = [];
     
        if(adv_amount == '' || adv_amount == ' '){
            error1.push("Comission Amount");
        }
		/*
		else{
            if(adv_amount.match(/^\d+$/)){
            }else{
                error2.push("Comission Amount must be integer ");
            }   
        }
		*/
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2;
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1 + data2);
        }else{
		
            $.ajax({
                type:"POST",
                url:"?widget=comisionadd",
                data:{
                    adv_amount:adv_amount,
					month:month,
                    emp_id:<?php echo $getID ?>
					
                },
                success:function(data){
                    if(data != false){
                        alert("Comission Added");
                        window.location.reload();
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }
    
    
    function del_comision(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=comisiondel",
                data:{
                    id:id, 
                    emp_id:<?php echo $_GET['viewId'] ?>
                },
                success:function(data){
                    if(data != false){
                        alert("Comission Deleted")
                       window.location.reload();
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }

    function add(){
       window.open('?loc=incident_record&emp_id=<?php echo $_GET['viewId'] ?>', '_parent')
    }

    function del(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=remarkdel",
                data:{
                    id:id,
					action:"1",
                    userid:<?php echo $_GET['viewId'] ?>
                },
                success:function(data){
				
                    if(data != false){
                        alert("Incident details has been deleted")
                        $("#contain").empty().append(data);
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }
	function del1(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=remarkdel",
                data:{
                    id:id,
					action:"2",
                    userid:<?php echo $_GET['viewId'] ?>
                },
                success:function(data){
                    if(data != false){
                        alert("Injury details has been deleted")
                        $("#contain1").empty().append(data);
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }
	function del2(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=remarkdel",
                data:{
                    id:id,
					action:"3",
                    userid:<?php echo $_GET['viewId'] ?>
                },
                success:function(data){
				
                    if(data != false){
                        alert("Injury details has been deleted")
                        $("#contain2").empty().append(data);
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }

    function back(){ 
        history.back(-1);
    }

    function print(id){
        window.open('?widget=emp_leave_balance_report&empid='+id);
    }
    
    function paysliphistory(){
        window.open('?widget=paysliphistory&emp_id=<?php echo $_GET['viewId'] ?>','mywindow','location=1,status=1,scrollbars=1,width=600,height=600');
    }
	
    $(function() {
        $("#e_remarkDate, #remarkDate, #year").datepicker({
            dateFormat: 'yy-mm-dd'
        });

		/*$(".inline").click(function(){
			var id=$(this).attr("alt");
			var action=$(this).attr("alt1");
				if(action=="h"){
				  $.ajax({
						type:'POST',
						url:"?widget=uni_edit",
						data:{
						 id:id,
						 action:action
						},
						success:function(data){
							$("#inline_content3").empty().append(data)
						}
					}); 
				}else{
					$.ajax({
						type:'POST',
						url:"?widget=uni_edit",
						data:{
						 id:id
						
						   
						},
						success:function(data){
						$("#inline_content").empty().append(data)
						  
						}
					});
				}
		 
		 })*/
		

		$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
		});

		$('.non-retina').colorbox({rel:'group5', transition:'none'})
		$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
        oTable = $('#education').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true,                 
            "sPaginationType": "full_numbers"
        });
		
     });
	
	function ed(id){
	   $.ajax({
            type:'POST',
            url:"?widget=uni_edit",
            data:{
				 id:id   
            },
            success:function(data){
				succ(data);
            }
        });
	}
	function add_emh(){
		   var name=$("#company").val();
		   var from=$("#from").val();
		   var to=$("#to").val();
		   var reason =$("#reason").val();
		   var em_id =$("#r_id").val();
		   var error3 = [];
		   
           if(name == "" || name == " "){
                error3.push("Company Name");
            }
			 if(from== "" || from== " "){
                error3.push("From year");
            }
			 if(to == "" || to == " "){
                error3.push("To year");
            }
			 if(reason== "" || reason == " "){
                error3.push("Reason");
            }
        
			var error_data1 = '';
			for(var i=0;
			i< error3.length;
			i++){
				error_data1 = error_data1 + error3[i] + "; "
			}
        

			var data1 = "";
			var data2 = "";
			var data3 = "";
			var data4 = "";
			if(error3.length > 0){
				data1 = "Please Insert :\n"+error_data1+"\n\n";
				alert(data1)
			}else{
			
				$.ajax({
					type:'POST',
					url:"?widget=add_uni",
					data:{
					 name:name,
					 from:from,
					 to:to,
					 em_id:em_id, 
					 reason:reason,
					 action:'h'
					   
					},
					success:function(data){
					
					  if(data!=0){
					 $("#emh").empty().append(data);
					  alert("Employment history has been added")
					   }
					}
				});
			}
    }
	function save_h(){ 
		   var name=$("#company_c").val();
		   var from=$("#from_c").val();
		   var to=$("#to_c").val();
		   var reason =$("#reason_c").val();
		   var em_id =$("#em_id").val();
		   var id =$("#id").val();
		   var error3 = [];
		   if(name == "" || name == " "){
                error3.push("Company Name");
            }
			if(from== "" || from== " "){
                error3.push("From year");
            }
			if(to == "" || to == " "){
                error3.push("To year");
            }
			if(reason== "" || reason == " "){
                error3.push("Reason");
            }
        
			var error_data1 = '';
			for(var i=0;
			i< error3.length;
			i++){
				error_data1 = error_data1 + error3[i] + "; "
			}
			

			var data1 = "";
			var data2 = "";
			var data3 = "";
			var data4 = "";
			if(error3.length > 0){
				data1 = "Please Insert :\n"+error_data1+"\n\n";
				alert(data1)
			}else{
			
				$.ajax({
					type:'POST',
					url:"?widget=add_uni",
					data:{
					 name:name,
					 from:from,
					 to:to,
					 em_id:em_id, 
					 id:id,
					 reason:reason,
					 action:'h',
					 ed:'ed' 
					   
					},
					success:function(data){
					
					  if(data!=0){
							 //$("#emh").empty().append(data);
							 alert("Employee History has been updated")
							 parent.jQuery.colorbox.close();
							 location.reload();
					   }
					}
				});
			}
    }
	function save_u(){
       
       var name=$("#name_e").val();
	   var year=$("#year_e").val();
	   var level=$("#level_e").val();
	   var id=$("#id").val();
  
	  // var uploaded_img = $('#uploaded_img').val();
       var em_id =$("#em_id").val();
	  // var uploaded_img = $('#file_upload').val();
	  $value=$('#file_upload1').val();
	  var files="";
	  if($('#file_upload1').val()!=""){
		 files = $('#file_upload1')[0].files[0];
	  }
       var em_id =$("#r_id").val();
        var error3 = [];
		
        var formData = new FormData();
		formData.append("name",name);
		formData.append("year",year);
		formData.append("level",level);
		formData.append("em_id",em_id);
		formData.append("id",id);
		formData.append("fileInput",files);
		formData.append("action","edit");
       var error3 = [];
       if(name == "" || name == " "){
                error3.push("University Name");
        }
		if(year == "" || year == " "){
                error3.push("Session");
       }
	   if(level == "" || level == " "){
                error3.push("Level");
       }
	   if(files!=""){
			var ext_arr = ['png','jpg','gif','pdf', 'PDF','PNG','JPG','GIV'];
			var ext =files.name.replace(/^.*\./, '');
			if(jQuery.inArray(ext, ext_arr)==-1 && files.name!=""){
				error3.push("Transcript as pdf or image");
			}
	   }
        var error_data1 = '';
        for(var i=0;
        i< error3.length;
        i++){
            error_data1 = error_data1 + error3[i] + "; "
        }
        

        var data1 = "";
        var data2 = "";
        var data3 = "";
        var data4 = "";
        if(error3.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
			alert(data1)
        }else{
		
            $.ajax({
                type:'POST',
                url:"?widget=add_uni",
                data:formData,
				processData: false,
				contentType: false,
                success:function(data){
					if(data!=0){
						  $("#edu").empty().append(data);
						  alert("Education background has been updated")
						  window.location.reload();
					   }
                }
            });
        }
		
    }
	function succ(id){
		
		$.fn.jAlert({
			'title':'Edit Education Background',
			
			'message': id,
			'theme': 'info',
			'btn': [
		{
		'label':'OK', 'cssClass': '#0B61A4', 'closeOnClick': true, 'onClick': function(){
			
		} 
		}
	]
	
		});
		
	}
function family_popup(id){
	$(".allegation input").val("");
	
	if(id==1){
		$(".family.alleg").show();
	}else if(id==2){
		$(".ed.alleg").show();
		$('span.trans_file').remove();
	}else if(id==3){
		$(".employee_history.alleg").show();
	}
	
	$("<div class='modalWindow'></div>").insertBefore("#MainContainer");
	
}
</script>

<style type="text/css">

    #viewProfileOuterDiv{
        border-color: #007DC5;
        border-style:solid;
        /*        margin-top: 20px;*/
        width:1180px;
        height:auto;
        min-height: 380px;
        padding-bottom: 30px;
    }

    #viewProfileTabs {
        font-size: 12pt;
        padding-top:20px;
        font-weight: bold;
    }

    #viewProfileTabs td{
        padding-left:20px;
        cursor:pointer;
        font-family: arial;
    }

    .viewProfileInfo{
        padding-left:20px;
    }

   

    .mouseOver{
        font-size:100%;
        position:absolute;
        visibility:hidden;
        border:solid;
        border-width: 1px;
        border-radius:10px;
        z-index: 10;
    }

    #popup_box {
        position:fixed;
        _position:absolute;
        min-height:300px;
        width:600px;
        background:#FFFFFF;
        left: 300px;
        top: 150px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: 15px;
        /* additional features, can be omitted */
        padding:15px;
        font-size:15px;
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;

    }

    #popupBoxClose {
        /*line-height:15px;*/
        right:5px;
        top:5px;
        position:absolute;
        font-weight:500;
    }

    #titlebar{
        background-color: #007DC5;
        border-style:1;
        border-radius:5px;
        padding-top:3px;
        padding-bottom:3px;
        color:white;
    }
</style>

<script type="text/javascript" charset="utf-8">
function add_family(id){
	   var update="";
	   if(id!=""){
		   update="edit";
	   }
       var name=$("#f_name").val();
	   var relationship=$("#f_relationship").val();
	   var age=$("#f_age").val();
       var em_id =$("#r_id").val();
	  
        var error3 = [];
       
        
            if(name == "" || name == " "){
                error3.push("Name");
            }
			 if(age == "" || age == " "){
                error3.push("Age");
            }
			 if(relationship == "" || relationship == " "){
                error3.push("Relationship");
            }
        var error_data1 = '';
        for(var i=0;
        i< error3.length;
        i++){
            error_data1 = error_data1 + error3[i] + "; "
        }
        

        var data1 = "";
        var data2 = "";
        var data3 = "";
        var data4 = "";
        if(error3.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
			alert(data1) 
        }else{
		
            $.ajax({
                type:'POST',
                url:"?widget=add_uni",
                data:{
				 name:name,
				 relationship:relationship,
				 age:age,
				 em_id:em_id ,
				 action:'family',
				 update:update,
				 id:id
                },
                success:function(data){
                  if(data!=0){
					 $("#edu").empty().append(data);
					  alert("Family background has been updated");
					  window.location.reload();
				   }
                }
            });
        }
    }
function add_u(){
       var name=$("#name").val();
	   var year=$("#year").val();
	   var level=$("#level").val();
	   var uploaded_img = $('#file_upload').val();
	   var files = $('#file_upload')[0].files[0];
       var em_id =$("#r_id").val();
	
        var error3 = [];

        var formData = new FormData();
		formData.append("name",name);
		formData.append("year",year);
		formData.append("level",level);
		formData.append("em_id",em_id);
		formData.append("fileInput",files);
		var ext_arr = ['png','jpg','gif','pdf', 'PDF','PNG','JPG','GIV'];
		var ext =$('#uploaded_img').val().replace(/^.*\./, '');
		if(jQuery.inArray(ext, ext_arr)==-1 && uploaded_img!=""){
			error3.push("Transcript as pdf or image");
		}

            if(name == "" || name == " "){
			  error3.push("University Name");
            }
			 if(year == "" || year == " "){
                error3.push("Session");
            }
			 if(level == "" || level == " "){
                error3.push("Level");
            }
			//if(uploaded_img == "" || uploaded_img == " "){
            //    error3.push("Transcript1");
            //}
        
        var error_data1 = '';
        for(var i=0;
        i< error3.length;
        i++){
            error_data1 = error_data1 + error3[i] + "; "
        }
        

        var data1 = "";
        var data2 = "";
        var data3 = "";
        var data4 = "";

        if(error3.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
			alert(data1) 
        }else{
		
            $.ajax({
                type:'POST',
                url:"?widget=add_uni",
                data:formData,
				processData: false,
				contentType: false,
                success:function(data){
                  if(data!=0){
					 $("#edu").empty().append(data);
					  window.location.reload();
                  
				   }
                }
            });
        }
    }
    $(document).ready(function() {
        oTable = $('#loantable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );

    $(document).ready(function() {
        oTable = $('#propertyTable, #benefitsTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );

    $(document).ready(function() {
	$(".popup_window").click(function(){
		 var id=$(this).attr("alt");
		 var action=$(this).attr("alt1");
		
		if(action=="h"){
		  $.ajax({
                type:'POST',
                url:"?widget=uni_edit",
                data:{
				 id:id,
				action:action
                   
                },
                success:function(data){
					$(".employee_history.alleg").show();
					$("<div class='modalWindow'></div>").insertBefore("#MainContainer");
					$(".employee_history.alleg").empty().append(data);
                }
            }); 
			}else if(action=="family"){
			  $.ajax({
					type:'POST',
					url:"?widget=uni_edit",
					data:{
					 id:id, 
					action:action
					},
					success:function(data){
						$(".family.alleg").show();
						$("<div class='modalWindow'></div>").insertBefore("#MainContainer");
						$(".family.alleg").empty().append(data);
						
						//$("#inline_content4").empty().append(data);
					}
				}); 
			}else if(action=="ed"){
			$.ajax({
                type:'POST',
                url:"?widget=uni_edit",
                data:{
				 id:id,
				 action:action
				
                   
                },
                success:function(data){
					$(".ed.alleg").show();
					$("<div class='modalWindow'></div>").insertBefore("#MainContainer");
					$(".ed.alleg").empty().append(data);
					//$("#inline_content").empty().append(data)
                  
                }
            });
			
			}
		 
		 })
        oTable = $('#tableRemark').dataTable({ 
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        }); 
		oTable = $('#tableRemark1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		oTable = $('#tableRemark2').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		oTable = $('#tableRemark_del').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    $(document).ready(function() {
        oTable = $('#tableadvsal').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
	 $(document).ready(function() {
        oTable = $('#tableadvsal1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    $(document).ready(function() {
        oTable = $('#tableClaim').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 oTable = $('#tableClaim12').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        })
    });
    function amount(){
	var i_month=$("#i_month").val();
	var amount=$("#advsalInput").val();

	var i_amount=amount/i_month;
	i_amount=i_amount.toFixed(2);
	if(i_month!="" && amount!=""){
	$("#i_amount").val(i_amount);
	}
	}
	
    $(document).ready(function() {
        oTable = $('#tableAllowance').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 oTable = $('#tableedu, #tablefamily').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 oTable = $('#tableh').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
  function chgPW(){
        var o = document.getElementById("passwordPop");
        o.style.display="block";
    }
    function checkPW(id){

        var pw0 = $('#pw0').val();
        var pw1 = $('#pw1').val();
        var pw2 = $('#pw2').val();
		pw0 = CryptoJS.MD5(pw0).toString();
		
        var pw9 = $('#password').val();
		
        if((pw0 == "" || pw0 == " ") || (pw0 != pw9)){
            alert("Wrong Current Password");
        }else{
		
            if((pw1 == "" || pw1 == " " || pw2 == "" || pw2 == " ") || (pw1 != pw2)){
                alert("New Password Does Not Match");
            }else{
                $.ajax({
                    type:'POST',
                    url:'?ewidget=changePassword',
                    data:{
                        id:id,
                        pw1:pw1
                    },
                    success:function(data){
					
                        if(data==true){
                            alert('Password Changed');
                            window.location = '?eloc=emp_view_profile';
                        }
                        else{
                            alert('Error While Processing');
                        }
                    }
                })
            }
        }
    }
    
function cancelPW(){
        var o = document.getElementById("passwordPop");
        o.style.display="none";
}
	 
function process(val){
window.open('?loc=admin_appraisal&id='+val, '_parent');
}
function selectBranch(company_id){
        $.ajax({
            type:"POST",
            url:"?widget=showcompany",
            data:{
                company_id:company_id
            },
            success:function(data){
                $("#dropbranch").empty().append(data);
                $("#dropdept").empty().append('<option value="">--Please Select--</option>');
                //$("#dept").empty().append('<option value="">--Please Select--</option>');
            }
        });
    }
	
	function selectDept(branch_id){
        $.ajax({
            type:"POST",
            url:"?widget=showdept",
            data:{
                branch_id:branch_id
            },
            success:function(data){
                $("#dropdept").empty().append(data);
				$("#dropgroup").empty().append('<option value="">--Please Select--</option>');
                //$("#dept").empty().append(data);
            }
        });
    }
	
	function changeGroup(dep_id){
        $.ajax({
            type:"POST",
            url:"?widget=showgroup2",
            data:{
                dept_idTop:dep_id
            },
            success:function(data){
                $("#dropgroup").empty().append(data);
                //$("#dept").empty().append(data);
            }
        });
    }
	
	function closePopoup(){
		$(".alleg").hide();
		$(".modalWindow").remove();
	}
	

  
</script>
<style>
table#tablefamily th.ui-state-default {
    width: 2px !important;
}
.expired{
  animation: blink-animation 1s steps(5, start) infinite;
  -webkit-animation: blink-animation 1s steps(5, start) infinite;
  background: #980505;
  padding: 4px;
  font-weight: bold;
  color: #fff;
}
@keyframes blink-animation {
  to {
    visibility: hidden;
  }
}
@-webkit-keyframes blink-animation {
  to {
    visibility: hidden;
  }
}
.allegation tr td input {
    width: 85% !important;
    margin-bottom: 1%;
}
table.allegation tr td {
    border: none;
}
table.allegation {
    border: none;
}
div#ui-datepicker-div {
    z-index: 99999 !important;
}
</style>
<!--<script type="text/javascript" src="js/uploadify/swfobject.js"></script>
<script type="text/javascript" src="js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<link href="js/uploadify/uploadify.css" rel="stylesheet" type="text/css" />-->

<?php

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>