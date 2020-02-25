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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Benefits Entitled Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
    <?php if ($igen_a_m == "a_m_edit") { ?>
        <div class="header_text">Benefits Entitled Maintenance</div>
        <div class="main_content">
            <div class="tablediv">
                <?php
                if (isset($_GET['aid']) == true) {
                    $sql_result = mysql_query("SELECT * FROM benefits WHERE id = " . $_GET['aid'] . ";");
                    while ($newArray1 = mysql_fetch_array($sql_result)) {
                        ?>
                        <table>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="button" value="Save" style="width:70px;" onclick="e_save_func(<?php echo $_GET['aid'] ?>)"/>
                                    <input type="button" class="button" value="Clear" style="width:70px;" onclick="clearNew()"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px;">Benefits Name</td>
                                <td><input id="e_name" class="input_text" type="text" value="<?php echo $newArray1['name'] ?>" style="width: 250px;"/></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><textarea style="height:100px;width:250px;" class="input_textarea" id="e_spec"><?php echo $newArray1['description'] ?></textarea></td>
                            </tr>
                         
                        </table>
                    <?php }
                } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" style="width:70px;" onclick="save_func()"/>
                                <input type="button" class="button" value="Clear" style="width:70px;" onclick="clearNew()"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:200px;">Name</td>
                            <td><input id="name" type="text" class="input_text" type="text" style="width: 250px;"/></td>
                        </tr>
                        <tr>
                                <td>Description</td>
                                <td><textarea style="height:100px;width:250px;" class="input_textarea" id="spec"></textarea></td>
                            </tr>
           
                    </table>
                <?php } ?>
            </div>
        </div>
        <br/><br/>                                
        <?php
    } elseif ($igen_a_m == "a_m_view") {
        $sql = 'SELECT * FROM claim_payroll WHERE id = ' . $_GET['view_id'];
        $query = mysql_query($sql);
        $row = mysql_fetch_array($query);
        ?>
        <div class="header_text">Benefits Entitled Maintenance</div>
        <div class="main_content">
            <div class="tablediv">
                <table>
                    <tr>
                        <td style="width:200px;">Benefits Name</td>
                        <td><input id="name" type="text" class="input_text" type="text" style="width: 250px;" value="<?php echo $row["claim_name"]; ?>" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                         <td><textarea style="height:100px;width:250px;" class="input_textarea" id="spec"><?php echo $newArray1['specification'] ?></textarea></td>
                    </tr>
                   
                </table>
            </div>
        </div>
        <br/><br/>   
    <?php } ?>
    <div class="header_text">
        <span>Benefits Entitled List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Benefits Name</th>
                        <th style="width: 500px;">Description</th>
            
                        <th class="aligncentertable" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM benefits";
                $sql_result = mysql_query($sql);

                while ($newArray = mysql_fetch_array($sql_result)) {
                    $i = $i + 1;
                    echo "<tr class='plugintr'>
                    <td>" . $i . "</td>
                    <td>" . $newArray['name'] . "</td>
                    <td>" .$newArray['description']. "</td>
                    <td class='aligncentertable'>";
                    if ($igen_a_m == "a_m_edit") {
                        echo "<a onclick='edit(" . $newArray['id'] . ")'><i class='far fa-edit' style='color:#000;'></i></a>&nbsp;|&nbsp;<a onclick='del(" . $newArray['id'] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>";
                    } 
                    echo "</td></tr>";
                }
                ?>
            </table>
			
        </div>
    </div>
</p></div></div></div>

<script type="text/javascript">
    function view(id){
        window.location="?loc=benefits_entitlement&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=benefits_entitlement';
    }
    function edit(id){
        window.location="?loc=benefits_entitlement&aid=" + id;
    }

    function del(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=benefitsadd",
                data:{
                    id:id,
					action:'del'
                },
                success:function(data){
                    if(data == true){
                        alert("Benefits Deleted");
                        window.location = '?loc=benefits_entitlement';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }

    function save_func(){
        var name = document.getElementById("name").value;
        var desc = document.getElementById("spec").value;

        var error1 = [];
        if(name == '' || name == ' '){
            error1.push("Name");
        }
        if(desc == '' || desc == ' '){
            error1.push("Description");
        }
      
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        
        var data1 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
                
        if(error1.length > 0){
            alert(data1);
        }else{
            $.ajax({
                type:"POST",
                url:"?widget=benefitsadd",
                data:{
                    name:name,
                    desc:desc
                },
                success:function(data){
                    if(data == true){
                        alert("Benefits Added");
                        window.location = '?loc=benefits_entitlement';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }

    function e_save_func(id){
        var name = document.getElementById("e_name").value;
        var desc = document.getElementById("e_spec").value;
        var error1 = [];
        var error2 = [];
        if(name == '' || name == ' '){
            error1.push("Name");
        }
        if(desc == '' || desc == ' '){
            error1.push("Description");
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
            
        var data1 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
             
        if(error1.length > 0){
            alert(data1);
        }else{
            $.ajax({
                type:"POST",
                url:"?widget=benefitsadd",
                data:{
                    name:name,
                    desc:desc,
					id:id,
					action:'edit'
                },
                success:function(data){
                    if(data == true){
                        alert("Benefits Updated");
                        window.location = "?loc=benefits_entitlement";
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