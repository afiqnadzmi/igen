<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
</script>

<div class="main_div">
<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Training Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <?php if ($igen_a_m == "a_m_edit") { ?>
        <div class="header_text">
            <span>Training Maintenance</span>
        </div>
        <div class="main_content">
            <div class="tablediv">
                <?php
                $sql2 = 'SELECT * FROM training WHERE id = ' . $_GET['training_id'] . '';
                $rs2 = mysql_query($sql2);
                while ($row2 = mysql_fetch_array($rs2)) { 
                    $training_name = $row2['training_name'];
                    $position = $row2['position'];
                    $startDate = $row2['from_date'];
                    $endDate = $row2['to_date'];
					$duration = $row2['duration'];
                    $training_id = $row2['id'];
					$emp_id=$row2['emp_id'];
					$b_a=$row2['b_a'];
					$a_b=$row2['a_b'];
                    $venue = $row2['venue'];
                    $train_desc = $row2['train_desc'];
                    $start_time = $row2['start_time']; 
                    $end_time = $row2['end_time'];
                }
                if (isset($_GET['training_id']) == true) {
				  
				 $emp_id =explode(",",$emp_id);
				
                    ?>
                    <table id="tbl">
                        <tr>
                            <td colspan="4">
                                <input type="button" class="button" value="Save" onclick="edittraining(<?php echo $training_id ?>)" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr>
                        <tr> 
                            <td style="width: 200px;">Training Name</td>
                            <td><input type="text" class="input_text" name="training" id="training" value="<?php echo $training_name ?>" style="width: 250px"/></td>
                            <td rowspan="3" style="padding-left: 50px; vertical-align: top;width: 180px;">Venue</td>
                            <td rowspan="3" style="vertical-align: top;"><TEXTAREA id="venue" class="input_textarea" NAME="venue" style="width: 250px; height: 70px;"><?php echo $venue ?></TEXTAREA></td>
                        </tr>
						<tr>
                            <td>Company</td>
                            <td>
                                <select class="input_text" name="selectcomp" id="selectcomp" style="width: 250px;">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    $query2 = "SELECT * FROM company ORDER BY name";
                                    $rs3 = mysql_query($query2);
                                    while ($row3 = mysql_fetch_array($rs3)) {
                                        $comp_name = $row3['name'];
                                        $comp_id = $row3['id'];

                                        echo '<option  value="' . $comp_id . '">' . $comp_name . '</option>';
                                    }
                                    ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Position</td>
                            <td>
                                <select class="input_text" name="selectpos" id="selectpos" style="width: 250px;">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    $query2 = "SELECT * FROM position ORDER BY position_name";
                                    $rs3 = mysql_query($query2);
                                    while ($row3 = mysql_fetch_array($rs3)) { 
                                        $position_name = $row3['position_name'];
                                        $pos_id = $row3['id'];
                                        if ($position == $position_name) {
                                            echo '<option  value="' . $pos_id . '" selected="selected">' . $position_name . '</option>';
                                        } else {
                                            echo '<option  value="' . $pos_id . '">' . $position_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select></select><input type="button" value=" + " onclick="addrow(this,<?php echo $pos_id; ?>)" name="addr" />
                            </td>
                        </tr>
						 <tr>
                        <td style="vertical-align:top">Employee <span class="red"> *</span></td>
                        <td>
                            <a class="selectEmployee"><select multiple size="5" class="input_text" name="employee_list_view" id="employee_list_view" style="width: 250px;" >
							  
                                    <?php
                                    $query2 = "SELECT * FROM employee ORDER BY full_name";
                                    $rs3 = mysql_query($query2);
                                    while ($row3 = mysql_fetch_array($rs3)) {
                                        
                                        $id = $row3['id'];
										 foreach($emp_id as $eid){
										
                                        if ($id==$eid) {
                                            echo '<option  value="' . $id . '" >' . $row3['full_name'] . '</option>';
                                        }
										
										}
                                    }
                                    ?>
							
							</select></a>
                        </td>
                    </tr> 
					<tr>
                            <td>Budget Allocated</td>
                            <td><input type="text" class="input_text" id="b_a"   value="<?php echo $b_a;  ?>" style="width: 250px"/></td>
                        </tr>
						<tr>
                            <td>Actual Budget</td>
                            <td><input type="text" class="input_text" id="a_b"   value="<?php echo $a_b;  ?>" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>From Date</td>
                            <td><input type="text" class="input_text" id="startdate" name="startdate"  value="<?php echo $startDate ?>" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td>To Date</td>
                            <td><input type="text" id="enddate" name="enddate" class="input_text" value="<?php echo $endDate ?>" style="width: 250px"/></td>
                            <td rowspan="3" style="padding-left: 50px; vertical-align: top;">Training Description</td>
                            <td rowspan="3" style="vertical-align: top;"><TEXTAREA id="train_desc" class="input_textarea"NAME="train_desc" style="width: 250px; height: 70px;"><?php echo $train_desc ?></TEXTAREA></td>
                        </tr>
						<tr>
                            <td>duration</td>
                            <td><input type="text" id="duration" name="duration" class="input_text" value="<?php echo $duration ?>" style="width: 250px"/></td>
                            
                        </tr>

                        <tr>
                            <td>Start Time</td>
                            <td>
                                <?php
                                $startTime = explode(":", $start_time);
                                ?>
                                <select id="start_time1">
                                    <?php
                                    for ($i = 0; $i <= 23; $i++) {
                                        $start1 = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        if ($startTime[0] == $start1) {
                                            echo '<option selected="true" value="' . $start1 . '">' . $start1 . '</option>';
                                        } else {
                                            echo '<option value="' . $start1 . '">' . $start1 . '</option>';
                                        }
                                    }
                                    ?>
                                </select>:<select id="start_time2">
                                    <?php
                                    for ($i = 0; $i <= 59; $i++) {
                                        $start2 = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        if ($startTime[1] == $start2) {
                                            echo '<option selected="true" value="' . $start2 . '">' . $start2 . '</option>';
                                        } else {
                                            echo '<option value="' . $start2 . '">' . $start2 . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>      
                        </tr>

                        <tr>
                            <td>End Time</td>
                            <td>
                                <?php
                                $endTime = explode(":", $end_time);
                                ?>
                                <select id="end_time1">
                                    <?php
                                    for ($i = 0; $i <= 23; $i++) {
                                        $end1 = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        if ($endTime[0] == $end1) {
                                            echo '<option selected="true" value="' . $end1 . '">' . $end1 . '</option>';
                                        } else {
                                            echo '<option value="' . $end1 . '">' . $end1 . '</option>';
                                        }
                                    }
                                    ?>
                                </select>:<select id="end_time2">
                                    <?php
                                    for ($i = 0; $i <= 59; $i++) {
                                        $end2 = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        if ($endTime[1] == $end2) {
                                            echo '<option selected="true" value="' . $end2 . '">' . $end2 . '</option>';
                                        } else {
                                            echo '<option value="' . $end2 . '">' . $end2 . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>     
                        </tr> 
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                <?php } else { ?>
                    <table id="tbl">
                        <tr>
                            <td colspan="4">
                                <input type="button" class="button" value="Add" onclick="addtraining()" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr>    
                        <tr>
                            <td style="width: 200px;">Training Name</td>
                            <td><input type="text" class="input_text" name="training" id="training" style="width: 250px"/></td>
                            <td rowspan="3" style="vertical-align: top;width: 180px;padding-left: 50px;">Venue</td>
                            <td rowspan="3" style="vertical-align: top;"><TEXTAREA id="venue" class="input_textarea" NAME="venue" style="width: 250px; height: 70px;"></TEXTAREA></td>
                        </tr>
                       <tr>
                            <td>Company</td>
                            <td>
                                <select class="input_text" name="selectcomp" id="selectcomp" style="width: 250px;">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    $query2 = "SELECT * FROM company ORDER BY name";
                                    $rs3 = mysql_query($query2);
                                    while ($row3 = mysql_fetch_array($rs3)) {
                                        $comp_name = $row3['name'];
                                        $comp_id = $row3['id'];

                                        echo '<option  value="' . $comp_id . '">' . $comp_name . '</option>';
                                    }
                                    ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Position</td>
                            <td>
                                <select class="input_text" name="selectpos" id="selectpos" style="width: 250px;">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    $query2 = "SELECT * FROM position ORDER BY position_name";
                                    $rs3 = mysql_query($query2);
                                    while ($row3 = mysql_fetch_array($rs3)) {
                                        $position_name = $row3['position_name'];
                                        $pos_id = $row3['id'];

                                        echo '<option  value="' . $pos_id . '">' . $position_name . '</option>';
                                    }
                                    ?>
                                </select><input type="button" value=" + " onclick="addrow(this,<?php echo $pos_id; ?>)" name="addr" />
                            </td>
                        </tr>
						 <tr>
                        <td style="vertical-align:top">Employee <span class="red"> *</span></td>
                        <td>
                            <a class="selectEmployee"><select multiple size="5" class="input_text" name="employee_list_view" id="employee_list_view" style="width: 250px;" ></select></a>
                        </td>
                    </tr> 
					<tr>
                            <td>Budget Allocated</td>
                            <td><input type="text" class="input_text" id="b_a"   value="" style="width: 250px"/></td>
                        </tr>
						<tr>
                            <td>Actual Budget</td>
                            <td><input type="text" class="input_text" id="a_b"   value="" style="width: 250px"/></td>
                        </tr>
						<tr>
                            <td>From Date</td>
                            <td><input type="text" class="input_text" id="startdate" name="startdate"  value="" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td>To Date</td>
                            <td><input type="text" id="enddate" name="enddate" class="input_text" value="" style="width: 250px"/></td>
                            <td rowspan="3" style="padding-left: 50px; vertical-align: top;">Training Description</td>
                            <td rowspan="3" style="vertical-align: top;"><TEXTAREA id="train_desc" class="input_textarea"NAME="train_desc" style="width: 250px; height: 70px;"></TEXTAREA></td>   
                        </tr>
                        <tr>
                            <td>Duration</td>
                            <td><input type="text" id="duration" name="duration" class="input_text" value="" style="width: 250px"/></td>
                               
                        </tr>
                        <tr>
                            <td>Start Time</td>
                            <td> 
                                <select id="start_time1">
                                    <?php
                                    for ($i = 0; $i <= 23; $i++) {
                                        $start1 = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        echo '<option value="' . $start1 . '">' . $start1 . '</option>';
                                    }
                                    ?>
                                </select>:<select id="start_time2">
                                    <?php
                                    for ($i = 0; $i <= 59; $i++) {
                                        $start2 = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        echo '<option value="' . $start2 . '">' . $start2 . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>      
                        </tr>

                        <tr>
                            <td>End Time</td>
                            <td>
                                <select id="end_time1">
                                    <?php
                                    for ($i = 0; $i <= 23; $i++) {
                                        $end1 = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        echo '<option value="' . $end1 . '">' . $end1 . '</option>';
                                    }
                                    ?>
                                </select>:<select id="end_time2">
                                    <?php
                                    for ($i = 0; $i <= 59; $i++) {
                                        $end2 = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        echo '<option value="' . $end2 . '">' . $end2 . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>     
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                <?php } ?>
            </div>
        </div>
        <br/><br/>
        <?php
    } elseif ($igen_a_m == "a_m_view") {
        $sql2 = 'SELECT * FROM training WHERE id = ' . $_GET['view_id'] . '';
        $rs2 = mysql_query($sql2);
        $row2 = mysql_fetch_array($rs2);
        $training_name = $row2['training_name'];
        $position = $row2['position'];
        $startDate = $row2['from_date'];
        $endDate = $row2['to_date'];
        $training_id = $row2['id'];
        $venue = $row2['venue'];
        $train_desc = $row2['train_desc'];

        $start = explode(":", $row2['start_time']);
        $end = explode(":", $row2['end_time']);

        $start_time = $start[0] . ':' . $start[1] . ' ' . $start[2];
        $end_time = $end[0] . ':' . $end[1] . ' ' . $end[2];
        ?>
        <div class="header_text">
            <span>Training Maintenance</span>
        </div>
        <div class="main_content">
            <div class="tablediv">
                <table>
                    <tr>
                        <td style="width: 200px;">Training Name</td>
                        <td><input type="text" class="input_text" name="training" id="training" value="<?php echo $training_name ?>" style="width: 250px" readonly="readonly"/></td>
                        <td rowspan="3" style="padding-left: 50px; vertical-align: top;width: 180px;">Venue</td>
                        <td rowspan="3" style="vertical-align: top;"><TEXTAREA id="venue" class="input_textarea" NAME="venue" style="width: 250px; height: 70px;" readonly="readonly"><?php echo $venue ?></TEXTAREA></td>
                    </tr>
                    <tr>
                        <td>Position</td>
                        <td>
                            <select class="input_text" name="selectpos" id="selectpos" style="width: 250px;" disabled="disabled">
                                <option value="">--Please Select--</option>
                                <?php
                                $query2 = "SELECT * FROM position ; ";
                                $rs3 = mysql_query($query2);
                                while ($row3 = mysql_fetch_array($rs3)) {
                                    $position_name = $row3['position_name'];
                                    $pos_id = $row3['id'];
                                    if ($position == $position_name) {
                                        echo '<option  value="' . $pos_id . '" selected="selected">' . $position_name . '</option>';
                                    } else {
                                        echo '<option  value="' . $pos_id . '">' . $position_name . '</option>';
										
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr> 
					
                    <tr>
                        <td>From Date</td>
                        <td><input type="text" class="input_text" id="startdate" name="startdate"  value="<?php echo $startDate ?>" style="width: 250px" disabled="disabled"/></td>
                    </tr>

                    <tr>
                        <td>To Date</td>
                        <td><input type="text" id="enddate" name="enddate" class="input_text" value="<?php echo $endDate ?>" style="width: 250px" disabled="disabled"/></td>
                        <td rowspan="3" style="padding-left: 50px; vertical-align: top;">Training Description</td>
                        <td rowspan="3" style="vertical-align: top;"><TEXTAREA id="train_desc" class="input_textarea"NAME="train_desc" style="width: 250px; height: 70px;" readonly="readonly"><?php echo $train_desc ?></TEXTAREA></td>
                    </tr>
                    
                    <tr>
                        <td>Start Time</td>
                        <td><input type="text" class="input_text" name="time" id="time" value="<?php echo $start_time ?>" style="width: 250px" readonly="readonly"/></td>      
                    </tr>
                    <tr>
                        <td>End Time</td>
                        <td><input type="text" class="input_text" name="time" id="time" value="<?php echo $end_time ?>" style="width: 250px" readonly="readonly"/></td>      
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
        <br/><br/>
    <?php } ?>
    <div class="header_text">
        <span>Training List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Training</th>
                        <th style="width:150px">Position</th>
                        <th class="aligncentertable" style="width: 100px;">Start Date</th>
                        <th class="aligncentertable" style="width: 100px;">End Date</th>
						<th class="aligncentertable" style="width: 100px;">duration</th>
                        <th class="aligncentertable" style="width: 100px;">Start Time</th>
						<th class="aligncentertable" style="width: 100px;">company</th>
                        <th style="width:180px">Venue</th>
                        <th class="aligncentertable" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * FROM training';
                $rs = mysql_query($sql);
                $num = 0;
                while ($row = mysql_fetch_array($rs)) {
                    $num = $num + 1;
                    $training_name = $row['training_name'];
                    $position = $row['position'];
                    $startDate = $row['from_date'];
                    $endDate = $row['to_date'];
                    $training_id = $row['id'];
					$duration = $row['duration'];
                    $venue = substr($row['venue'], 0, 23) . '...';
                    $train_desc = $row['train_desc'];
                    $start_time = $row['start_time'];
					$companyID=$row['companyID'];
					$sql_comp = 'SELECT * FROM company WHERE id="'.$companyID.'"';
                $rs_comp = mysql_query($sql_comp);
                while ($row_comp = mysql_fetch_array($rs_comp)) {
				 $cmp_name=$row_comp['name'];
				}
				

                    echo'<tr class="plugintr">
                    <td>' . $num . '</td>
                    <td>' . $training_name . '</td>
                    <td>' . $position . '</td>
                    <td class="aligncentertable">' . $startDate . '</td>
                    <td class="aligncentertable">' . $endDate . '</td>
					<td class="aligncentertable">' . $duration . '</td>
                    <td class="aligncentertable">' . $start_time . '</td>
					<td class="aligncentertable">' . $cmp_name . '</td>
                    <td>' . $venue . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="Edit" href="?loc=training_management&training_id=' . $training_id . '"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;|&nbsp;<a title="Delete" href="javascript:void()" onclick="deletetraining(' . $training_id . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td title="View" class="aligncentertable"><a href="?loc=training_management&view_id=' . $training_id . '"><i class="far fa-eye" aria-hidden="true"></i></a></td>';
                    }
                    echo '</tr>';
                }
                ?> 
				
            </table>
        </div>
    </div>
</p></div></div></div>
<div class="alleg" style="display:none">
				<input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;margin-bottom: 3px; margin-top: -8px;" type="button" value="X">
				<table class="allegation" style="border-collapse: collapse;width: 100%; font-size: 13px;">
					
						
				</table>			
		</div>
<!-- This contains the hidden content for Editing education background -->
		<div style='display:none;' >
			<div id='inline_content' style='padding:10px; height:300px;  background-color:#E5E5E5;'>

			</div> </div>
<script type="text/javascript">

    function clearNew(){
        window.location='?loc=training_management';
    }
	
	$(function(){
		
		$("#duration").click(function(){
			var startdate=$("#startdate").val();
			var enddate=$("#enddate").val();
			var date2 = new Date(startdate); // 1st argument = year, 2nd = month - 1 (because getMonth() return 0-11 not 1-12), 3rd = date
			var date1 = new Date(enddate);
			var distance = date1.getTime() - date2.getTime();
			distance = Math.ceil(distance / 1000 / 60 / 60 / 24); // convert milliseconds to days. ceil to round up.

			$("#duration").val(distance);
		
		})
	
	})

  $("#startdate, #enddate").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (){
            var from = $("#startdate").val();
            var to = $("#enddate").val();
            
        },
		onClose: function( selectedDate ) {
    $( "#enddate" ).datepicker( "option", "minDate", selectedDate );
	}
    });
	
	function closePopoup(){
		$(".alleg").hide();
		$(".modalWindow").remove();
	}

    function addtraining(){
	  var y1="", str="";
        var training_name = $('#training').val();
        var start_date = $('#startdate').val();
        var end_date = $('#enddate').val();
        var venue = $('#venue').val();
		var duration= $('#duration').val();
        var train_desc = $('#train_desc').val();
        var start_time = $("#start_time1").val() + ":" + $("#start_time2").val();
        var end_time = $("#end_time1").val() + ":" + $("#end_time2").val();
        var position = $('#selectpos').val();
		var comp_id=$("#selectcomp").val();
		var b_a=$("#b_a").val();
		var a_b=$("#a_b").val() 
		
		var all_id="";
		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){
             
            y1=$(dom).find("[name=fy]").val();
            str+="," + y1
        }); 
		
		  $("#employee_list_view option").each(function()
        {
            all_id += jQuery(this).val()+",";
        });
		
		 var new_all_id = all_id.substring(0, all_id.length-1);
		
		
    
        var error1 = [];
        var error3 = [];
        
        if(training_name == '' || training_name == ' '){
            error1.push("Training Name");
        }
		if(comp_id == '' || comp_id == ' '){
            error1.push("Training Name");
        }
        if(start_date == '' || start_date == ' '){
            error1.push("Start Date");
        }
        if(end_date == '' || end_date == ' '){
            error1.push("End Date");
        }  
		if(duration == '' || duration == ' '){
            error1.push("Duration");
        }
		if(new_all_id == '' || new_all_id == ' '){
            error1.push("Employee");
        }
		if(b_a== '' || b_a == ' '){
            error1.push("Budget Allocated");
        }
		if(a_b== '' || a_b == ' '){
            error1.push("Actual Budget");
        }
        if(venue == '' || venue == ' '){
            error1.push("Venue");
        }
        if(train_desc == '' || train_desc == ' '){
            error1.push("Training Description");
        }
        if(position == ''){
            error3.push("Position");
        }

        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error3.length > 0){
            alert(data1 + data3);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=addtraining",
                data:{
                    training_name:training_name,
                    start_date:start_date,
                    end_date:end_date,
                    venue:venue,
                    train_desc:train_desc,
                    start_time:start_time,
					duration:duration,
                    position:position,
					str:str,
					comp_id:comp_id,
					a_b:a_b,
					b_a:b_a,
					new_all_id:new_all_id,
                    end_time:end_time
                },
                success:function(data){
					alert(data);
					exit();
                     if(data == true){
                        alert("Training Added");
                        window.location='?loc=training_management';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
    }
      function add_emp_list(){
       
       var position = $("#selectpos").val();
	    var y1="", str=position;
		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){
             
            y1=$(dom).find("[name=fy]").val();
            str+="," + y1
			
			
        });
			
			
        if(str != ""){
            if(str == ""){
                str = "ALL";
            }
            var url= "?widget=simulation_popup&p="+str;
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        }
    }
    function deletetraining(training_id){

        var result = confirm("Are you sure you want to delete this record?");
   
        if(result){
            $.ajax({
                type:'POST',
                url:'?widget=deletetraining',
                data:{
                    training_id:training_id
                },

                success:function(data){
                    if(data==true){
                        alert('Training Deleted');
                        window.location='?loc=training_management';
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }
	function addrow(obj,id){
	 $.ajax({
                type:'POST',
                url:"?widget=addrow",
                data:{
				action:id
                    
                },
                success:function(data){
				
			 $(obj).parent().parent().after("<tr  name='leave_row'><td></td><td><select class='input_text' name='fy' class='selectpos1' style='width: 250px;'><option value=''>--Please Select--</option>"+data+"</select><input type='button'  value=' + ' onclick='addrow(this,"+id+")' name='addr' />&nbsp;<input type='button'   value=' x ' onclick='removerow(this)' /></td></tr>");
        $(obj).hide();
                    
                }

            });
       
    }
	function removerow(obj){
        $(obj).parent().parent().prev().find("[name=addr]").show(); 
        $(obj).parent().parent().remove();
    }

    function edittraining(trainingid)
    {
	    var y1="", str=$("#selectpos").val();
  	 
        var training_name = $('#training').val();
        var start_date = $('#startdate').val();
        var end_date = $('#enddate').val();
        var venue = $('#venue').val();
        var train_desc = $('#train_desc').val();
		var duration = $('#duration').val();
        var start_time = $("#start_time1").val() + ":" + $("#start_time2").val();
        var end_time = $("#end_time1").val() + ":" + $("#end_time2").val();
        var training_id = trainingid;
		var comp_id=$("#selectcomp").val();
        var position_id = $('#selectpos').val();
		var b_a=$("#b_a").val();
		var a_b=$("#a_b").val()
		var  all_id="";
		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){
             
            y1=$(dom).find("[name=fy]").val();
            str+="," + y1
			
			
        });

		
		
	    $("#employee_list_view option").each(function()
        {
            all_id += jQuery(this).val()+",";
        });
		
		 var new_all_id = all_id.substring(0, all_id.length-1);
		
      
        var error1 = [];
        var error3 = [];
        
        if(training_name == '' || training_name == ' '){
            error1.push("Training Name");
        }
		if(comp_id == '' || comp_id == ' '){
            error1.push("Training Name");
        }
        if(start_date == '' || start_date == ' '){
            error1.push("Start Date");
        }
        if(end_date == '' || end_date == ' '){
            error1.push("End Date");
        }
		if(duration == '' || duration == ' '){
            error1.push("Duration");
        }
        if(venue == '' || venue == ' '){
            error1.push("Venue");
        }
        if(train_desc == '' || train_desc == ' '){
            error1.push("Training Description");
        }
        if(position_id == ''){
            error3.push("Position");
        }

        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error3.length > 0){
            alert(data1 + data3);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=edittraining",
                data:{
                    training_name:training_name,
                    start_date:start_date,
                    end_date:end_date,
                    venue:venue,
                    train_desc:train_desc,
                    training_id:training_id,
                    start_time:start_time,
                    position_id:position_id,
					duration:duration,
					str:str,
					comp_id:comp_id,
					new_all_id:new_all_id,
					b_a:b_a,
					a_b:a_b,
                    end_time:end_time
                }, 
                success:function(data){
				
                    if(data == true){
                        alert("Training Updated");
                        window.location='?loc=training_management';
                    }else{
                        alert("Error While Processing");
                    }
                }

            });
        }
    }
	
	 $(".selectEmployee").click(function(){
	    var position = $("#selectpos").val();
	    var y1="", str=position;
	   $("#tbl").children().find("[name=leave_row]").each(function(i,dom){
             
            y1=$(dom).find("[name=fy]").val();
            str+="," + y1
        });
	
		if(str!=""){
		
		  $.ajax({
                type:'POST',
                url:"?widget=training_popup",
                data:{
				 str:str,
                },
                success:function(data){
					//$("#inline_content").empty().append("dkkdkdkdkdkdkkdkkdkdd");
					//alert(data);
					//exit();
					$(".alleg").show();
					$("<div class='modalWindow'></div>").insertBefore("#MainContainer");
					$(".alleg").empty().append(data);
                  
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
				
	function select_all(){
	
		$("input").attr("checked",true);
    }
    function deselect_all(){
		
        $("input").attr("checked",false);
    }
	
	function done(){
    
        var ids = new Array();
        var names = new Array();
        $("input:checkbox:checked").each(function(i,dom){
            ids[i] = $(dom).val();
            names[i] = "<option>" + $(dom).attr("name") + "</option>";
        });
        var newStr = ids.toString();
       
        $.ajax({
            type:"POST",
            url:"?widget=append_emp",
            data:{
                newStr:newStr
            },
            success:function(data){
		
                if(data != false){ 
				
                    $("#employee_ids").html(newStr);
                    $("#employee_list_view").empty().append(data);
					closePopoup();
                   //  parent.jQuery.colorbox.close();
					 
					 
                }else{
                   
                }
            }
        });
    }
	
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>