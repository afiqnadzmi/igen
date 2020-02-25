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
        oTable = $('#tablecolor1').dataTable({ 
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
        $("#img1").load(function(){
            $("#img1msg").text("");
        })
    } );
</script>

<div class="main_div">
   		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Bank Maintenance</a>
					</h4>
				</div>
		</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
    <div class="header_text">
        <span>Bank Maintenance</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <?php
                if (isset($_GET['id']) == true) {
                    $company_id = $_GET['id'];

                    $sql = 'SELECT * FROM bank WHERE id=' . $company_id;
                    $rs = mysql_query($sql);
                    $row = mysql_fetch_array($rs);
                
                    ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Save" onclick="savecompany(<?php echo $company_id ?>)" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                            <td><span></span></td>
                        </tr>   
                        <tr>
                            <td style="width: 200px;">Bank Code</td>
                            <td><input type="text" value="<?php echo $row['code'] ?>" id="company_code" style="width: 250px"/></td>
                           
                        </tr>

                        <tr>
						<td style="vertical-align: top;">Bank Name</td>
						<td> <select style="width:250px;" id="company_name">
                                        <option value="" >--Please Select--</option>
                                        <option value="Affin Bank" <?php if($row['name']=="Affin Bank"){echo"selected";} ?>>Affin Bank</option>
                                        <option value="AmBank" <?php if($row['name']=="AmBank"){echo"selected";} ?>>AmBank</option>
                                        <option value="Cimb Bank" <?php if($row['name']=="Cimb Bank"){echo"selected";} ?>>Cimb Bank</option>
                                        <option value="Hong Leong Bank" <?php if($row['name']=="Hong Leong Bank"){echo"selected";} ?>>Hong Leong Bank</option>
                                        <option value="Maybank" <?php if($row['name']=="Maybank"){echo"selected";} ?>>Maybank</option>
										<option value="Public Bank" <?php if($row['name']=="Public Bank"){echo"selected";} ?>>Public Bank</option>
										<option value="RHB Bank" <?php if($row['name']=="RHB Bank"){echo"selected";} ?>>RHB Bank</option>
                                    </select></td>
                            
                               
                        </tr>

                       
                    </table>
                <?php } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" onclick="addcompany()" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Bank Code</td>
                            <td><input type="text" id="company_code" style="width: 250px"/></td>
                        </tr>

                        <tr>
						<td style="vertical-align: top;">Bank Name</td>
						<td> <select style="width:250px;" id="company_name">
                                        <option value="" >--Please Select--</option>
                                        <option value="Affin Bank">Affin Bank</option>
                                        <option value="AmBank">AmBank</option>
                                        <option value="Cimb Bank">Cimb Bank</option>
                                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                                        <option value="Maybank">Maybank</option>
										<option value="Public Bank">Public Bank</option>
										<option value="RHB Bank">RHB Bank</option>
                                    </select></td>
                            
                               
                        </tr>

                        
                    </table>
                <?php } ?>
                <?php
            }
			?>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Bank List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor1" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width:30px">No.</th>
                        <th style="width:200px">Bank Code</th>
                        <th>Bank Name</th>
                        
                        <th class='aligncentertable' style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * FROM bank';
                $rs = mysql_query($sql);
                while ($row = mysql_fetch_array($rs)) {
                    $i = $i + 1;
                    $bank_id = $row['id'];
                    $bank_code = $row['code'];
                    $bank_name = $row['name'];
                   
                    echo '<tr class="plugintr">
                          <td>' . $i . '</td>
                          <td>' . $bank_code . '</td>
                          <td>' . $bank_name . '</td>';
                        
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="Edit" href="?loc=bank_management&id=' . $bank_id . '"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title="Delete" onclick="deletecompany(' . $bank_id . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a href="?loc=bank_management&view_id=' . $bank_id . '">View</a></td>';
                    }
                    echo '</tr>';
                }
                ?>  
            </table>
        </div>
    </div>
</p></div></div></div>

<script type="text/javascript">

    
    function clearNew(){
        window.location='?loc=bank_management';
    }
    function addcompany()
    {
        var company_code = $('#company_code').val();
        var company_name = $('#company_name').val();
       
        var error1 = [];
      
        
        if(company_code == '' || company_code == ' '){
            error1.push("Bank Code");
        }
        if(company_name == '' || company_name == ' '){
            error1.push("Bank Name");
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
                type:'POST',
                url:"?widget=addbank",
                data:{
                    action:"add",
                    company_code:company_code,
                    company_name:company_name
                    
                },
                success:function(data){
				if(data!=1){
				if(data==2){
                        alert("bank Added");
						window.location='?loc=bank_management';
				}else{
						alert("Error While Processing");
						
						}
						}else{
						alert("the bank name is already exist in the database")
						
						}
						
                }
            });
        }
    }
    
    function deletecompany(id){

        var result = confirm("Are you sure you want to delete this record?");
        
        if(result){
            
                $.ajax({
                    type:'POST',
                    url:'?widget=addbank',
                    data:{
                        action:"del",
                        id:id
                    },
                    success:function(data){
					
                        if(data==1){
						
                            alert("Bank Deleted");
                            window.location='?loc=bank_management';
                        }else{
                            alert('Error While Processing');
                        }
                    }
                })
            }
        }
    function savecompany(id){
        var company_code = $('#company_code').val();
        var company_name = $('#company_name').val();
       var id=id;
	  
        var error1 = [];
        var error2 = [];
        
        if(company_code == '' || company_code == ' '){
            error1.push("Bank Code");
        }
        if(company_name == '' || company_name == ' '){
            error1.push("Bank Name");
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
                dataType:'json',
                type:'POST',
                url:"?widget=addbank",
                data:{
                    action:"edit",
                    company_code:company_code,
                    company_name:company_name,
					id:id
					
                    
                },
                success:function(data){
				
				 
                    if(data == 1){
                        alert("Bank Updated");
                        window.location='?loc=bank_management';
                    }else{
                        alert('Error While Processing');
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