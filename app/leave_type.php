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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Leave Type Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Leave Type Maintenance</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <?php
                $sql2 = "SELECT * FROM leave_type WHERE id = " . $_GET[leave_id] . ";";
                $sql_result2 = mysql_query($sql2);
                while ($row = mysql_fetch_array($sql_result2)) {
                    $leave_type = $row['type_name'];
                    $leave_id = $row['id'];
                }

                if (isset($_GET["leave_id"]) == true) {
                    ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" value="Save" class="button" onclick="editleavetype('<?php echo $leave_id ?>')" style="width: 70px;"/>
                                <input type="button" value="Clear" class="button" onclick="clearNew()" style="width: 70px;"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Name </td>
                            <td><input type="text" class="input_text" id="add_name" value ="<?php echo $leave_type ?>" style="width: 250px;"/></td>
                        </tr>
                    </table>
                <?php } else { ?>
                    <table>
                        <tr>
                            <td>
                                <input type="button" value="Add" class="button" onclick="save()" style="width: 70px;"/>
                                <input type="button" value="Clear" class="button" onclick="clearNew()" style="width: 70px;"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Name </td>
                            <td><input type="text" class="input_text" id="add_name" style="width: 250px;"/></td>
                        </tr>
                    </table>
                    <?php
                }
            } elseif ($igen_a_m == "a_m_view") {
                $sql2 = "SELECT * FROM leave_type WHERE id = " . $_GET[view_id] . ";";
                $sql_result2 = mysql_query($sql2);
                $row = mysql_fetch_array($sql_result2);
                $leave_type = $row['type_name'];
                $leave_id = $row['id'];
                ?>
                <table>
                    <tr>
                        <td style="width: 200px;">Name </td>
                        <td><input type="text" class="input_text" id="add_name" value ="<?php echo $leave_type ?>" style="width: 250px;" readonly="readonly"/></td>
                    </tr>
                </table>
            <?php } ?>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Leave Type List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Name</th>
                        <th class="aligncentertable" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM leave_type;";
                $sql_result = mysql_query($sql);

                while ($newArray = mysql_fetch_array($sql_result)) {
                    $t = $t + 1;

                    echo "<tr class='plugintr'>
                        <td>" . $t . "</td>
                    <td>" . $newArray['type_name'] . "</td>";
                    if ($igen_a_m == "a_m_edit") {
                        echo "<td class='aligncentertable'>";
						/*
                        if ($newArray['id'] < 5) {
                            echo "<a style='font-size: 10pt;color:blue;' onclick='edit(" . $newArray['id'] . ")'>Edit</a>";
                        } else {
						*/
                            echo "<a title='Edit' style='font-size: 10pt;color:blue;' onclick='edit(" . $newArray['id'] . ")'><i class='far fa-edit' style='color:#000;' ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title='Delete' style='font-size: 10pt;color:blue;' onclick='del(" . $newArray['id'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>";
                       // }
                        echo "</td>";
                    } elseif ($igen_a_m == "a_m_view") {
                        echo "<td class='aligncentertable'>";
                        echo "<a style='font-size: 10pt;color:blue;' onclick='view(" . $newArray['id'] . ")'><i class='far fa-eye' aria-hidden='true'></i></a>";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div> 
    </div>
</p></div></div></div>

<script type="text/javascript">
    function view(id){
        window.location="?loc=leave_type&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=leave_type';
    }
    function save(){
        var add_name = document.getElementById("add_name").value;
        if(add_name == "" || add_name == " "){
            alert("Please Insert Leave Type Name");
        }else{
            $.ajax({
                type:"POST",
                url:"?widget=leavetypeadd",
                data:{
                    add_name:add_name
                },
                success:function(data){
                    if(data == true){
                        alert("Leave Type Added");
                        window.location = '?loc=leave_type';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }

    function del(id){
        var id = id;
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=del_leave_type",
                data:{
                    id:id
                },
                success:function(data){
                    if(data == true){
                        alert("Leave Type Deleted");
                        window.location = '?loc=leave_type';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }

    function edit(id){
        window.location = "?loc=leave_type&leave_id=" + id;
    }

    function editleavetype(leave_id){
        var leave_type = $('#add_name').val();
    
        if(leave_type == ""){
            alert('Please Insert Leave Type Name');
        }else{
            $.ajax({
                type:"POST",
                url:"?widget=editleavetype",
                data:{
                    leave_type:leave_type,
                    leave_id : leave_id
                },
                success:function(data){
                    if(data == true){
                        alert("Leave Type Updated");
                        window.location='?loc=leave_type';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
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