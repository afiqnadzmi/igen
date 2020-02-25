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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Holiday Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
    <div class="header_text">
        <span>Holiday Maintenance</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <?php
                if (isset($_GET['occ_id'])) {
                    $sql_result = mysql_query("SELECT * FROM public_holiday WHERE id = " . $_GET['occ_id'] . ";");
                    while ($newArray = mysql_fetch_array($sql_result)) {
                        ?>
                        <table>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="button" value="Save" onclick="e_save(<?php echo $_GET['occ_id'] ?>)" style="width: 70px;" />
                                    <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                                </td>
                            </tr> 
                            <tr>
                                <td style="width: 200px;">Occasion Name</td>
                                <td><input class="input_text" type="text" name="occasion" id="e_occasion" style="width: 250px" value="<?php echo $newArray['occasion_name'] ?>"/></td>
                            </tr>
                            <tr>
                                <td>From Date</td>
                                <td><input class="input_text" type="text" id="e_startdate" name="startdate" style="width: 250px" value="<?php echo date('d-m-Y',strtotime($newArray['from_date'])) ?>"/></td>
                            </tr>
                            <tr>
                                <td>To Date</td>
                                <td><input class="input_text" type="text" id="e_enddate" name="enddate" style="width: 250px" value="<?php echo date('d-m-Y',strtotime($newArray['to_date'])) ?>"/></td>
                            </tr>
                        </table>
                    <?php }
                } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" onclick="addholiday()" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Occasion Name</td>
                            <td><input class="input_text" type="text" name="occasion" id="occasion" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>From Date</td>
                            <td><input class="input_text" type="text" id="startdate" name="startdate"  value="" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td>To Date</td>
                            <td><input class="input_text" type="text" id="enddate" name="enddate" value="" style="width: 250px"/></td>
                        </tr>    
                    </table>
                <?php } ?>
                <?php
            } elseif ($igen_a_m == "a_m_view") {
                $sql_result = mysql_query("SELECT * FROM public_holiday WHERE id = " . $_GET['view_id'] . ";");
                $newArray = mysql_fetch_array($sql_result);
                ?>
                <table>
                    <tr>
                        <td style="width: 200px;">Occasion Name</td>
                        <td><input class="input_text" type="text" name="occasion" id="e_occasion" style="width: 250px" value="<?php echo $newArray['occasion_name'] ?>" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>From Date</td>
                        <td><input class="input_text" type="text" id="e_startdate" name="startdate" style="width: 250px" value="<?php echo date('d-m-Y',strtotime( $newArray['from_date'])) ?>" disabled="disabled"/></td>
                    </tr>
                    <tr>
                        <td>To Date</td>
                        <td><input class="input_text" type="text" id="e_enddate" name="enddate" style="width: 250px" value="<?php echo date('d-m-Y',strtotime($newArray['to_date'] ))?>" disabled="disabled"/></td>
                    </tr>
                </table>
            <?php } ?>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Holiday List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Occasion</th>
                        <th style="width:150px">Start date</th>
                        <th style="width:150px">End date</th>
                        <th style="width: 100px;" class="aligncentertable">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * FROM public_holiday';
                $rs = mysql_query($sql);

                while ($row = mysql_fetch_array($rs)) {
                    $i = $i + 1;
                    $occasion_name = $row['occasion_name'];
                    $startDate = $row['from_date'];
                    $endDate = $row['to_date'];
                    $occ_id = $row['id'];

                    echo'<tr class="plugintr">
                        <td>' . $i . '</td>
                        <td>' . $occasion_name . '</td>
                        <td>' . date('d-m-Y',strtotime($startDate)) . '</td>
                        <td>' . date('d-m-Y',strtotime($endDate)) . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="Edit" href="javascript:void()" onclick="edit(' . $occ_id . ')"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title="Delete" href="javascript:void()" onclick="deleteholiday(' . $occ_id . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a title="View" href="javascript:void()" onclick="view(' . $occ_id . ')"><i class="far fa-eye" aria-hidden="true"></i></a></td>';
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
        window.location="?loc=holiday_management&view_id=" + id;
    }
    function clearNew(){
        window.location="?loc=holiday_management";
    }
    function edit(id){
        window.location = "?loc=holiday_management&occ_id=" + id;
    }
	$("#startdate, #enddate").datepicker({
        dateFormat: 'dd-mm-yy',
        onSelect: function (){
            var from = $("#startdate").val();
            var to = $("#enddate").val();
            
        },
		onClose: function( selectedDate ) {
    $( "#enddate" ).datepicker( "option", "minDate", selectedDate );
	}
    });
    
   
    $(function() {
        $("#e_startdate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
    
    $(function() {
        $("#e_enddate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
    function addholiday(){
        var occasion_name = $('#occasion').val();
        var start_date = $('#startdate').val();
        var end_date = $('#enddate').val();
        
        var error1 = [];
        
        if(occasion_name == "" || occasion_name == " "){
            error1.push("Occasion Name");
        }
        if(start_date == "" || start_date == " "){
            error1.push("Start Date");
        }
        if(end_date == "" || end_date == " "){
            error1.push("End Date");
        }
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
                
        var data1 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1;
        }
                
        if(error1.length > 0){
            alert(data1);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=addholiday",
                data:{
                    occasion_name:occasion_name,
                    start_date:start_date,
                    end_date:end_date
                },
                success:function(data){
                    if(data==true){
                        alert("Holiday Added");
                        window.location='?loc=holiday_management';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
    }
    
    function deleteholiday(occid){

        var result = confirm("Are you sure you want to delete this record?");
        
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?widget=deleteholiday',
                data:{
                    occid:occid
                },

                success:function(data){
                    if(data==true){
                        alert("Holiday Deleted");
                        window.location='?loc=holiday_management';
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }
    
    function e_save(id){
        var occasion_name = $('#e_occasion').val();
        var start_date = $('#e_startdate').val();
        var end_date = $('#e_enddate').val();
        var occ_id = id;
        
        var error1 = [];
        
        if(occasion_name == "" || occasion_name == " "){
            error1.push("Occasion Name");
        }
        if(start_date == "" || start_date == " "){
            error1.push("Start Date");
        }
        if(end_date == "" || end_date == " "){
            error1.push("End Date");
        }
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
                
        var data1 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1;
        }
                
        if(error1.length > 0){
            alert(data1);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=editholiday",
                data:{
                    occasion_name:occasion_name,
                    start_date:start_date,
                    end_date:end_date,
                    occ_id:occ_id
                },
                success:function(data){
                    if(data == true){
                        alert("Holiday Updated");
                        window.location='?loc=holiday_management';
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