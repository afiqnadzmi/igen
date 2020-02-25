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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Company Asset Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <?php if ($igen_a_m == "a_m_edit") { ?>
        <div class="header_text">Company Asset Maintenance</div>
        <div class="main_content">
            <div class="tablediv">

                <?php
                if (isset($_GET['pid']) == true) {
                    $sql_result1 = mysql_query("SELECT * FROM property WHERE id = " . $_GET['pid'] . ";");
                    while ($newArray1 = mysql_fetch_array($sql_result1)) {
                        ?>
                        <table>
                            <tr>
                                <td colspan="4">
                                    <input type="button" class="button" value="Save" style="width: 70px;" onclick="e_save_func(<?php echo $_GET['pid']; ?>)"/>
                                    <input type="button" class="button" value="Clear" style="width: 70px;" onclick="clearNew()"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px;">Name</td>
                                <td><input id="e_name" type="text" class="input_text" value="<?php echo $newArray1['property_name'] ?>" style="width: 250px;" /></td>
                                <td rowspan="4" valign="top" style="width:200px;padding-left: 50px;">Specification</td>
                                <td rowspan="4" valign="top"><textarea style="height:100px;width:250px;" class="input_textarea" id="e_spec"><?php echo $newArray1['specification'] ?></textarea></td>
                            </tr>
                            <tr>
                                <td>Serial No.</td>
                                <td><input id="e_serial" type="text" class="input_text" value="<?php echo $newArray1['serial_no'] ?>" style="width: 250px;" /></td>
                            </tr>
                            <tr>
                                <td>Stock in Date</td>
                                <td><input type="text" class="input_text"style="width: 250px" id="e_in_date"  value="<?php echo $newArray1['stock_in_date'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td><select id="e_category" class="input_text" style="width: 250px;">
                                        <option value="0">--Please Select--</option>
                                        <?php
                                        $sql = "SELECT * FROM property_category ORDER BY name";
                                        $sql_result = mysql_query($sql);
                                        while ($newArray = mysql_fetch_array($sql_result)) {
                                            if ($newArray1['category_id'] == $newArray['id']) {
                                                echo"<option value='" . $newArray['id'] . "' selected='selected'>" . $newArray['name'] . "</option>";
                                            } else {
                                                echo"<option value='" . $newArray['id'] . "'>" . $newArray['name'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Is Active</td>
                                <td>
                                    <?php if ($newArray1['is_active'] == "Y") { ?>
                                        <input type="radio" id="e_active" name="active" value="Y" checked>Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" id="e_active" name="active" value="N">No
                                    <?php } else { ?>
                                        <input type="radio" id="e_active" name="active" value="Y">Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" id="e_active" name="active" value="N" checked>No
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    <?php }
                } else { ?>
                    <table>
                        <tr>
                            <td colspan="4">
                                <input type="button" class="button" value="Add" style="width: 70px;" onclick="save_func()"/>
                                <input type="button" class="button" value="Clear" style="width: 70px;" onclick="clearNew()"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Name</td>
                            <td><input id="name" type="text" class="input_text" style="width: 250px;"/></td>
                            <td rowspan="4" valign="top" style="width:200px;padding-left: 50px;">Specification</td>
                            <td rowspan="4" valign="top"><textarea style="height:100px;width:250px;" class="input_textarea" id="spec"></textarea></td>
                        </tr>
                        <tr>
                            <td>Serial No.</td>
                            <td><input id="serial" type="text" class="input_text" style="width: 250px;"/></td>
                        </tr>
                        <tr>
                            <td>Stock in Date</td>
                            <td><input type="text" class="input_text"style="width: 250px" id="in_date" value="<?php print date('Y-m-d'); ?>"/></td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td><select id="category" class="input_text" style="width: 250px;">
                                    <option value="0">--Please Select--</option>
                                    <?php
                                    $sql = "SELECT * FROM property_category ORDER BY name";
                                    $sql_result = mysql_query($sql);
                                    while ($newArray = mysql_fetch_array($sql_result)) {
                                        echo"<option value='" . $newArray['id'] . "'>" . $newArray['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Is Active</td>
                            <td>
                                <input type="radio" id="active" name="active" value="Y" checked>Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="active" name="active" value="N">No
                            </td>
                        </tr>
                    </table>
                <?php } ?>
            </div>
        </div>
        <br/><br/>
        <?php
    } elseif ($igen_a_m == "a_m_view") {
        $sql1 = "SELECT * FROM property WHERE id = " . $_GET['view_id'];
        $query1 = mysql_query($sql1);
        $newArray1 = mysql_fetch_array($query1);

        $sql = "SELECT * FROM property_category;";
        $sql_result = mysql_query($sql);
        $row = mysql_fetch_array($sql_result);
        ?>
        <div class="header_text">Company Asset Maintenance</div>
        <div class="main_content">
            <div class="tablediv">
                <table>
                    <tr>
                        <td style="width: 200px;">Name</td>
                        <td><input id="e_name" type="text" class="input_text" value="<?php echo $newArray1['property_name'] ?>" style="width: 250px;" readonly="readonly" /></td>
                        <td rowspan="4" valign="top" style="width:200px;padding-left: 50px;">Specification</td>
                        <td rowspan="4" valign="top"><textarea style="height:100px;width:250px;" class="input_textarea" id="e_spec" readonly="readonly"><?php echo $newArray1['specification'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Serial No.</td>
                        <td><input id="e_serial" type="text" class="input_text" value="<?php echo $newArray1['serial_no'] ?>" style="width: 250px;" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <td>Stock in Date</td>
                        <td><input type="text" class="input_text"style="width: 250px" id="e_in_date"  value="<?php echo $newArray1['stock_in_date'] ?>" disabled="disabled" /></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td><input type="text" id="e_category" class="input_text" style="width: 250px;" readonly="readonly" value="<?php echo $row['name'] ?>"/></td>
                    </tr>
                    <tr>
                        <td>Is Active</td>
                        <td>
                            <?php if ($newArray1['is_active'] == "Y") { ?>
                                <input type="radio" id="e_active" name="active" value="Y" checked disabled="disabled" />Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="e_active" name="active" value="N" disabled="disabled"/>No
                            <?php } else { ?>
                                <input type="radio" id="e_active" name="active" value="Y" disabled="disabled"/>Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="e_active" name="active" value="N" checked disabled="disabled"/>No
                            <?php } ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br/><br/>
    <?php } ?>
    <div class="header_text">
        <span>Company Asset List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Name</th>
                        <th style="width: 200px;">Serial No.</th>
                        <th style="width: 200px;">Category</th>
                        <th style="width: 120px;">Stock In Date</th>
                        <th style="width: 100px;">Active Status</th>
                        <th class="aligncentertable" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT *, p.id AS pid
                FROM property AS p
                INNER JOIN property_category AS c
                ON p.category_id = c.id;";
                $sql_result = mysql_query($sql);

                while ($newArray = mysql_fetch_array($sql_result)) {
                    $i = $i + 1;
                    $active = ($newArray['is_active'] == "Y") ? "Yes" : "No";
                    echo"<tr class='plugintr'>
                    <td>" . $i . "</td>
                    <td>" . $newArray['property_name'] . "</td>
                    <td>" . $newArray['serial_no'] . "</td>
                    <td>" . $newArray['name'] . "</td>
                    <td>" . date('d-m-Y',strtotime($newArray['stock_in_date'])) . "</td>
                    <td>" . $active . "</td>";
                    if ($igen_a_m == "a_m_edit") {
                        echo "<td class='aligncentertable'>
                    <a title='Edit' style='font-size: 10pt;color:blue;' onclick='edit(" . $newArray['pid'] . ")'><i class='far fa-edit' style='color:#000;'></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title='Delete' style='font-size: 10pt;color:blue;' onclick='del(" . $newArray['pid'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>
                    </td>";
                    } elseif ($igen_a_m == "a_m_view") {
                        echo "<td class='aligncentertable'>
                    <a title='View' style='font-size: 10pt;color:blue;' onclick='view(" . $newArray['pid'] . ")'><i class='far fa-eye' aria-hidden='true'></i></a>
                    </td>";
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
        window.location="?loc=property_maintain&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=property_maintain';
    }
    function save_func(){
        var name = document.getElementById("name").value;
        var serial = document.getElementById("serial").value;
        var in_date = document.getElementById("in_date").value;
        var category = document.getElementById("category").value;
        var active = $("#active:checked").val();
        var spec = document.getElementById("spec").value;
        
        var error1 = [];
        var error3 = [];
        
        if(name == '' || name == ' '){
            error1.push("Property Name");
        }
        if(serial == '' || serial == ' '){
            error1.push("Serial No.");
        }
        if(in_date == '' || in_date == ' '){
            error1.push("Stock in Date");
        }
        if(category == 0){
            error3.push("Category");
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
                type:"POST",
                url:"?widget=propertyadd",
                data:{
                    name:name,
                    serial:serial,
                    in_date:in_date,
                    category:category,
                    active:active,
                    spec:spec
                },
                success:function(data){
                    if(data == true){
                        alert("Property Added");
                        window.location = '?loc=property_maintain';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }

    $(function() {
        $("#in_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
    $(function() {
        $("#e_in_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
    
    function edit(pid){
        window.location = "?loc=property_maintain&pid=" + pid;
    }
    
    function e_save_func(id){
        var name = document.getElementById("e_name").value;
        var serial = document.getElementById("e_serial").value;
        var in_date = document.getElementById("e_in_date").value;
        var category = document.getElementById("e_category").value;
        var active = $("#e_active:checked").val();
        var spec = document.getElementById("e_spec").value;
        var error1 = [];
        var error3 = [];
        
        if(name == '' || name == ' '){
            error1.push("Property Name");
        }
        if(serial == '' || serial == ' '){
            error1.push("Serial No.");
        }
        if(in_date == '' || in_date == ' '){
            error1.push("Stock in Date");
        }
        if(category == 0){
            error3.push("Category");
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
                type:"POST",
                url:"?widget=editproperty",
                data:{
                    name:name,
                    serial:serial,
                    in_date:in_date,
                    category:category,
                    active:active,
                    spec:spec,
                    id:id
                },
                success:function(data){
                    if(data == true){
                        alert("Property Updated");
                        window.location = "?loc=property_maintain";
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }
    function del(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=del_property",
                data:{
                    id:id
                },
                success:function(data){
                    if(data == true){
                        alert("Property Deleted");
                        window.location = '?loc=property_maintain';
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