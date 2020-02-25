<?php
session_start();
if(isset($_GET['viewId']) == true){
$employee_id=$_GET['viewId'];
if ($_SESSION["userid"]!=$_GET['viewId']){
echo "<script language='javascript' type='text/javascript'> ";


echo "alert('Sorry, You are not allowed to access this page. Please contact the administrator')";


echo "</script>";
echo "<script language='javascript' type='text/javascript'>";
echo " self.location='?eloc=emp_view_profile'";
echo "</script>";

}
}else{
	$employee_id=0;
}

if (isset($_GET['viewId']) == true || isset($_COOKIE["igen_user_id"])) {
    $getID = isset($_GET['viewId']) ? $_GET['viewId'] : $_COOKIE["igen_user_id"];
    $query = mysql_query('SELECT * FROM employee WHERE id=' . $getID . ';');
    $row = mysql_fetch_array($query);

    $queryJoin = mysql_query('SELECT e.bank_acc_id,b.code, b.name FROM employee AS e INNER JOIN bank AS b WHERE e.bank_acc_id=b.id AND e.id=' . $getID . ';');
    $rowJoin = mysql_fetch_array($queryJoin);

    $queryCompany = mysql_query('SELECT c.id, c.code, c.name FROM company AS c INNER JOIN employee AS e ON c.id = e.company_id WHERE e.id = ' . $getID . ';');
    $rowCompany = mysql_fetch_array($queryCompany);

    $queryDept = mysql_query('SELECT d.dep_name FROM department AS d INNER JOIN emp_group AS eg JOIN employee AS e ON d.id=eg.dep_id AND e.group_id = eg.id WHERE e.id = ' . $getID . ';');
    $rowDept = mysql_fetch_array($queryDept);

    $queryGroup = mysql_query('SELECT g.group_name FROM emp_group AS g INNER JOIN employee AS e ON g.id = e.group_id WHERE e.id=' . $getID . ';');
    $rowGroup = mysql_fetch_array($queryGroup);

    $queryLevel = mysql_query('SELECT l.name FROM level AS l INNER JOIN employee AS e ON l.id = e.level_id WHERE e.id = ' . $getID . ';');
    $rowLevel = mysql_fetch_array($queryLevel);

    $queryPos = mysql_query('SELECT p.position_name FROM position AS p INNER JOIN employee AS e ON p.id = e.position_id WHERE e.id = ' . $getID . ';');
    $rowPos = mysql_fetch_array($queryPos);

    $queryBranch = mysql_query('SELECT b.branch_code FROM branch AS b INNER JOIN employee AS e ON b.id = e.branch_id WHERE e.id = ' . $getID . ';');
    $rowBranch = mysql_fetch_array($queryBranch);


    $queryBank = mysql_query('SELECT bank_acc_id FROM employee WHERE id = ' . $getID . ';');
    $rowBankSelected = mysql_fetch_array($queryBank);
	$sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $getID);
$rowGetNew = mysql_fetch_array($sqlGetNew);
$numRow = mysql_num_rows($sqlGetNew);
$img=$rowGetNew['image_src'];

	
    
?>
<div class="main_div" style="width:100%">
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
			<?php 
			// employee basic details
			include("employee_profile.php");  
			?>
			
        </div>
    </div>
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
			<?php
			// uploading employee personal information 
			include("employee_personal_info.php");
			?>			 
	 </div></div>
<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a href="#collapsefive" data-toggle="collapse" data-parent="accordion">Family Information</a>
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
		&nbsp;&nbsp;&nbsp;Family Information
		</td>
		</tr>
		 </table><br>
				  <div id="family-information">
					 <table  class="TFtable" id="tablefamily" border="1px solid" style="border-collapse: collapse; width: 100%;">
						<thead>
							<tr class="pluginth">
								<th style="width:10px">No.</th>
								<th style="width:300px">Name</th>
								<th style="width:50px">Relationship</th>
								<th style="width:50px">Age</th>
								<th style="width:50px">Action</th>

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
									 <td style="width:10px">' .  $num_loan . '</td>
									<td style="width:300px">' . $name . '</td>
									<td style="width:50px">' . $relationship . '</td>
									
									<td style="width:50px">' . $age . '</td>';
								if($igen_a_hr == "a_hr_edit"){
								echo'
									<td style="width:50px,; cursor:pointer"><a  class="inline" style="text-decoration:none" href="#inline_content4" alt1="family" alt="'.$row['id'].'"> <input type="button" id="editBut" value="Edit"> </a></td>';
									
									}else{
									echo'<td style="width:50px">-</td>';
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
						<a href="#collapsethree" data-toggle="collapse" data-parent="accordion">Education Background</a>
					</h4>
				</div>
		</div>
	</div>
    <div id="collapsethree" class="panel-collapse collapse">
		<div class="panel-body"> 
		 <table class="titleBart">
                            <tr>
                                <td style="font-size:large;font-weight: bold;">
                                    &nbsp;&nbsp;&nbsp;Employee Education Background
                                </td>
								<!--<td style="width: 100px;">
								 <a  class='inline' style="text-decoration:none" href="#inline_content1"><input type="button" value="Add" id="editBut"></a> </td>-->
                            </tr>
                        </table><br>

		 <table  class="TFtable" id="tableedu" border="1px solid" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr class="pluginth">
                    <th style="width:10px">No.</th>
                    <th style="width:300px">Institute Names</th>
                  
                    <th style="width:100px">Qualification</th>
                    <th style="width:50px">Completion Date</th>
					<th style="width:50px">Transcript</th>
                    <th style="width:50px">Action</th>

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
				         <td style="width:10px">' .  $num_loan . '</td>
                        <td style="width:300px">' . $uni . '</td>
						<td style="width:100px">' . $level . '</td>
                        
                        <td style="width:50px">' . $year . '</td>';
				if($attachment!=null){
					echo '<td class="aligncentertable" style="width:50px"><a href="uploads/transcript/' .$attachment. '" target="_blank"><input type="button" value="View" id="editBut"></a></td>';
					}else{
					echo '<td class="aligncentertable" style="width:50px"></td>';
					}
					if($igen_a_hr == "a_hr_edit"){
                    echo'
                        <td style="width:50px; cursor:pointer"><a  class="inline" style="text-decoration:none" href="#inline_content" alt="'.$row['id'].'"> <input type="button" value="Edit" id="editBut"> </a></td>';
					}else{
						echo '<td class="aligncentertable" style="width:50px;">-</td>';
					}
                   echo'</tr>';
            }
            ?>
        </table>
     </div>
	 </div>
	 <input type="hidden" value="" id="t_id">
	 <script>
	$(document).ready(function() {
		 $(".inline").click(function(){
		 var t_id=$(this).attr("alt_t")
		 //$("#t_id").val(t_id);
		
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
		 
		 })
		
		 	//$(".inline").colorbox({inline:true, width:"50%"
		
			//});
				//alert(1)
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
		
    } );
	
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
 </script>
 <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapsefour" data-toggle="collapse" data-parent="accordion">Employee History</a>
					</h4>
				</div>
		</div>
	</div>
    <div id="collapsefour" class="panel-collapse collapse">
		<div class="panel-body"> 
          <p>
		   <table class="titleBart">
                            <tr>
                                <td style="font-size:large;font-weight: bold;">
                                    &nbsp;&nbsp;&nbsp;Employee History
                                </td>
								<!--<td style="width: 100px;">
								 <a  class='inline' style="text-decoration:none" href="#inline_content2"><input type="button" value="Add"   id="editBut"></a></td>-->
                            </tr>
                        </table><br>
		  <div id="emh" style="margin-bottom:3%">

		 <table  class="TFtable" id="tableh" border="1px solid" style="border-collapse: collapse; width: 100%">
            <thead>
                <tr class="pluginth">
                    <th style="width:30px">No.</th>
                    <th style="width:300px">Company Name</th>
                  
                    <th style="width:50px">From Year</th>
                    <th style="width:50px">To Year</th>
					<th style="width:500px">Reason</th> 
                    <th style="width:50px">Action</th>

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
				         <td style="width:5px">' .  $num_loan . '</td>
                        <td style="width:150px">' . $company . '</td>
						<td style="width:50px">' . $from . '</td>
                        
                        <td style="width:50px">' . $to . '</td>
						<td style="width:150px">' . $reason . '</td>';
					if($igen_a_hr == "a_hr_edit"){
                    echo'
                        <td style="width:50px; cursor:pointer"><a  class="inline" style="text-decoration:none" alt1="h" href="#inline_content3" alt="'.$row['id'].'"> <input type="button" value="Edit" id="editBut"> </a></td>';
					}else{
						echo'<td>-</td>';
					}
                   echo'</tr>';
            }
            ?>
        </table>
     </div>
  </div>
 </div>
 <!-- <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapsefive" data-toggle="collapse" data-parent="accordion">Employee Performance</a>
					</h4>
				</div>
		</div>
	</div>
    <div id="collapsefive" class="panel-collapse collapse" >
		<div class="panel-body"> 
		<table class="titleBart">
					<tr>
						<td style="font-size:large;font-weight: bold;">
						&nbsp;&nbsp;&nbsp;Employee Performance
						</td>
						<td style="width: 100px;">
					   </td>
					</tr>
		</table><br>
		<table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
						 <thead><tr>           
						<td class="title_bold" style="width: 150px;">Employee Name</td>
						<td class="title_bold" style="width: 150px;">Appraisal Period</td>
						<td class="title_bold" style="width: 150px;">From Date</td>
						<td class="title_bold" style="width: 150px;">To Date</td>
						<td class="title_bold" style="width: 150px;">Evaluated By</td>
						<td class="title_bold" style="width: 150px;">Status</td>
						<td class="title_bold" style="width: 10px;">Action</td>
						</tr>    </thead>
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


			<input type="button" value="Edit" onClick="process(<?php echo $row_r['id'] ;?>)" id="editBut">

				</td>
			<?php
			}else{
			echo'<td style="width:100px"><a href="?eloc=emp_appraisal&id='.$row_r['id'].'"><input type="button" value="VIEW" id="editBut" ></a></td>';

			}

			?>
			</tr>

			<?php

			}

			?>

			</table>
	</div>
</div> -->
		 
		
 <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapsesix" data-toggle="collapse" data-parent="accordion">Employee Record</a>
					</h4>
				</div>
		</div>
	</div>
    <div id="collapsesix" class="panel-collapse collapse">
		<div class="panel-body"> 
                    <table id="titleBar">
                        <tr>
                            <td style="font-size:large;font-weight: bold; ">
                                &nbsp;&nbsp;&nbsp;Records
                            </td>
                        </tr>
                    </table>

                    <div style="overflow:auto;width:98.5%;min-height: 500px;">
                        <div class="record_div">
                            <table style="width: 100%;">
                                <tr style="cursor:pointer;" onclick="loan(this)">
                                    <td id="loan" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                                        <img id="loan_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Loan</span></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:20px;">
                                        <div id="loanDiv" style="display:none;" >
                                            <?php include 'e_loanDiv.php'; ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="record_div">
                            <table style="width: 100%;">
                                <tr onclick="property(this)" style="cursor:pointer;">
                                    <td id="property" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                                        <img id="property_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Company Asset</span></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:20px;">
                                        <div id="propertyDiv" style="display:none;" >
                                            <?php include 'e_proDiv.php'; ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
						<div class="record_div">
							<table style="width: 100%;">
								<tr onclick="benefits(this)" style="cursor:pointer;">
									<td id="benefits" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
										<img id="benefits_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Benefits Entitled</span></td>
								</tr>
								<tr>
									<td style="padding-left:20px;">
										<div id="benefitsDiv" style="display:none;" >
										
											<?php include 'e_benefitDiv.php'; ?>
										</div>
									</td>
								</tr>
							</table>
						</div>
                        <div class="record_div">
                            <table style="width: 100%;">
                                <tr onclick="leave(this)" style="cursor:pointer;">
                                    <td id="leave" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                                        <img id="leave_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Leave</span></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:20px;">
                                        <div id="leaveDiv" style="display:none;" >
                                            <?php include 'e_leaveDiv.php'; ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
						 <div class="record_div">
            <table style="width: 100%;">
                <tr onclick="training(this)" style="cursor:pointer;">
                    <td id="training" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="training_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Training</span></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="trainingDiv" style="display:none;" >
                            <?php include 'e_div_training.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
                   <!--     <div class="record_div">
                            <table style="width: 100%;">
                                <tr onclick="remark(this)" style="cursor:pointer;">
                                    <td id="remark" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                                        <img id="remark_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Incident Management</span></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:20px;">
                                        <div id="remarkDiv" style="display:none;" >
                                            <?php// include 'e_remark.php'; ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>-->
                        <div class="record_div">
                            <table style="width: 100%;">
                                <tr onclick="claim(this)" style="cursor:pointer;">
                                    <td id="l_claim" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                                        <img id="l_claim_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Claim</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:20px;">
                                        <div id="claimDiv" style="display:none;" >
                                            <?php include 'e_claim.php'; ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="record_div">
                            <table style="width: 100%;">
                                <tr onclick="advsal(this)" style="cursor:pointer;">
                                    <td id="advsal" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                                        <img id="advsal_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Advance Salary</span></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:20px;">
                                        <div id="advsalDiv" style="display:none;" >
                                            <?php include 'e_adv_salary.php'; ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="record_div">
                            <table style="width: 100%;">
                                <tr onclick="allowance(this)" style="cursor:pointer;">
                                    <td id="allowance" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                                        <img id="allowance_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Allowance</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left:20px;">
                                        <div id="allowanceDiv" style="display:none;" >
                                            <?php include 'e_allowance_div.php'; ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                      
                  </div>
				  </div>
			</div>
		</div>
        
            <!--end of employee info-->	
			
    <script>
    function salary(){
	
        var o = document.getElementById("salary");
        o.style.color="orchid";

        var p = document.getElementById("personal");
        p.style.color="black";
        var o = document.getElementById("ttable");
        o.style.color="black";
        var o = document.getElementById("record");
        o.style.color="black";

        $('#sal').toggle('slow', function() {
        });
        $('#pi').hide('slow', function() {
        });
        $('#tt').hide('slow', function() {
        });
        $('#r').hide('slow', function() {
        });

    }
	  function personal(){

        var o = document.getElementById("personal");
        o.style.color="orchid";

        var p = document.getElementById("salary");
        p.style.color="black";
        var o = document.getElementById("ttable");
        o.style.color="black";
        var o = document.getElementById("record");
        o.style.color="black";

        $('#pi').toggle('slow', function() {
        });
        $('#sal').hide('slow', function() {
        });
        $('#tt').hide('slow', function() {
        });
        $('#r').hide('slow', function() {
        });
       

    }
	
	function record()
    {
        var o = document.getElementById("record");
        o.style.color="orchid";

        var p = document.getElementById("salary");
        p.style.color="black";
        var r = document.getElementById("personal");
        r.style.color="black";
        var o = document.getElementById("ttable");
        o.style.color="black";


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
        alltitle(obj,"advsal");
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
    function leave(obj){
        $('#leaveDiv').toggle('slow');
        alltitle(obj,"leave");
    }
	function training(obj){

        $('#trainingDiv').toggle('slow');
        alltitle(obj,"training");
    }
    
    function salaryhistory(){
        window.open('?widget=e_salaryhistory','mywindow','location=1,status=1,scrollbars=1,width=600,height=600');
    }
    function paysliphistory(){
        window.open('?widget=e_paysliphistory','mywindow','location=1,status=1,scrollbars=1,width=600,height=600');
    }
		  
	 $(document).ready(function() {
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
		 oTable = $('#table_p').dataTable({
            "bJQueryUI": true,                 
            "sPaginationType": "full_numbers"
        });
    } );
		  </script>

		
               

               
            <!--end of employee info-->
<?php

}

?>

<div  id='training_upload'>
<div  id="inn-training" style='padding:10px; height:auto;  background-color:#FFF;'>
<div style="padding: 5px 0px 5px 5px;">
    <input type="button"  id="editBut" value="Save" onclick="add_file()" style="width: 100px;margin-left:-10px"/>
	<input type="button"  id="editBut" class="cl" value="Cancel" onclick="close_ttUpload()" style="width: 100px;margin-left:10px"/>
    
	
</div>
<div  style="width: 95%;  margin-top:20px">
<table class="train">
 
 
					<tr>
                   <td id="dropFileForm">
		
								 <input type="file" name="files[]" id="fileInput" multiple onchange="addFiles(event)">

								  <label for="fileInput" id="fileLabel" ondragover="overrideDefault(event);fileHover();" ondragenter="overrideDefault(event);fileHover();" ondragleave="overrideDefault(event);fileHoverEnd();" ondrop="overrideDefault(event);fileHoverEnd();
										addFiles(event);">
									<img src="images/download.png"><br>
									 
									<span id="fileLabelText">
									<input type="text" id="uploaded_img" style="width:250px;" value="Choose a file or drag it here" readonly />
								
									</span>
									
									<span id="uploadStatus"></span>
								  </label>
			</td>
                </tr>
					 
					</table>

</div>
		
			
</div> 
</div>
	<!-- This contains the hidden content for Adding education background -->
		<div style='display:none;'>
			<div id='inline_content1' style='padding:10px; height:300px;  background-color:#E5E5E5;'>
			

<div style="padding: 5px 0px 5px 5px;">
    <input type="button"  id="editBut" value="Process" onclick="add_u()" style="width: 100px;margin-left:-10px"/>
	<input type="button"  id="editBut" class="cl" value="Cancel" onclick="close()" style="width: 100px;margin-left:10px"/>
    
	
</div>
<div  style="width: 95%; margin-top:20px">
<table class="ed">
 
  <tr >

                        <td style="width: 150px;">University Names<span class="red"> *</span></td>
                        <td style="margin-bottom:20px">
                            
                            <input type="text" id="name" style="width: 250px;" />
                        </td></tr>
						<tr>
						<td>Level<span class="red"> *</span></td>
                        <td>
                            
                            <input type="text" id="level" style="width: 250px;" />
                        </td>
                    </tr>
					<tr>
						<td>Session<span class="red"> *</span></td>
                        <td>
                            
                            <input type="text" id="year" style="width: 250px;" />
                        </td>
                    </tr>
					<tr>
                    <td style="vertical-align: top;">Transcript</td> 
                    <td>
                        <input type="file" name="file" id="fileInput">
                        <!--<input type="text" id="uploaded_img" style="width:250px; display: none; background-color:#D0D7F3;" readonly />-->
                    </td>
                </tr>
					 
					</table>

</div>
			
			
			</div> </div>
	
<!-- This contains the hidden content for Editing education background -->
		<div style='display:none;'>
			<div id='inline_content' style='padding:10px; height:300px;  background-color:#E5E5E5;'>

			
			
			</div> </div>
			
	<!-- This contains the hidden content for Adding Employment History -->
		<div style='display:none;' style="font-size:20px">
			<div id='inline_content2' style='padding:10px; height:300px;  background-color:#E5E5E5;'>
			

<div style="padding: 5px 0px 5px 5px;">
    <input type="button"  id="editBut" value="Process" onclick="add_emh()" style="width: 100px;margin-left:-10px"/>
    <input type="button"  id="editBut" class="cl" value="Cancel" onclick="close()" style="width: 100px;margin-left:10px"/>
	
</div>
<div  style="width: 95%; margin-top:20px">
<table class="emh">
 
  <tr >

                        <td style="width: 150px;">Company Name<span class="red"> *</span></td>
                        <td style="margin-bottom:20px">
                            
                            <input type="text" id="company" style="width: 250px;" />
                        </td></tr>
						<tr>
						<td>From Year<span class="red"> *</span></td> 
                        <td>
                            
                            <input type="text" id="from" maxlength="4" style="width: 250px;" />
                        </td>
                    </tr>
					<tr>
						<td>To Year<span class="red"> *</span></td>
                        <td>
                            
                            <input type="text" id="to" maxlength="4" style="width: 250px;" />
                        </td>
                    </tr>
					<tr>
						<td>Reason<span class="red"> *</span></td>
                        <td>
                            
                           <textarea id="reason"  rows="10" cols="39"> </textarea>
                        </td>
                    </tr>
					 
					</table>

</div>
			
			
			</div> </div>
<!-- This contains the hidden content for Editing Employment History -->
		<div style='display:none;'>
			<div id='inline_content3' style='padding:10px; height:300px;  background-color:#E5E5E5;'>

			
			
			</div> </div>


<script type="text/javascript"> 
 
function uploadImage(){
        $('#uploadImage').css({"display":"block"});
        $("#profileIMG").css({ // this is just for style
            "opacity": "3"
        });
    } 
	
	  function deletePic(loc,id){
	 
        var result = confirm('Are you sure you want to change your profile picture?');
        if(result){
           // mywindow = window.open('?widget=editprofileupload&employee='+id,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
        }
        uploadPic(id);
    }
    
    function noUploadImage(){
        $('#uploadImage').css({"display":"none"});
        $("#profileIMG").css({ // this is just for style
            "opacity": "3"
        });
    }
	 function uploadPic(id) {

        mywindow = window.open('?widget=editprofileupload&employee='+id,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
    }

    function chgPW(){
        var o = document.getElementById("passwordPop");
        o.style.display="block";
    }
    function checkPW(id){

        var pw0 = $('#pw0').val();
        var pw1 = $('#pw1').val();
        var pw2 = $('#pw2').val();
		pw0 = CryptoJS.MD5(pw0).toString();
		
        var pw9 = $('#hiddenField').val();
		
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
    
   

  
	 

    
   


    function tt()
    {
        var o = document.getElementById("ttable");
        o.style.color="orchid";

        var p = document.getElementById("salary");
        p.style.color="black";
        var r = document.getElementById("personal");
        r.style.color="black";
        var o = document.getElementById("record");
        o.style.color="black";


        $('#tt').toggle('slow', function() {
        });
        $('#sal').hide('slow', function() {
        });
        $('#pi').hide('slow', function() {
        });
        $('#r').hide('slow', function() {
        });
    }
   function upload_training(t_id){
	   $("#t_id").val(t_id);
	  $('#training_upload').show('slow', function() {
        });
   }
   function close_ttUpload(){
	  $('#training_upload').hide('slow', function() {
        });
   }

   

</script>

<style type="text/css">

    #viewProfileOuterDiv
    {
        border-color: #007DC5;
        border-style:solid;
        /*        margin-top: 20px;*/
        width:1180px;
        height:auto;
        min-height: 380px;
        padding-bottom: 30px;
    }

    #viewProfileTabs
    {
        font-size: 12pt;
        padding-top:20px;
        font-weight: bold;
    }

    #viewProfileTabs td
    {
        padding-left:20px;
        cursor:pointer;
        font-family: arial;
    }

    .viewProfileInfo
    {
        padding-left:20px
    }

    #titleBarTop
    {
        background-color: #007DC5;
        border-style:1;
        border-radius:5px;
        padding-top:3px;
        padding-bottom:3px;
        color:white;
        width:98%;
    }

    #titleBar
    {
        background-color: #007DC5;
        border-style:1;
        border-radius:5px;
        padding-top:3px;
        padding-bottom:3px;
        color:white;
        width: 98%;
    }
    .record_div{
        -moz-border-radius: 10px;
        border-radius: 10px;
        border:solid;
        border-color:#E3E3E3;  
        width: 99%;
    }
	#dropFileForm #fileLabel {
    width: 96% !important;
}

</style>
<input type="hidden" id="em_id" value="<?php  echo $getID ;?>">
<style type="text/css">
table.ed tr td {padding-bottom:10px}
    #passwordPop {

        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:200px;  
        width:400px;  
        background:#FFFFFF;  
        left: 500px;
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
div#inn-training {
    border-radius: 4px;
    width: 32%;
    position: relative;
    top: 649px;
    left: 34%;
    border: 6px solid #9c9c9c;
}
div#training_upload {
	display:none;
    background: #0605057a;
    width: 1302px;
    height: 1450px;
    margin: auto;
    position: absolute;
    top: 0px;
    /*z-index: 1000;*/
}

table#tableh th.ui-state-default{
	width:1px !important;
}

</style>
<!--
<link rel="stylesheet" type="text/css" href="css/jAlert-v2.css">
<script src='https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src='js/jAlert-v2.js'></script> -->
<!--plug-in* <<datatable>> -->
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#loantable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		
		 oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true,                 
            "sPaginationType": "full_numbers"
        });
    } );


    $(document).ready(function() {
        oTable = $('#propertyTable').dataTable({ 
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );


    $(document).ready(function() {
        oTable = $('#tableAllowance').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    $(document).ready(function() {
        oTable = $('#eloantable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    $(document).ready(function() {
        oTable = $('#eprotable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    $(document).ready(function() {
        oTable = $('#eremarktable').dataTable({ 
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    $(document).ready(function() {
        oTable = $('#eclaimtable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    $(document).ready(function() {
        oTable = $('#eallowancetable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    $(document).ready(function() {
        oTable = $('#eadvsaltable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
	function add_file(){
	
       var id=$("#t_id").val();
	  
	   var uploaded_img = $('#uploaded_img').val();
	   var files = $('#fileInput')[0].files[0];
	   var ext_arr = ['png','jpg','gif','pdf','PNG','JPG','GIV','PDF'];
	   var ext =$('#uploaded_img').val().replace(/^.*\./, '');
		if(jQuery.inArray(ext, ext_arr)==-1){
			alert("Please upload image or pdf file only");
			exit;
		}
		
		var formData = new FormData();
		formData.append("fileInput",files);
		formData.append("id",id);
    
        /*if(uploaded_img==""){
            alert("Please Upload The File");*/
			
        //}else{
		
            $.ajax({
                type:'POST',
                url:"?widget=add_file",
                data: formData,
				processData: false,
				contentType: false,
				success:function(data){
                  if(data!=0){
					  alert("Successfully uploaded");
					  location.reload();
				   }else{
					alert("Error while processing");
				   }
                }
            });
        //}
    }

function add_u(){
	
       var name=$("#name").val();
	   var year=$("#year").val();
	   var level=$("#level").val();
	   var uploaded_img = $('#uploaded_img').val();
       var em_id =$("#em_id").val();
	   var files = $('#fileInput')[0].files[0];
	   var uploaded_img = $('#fileInput').val();
	   var formData = new FormData();
	   formData.append("name",name);
	   formData.append("year",year);
	   formData.append("em_id",em_id);
	   formData.append("level",level);
	   formData.append("fileInput",files);
	   var ext_arr = ['png','jpg','gif','PNG','JPG','GIV', 'pdf', 'PDF'];
	   var ext =$('#fileInput').val().replace(/^.*\./, '');
	   if(jQuery.inArray(ext, ext_arr)==-1 && uploaded_img!=""){
		   alert("Please upload image only");
		   exit;
	   }		   
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
			 if(uploaded_img == "" || uploaded_img == " "){
                error3.push("Transcript");
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
                data: formData,
				processData: false,
				contentType: false,
                success:function(data){
                  if(data!=0){
				 $("#edu").empty().append(data);
                  alert("Education background has been updated")
				  parent.jQuery.colorbox.close();
				  location.reload();
				   }
                }
            });
        }
    } 
	function add_emh(){
	
       var name=$("#company").val();
	   var from=$("#from").val();
	   var to=$("#to").val();
	   var reason =$("#reason").val();
       var em_id =$("#em_id").val();
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
                  alert("Employee History has been updated")
				   parent.jQuery.colorbox.close();
				   location.reload();
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
				 $("#emh").empty().append(data);
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
				/*
				 if(uploaded_img == "" || uploaded_img == " "){
					error3.push("Transcript");
				}
				*/
			
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
					 level:level,
					 year:year,
					 id:id,
					 em_id:em_id,
					 action:"edit" 
					   
					},
					success:function(data){
					
					if(data!=0){
					 $("#edu").empty().append(data);
					  alert("Education background has been updated")
					   parent.jQuery.colorbox.close();
					     location.reload();
					   }
					}
				});
			}
			
	}
	
function process(val){
	window.open('?eloc=emp_appraisal&id='+val, '_parent');
}
$(document).ready(function() {

        oTable = $('#tableedu, #tablefamily, #benefitsTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 oTable = $('#tableh').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 
		
    } ); 
	
	$(".cl").click(function () {
			parent.jQuery.colorbox.close();
		});
	var dropFileForm = document.getElementById("dropFileForm");
	//var #uploaded_img = document.getElementById("uploaded_img");
	var uploadStatus = document.getElementById("uploadStatus");
	var fileInput = document.getElementById("fileInput");
	var droppedFiles;

	function overrideDefault(event) {
	  event.preventDefault();
	  event.stopPropagation();
	}

	function fileHover() {
	  dropFileForm.classList.add("fileHover");
	  
	}

	function fileHoverEnd() {
	  dropFileForm.classList.remove("fileHover");
	}

	function addFiles(event) {
	  droppedFiles = event.target.files || event.dataTransfer.files;
	  //$("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);
	  showFiles(droppedFiles);
	}

	function showFiles(files) {
		$("input[type='file']").prop("files", files);
	  if (files.length > 1) {
		 $("#uploaded_img").val(files.length + " files selected");
		//fileLabelText.innerText = files.length + " files selected";
	  } else {
		 $("#uploaded_img").val(files[0].name);
		//fileLabelText.innerText = files[0].name;
	  }
	}

	function changeStatus(text) {
	  uploadStatus.innerText = text;
	}
	
	 

</script>
	
</div>	
















