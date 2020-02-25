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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">OverTime Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <?php if ($igen_a_m == "a_m_edit") { ?>
        <div class="header_text">
            <span>OverTime Maintenance</span>
        </div>
        <div class="main_content"> 
            <div class="tablediv">
                <?php
                $sql2 = 'SELECT * FROM overtime WHERE id = ' . $_GET['overtime_id'] . '';
                $rs2 = mysql_query($sql2);
                while ($row2 = mysql_fetch_array($rs2)) {
                    $overtime_name = $row2['overtime_name'];
                    $week_end_rate = $row2['week_end_rate'];
                    $holiday_rate = $row2['holiday_rate'];
                    $normal_rate = $row2['normal_rate'];
                    $overtime_id = $row2['id'];
                }
                if (isset($_GET['overtime_id']) == true) {
                    ?>  
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Save" onclick="editovertime(<?php echo $overtime_id ?>)" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr> 
                        <tr>
                            <td style="width:200px;">Overtime Name</td>
                            <td><input type="text" value="<?php echo $overtime_name ?>" class="input_text"  name="overtime_name" id="overtime_name" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td >Resting Day Rate</td>
                            <td ><input type="text" value="<?php echo $week_end_rate ?>" class="input_text" id="week_end_rate" name="week_end_rate"  value="" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td >Holiday Rate</td>
                            <td ><input type="text" class="input_text" id="holiday_rate" name="holiday_rate" value="<?php echo $holiday_rate ?>" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td >Normal Rate</td>
                            <td ><input type="text" class="input_text" id="normal_rate" name="normal_rate" value="<?php echo $normal_rate ?>" style="width: 250px"/></td>
                        </tr>   
                    </table>
                <?php } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" onclick="addovertime()" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr>  
                        <tr>
                            <td style="width: 200px;">Overtime Name</td>
                            <td><input type="text" class="input_text"  name="overtime_name" id="overtime_name" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td >Resting Day Rate</td>
                            <td ><input type="text" class="input_text" id="week_end_rate" name="week_end_rate"  style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td >Holiday Rate</td>
                            <td ><input type="text" class="input_text" id="holiday_rate" name="holiday_rate" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td >Normal Rate</td>
                            <td ><input type="text" class="input_text" id="normal_rate" name="normal_rate" style="width: 250px"/></td>
                        </tr>  
                    </table>
                <?php } ?>
            </div>
        </div>
        <br/><br/>
        <?php
    } elseif ($igen_a_m == "a_m_view") {
        $sql2 = 'SELECT * FROM overtime WHERE id = ' . $_GET['view_id'];
        $rs2 = mysql_query($sql2);
        $row2 = mysql_fetch_array($rs2);
        $overtime_name = $row2['overtime_name'];
        $week_end_rate = $row2['week_end_rate'];
        $holiday_rate = $row2['holiday_rate'];
        $normal_rate = $row2['normal_rate'];
        $overtime_id = $row2['id'];
        ?>
        <div class="header_text">
            <span>Overtime Maintenance</span>
        </div>
        <div class="main_content"> 
            <div class="tablediv">
                <table>
                    <tr>
                        <td style="width:200px;">Overtime Name</td>
                        <td><input type="text" value="<?php echo $overtime_name ?>" style="width: 250px" readonly="readonly"/></td>
                    </tr>

                    <tr>
                        <td >Resting day Rate</td>
                        <td ><input type="text" value="<?php echo $week_end_rate ?>" readonly="readonly" style="width: 250px"/></td>
                    </tr>

                    <tr>
                        <td >Holiday Rate</td>
                        <td ><input type="text" value="<?php echo $holiday_rate ?>" style="width: 250px" readonly="readonly"/></td>
                    </tr>

                    <tr>
                        <td >Normal Rate</td>
                        <td ><input type="text" value="<?php echo $normal_rate ?>" style="width: 250px" readonly="readonly"/></td>
                    </tr>   
                </table>
            </div>
        </div>
        <br/><br/>
    <?php } ?>
    <div class="header_text">
        <span>OverTime List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Overtime Name</th>
                        <th class="aligncentertable" style="width:150px">Resting day rate</th>
                        <th class="aligncentertable" style="width:150px">Holiday rate</th>
                        <th class="aligncentertable" style="width:150px">Normal rate</th>
                        <th class="aligncentertable" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * FROM overtime';
                $rs = mysql_query($sql);

                while ($row = mysql_fetch_array($rs)) {
                    $i = $i + 1;
                    $overtime_name = $row['overtime_name'];
                    $week_end_rate = $row['week_end_rate'];
                    $holiday_rate = $row['holiday_rate'];
                    $normal_rate = $row['normal_rate'];
                    $overtime_id = $row['id'];

                    echo'<tr class="plugintr">
                        <td>' . $i . '</td>
                        <td style="width:250px">' . $overtime_name . '</td>
                        <td class="aligncentertable">' . $week_end_rate . '</td>
                        <td class="aligncentertable">' . $holiday_rate . '</td>
                        <td class="aligncentertable">' . $normal_rate . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="Edit" href="?loc=overtime_management&overtime_id=' . $overtime_id . '"><i class="far fa-edit" style="color:#000;"></i></a>&nbsp;|&nbsp;<a title="Delete" href="javascript:void()" onclick="deleteovertime(' . $overtime_id . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a title="View" href="?loc=overtime_management&view_id=' . $overtime_id . '"><i class="far fa-eye" aria-hidden="true"></i></a></td>';
                    }
                    echo '</tr>';
                }
                ?> 
				
            </table>
        </div>
    </div>
</p></div></div></div>

<script type="text/javascript">
    function view(id){
        window.location="?loc=overtime_management&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=overtime_management';
    }
    function addovertime(){
        var overtime_name = $('#overtime_name').val();
        var week_end_rate = $('#week_end_rate').val();
        var holiday_rate = $('#holiday_rate').val();
        var normal_rate = $('#normal_rate').val();
        
        var error1 = [];
        var error2 = [];
        
        if(overtime_name == '' || overtime_name == ' '){
            error1.push("Overtime Name");
        }
        if(week_end_rate == '' || week_end_rate == ' '){
            error1.push("Resting Day Rate");
        }else{
            if(week_end_rate.match(/^\d+$/) || week_end_rate.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Resting Day Rate");
            }   
        }
        if(holiday_rate == '' || holiday_rate == ' '){
            error1.push("Holiday Rate");
        }else{
            if(holiday_rate.match(/^\d+$/) || holiday_rate.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Holiday Rate");
            }   
        }
        if(normal_rate == '' || normal_rate == ' '){
            error1.push("Normal Rate");
        }else{
            if(normal_rate.match(/^\d+$/) || normal_rate.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Normal Rate");
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
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1 + data2);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=addovertime",
                data:{
                    overtime_name:overtime_name,
                    week_end_rate:week_end_rate,
                    holiday_rate:holiday_rate,
                    normal_rate:normal_rate
                },
                success:function(data){
                    if(data == true){
                        alert("Overtime Added");
                        window.location='?loc=overtime_management';
                    }else{
                        alert("Error While Processing");
                    }
                }

            });
        }
    }
    
    function deleteovertime(overtimeid){

        var result = confirm("Are you sure you want to delete this record?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?widget=deleteovertime',
                data:{
                    overtimeid:overtimeid
                },

                success:function(data){
                    if(data==true){
                        alert('Overtime Deleted');
                        window.location='?loc=overtime_management';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
    
    function editovertime(overtimeid)
    {
        var overtime_name = $('#overtime_name').val();
        var week_end_rate = $('#week_end_rate').val();
        var holiday_rate = $('#holiday_rate').val();
        var normal_rate = $('#normal_rate').val();
        var overtime_id = overtimeid;
  
        var error1 = [];
        var error2 = [];
        
        if(overtime_name == '' || overtime_name == ' '){
            error1.push("Overtime Name");
        }
        if(week_end_rate == '' || week_end_rate == ' '){
            error1.push("Resting Day Rate");
        }else{
            if(week_end_rate.match(/^\d+$/) || week_end_rate.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Resting Day Rate");
            }   
        }
        if(holiday_rate == '' || holiday_rate == ' '){
            error1.push("Holiday Rate");
        }else{
            if(holiday_rate.match(/^\d+$/) || holiday_rate.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Holiday Rate");
            }   
        }
        if(normal_rate == '' || normal_rate == ' '){
            error1.push("Normal Rate");
        }else{
            if(normal_rate.match(/^\d+$/) || normal_rate.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Normal Rate");
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
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1 + data2);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=editovertime",
                data:{
                    overtime_name:overtime_name,
                    week_end_rate:week_end_rate,
                    holiday_rate:holiday_rate,
                    normal_rate:normal_rate,
                    overtime_id:overtime_id
                },
                success:function(data){
                    if(data==true){
                        alert("Overtime Updated");
                        window.location='?loc=overtime_management';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
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