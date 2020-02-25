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
    });
</script>

<div class="main_div">
   	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Holiday Group Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Holiday Group Maintenance</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <table>
                <tr>
                    <td colspan="2">
                        <input type="button" class="button" value="Add" onclick="addgroup()" style="width: 70px;" />
                        <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 200px;">Group Name</td>
                    <td><input class="input_text" type="text" id="grp_name" style="width: 250px"/></td>
                </tr>
                <tr>
                    <td>Group Description</td>
                    <td><input class="input_text" type="text" id="grp_desc" style="width: 250px"/></td>
                </tr>   
            </table>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Holiday Group List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th style="width:150px">Group Name</th>
                        <th>Group Description</th>
                        <th class="aligncenter" style="width:100px">Count</th>
                        <th style="width: 100px;" class="aligncentertable">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * FROM holiday_group';
                $rs = mysql_query($sql);

                while ($row = mysql_fetch_array($rs)) {
                    $i = $i + 1;
                    $group_name = $row['group_name'];
                    $group_desc = $row['group_desc'];
                    $holi_grp_id = $row['id'];
                    $sql2 = 'select * from branch where holi_group_id = ' . $holi_grp_id . '';
                    $rs2 = mysql_query($sql2);
                    $row_count = mysql_num_rows($rs2);

                    echo'<tr class="plugintr">
                        <td>' . $i . '</td>
                        <td>' . $group_name . '</td>
                        <td>' . $group_desc . '</td>
                        <td class="aligncenter">' . $row_count . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="Edit" href="javascript:void()" onclick="edit(' . $holi_grp_id . ')"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title="Delete" href="javascript:void()" onclick="deleteholiday(' . $holi_grp_id . ',' . $row_count . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a href="javascript:void()" onclick="view(' . $holi_grp_id . ')"><i class="far fa-eye" aria-hidden="true"></i></a></td>';
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
        window.location="?loc=holiday_group_edit&view_id=" + id;
    }
    function clearNew(){
        window.location="?loc=holiday_group_management";
    }
    function edit(id){
        window.location = "?loc=holiday_group_edit&holi_grp_id=" + id;
    }
    
    function addgroup(){
        var grp_name = $('#grp_name').val();
        var grp_desc = $('#grp_desc').val();
        
        var error1 = [];
        
        if(grp_name == "" || grp_name == " "){
            error1.push("Group Name");
        }
        if(grp_desc == "" || grp_desc == " "){
            error1.push("Description");
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
                url:"?widget=addholiday_grp",
                data:{
                    grp_name:grp_name,
                    grp_desc:grp_desc
                },
                success:function(data){
                    if(data==true){
                        alert("Holiday Group Added");
                        window.location='?loc=holiday_group_management';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
    }
    
    function deleteholiday(id,num_row){

        var result = confirm("Are you sure you want to delete this record?");
        
        if(result == true){
            if(num_row <= 0){
                $.ajax({
                    type:'POST',
                    url:'?widget=deleteholiday_grp',
                    data:{
                        id:id
                    },
                    success:function(data){
                        if(data==true){
                            alert("Holiday Group Deleted");
                            window.location='?loc=holiday_group_management';
                        }else{
                            alert('Error While Processing');
                        }
                    }
                })
            }else{
                alert("Holiday Group Can't be Deleted");
            }
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