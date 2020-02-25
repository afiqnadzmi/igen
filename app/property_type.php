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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Company Asset Type Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">  

    <?php if ($igen_a_m == "a_m_edit") { ?>
        <div class="header_text">Company Asset Type Maintenance</div>
        <div class="main_content">
            <div class="tablediv">

                <?php
                if (isset($_GET['pid']) == true) {
                    $sql_result1 = mysql_query("SELECT * FROM property_category WHERE id = " . $_GET['pid'] . ";");
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
                                <td style="width: 200px;">Company Asset Type</td>
                                <td><input id="e_name" type="text" class="input_text" value="<?php echo $newArray1['name'] ?>" style="width: 250px;" /></td>
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
                            <td style="width: 200px;">Company Asset Type</td>
                            <td><input id="name" type="text" class="input_text" style="width: 250px;"/></td>
                        </tr>
                    </table>
                <?php } ?>
            </div>
        </div>
        <br/><br/>
        <?php
    } elseif ($igen_a_m == "a_m_view") {
        $sql1 = "SELECT * FROM property_category WHERE id = " . $_GET['view_id'];
        $query1 = mysql_query($sql1);
        $newArray1 = mysql_fetch_array($query1);
        ?>
        <div class="header_text">Company Asset Type Maintenance</div>
        <div class="main_content">
            <div class="tablediv">
                <table>
                    <tr>
                        <td style="width: 200px;">Name</td>
                        <td><input id="e_name" type="text" class="input_text" value="<?php echo $newArray1['name'] ?>" style="width: 250px;" readonly="readonly" /></td>
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
                        <th>Company Asset Type</th>
                        <th class="aligncentertable" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM property_category";
                $sql_result = mysql_query($sql);

                while ($newArray = mysql_fetch_array($sql_result)) {
                    $i = $i + 1;
                    echo"<tr class='plugintr'>
                    <td>" . $i . "</td>
                    <td>" . $newArray['name'] . "</td>";
                    if ($igen_a_m == "a_m_edit") {
                        echo "<td class='aligncentertable'>
                    <a title='Edit' style='font-size: 10pt;color:blue;' onclick='edit(" . $newArray['id'] . ")'><i class='far fa-edit' style='color:#000;' ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title='Delete' style='font-size: 10pt;color:blue;' onclick='del(" . $newArray['id'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a></a>
                    </td>";
                    } elseif ($igen_a_m == "a_m_view") {
                        echo "<td class='aligncentertable'>
                    <a style='font-size: 10pt;color:blue;' onclick='view(" . $newArray['id'] . ")'><i class='far fa-eye' aria-hidden='true'></i></a>
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
        window.location="?loc=property_type&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=property_type';
    }
    function save_func(){
        var name = document.getElementById("name").value;
        
        var error1 = [];
        
        if(name == '' || name == ' '){
            error1.push("Property Type");
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
                type:"POST",
                url:"?widget=propertyType",
                data:{
                    name:name,
                    action:"add"
                },
                success:function(data){
                    if(data == true){
                        alert("Property Type Added");
                        window.location = '?loc=property_type';
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
            dateFormat: 'yy-mm-dd'
        });
    });
    $(function() {
        $("#e_in_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
    
    function edit(pid){
        window.location = "?loc=property_type&pid=" + pid;
    }
    
    function e_save_func(id){
        var name = document.getElementById("e_name").value;
        
        var error1 = [];
        
        if(name == '' || name == ' '){
            error1.push("Property Type");
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
                type:"POST",
                url:"?widget=propertyType",
                data:{
                    name:name,
                    id:id,
                    action:"edit"
                },
                success:function(data){
                    if(data == true){
                        alert("Property Type Updated");
                        window.location = "?loc=property_type";
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
                url:"?widget=propertyType",
                data:{
                    id:id,
                    action:"del"
                },
                success:function(data){
                    if(data == true){
                        alert("Property Type Deleted");
                        window.location = '?loc=property_type';
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