<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$eid = isset($_GET["eid"]) ? $_GET["eid"] : "";
if ($eid != "") {
    $style = "block";
    $sql = "SELECT * FROM group_for_leave where id='" . $eid . "' limit 1";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
} else {
    $style = "none";
}
?>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    });
</script>
<div class="main_div">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Leave Group Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <?php if ($igen_a_m == "a_m_edit") { ?>
        <div class="header_text">
            <span>Leave Group Maintenance</span>
        </div>
        <div class="main_content" id ="addnewbox" style="display: block">
            <div class="tablediv">
                <table>
                    <tr>
                        <td colspan="2">
                            <?php if (isset($_GET["eid"]) == false) { ?>
                                <input type="button" class="button" value="Confirm" onclick="add_leave()" style="width: 70px;"/>
                            <?php } ?>
                            <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                            <span id="leaveIDSpan" style="display: none;"><?php echo $_GET["eid"]; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px;">Group Name</td>
                        <td><input type="text" class="input_text" id="group_name" value="<?php echo $row["group_name"] ?>" style="width: 250px;"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td>
                                        <select id="leave_list" multiple size="7" style="width: 160px;">
                                            <?php
                                            if ($eid != "") {
                                                $sql = "SELECT * FROM leave_type where id not in (
                                                        SELECT lt.id FROM leave_group lg join leave_type lt
							on lg.leave_type_id=lt.id
							where group_for_leave_id='" . $eid . "')
                                                        ORDER BY type_name";
                                                $sql_result = mysql_query($sql);
                                                while ($newArray = mysql_fetch_array($sql_result)) {
                                                    $leave_type = $newArray['type_name'];
                                                    $leave_id = $newArray['id'];
                                                    echo '<option value="' . $leave_id . '">' . $leave_type . '</opiton>';
                                                }
                                            } else {
                                                $sql = "SELECT * FROM leave_type ORDER BY type_name";
                                                $sql_result = mysql_query($sql);
                                                while ($newArray = mysql_fetch_array($sql_result)) {
                                                    $leave_type = $newArray['type_name'];
                                                    $leave_id = $newArray['id'];
                                                    echo '<option value="' . $leave_id . '">' . $leave_type . '</opiton>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td style="padding-left: 20px; padding-right: 20px;">
                                        <table>
                                            <tr>
                                                <td><input type="submit" class="button bold" value=">>" onclick="addtogroup()"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="submit" class="button bold" value="<<" onclick="removefromgroup()"/></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="selected_leave"></div>
                                        <select id="selected_leave_list" multiple size="7" style="width: 160px;">
                                            <?php
                                            if ($eid != "") {
                                                $sql2 = "SELECT *,lt.id as lg_id FROM leave_group lg join leave_type lt
                                                    on lg.leave_type_id=lt.id
                                                    where group_for_leave_id='" . $eid . "' group by lt.id ORDER BY lt.type_name";
                                                $sql_result = mysql_query($sql2);
                                                while ($newArray = mysql_fetch_array($sql_result)) {
                                                    $leave_type = $newArray['type_name'];
                                                    $leave_id = $newArray['lg_id'];
                                                    echo '<option value="' . $leave_id . '">' . $leave_type . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="main_content" id="updatetable" style="display: <?php echo $style ?>;">
            <div class="tablediv">
                <div style="padding-top: 10px;padding-bottom: 5px;">
                    <?php if ($eid != "") { ?>
                        <input type="button" class="button" value="Save" onclick="updategroup(<?php echo $eid ?>)" style="width: 70px;"/>
                    <?php } else { ?>
                        <input type='button' class="button" value='Add' onclick='savegroup()' style="width: 70px;" />
                    <?php } ?>
                </div>
                <div class="table">
                    <div style="border: 1px solid black; width: 850px; padding-bottom: 10px;background-color: beige;">
                        <table id="tbl" class="bold bordercollapse" style="width: 100%;">
                            <tr class="tableth">
                                <th style="width: 200px;">Leave Type</th>
                                <th style="width: 180px;">From Year</th>
                                <th style="width: 180px;">To Year</th>
                                <th style="width: 180px;">Days of Leave</th>
                                <th></th>
                            </tr>
                            <?php
                            if ($eid != "") {
                                $sql2 = "SELECT * FROM group_for_leave where id='" . $eid . "'";
                                $sql_result2 = mysql_query($sql2);
                                $newArray = mysql_fetch_array($sql_result2);

                                $sql1 = "SELECT * FROM leave_group l join leave_type lt
                                        on l.leave_type_id=lt.id 
					where group_for_leave_id='" . $eid . "'
                                        ORDER BY lt.type_name, l.from_year";
                                $sql_result1 = mysql_query($sql1);

                                $temp_name = "";
                                while ($newArray1 = mysql_fetch_array($sql_result1)) {
                                    ?>
                                    <tr class="tabletr" name='leave_row' style="background-color: beige; color: black;">
                                        <td>
                                            <?php
                                            if ($temp_name != $newArray1["type_name"]) {
                                                echo $newArray1["type_name"];
                                            }
                                            ?>
                                            <input name='tid' value='<?php echo $newArray1["id"]; ?>' type='hidden' />
                                        </td>
                                        <td>
                                            <input name='fy' type='text' value="<?php echo $newArray1["from_year"]; ?>" />
                                        </td>
                                        <td>
                                            <input name='ty' type='text' value="<?php echo $newArray1["to_year"]; ?>" />
                                        </td>
                                        <td>
                                            <input name='days' type='text' value="<?php echo $newArray1["days"]; ?>" />
                                        </td>
                                        <td>
                                            <input type="button" value=" + " onclick="addrow(this,<?php echo $newArray1["id"]; ?>)" name="addr" /><?php
                                if ($temp_name == $newArray1["type_name"]) {
                                                ?>
                                                <input type='button' value=' x ' onclick='removerow(this)' />
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $temp_name = $newArray1["type_name"];
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br/><br/>
    <?php } elseif ($igen_a_m == "a_m_view") { ?>
        <div class="header_text">
            <span>Leave Group Maintenance</span>
        </div>
        <div class="main_content" id ="addnewbox" style="display: block">
            <div class="tablediv">
                <table>
                    <tr>
                        <td style="width: 200px;">Group Name</td>
                        <td><input type="text" class="input_text" id="group_name" value="<?php echo $row["group_name"] ?>" style="width: 250px;" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td>
                                        <select id="leave_list" multiple size="7" style="width: 160px;" disabled="disabled">
                                            <?php
                                            if ($eid != "") {
                                                $sql = "SELECT * FROM leave_type where id not in (
									SELECT lt.id FROM leave_group lg join leave_type lt
									on lg.leave_type_id=lt.id
									where group_for_leave_id='" . $eid . "')";
                                                $sql_result = mysql_query($sql);
                                                while ($newArray = mysql_fetch_array($sql_result)) {
                                                    $leave_type = $newArray['type_name'];
                                                    $leave_id = $newArray['id'];
                                                    echo '<option value="' . $leave_id . '">' . $leave_type . '</opiton>';
                                                }
                                            } else {
                                                $sql = "SELECT * FROM leave_type;";
                                                $sql_result = mysql_query($sql);
                                                while ($newArray = mysql_fetch_array($sql_result)) {
                                                    $leave_type = $newArray['type_name'];
                                                    $leave_id = $newArray['id'];
                                                    echo '<option value="' . $leave_id . '">' . $leave_type . '</opiton>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td style="padding-left: 20px; padding-right: 20px;">
                                        <table>
                                            <tr>
                                                <td><input type="submit" class="button bold" value=">>" onclick="addtogroup()" readonly="readonly"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="submit" class="button bold" value="<<" onclick="removefromgroup()" readonly="readonly"/></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="selected_leave"></div>
                                        <select id="selected_leave_list" multiple size="7" style="width: 160px;" disabled="disabled">
                                            <?php
                                            if ($eid != "") {
                                                $sql2 = "SELECT *,lt.id as lg_id FROM leave_group lg join leave_type lt
                                                        on lg.leave_type_id=lt.id
							where group_for_leave_id='" . $eid . "' group by lt.id";
                                                $sql_result = mysql_query($sql2);
                                                while ($newArray = mysql_fetch_array($sql_result)) {
                                                    $leave_type = $newArray['type_name'];
                                                    $leave_id = $newArray['lg_id'];
                                                    echo '<option value="' . $leave_id . '">' . $leave_type . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="main_content" id="updatetable" style="display: <?php echo $style ?>;">
            <div class="tablediv">
                <div class="table">
                    <div style="border: 1px solid black; width: 850px; padding-bottom: 10px;background-color: beige;">
                        <table id="tbl" class="bold bordercollapse" style="width: 100%;">
                            <tr class="tableth">
                                <th style="width: 200px;">Leave Type</th>
                                <th>From Year</th>
                                <th>To Year</th>
                                <th>Days of Leave</th>
                                <th></th>
                            </tr>
                            <?php
                            if ($eid != "") {
                                $sql2 = "SELECT * FROM group_for_leave where id='" . $eid . "'";
                                $sql_result2 = mysql_query($sql2);
                                $newArray = mysql_fetch_array($sql_result2);

                                $sql1 = "SELECT * FROM leave_group l join leave_type lt
                                         on l.leave_type_id=lt.id 
					 where group_for_leave_id='" . $eid . "'
                                        ORDER BY lt.type_name, l.from_year";
                                $sql_result1 = mysql_query($sql1);

                                $temp_name = "";
                                while ($newArray1 = mysql_fetch_array($sql_result1)) {
                                    ?>
                                    <tr class="tabletr" name='leave_row' style="background-color: beige; color: black;">
                                        <td>
                                            <?php
                                            if ($temp_name != $newArray1["type_name"]) {
                                                echo $newArray1["type_name"];
                                            }
                                            ?>
                                            <input name='tid' value='<?php echo $newArray1["id"]; ?>' type='hidden' readonly="readonly" />
                                        </td>
                                        <td>
                                            <input name='fy' type='text' value="<?php echo $newArray1["from_year"]; ?>" readonly="readonly" />
                                        </td>
                                        <td>
                                            <input name='ty' type='text' value="<?php echo $newArray1["to_year"]; ?>" readonly="readonly" />
                                        </td>
                                        <td>
                                            <input name='days' type='text' value="<?php echo $newArray1["days"]; ?>" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <?php
                                    $temp_name = $newArray1["type_name"];
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br/><br/>
    <?php } ?>
    <div class="header_text">
        <span>Leave Group List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width:30px">No.</th>
                        <th>Leave Group Name</th>
                        <th class="aligncentertable" style="width:300px">Action</th>  
                    </tr>
                </thead>
                <?php
                $sql3 = 'SELECT * FROM group_for_leave';
                $rs3 = mysql_query($sql3);
                while ($row3 = mysql_fetch_array($rs3)) {
                    $i = $i + 1;
                    $gname = $row3['group_name'];
                    $career_id = $row3['id'];

                    echo '<tr class="plugintr">
                        <td>' . $i . '</td>
                        <td>' . $gname . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="edit" href="javascript:void()" onclick="edit(' . $career_id . ')"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title="Delete" href="javascript:void()" onclick="delete_group(' . $career_id . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a title="View" href="javascript:void()" onclick="view(' . $career_id . ')"><i class="far fa-eye" aria-hidden="true"></i></a></td>';
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
        window.location="?loc=leave_maintain&eid=" + id;
    }
    function addrow(obj,id){
        $(obj).parent().parent().after("<tr class='tabletr' name='leave_row'><td><input name='tid' value='"+id+"' type='hidden' /></td><td><input name='fy' type='text' value='' /></td><td><input name='ty' type='text' value='' /></td><td><input name='days' type='text' value='' /></td><td><input type='button' value=' + ' onclick='addrow(this,"+id+")' name='addr' />&nbsp;<input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
        $(obj).hide();
    }
    function removerow(obj){
        $(obj).parent().parent().prev().find("[name=addr]").show();
        $(obj).parent().parent().remove();
    }
    function clearNew(){
        window.location='?loc=leave_maintain';
    }
    function addnewbox(){
        $('#addnewbox').toggle('slow');
    }
    function add_leave(){
        var error1 = [];
        var error3 = [];
        
        var grp_name = $("#group_name").val();
        if(grp_name == "" || grp_name == " "){
            error1.push("Leave Group Name");
        }
        var l=$("#selected_leave_list").val();
        if(l!=null){
        }else{
            error3.push("Leave Type");
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
            $("#tbl").empty().append("<tr class='tableth'><th style='width: 200px;'>Leave Type</th><th style='width: 180px;'>From Year</th><th style='width: 180px;'>To Year</th><th style='width: 180px;'>Days of Leave</th><th></th></tr>");
            $("#selected_leave_list option").each(function(){
                $("#tbl").append("<tr name='leave_row' style='background-color: beige; color: black;'><td style='padding-left: 10px;'>"+$(this).text()+"<input name='tid' value='"+$(this).val()+"' type='hidden' /></td><td style='padding-left: 10px;'><input name='fy' type='text' /></td><td style='padding-left: 10px;'><input name='ty' type='text' /></td><td style='padding-left: 10px;'><input name='days' type='text' /></td><td style='padding-left: 10px;'><input type='button' value=' + ' onclick='addrow(this,"+$(this).val()+")' name='addr' /></td></tr>");
            });
            $('#updatetable').fadeIn();//.toggle('slow');
        }
    }
    
    function updategroup(gid){
        var id='', y1='', y2='', y3='',str='';
        var gn=$("#group_name").val();
        $("#tbl").children().find("[name=leave_row]").each(function(i,dom){
            id=$(dom).find("[name=tid]").val(); 
            y1=$(dom).find("[name=fy]").val();
            y2=$(dom).find("[name=ty]").val();
            y3=$(dom).find("[name=days]").val();
            str+=id+','+y1+','+y2+','+y3+';';
        });
        $.ajax({
            type:"POST",
            url:"?widget=update_group",
            data:{
                gn:gn,
                str:str,
                gid:gid
            },
            success:function(data){
                if(data == true){
                    alert("Leave Group Updated");
                    window.location = '?loc=leave_maintain';
                }else{
                    alert("Error While Processing");
                }
            }
        })
    }
    function addtogroup(){
        var leave_id = $("#leaveIDSpan").html();
        if(leave_id == ""){
            $("#leave_list option:selected").each(function(i,dom){
                $("#selected_leave_list").append(dom);
            }); 
        }else{
            $("#leave_list option:selected").each(function(i,dom){
                $("#selected_leave_list").append(dom);
            }); 
            
            var selectedOptions = $.map($('#selected_leave_list option'),
            function(e) { return $(e).val(); } );
            var list = selectedOptions.join(',');

            $.ajax({
                type:"POST",
                url:"?widget=getLeaveGroupType",
                data:{
                    leave_id:leave_id,
                    list:list
                },
                success:function(data){
                    $("#tbl").empty().append("<tr class='tableth'><th style='width: 200px;'>Leave Type</th><th style='width: 180px;'>From Year</th><th style='width: 180px;'>To Year</th><th style='width: 180px;'>Days of Leave</th><th></th></tr>");
                    $("#tbl").append(data);
                    $('#updatetable').fadeIn();//.toggle('slow');
                }
            })
        }
    }
    function removefromgroup(){
        var leave_id = $("#leaveIDSpan").html();
        if(leave_id == ""){
            $("#selected_leave_list option:selected").each(function(i,dom){
                $("#leave_list").append(dom);
            }); 
        }else{
            $("#selected_leave_list option:selected").each(function(i,dom){
                $("#leave_list").append(dom);
            }); 
            
            var selectedOptions = $.map($('#selected_leave_list option'),
            function(e) { return $(e).val(); } );
            var list = selectedOptions.join(',');

            $.ajax({
                type:"POST",
                url:"?widget=getLeaveGroupType",
                data:{
                    leave_id:leave_id,
                    list:list
                },
                success:function(data){
                    $("#tbl").empty().append("<tr class='tableth'><th style='width: 200px;'>Leave Type</th><th style='width: 180px;'>From Year</th><th style='width: 180px;'>To Year</th><th style='width: 180px;'>Days of Leave</th><th></th></tr>");
                    $("#tbl").append(data);
                    $('#updatetable').fadeIn();//.toggle('slow');
                }
            })
        }
    }
    
    function savegroup(){
        var id='', y1='', y2='', y3='',str='';
        var gn=$("#group_name").val();
        $("#tbl").children().find("[name=leave_row]").each(function(i,dom){
            id=$(dom).find("[name=tid]").val(); 
            y1=$(dom).find("[name=fy]").val();
            y2=$(dom).find("[name=ty]").val();
            y3=$(dom).find("[name=days]").val();
            str+=id+','+y1+','+y2+','+y3+';';
        });
        $.ajax({
            type:"POST",
            url:"?widget=save_group",
            data:{
                gn:gn,
                str:str
            },
            success:function(data){
                if(data == true){
                    alert("Leave Group Added");
                    window.location = '?loc=leave_maintain';
                }else{
                    alert("Error While Processing");
                }
            }
        })
    }
    function delete_group(id){
        var r=confirm("Are you sure you want to delete this record?");
        if(r){
            $.ajax({
                type:"POST",
                url:"?widget=del_leavegroup",
                data:{
                    id:id
                },
                success:function(data){
                    if(data == true){
                        alert("Leave Group Deleted");
                        window.location='?loc=leave_maintain';
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }
    function edit(id){
        window.location="?loc=leave_maintain&eid="+id;
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