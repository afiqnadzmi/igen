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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Position Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Position Maintenance</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <?php
                $sql2 = 'SELECT * FROM position WHERE id=' . $_GET['pos_id'] . '';
                $rs2 = mysql_query($sql2);
                while ($row2 = mysql_fetch_array($rs2)) {
                    $position_name = $row2['position_name'];
                    $desc = $row2['position_desc'];
                    $pos_id = $row2['id'];
                    $epf_rate = $row2['epf_rate'];
                    $employer_epf_rate = $row2['employer_epf_rate'];
                    $time_att = $row2['time_att'];
                    $late_early = $row2['late_early'];
                }

                if (isset($_GET['pos_id']) == true) {
                    echo '
                    <table>
                        <tr>
                            <td colspan="2">
                            <input type="button" class="button" value="Save" onclick="editposition(' . $pos_id . ')" style="width: 70px;" />
                            <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                            </td>
                        </tr> 
                        <tr>
                            <td style="width: 200px;">Position Name</td>
                            <td><input class="input_text" value= "' . $position_name . '" type="text" name="position" id="position" style="width: 250px"/></td>
                        </tr>
                        
                        <tr>
                            <td style="vertical-align: top;">Description</td>
                            <td><textarea name="desc" id="desc" style="width: 250px; height: 100px">' . $desc . '</textarea></td>
                        </tr>
                        
                        <tr>
                            <td>EPF Rate (%)</td>
                            <td><input class="input_text" value="' . $epf_rate . '" type="text" name="level" id="epf_rate" style="width: 250px"/>&nbsp;&nbsp;(optional)</td>
                        </tr>
						
						 <tr>
                            <td>Employer EPF Rate (%)</td>
                            <td><input class="input_text" value="' . $employer_epf_rate . '" type="text" name="level" id="employer_epf_rate" style="width: 250px"/>&nbsp;&nbsp;(optional)</td>
                        </tr>
						
						<tr>
                            <td style="vertical-align: top;">Time Attendance</td>
                            <td>
							<input type="radio" name="time_attr" value="0"  onclick="etime_att(0)" ';
                    print ($time_att == 0) ? "checked" : "";
                    print '/> Yes<br/>
							<input type="radio" name="time_attr" value="1"  onclick="etime_att(1)" ';
                    print ($time_att == 1) ? "checked" : "";
                    print ' /> No<br/>
							</td>
                        </tr>';
                    if ($time_att == 1) {
                        $time_att0 = 'style="display: none;"';
                    }
                    echo '<tr id="lateinout_tr" ' . $time_att0 . '>
                            <td style="vertical-align: top;">Late In Early Out</td>
                            <td>
							<input id="no_cal" type="radio" name="late_cal" value="0"';
                    print ($late_early == 0) ? "checked" : "";
                    print '/> No Calculation<br/>
							<input type="radio" name="late_cal" value="1"';
                    print ($late_early == 1) ? "checked" : "";
                    print '/> Included Lunch In & Out<br/>
							<input type="radio" name="late_cal" value="2"';
                    print ($late_early == 2) ? "checked" : "";
                    print '/> Excluded Lunch In & Out</td>
                        </tr>';
                    echo '</table>';
                } else {
                    echo '
                    <table>
                        <tr>
                            <td colspan="2">
                            <input type="button" class="button" value="Add" onclick="addposition()" style="width: 70px;" />
                            <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                            </td>
                        </tr> 
                        <tr>
                            <td style="width: 200px;">Position Name</td>
                            <td><input class="input_text" type="text" name="position" id="position" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top;">Description</td>
                            <td><textarea name="desc" id="desc" style="width: 250px; height: 100px"></textarea></td>
                        </tr>
                        
                        <tr>
                            <td>EPF Rate (%)</td>
                            <td><input class="input_text" value="' . $epf_rate . '" type="text" name="level" id="epf_rate" style="width: 250px"/>&nbsp;&nbsp;(optional)</td>
                        </tr>
						
						 <tr>
                            <td>Employer EPF Rate (%)</td>
                            <td><input class="input_text" value="' . $employer_epf_rate . '" type="text" name="level" id="employer_epf_rate" style="width: 250px"/>&nbsp;&nbsp;(optional)</td>
                        </tr>
						
						 <tr>
                            <td style="vertical-align: top;">Time Attendance</td>
                            <td>
							<input type="radio" name="time_attr" value="0" onclick="time_att(0)" /> Yes<br/>
							<input type="radio" name="time_attr" value="1" onclick="time_att(1)"/> No<br/>
							</td>
                        </tr>';


                    echo '<tr id="lateinout_tr" style="display: none;">
                            <td style="vertical-align: top;">Late In Early Out</td>
                            <td>
							<input id="no_cal" type="radio" name="late_cal" cheched value="0"/> No Calculation<br/>
							<input type="radio" name="late_cal" value="1"/> Included Lunch In & Out<br/>
							<input type="radio" name="late_cal" value="2"/> Excluded Lunch In & Out
							</td>
                        </tr>
                        
                    </table>';
                }
            } elseif ($igen_a_m == "a_m_view") {
                $sql2 = 'SELECT * FROM position WHERE id=' . $_GET['view_id'] . '';
                $rs2 = mysql_query($sql2);
                $row2 = mysql_fetch_array($rs2);
                $position_name = $row2['position_name'];
                $desc = $row2['position_desc'];
                $pos_id = $row2['id'];
                $epf_rate = $row2['epf_rate'];
                $time_att = $row2['time_att'];
                $late_early = $row2['late_early'];
                $employer_epf_rate = $row2['employer_epf_rate'];
                echo '<table>
                        <tr>
                            <td style="width: 200px;">Position Name</td>
                            <td><input class="input_text" value= "' . $position_name . '" type="text" name="position" id="position" style="width: 250px" readonly="readonly"/></td>
                        </tr>
                        
                        <tr>
                            <td style="vertical-align: top;">Description</td>
                            <td><textarea name="desc" id="desc" style="width: 250px; height: 100px" readonly="readonly">' . $desc . '</textarea></td>
                        </tr>
                        
                        <tr>
                            <td>EPF Rate (%)</td>
                            <td><input class="input_text" value="' . $epf_rate . '" type="text" name="level" id="epf_rate" style="width: 250px" readonly="readonly"/></td>
                        </tr>
				<tr>
                            <td>Employer EPF Rate (%)</td>
                            <td><input class="input_text" value="' . $employer_epf_rate . '" type="text" name="level" id="employer_epf_rate" style="width: 250px"/></td>
                        </tr>		
						<tr>
                            <td style="vertical-align: top;">Time Attendance</td>
                            <td>
							<input type="radio" name="time_attr" value="0"';
                print ($time_att == 0) ? "checked" : "";
                print ' disabled /> Yes<br/>
							<input type="radio" name="time_attr" value="1"';
                print ($time_att == 1) ? "checked" : "";
                print ' disabled /> No<br/>
							</td>
                        </tr>
						
						<tr>
                            <td style="vertical-align: top;">Late In Early Out</td>
                            <td>
							<input type="radio" name="late_cal" value="0"';
                print ($late_early == 0) ? "checked" : "";
                print ' disabled /> No Calculation<br/>
							<input type="radio" name="late_cal" value="1"';
                print ($late_early == 1) ? "checked" : "";
                print ' disabled /> Included Lunch In & Out<br/>
							<input type="radio" name="late_cal" value="2"';
                print ($late_early == 2) ? "checked" : "";
                print ' disabled /> Excluded Lunch In & Out
							</td>
                        </tr>
                    </table>';
            }
            ?> 
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Position List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Position Name</th>
                        <th style="width:200px">EPF Rate (%)</th>
                        <th style="width:200px">Employer EPF Rate (%)</th>
                        <th class="aligncentertable" style="width:100px">Head Count</th>
                        <th class="aligncentertable" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * FROM position';
                $rs = mysql_query($sql);

                while ($row = mysql_fetch_array($rs)) {
                    $i = $i + 1;
                    $position_name = $row['position_name'];
                    $desc = $row['position_desc'];
                    $pos_id = $row['id'];
                    $epf_rate = $row['epf_rate'];
                    $employer_epf_rate = $row['employer_epf_rate'];

                    $sql3 = 'SELECT id FROM employee WHERE position_id = ' . $pos_id;
                    $query3 = mysql_query($sql3);
                    $num_rows3 = mysql_num_rows($query3);

                    echo'<tr class="plugintr">
                        <td>' . $i . '</td>
                    <td>' . $position_name . '</td>
                    <td>' . $epf_rate . '</td>
                    <td>' . $employer_epf_rate . '</td>
                    <td class="aligncentertable">' . $num_rows3 . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="Edit" href="?loc=position_management&pos_id=' . $pos_id . '"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title="Delete" href="javascript:void()" onclick="deleteposition(' . $pos_id . ', ' . $num_rows3 . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a title="View" href="?loc=position_management&view_id=' . $pos_id . '"><i class="far fa-eye" aria-hidden="true"></i></a></td>';
                    }
                    echo '</tr>';
                }
                ?>  
            </table>
        </div>
    </div>
</p></div></div></div>

<script type="text/javascript">
  
    function time_att(ans){
        if(ans == 0){
           // $("#lateinout_tr").show();
		    $('#no_cal').attr('checked', 'checked');
            //$('#no_cal').attr('checked', false);
			 $("#lateinout_tr").hide();
        }else if(ans == 1){
            $("#lateinout_tr").hide();
            $('#no_cal').attr('checked', 'checked');
        }
    }
    function etime_att(ans){
        if(ans == 0){
           // $("#lateinout_tr").show();
		    $('#no_cal').attr('checked', 'checked');
           // $('#no_cal').attr('checked', false);
		    $("#lateinout_tr").hide();
        }else if(ans == 1){
            $("#lateinout_tr").hide();
            $('#no_cal').attr('checked', 'checked');
        }
    }
    function view(id){
        window.location="?loc=position_management&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=position_management';
    }
    
    
    function addposition(){
        var position_name = $('#position').val();
        var desc = $('#desc').val();
        var epf_rate = $('#epf_rate').val();
        var employer_epf_rate = $('#employer_epf_rate').val();
        var time_attr =$("input[name='time_attr']:checked").val();
        var late_cal =$("input[name='late_cal']:checked").val();
		
        if(time_attr == "0" && late_cal == "0"){
            time_attr = "1"
        }
                
        var error1 = [];
        var error3 = [];
                
        if(position_name == "" || position_name == " "){
            error1.push("Position Name");
        }
        if($("input[name='time_attr']:checked").val()==null){
            error3.push("Option for Time Attendance");
        }
        if($("input[name='late_cal']:checked").val()==null){
            error3.push("Option for Late In Early Out");
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
                url:"?widget=addposition",
                data:{
                    position_name:position_name,
                    desc:desc,
                    epf_rate:epf_rate,
                    employer_epf_rate:employer_epf_rate,
                    time_attr:time_attr,
                    late_cal:late_cal
                },
                success:function(data){
                    if(data==true){
                        alert("Position Added");
                        window.location='?loc=position_management';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
    }
    
    function deleteposition(posid, count){

        var result = confirm("Are you sure you want to delete this record?");
  
        if(result){
            if(count <= 0){
                $.ajax({
                    type:'POST',
                    url:'?widget=deleteposition',
                    data:{
                        posid:posid
                    },
                    success:function(data){
                        if(data==true){
                            alert("Position Deleted");
                            window.location='?loc=position_management';
                        }else{
                            alert('Error While Processing');
                        }
                    }
                })
            }else{
                alert("Position Can't be Deleted");
            }
        }
    }
    
    function editposition(posid)
    {
        var position_name = $('#position').val();
        var desc = $('#desc').val();
        var epf_rate = $('#epf_rate').val();
        var employer_epf_rate = $('#employer_epf_rate').val();
        var pos_id = posid;
        var time_attr =$("input[name='time_attr']:checked").val();
        var late_cal =$("input[name='late_cal']:checked").val();
        /*if(time_attr == "0" && late_cal == "0"){
            time_attr = "1";
        }*/
          
        if(position_name == "" || position_name == " "){
            alert("Please Insert Position Name");
        }else if($("input[name='time_attr']:checked").val()==null)
        {
            alert("Please Select Option for Time Attendance");
        }else if($("input[name='late_cal']:checked").val()==null)
        {
            alert("Please Select Option for Late In Early Out");
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=editposition",
                data:{
                    position_name:position_name,
                    desc:desc,
                    pos_id:pos_id,
                    time_attr:time_attr,
                    late_cal:late_cal,
                    epf_rate:epf_rate,
                    employer_epf_rate:employer_epf_rate
                },
                success:function(data){
                    if(data == true){
                        alert("Position Updated");
                        window.location='?loc=position_management';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
        }
    }
	
	$(document).ready(function(){
		 $("#lateinout_tr").hide();
	})
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>